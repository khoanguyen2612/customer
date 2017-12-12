<?php

/******************************************************************************
 * tue.phpmailer@gmail.com                                                    *
 ******************************************************************************/

App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');

/**
 * Class CartsController
 */
class CartsController extends AppController
{

    /**
     * @var array
     */
    //var $layout = 'cart';

    public $uses = array('Product', 'Cart', 'Order', 'OrderDetail');
    public $components = array('Acl', 'RequestHandler');
    public $helpers = array('Html', 'Form', 'Js' => array('Jquery'), 'Session');
    var $session_cart = array();

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = 'cart';

        // Change layout for Ajax requests
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax_cart';
        }

        $n_item_cart = $this->Cart->getCount();

        if ($n_item_cart == 0) {
            $this->Session->delete('order_code');
        }

        $cart = $this->Cart->readCart();
        $this->Session->write('total_money', 0);

        if (isset($cart) && !is_null($cart)) {

            if (isset($cart['list']))
                $all_item = array_shift($cart);  // shift an element off the beginning of array
            else
                $all_item = $cart;

            $total_money = 0;
            $products = $all_item;

            if (count($products) > 0) {
                foreach ($products as $it) {
                    $total_money += $it['price'] * $it['quantity'];
                }
            }

            $this->Session->delete('total_money');
            $this->Session->write('total_money', $total_money);
        }

        $this->Order->setDataSource('db_vtc_cloud');
        $this->Product->setDataSource('db_vtc_cloud');
        $this->OrderDetail->setDataSource('db_vtc_cloud');

        //$this->Order->recursive = -1;
        //$order_schema = $this->Order->findById('614'); // 1430, 614, 1477 high total cost money
        //$order = $order_schema['Order'];
        // load count sum element of item
        //$this->Session->delete('order_code');

        $_tmp = $this->Session->read('order_code');
        //Debugger::dump($_tmp);
        if ( !isset($_tmp) || is_null($_tmp) ) {
            $this->Session->write('order_code', 'MSHĐ_A'. rand(11111111, 22222222). 'Z'. rand(11111111, 22222222));
        }


    }

    public function add()
    {
        $this->autoRender = false;

        if ($this->request->is('post')) {

            $this->Cart->addProduct($this->request->data['cart']);

        }

        echo $this->Cart->getCount();
    }

    /* add domain to cart in ProductPrice controller, register_domain.ctp, result_search.ctp */
    public function add_domain()
    {


        $request = $this->request->data;

        $checkbox = $this->Session->read('checkbox');

        $this->autoRender = false;
        $this->request->onlyAllow('ajax'); // No direct access via browser URL

        if ($this->RequestHandler->isAjax()) {
            Configure::write('debug', 2);
        }


        //Debugger::dump($this->Order->findById($request['cart']['order']['id']));
        $cart = array();
        $cart = $request; //$cart = $request['cart'];

        $cart['order']['id'] = 614;  // 1430, 614, 1477 high total cost money  // $this->Order->findById($request['cart']['order']['id'])
        $cart['product']['id'] = 171; // 171 --> Domain SSL - Standard, 172 --> Domain SSL - WildCard, product tbl DB

        if ($this->request->is('post')) {
            if (!empty($request) && count($request) > 0 && count($request['product'] > 0)) {

                // define 1 product in order detail item to add on to cart,
                // for Database
                $order_detail['id'] = rand(95000, 99999);  // new id for item in OrderDetail on to session Cart

                $order_detail['order_id'] = $cart['order']['id'];
                $order_detail['product_id'] = $cart['product']['id']; // 171 --> Domain SSL - Standard, 172 --> Domain SSL - WildCard,
                $order_detail['domain_name'] = $cart['product']['product_name'];
                $order_detail['action_id'] = 0;
                $order_detail['order_type'] = 1;
                $order_detail['order_dtl_status'] = 1;
                $order_detail['price'] = $cart['product']['price']; // int
                $order_detail['quantity'] = 1; // $cart['product']['quantity'];;  // int
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
                switch ((string)$cart['product']['product_type']) {
                    case '7':
                        $p_type = 'Domain SSL - Standard';
                        break;
                    default :
                        $p_type = 'Domain SSL - WildCard';
                        break;
                }

                $order_detail['product_type'] = $cart['product']['product_type'];
                $order_detail['product_name'] = $cart['product']['product_name'];
                // for view layout
                $order_detail['type'] = $p_type;
                // addon year in product
                $order_detail['year'] = 1;

                //add to cart
                $cart['product'] = $order_detail;

            }

            if (is_null($checkbox) || empty($checkbox) || is_null($checkbox[$cart['checkbox']['id']])) {
                $checkbox[$cart['checkbox']['id']] = $cart['checkbox']['id'];
                $this->Session->write('checkbox', $checkbox);
                $this->Cart->addProduct($cart);
            }

        }

        $this->response->body(json_encode($cart));
        $this->response->send();
        $this->_stop();

    }

    /* add domain to cart in ProductPrice controller, register_domain.ctp, result_search.ctp */
    public function do_in_cart() {
        $this->redirect(array("controller" => "carts",
                "action" => "view",
            )
        );
    }

    public function view($param = null)
    {

        ini_set('memory_limit', '-1');

        // to view layout
        $order_id = '614'; // example
        $order_code = $this->Session->read('order_code');

        $cart = $this->Cart->readCart();
        // load count sum element of item
        $n_item_cart = $this->Cart->getCount();

        if ($n_item_cart == 0) {
            // Create new Order to DB
            $order = array();
            //$order['order_code'] = $this->Session->read('order_code');
        }

        /* DONT LOAD EXIST PRODUCT IN DB */
        /*$order_schema = $this->Order->findById('614'); // 1430, 614, 1477 high total cost money
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
            // re soft list key of array
            // sort($cart);

            // List product exist in order db
            // $this->Cart->saveCart($cart);
            // don'n load exist product
        };*/

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
        // Not load exist from db
        //$products = array();

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

    public function continue_buy_product()
    {
        $this->autoRender = false;

        $this->redirect(array("controller" => "home",
                "action" => "index",
            )
        );

    }

    public function payment()
    {
        // Check product in cart shopping

        $n_item_cart = $this->Cart->getCount();

        if ( is_null($n_item_cart) || $n_item_cart == 0 ) {
            //$this->autoRender = false;

            // In the controller cart .
            $this->Session->setFlash('Lets by sell own\' production, please !');

            $this->redirect(array("controller" => "carts",
                    "action" => "view",
                )
            );
        }

        $id_acc = $this->Auth->User('id');
        $user_info = $this->Account->findById($id_acc);
        $name = $user_info['Account']['name'];

        $res = $this->request->data;

        if ($this->request->is('post') || $this->request->is('get')) {

            $order_code = $this->Session->read('order_code');
            $total_money = $this->Session->read('total_money');
            $total_payment = $total_money - round($total_money * 10 / 100);

            $this->set(compact('n_item_cart'));
            $this->set(compact('name'));
            $this->set(compact('order_code'));
            $this->set(compact('total_payment'));
        }

    }

    public function accept_payment()
    {

        // Check product in cart shopping
        $n_item_cart = $this->Cart->getCount();

        if ( is_null($n_item_cart) || $n_item_cart == 0 ) {

            //$this->autoRender = false;

            // In the controller cart .
            $this->Session->setFlash('Lets by sell own\' production, please !');

            $this->redirect(array("controller" => "carts",
                    "action" => "view",
                )
            );

        }

        $id_acc = $this->Auth->User('id');
        $user_info = $this->Account->findById($id_acc);
        $name = $user_info['Account']['name'];

        $res = $this->request->data;

        // add current input money
        $add_curent_money = (isset( $res['Payment']) )? $res['Payment']['add_curent_money'] : 0;

        if ($this->request->is('post') || $this->request->is('get')) {

            $order_code = $this->Session->read('order_code');
            $total_money = $this->Session->read('total_money');
            $total_payment = $total_money - round($total_money * 10 / 100);

            $this->set(compact('n_item_cart'));
            $this->set(compact('name'));
            $this->set(compact('add_curent_money'));
            $this->set(compact('order_code'));
            $this->set(compact('total_payment'));

        }

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

            //header('Location: ' . $destinationUrl);

        }

    }

    public function finish()
    {

        // Check product in cart shopping
        $n_item_cart = $this->Cart->getCount();
        if ( is_null($n_item_cart) || $n_item_cart == 0 ) {
            // In the controller cart .
            $this->Session->setFlash('Lets by sell own\' production, please !');
            $this->redirect(array("controller" => "carts",
                    "action" => "view",
                )
            );
        }
        // Payment port return GET/POST
        // Check return in VTC redirect
        // URL is string return in VTC redirect
        $url_query = $this->request->query;
        // can also access it via an array
        //$url_return = $this->request->here;
        if ( count($url_query) > 0 ) {

            $id_acc = $this->Auth->User('id');
            $user_info = $this->Account->findById($id_acc);

            $u_name = $email = $cmtnd = $phone = '';

            if (count($user_info) > 0) {

                $u_name = $user_info['Account']['name'];
                $email = $user_info['Account']['email'];
                $cmtnd = $user_info['Account']['CMTND'];
                $phone = $user_info['Account']['phonenumber'];

            }

            $cart = $this->Cart->readCart();
            $products = isset($cart['list']) ? $cart['list'] : array() ;

            if ($this->request->is('post') || $this->request->is('get')) {

                $order_code = $this->Session->read('order_code');
                $total_money = $this->Session->read('total_money');

                $total_vat = round($total_money * 10 / 100);
                $total_payment = $total_money - round($total_money * 10 / 100);

                $date_day = CakeTime::format(date('Y/m/d'), '%Y/%m/%d', 'N/A', 'Asia/Ho_Chi_Minh');
                $time_h = CakeTime::format(date('H:i:s'), '%H:%M:%S', 'N/A', 'Asia/Ho_Chi_Minh');

                $this->set(compact('u_name'));
                $this->set(compact('email'));
                $this->set(compact('cmtnd'));
                $this->set(compact('phone'));

                $this->set(compact('products'));
                $this->set(compact('order_code'));
                $this->set(compact('total_money'));
                $this->set(compact('total_payment'));
                $this->set(compact('total_vat'));

                $this->set(compact('date_day'));
                $this->set(compact('time_h'));

                // This save Cart to DB
                try {
                    $this->Cart->saveDbCart();
                } catch (Exception $e) {
                    $this->Session->setFlash('Lỗi database MySQL: ' . $e->getMessage());
                }

            }

        } else {
            // In the controller cart .
            $this->Session->setFlash('Không nhận được phản hồi từ cổng thanh toán trực tuyến, vui lòng xem lại thông tin mua hàng hoặc liên hệ support.');
            $this->redirect(array("controller" => "carts",
                    "action" => "view",
                )
            );
        }

    }

    public function remove()
    {
        $this->autoRender = false;

        if ($this->request->is('post')) {
            $res = $this->request->data;
            if (count($res) > 0)
                $this->Cart->remove_it($res['id_odetail_product']);
        }

        $this->redirect(array("controller" => "carts",
                "action" => "view",
                //"param1" => "item_del",
            )
        );
    }

    public function del_ajax_it()
    {

        $this->autoRender = false;
        $this->request->onlyAllow('ajax'); // No direct access via browser URL

        if ($this->RequestHandler->isAjax()) {
            if ($this->request->is('post')) {
                $n_item = $this->Cart->getCount();
                $this->set(compact('n_item'));
                $this->render('ajax_up_i_cart', 'ajax_cart');
            }
        }

    }

    public function update_ajax_it()
    {

        $this->autoRender = false;
        $this->request->onlyAllow('ajax'); // No direct access via browser URL

        if ($this->RequestHandler->isAjax()) {
            if ($this->request->is('post')) {
                $n_item = $this->Cart->getCount();
                $this->set(compact('n_item'));
                $this->render('ajax_up_i_cart', 'ajax_cart');
            }
        }


    }

    public function update_ajax_sum_money()
    {

        $this->autoRender = false;
        $this->request->onlyAllow('ajax'); // No direct access via browser URL

        if ($this->RequestHandler->isAjax()) {
            Configure::write('debug', 0);
        }

        if ($this->RequestHandler->isAjax()) {
            if ($this->request->is('post')) {

                $cart = $this->Cart->readCart();

                if (isset($cart['list']))
                    $all_item = array_shift($cart);  // shift an element off the beginning of array
                else
                    $all_item = $cart;

                $total_money = 0;
                $products = $all_item;

                if (count($products) > 0) {
                    foreach ($products as $it) {
                        $total_money += $it['price'] * $it['quantity'];
                    }
                }

                $this->Session->delete('total_money');
                $this->Session->write('total_money', $total_money);

                $total_money_vat = round($total_money * 10 / 100);
                $total_money_finish = $total_money - $total_money_vat;

                $this->response->body(json_encode(array(
                    'total_money' =>  number_format( $total_money,0,',','.'),
                    'total_money_vat' => number_format( $total_money_vat,0,',','.'),
                    'total_money_finish' => number_format( $total_money_finish,0,',','.'),
                )));

                $this->response->send();
                $this->_stop();

            }
        }
    }

    public function ajax_otp_change_year_money()
    {

        $this->autoRender = false;
        $this->request->onlyAllow('ajax'); // No direct access via browser URL

        $resp = $this->request->data;

        if ($this->RequestHandler->isAjax()) {
            Configure::write('debug', 0);
        }

        if ($this->RequestHandler->isAjax()) {

            if ($this->request->is('post')) {

                $cart = $this->Cart->readCart();

                if (isset($cart['list']))
                    $all_item = array_shift($cart);  // shift an element off the beginning of array
                else
                    $all_item = $cart;

                $total_money = 0;
                $products = $all_item;

                if (count($products) > 0) {
                    foreach ($products as $it) {
                        $total_money += $it['price'] * $it['quantity'];
                    }
                }

                //total money for number year product
                $cost = $resp['price'];
                $year = $resp['year'];

                $total_money = $total_money;

                $this->Session->delete('total_money');
                $this->Session->write('total_money', $total_money);

                $total_money_vat = round($total_money * 10 / 100);
                $total_money_finish = $total_money - $total_money_vat;

                $this->response->body(json_encode(array(
                    'total_money' =>  number_format( $total_money,0,',','.'),
                    'total_money_vat' => number_format( $total_money_vat,0,',','.'),
                    'total_money_finish' => number_format( $total_money_finish,0,',','.'),
                )));

                $this->response->send();
                $this->_stop();

            }
        }
    }

    public function gif_code_daily_ajax_sum_money()
    {

        $this->autoRender = false;
        $this->request->onlyAllow('ajax'); // No direct access via browser URL
        $res = $this->request->data;

        if ($this->RequestHandler->isAjax()) {
            Configure::write('debug', 2);
        }

        if ($this->RequestHandler->isAjax()) {

            if ($this->request->is('post')) {

                if (isset($res['phone']))
                    $phone = $res['phone'];
                else
                    $phone = 'Lỗi số phone gif code';

                $l_phone[] = $phone;
                $this->Session->write('phone_gif', $l_phone);

                $this->response->body(json_encode(array(
                    'phone_gif' => $phone,
                    'status' => '0',
                ), JSON_UNESCAPED_UNICODE));

                $this->response->send();
                $this->_stop();

            }
        }

    }

    public function supporters_ajax()
    {

        $this->autoRender = false;
        $this->request->onlyAllow('ajax'); // No direct access via browser URL
        $res = $this->request->data;

        if ($this->RequestHandler->isAjax()) {
            Configure::write('debug', 2);
        }

        //Debugger::dump($this->request->is('post'));
        //Debugger::dump($this->RequestHandler->isAjax());
        //Debugger::dump($res);

        if ($this->RequestHandler->isAjax()) {

            if ($this->request->is('post')) {

                if (isset($res['phone']))
                    $phone = $res['phone'];
                else
                    $phone = 'Lỗi số phone support';

                $l_phone[] = $phone;
                $this->Session->write('phone_support', $l_phone);

                $this->response->body(json_encode(array(
                    'phone_support' => $phone,
                    'status' => '0',
                ), JSON_UNESCAPED_UNICODE));

                $this->response->send();
                $this->_stop();

            }
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

    public function checkout()
    {

        $this->autoRender = false;
        //$this->Cart->saveDbCart();

        $this->redirect(array("controller" => "carts",
                "action" => "register",
                //"param1" => "val1",
                //"param2" => "val2")
            )
        );
    }

}
