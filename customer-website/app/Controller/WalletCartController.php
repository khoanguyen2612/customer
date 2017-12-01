<?php

/******************************************************************************
 * tue.phpmailer@gmail.com                                                    *
 ******************************************************************************/

App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');

/**
 * Class CartsController
 */
class WalletCartController extends AppController
{
    /**
     * @var array
     */
    var $layout = 'banking_cart';
    var $session_cart = array();

    public $uses = array('Wallet', 'Order', 'OrderDetail', 'Product', );
    public $components = array('Acl', 'RequestHandler');
    public $helpers = array('Html', 'Form', 'Js' => array('Jquery'), 'Session');

    function beforeFilter()
    {
        parent::beforeFilter();
        $current_p = $this->Wallet->get_current_product();

        if ($current_p == 0) {
            $this->Session->delete('order_code');
        }

        $_wallet_product = $this->Wallet->rWalletProduct();

        $this->Session->write('total_money', 0);
        $total_money = 0;

        if (isset($_wallet_product) && !is_null($_wallet_product)) {
            if (count($_wallet_product) > 0) {
                foreach ($_wallet_product as $it) {
                    $total_money += $it['price'] * $it['quantity'];
                }
            }

            $this->Session->delete('total_money');
            $this->Session->write('total_money', $total_money);
        }

        $this->Order->setDataSource('default');

        $_tmp = $this->Session->read('order_code');

        if ( !isset($_tmp) || is_null($_tmp) ) {
            $this->Session->write('order_code', 'MSHĐ_A'. rand(11111111, 22222222). 'Z'. rand(11111111, 22222222));
        }

        $this->layout = 'home';

    }

    /* add domain to cart in ProductPrice controller, register_domain.ctp, result_search.ctp */
    public function do_in_cart() {
        $this->redirect(array("controller" => "carts",
                "action" => "view",
            )
        );
    }

    public function view()
    {

        $order_schema = $this->Order->findById('614'); // 1430, 614, 1477 high total cost money
        $order = $order_schema['Order'];
        $order_code = $order['order_code'];
        $order_id = $order['id'];
        $product_in_order = $order_schema['OrderDetail'];

        if (is_null($cart) || empty($cart) || !count($cart)) {
            foreach ($product_in_order as $p_item) {
                $this->Product->recursive = 2;
                $_p = $this->Product->findById($p_item['product_id']);

                if (count($_p) > 0) {
                    //(1:domain, 2:window hosting, 3:linux hosting, 4:other)
                    $type = $_p['Product']['product_type'];

                    switch ($type) {
                        case '1':
                            $p_type = 'Domain';
                            break;
                        case '2':
                            $p_type = 'Window hosting';
                            break;
                        case '3':
                            $p_type = 'Linux hosting';
                            break;
                        case '4':
                            $p_type = 'Other';
                            break;
                        default :
                            $p_type = 'Other';
                            break;
                    }

                    $p_item['type'] = $p_type;
                    $products[] = $p_item;
                }
            }

            $cart = array();
            foreach ($products as $item) {
                $cart['list'][] = $item;
                $tmp['order'] = array('id' => $order_id);
                $tmp['product'] = $item;

                //number year exp
                $tmp['year_exp'] = 1;
                //add new field
                $cart[] = $tmp;
            }
        };

        $conditions = array(
            'OR' => array(
                array('product_type' => '2'),
                array('product_type' => '3')
            )
        );

        $hosts = $this->Product->find('all', array(
                'fields' => array('id', 'product_type', 'product_key', 'product_type', 'product_name', 'price', 'price_1', 'price_2',),
                'conditions' => $conditions,
                'recursive' => 0,
                'limit' => 100,
            )
        );

        foreach ($hosts as $host) {
            $list_hosting[] = $host['Product'];
        }

        $total_money = 0;
        $cart = $this->Cart->readCart(); //Debugger::dump($cart);

        if (isset($cart['list']))
            $all_item = array_shift($cart);  // shift an element off the beginning of array
        else
            $all_item = $cart;

        $products = $all_item;

        if (count($products) > 0) {
            foreach ($products as $it) {
                $total_money += $it['price'] * $it['quantity'];
            }
        }

        $this->Session->delete('total_money');
        $this->Session->write('total_money', $total_money);

        $this->set(compact('n_item_cart'));
        $this->set(compact('total_money'));
        $this->set(compact('products'));

        $this->set(compact('order_id'));
        //$this->set(compact('order'));
        $this->set(compact('order_code'));
        $this->set(compact('list_hosting'));

    }

