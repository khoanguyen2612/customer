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

    public $uses = array('Wallet', 'Order', 'OrderDetail', 'Product', 'Account', 'DepositHistory', );
    public $components = array('Acl', 'RequestHandler');
    public $helpers = array('Html', 'Form', 'Js' => array('Jquery'), 'Session');

    function beforeFilter()
    {
        parent::beforeFilter();
        // for debug
        Configure::write('Cache.disable', true);
        Configure::write('debug', 2);

        // check is login
        $_is_login = $this->Wallet->user_info();
        if (count($_is_login) == 0) {
            $this->Session->setFlash('Bạn chưa Login.');
            $this->redirect(array("controller" => "users",
                    "action" => "login",
                )
            );
        }
        //Menu information
        $user = $this->Wallet->user_info();
        $name = (isset($user) && count($user)) ? $user['lname'] : 'Bạn chưa login';
        $this->set(compact('name'));
        // wallet account deposit, point
        $deposit = (isset($user) && count($user)) ? $user['deposit'] : 0;
        $_record_dep = $this->Account->find('first',
            array('fields' => array('Account.id', 'deposit', 'lname', 'credit'),
                'conditions' => array('Account.id =' => $user['id']),
                'recursive' => 0,
            )
        );
        $deposit = $_record_dep['Account']['deposit'];
        $this->set(compact('deposit'));
        // wallet account deposit, point
        $_record_dep = $this->DepositHistory->find('all',
            array('fields' => array('DepositHistory.id', 'account_id', 'tong_nap', 'SUM(DepositHistory.tong_nap) as deposit_total'),
                'conditions' => array('DepositHistory.account_id =' => $user['id'] ),
                'recursive' => 0,
                'group' => array('account_id'), // fields to GROUP BY
            )
        );

        $deposit_total = (count($_record_dep) > 0) ? $_record_dep[0][0]['deposit_total'] : 0;
        $this->set(compact('deposit_total'));
        // wallet account deposit, point
        $total_point = (isset($user) && count($user)) ? $user['total_point'] : 0;
        $this->set(compact('total_point'));
        $credit = (isset($user) && count($user)) ? $user['credit'] : 0;
        $this->set(compact('credit'));
        // wallet account total product
        $total_product = $this->Wallet->get_count_product();
        $this->set(compact('total_product'));
        //Menu information


        $this->Order->setDataSource('default');
        $current_p = $this->Wallet->get_current_product();

        if ($current_p == 0) {
            $this->Session->delete('order_code');
        }

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

        $_tmp = $this->Session->read('order_code');
        if ( !isset($_tmp) || is_null($_tmp) ) {
            $this->Session->write('order_code', 'MSHĐ_A'. rand(11111111, 22222222). 'Z'. rand(11111111, 22222222));
        }

        $this->layout = 'home';
    }


    public function index()
    {

        $order_schema = $this->Wallet->rWalletProduct();
        $order = $order_code = $order_id = $_product_order = null;

        if (count($order_schema)) {
            $order = $order_schema['Order'];
            $order_code = $order['order_code'];
            $order_id = $order['id'];
            $_product_order = $order_schema['Orderdetail'];
        }

        $total_money = 0;
        $products = array();

        if (count($_product_order) > 0)
            foreach ($_product_order as $p_item) {
                $this->Product->recursive = 2;
                $_p_tbl = $this->Product->findById($p_item['product_id']);
                if (count($_p_tbl) > 0) {
                    //(1:domain, 2:window hosting, 3:linux hosting, 4:other, 5:Cloud Storage )
                    $type = $_p_tbl['Product']['product_type'];
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
                        case '5':
                            $p_type = 'Cloud Storage';
                            break;
                        default :
                            $p_type = 'Other';
                            break;
                    }
                    $p_item['type'] = $p_type;
                    $products[] = $p_item;
                }
            }
        // set total money
        if (count($_product_order) > 0) {
            foreach ($_product_order as $p_item) {
                $total_money += $p_item['price'];
            }
        }

        $this->Session->delete('total_money');
        $this->Session->write('total_money', $total_money);

        $this->set(compact('total_money'));
        $this->set(compact('products'));

        $this->set(compact('order_id'));
        //$this->set(compact('order'));
        $this->set(compact('order_code'));
        //Debugger::dump($order_schema);
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
        CakeLog::warning('orders cart stream', 'orders');
        CakeLog::warning('payments streams', 'payment');
        //CakeLog::warning('This gets written to both cart and payments streams', 'unknown');
    }

}
