<?php
    /**
     * Created by TueNT
     * User: tue.phpmailer@gmail.com
     * Date: month 11/2017
     */

    App::uses('AppController', 'Controller');
    App::uses('CakeTime', 'Utility');

class WalletController extends AppController
{

    /**
     * @var array
     */
    var $layout = 'wallet';
    var $session_cart = array();

    public $uses = array('Order', 'OrderDetail', 'Wallet',);
    public $components = array('Acl', 'RequestHandler');
    public $helpers = array('Html', 'Form', 'Js' => array('Jquery'), 'Session');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = 'home';

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

        $user = $this->Wallet->user_info();
        $name = (isset($user) && count($user)) ? $user['name'] : 'Bạn chưa login';
        $this->set(compact('name'));

        $total_product = $this->Wallet->get_count_product();
        $this->set(compact('total_product'));

    }

    function view() {
        $id_acc = $this->Auth->User('id');
        $user_info = $this->Account->findById($id_acc);
        $this->set(compact('user_info'));
    }

    function index()
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            $order_code = $this->Session->read('order_code');
            $this->set(compact('order_code'));
        }
    }

    function add_money_found()
    {
        $resp = $this->request->data;
        $add_current_money = (isset($resp['Wallet'])) ? $resp['Wallet']['add_current_money'] : 0 ;

        if ( $this->request->is('post') ) {
            $this->set(compact('add_current_money'));
        };
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

    public function finish()
    {
        // Payment port return GET/POST
        // Check return in VTC redirect
        // URL is string return in VTC redirect
        $url_query = $this->request->query;
        // can also access it via an array
        //$url_return = $this->request->here;
        if ( count($url_query) > 0 ) {

            $this->Session->setFlash('Bạn đã nạp tiền thành công.');
            $this->redirect(array("controller" => "Wallet",
                    "action" => "index",
                )
            );

        } else {
            // In the controller cart .
            $this->Session->setFlash('Không nhận được phản hồi từ cổng thanh toán trực tuyến, vui lòng xem lại thông tin mua hàng hoặc liên hệ support.');
            $this->Session->setFlash('Lets by sell own\' production, please !');
            $this->redirect(array("controller" => "Wallet",
                    "action" => "index",
                )
            );
        }

    }



}