    public function update()
    {

        $request = $this->request->data;
        $this->autoRender = false;
        $this->request->onlyAllow('ajax'); // No direct access via browser URL

        $cart = isset($request['cart']) ? $request['cart'] : array();

        if ($this->request->is('post')) {
            if ( !empty($request) && count($request) > 0 && count($cart) > 0 ) {

                // define 1 product in order detail item to add on to cart,
                // for Database
                $order_detail['id'] = rand(95000, 99999);  // new id for item in OrderDetail on to session Cart
                // detail for Order detail
                $order_detail['order_id'] = null; // for new Order create, //$cart['order']['id'];
                $order_detail['product_id'] = $cart['product']['id'];
                $order_detail['domain_name'] = $cart['product']['product_name'];
                $order_detail['action_id'] = 0;
                $order_detail['order_type'] = 1;
                $order_detail['order_dtl_status'] = 1;
                $order_detail['price'] = $cart['product']['price']; // int
                $order_detail['quantity'] = $cart['product']['quantity'];;  // int
                $order_detail['amount'] = 0;
                $order_detail['total'] = 0;
                $order_detail['discount'] = 0;
                $order_detail['code_affilates'] = 'CODE_AFF_0321A';
                $order_detail['code_qc'] = 'CODE_QC_0321A';
                $order_detail['notes'] = 'Thông tin note khách hàng mua sản phẩm'; // string
                $order_detail['payment_method'] = 0;
                $date_getmoney = CakeTime::format(date('Y-m-d H:i:s'), '%Y-%m-%d %H:%M:%S', 'N/A', 'Asia/Ho_Chi_Minh');
                $order_detail['date_getmoney'] = $date_getmoney; // string, varchar
                $order_detail['money_kd'] = 0;
                $order_detail['flg_renew'] = 0;
                $order_detail['hosting_id'] = 0;
                $order_detail['customer_id'] = 0;
                $order_detail['campainh'] = 'ký tự, unknow value ?';  // varchar
                $order_detail['totenten'] = 'ký tự, unknow value ?';  // varchar
                $order_detail['csr_string'] = 'ký tự, unknow value ?';  // varchar
                $order_detail['payment_activator'] = 'Người active Payment'; // string
                $order_detail['auth_code_tranfer'] = 'ACT_0321A'; // string
                $order_detail['detail_id_sub'] = 0;
                $order_detail['flg_smartphone'] = 0;
                $order_detail['user_confirm_active'] = 'UCA_0321A'; // string
                $order_detail['ketoan_update'] = $date_getmoney;  // datetime
                $order_detail['note_ketoan'] = 'Ghi nhớ cho kế toán'; // string
                // Update field product of cart array
                // for view layout
                switch ( (string) $cart['product']['product_type']) {
                    case '1':
                        $p_type = 'Domain';
                        break;
                    case '2':
                        $p_type = 'Window hosting';
                        break;
                    case '3':
                        $p_type = 'Linux hosting';
                        break;
                    case '4':
                        $p_type = 'Other';
                        break;
                    case '5':
                        $p_type = 'Cloud Storage';
                        break;
                    default :
                        $p_type = 'Other';
                        break;
                }

                $order_detail['product_type'] = $cart['product']['product_type'];
                $order_detail['product_name'] = $cart['product']['product_name'];
                // for view layout
                $order_detail['type'] = $p_type;
                // for view layout
                //number year exp
                $order_detail['year_exp'] = 1;
                $order_detail['month_exp'] = 0;
                //add product to cart
                $cart['product'] = $order_detail;
            }
            $this->Cart->addProduct($cart);
        }

        $this->set(compact('cart'));
        $this->render('ajax_update', 'ajax_cart');

    }

    public function vtc_payment()
    {

        $this->autoRender = false;
        $res = $this->request->data;

        $destinationUrl = "http://alpha1.vtcpay.vn/portalgateway/checkout.html";

        if ($this->request->is('post')) {
            $plaintext = $res["txtTotalAmount"] . "|" .
                $res["txtCurency"] . "|" .
                $res["txtParamExt"] . "|" .
                $res["txtReceiveAccount"] . "|" .
                $res["txtOrderID"] . "|" .
                $res["txtUrlReturn"] . "|" .
                $res["txtWebsiteID"] . "|" .
                $res["txtSecret"];
            echo $plaintext;

            $sign = strtoupper(hash('sha256', $plaintext));
            $data = "?website_id=" .
                $res["txtWebsiteID"] . "&currency=" .
                $res["txtCurency"] . "&reference_number=" .
                $res["txtOrderID"] . "&amount=" .
                $res["txtTotalAmount"] . "&receiver_account=" .
                $res["txtReceiveAccount"] . "&url_return=" . urlencode($res["txtUrlReturn"]) . "&signature=" . $sign . "&payment_type=" . $res["txtParamExt"];
            $bill_to_surname = htmlentities($res["txtCustomerFirstName"]);
            $bill_to_forename = htmlentities($res["txtCustomerLastName"]);
            $bill_to_address = htmlentities($res["txtBillAddress"]);
            $bill_to_address_city = htmlentities($res["txtCity"]);
            $bill_to_email = htmlentities($res["txtCustomerEmail"]);
            $bill_to_phone = htmlentities($res["txtCustomerMobile"]);
            $language = htmlentities($res["txtParamLanguage"]);
            $destinationUrl = $destinationUrl . $data;
            echo "||||" . $destinationUrl;
            $this->redirect($destinationUrl);

        }
    }

    /*  ***************************** */
    /*  **  Write log to system   **  */
    /*  ** tue.phpmailer@gmail.com ** */
    /*  ***************************** */
    private function _log ($logs = array()) {
        /**
         * Configures default file logging options
         */
        App::uses('CakeLog', 'Log');
        // Configure tmp/logs/cart.log to receive the two configured types (log levels), but only
        // those with `orders` and `payments` as scope
        CakeLog::config('cart', array(
            'engine' => 'FileLog',
            'types' => array('warning', 'error'),
            'scopes' => array('orders', 'payments'),
            'file' => 'cart.log',
        ));
        // Configure tmp/logs/payments.log to receive the two configured types, but only
        // those with `payments` as scope
        CakeLog::config('payment', array(
            
            'engine' => 'SysLog',
            'types' => array('info', 'error', 'warning'),
            'scopes' => array('payment'),
            
        ));
        CakeLog::warning('This gets written only to cart stream', 'orders');
        CakeLog::warning('This gets written to both cart and payments streams', 'payment');
        CakeLog::warning('This gets written to both cart and payments streams', 'unknown');
        // CakeLog::emergency($message, $scope = array());
        // CakeLog::alert($message, $scope = array());
        // CakeLog::critical($message, $scope = array());
        // CakeLog::error($message, $scope = array());
        // CakeLog::warning($message, $scope = array());
        // CakeLog::notice($message, $scope = array());
        // CakeLog::info($message, $scope = array());
        // CakeLog::debug($message, $scope = array());
    }


}
