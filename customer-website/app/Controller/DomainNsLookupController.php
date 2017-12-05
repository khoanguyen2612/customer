<?php
    /**
     * Created by TueNT
     * User: tue.phpmailer@gmail.com
     * Date: month 12/2017
     */

    App::uses('AppController', 'Controller');
    App::uses('CakeTime', 'Utility');

    //load define API Domain
    App::import('Vendor', 'CONSTANTS/CONSTANTS');
    App::import('Vendor', 'Api_helper/CallApi');

    class DomainNsLookupController extends AppController
    {
        /**
         * @var array
         */
        var $layout = 'wallet';
        var $session_cart = array();
        // token to login https://dms.inet.vn/api#/api-Domain-domainDetail
        private $token = '';

        public $uses = array('Order', 'OrderDetail', 'Wallet',);
        public $components = array('Acl', 'RequestHandler');
        public $helpers = array('Html', 'Form', 'Js' => array('Jquery'), 'Session');

        // before call function
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
            $this->render(false);
            $query = array('email'=> '', 'password'=> '');

            $this->_auth_token_inet($query);


            Debugger::dump(LINK_WHOIS);

            if ($this->request->is('post') || $this->request->is('get')) {
                $order_code = $this->Session->read('order_code');
                $this->set(compact('order_code'));
            }
        }

        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function data_json_post_fields($array, $opt = array()) {
            return json_encode($array);
        }
        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function data_post_fields($array, $opt = array()) {
            $params = array();

            foreach ($array as $key => $value) {
                $params[] = $key . '=' . urlencode($value);
            }

            return implode('&', $params);
        }
        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function data_http_build_query($array, $opt = array()) {
            return http_build_query($array, '&');
        }
        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _shell_exec() {
            return (array('result' => $result = curl_exec(CallApi::$ch), 'content_type' => $content_type = curl_getinfo(CallApi::$ch, CURLINFO_CONTENT_TYPE))) ;
        }
        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _auth_token_inet($query, $opt = array())
        {
            $query = array("email" => INET_API_USERNAME, "password" => INET_API_PASSWORD);
            CallApi::_private_opt();

            curl_setopt(CallApi::$ch, CURLOPT_URL, "https://dms.inet.vn/api/sso/v1/user/signin");
            curl_setopt(CallApi::$ch, CURLOPT_POSTFIELDS, $this->data_post_fields($query));
            curl_setopt(CallApi::$ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            // this function is called by curl for each header received
            curl_setopt(CallApi::$ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::$ch, CURLOPT_HEADER, 0);
            curl_setopt(CallApi::$ch, CURLOPT_HTTPHEADER, CallApi::$headers);

            $result = $this->_shell_exec();
            $result = json_decode($result['result'], true);

            if(curl_errno(CallApi::$ch)) {
                throw new Exception(curl_error(CallApi::$ch));
            }

            $this->token = (isset($result['session'])) ? $result['session']['token'] : array();
            return (isset($result['session'])) ? $result['session'] : array();
        }

        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _get_domain_inet($domain, $opt = array()) {

            $query = array("token" =>$this->token, "name" => $domain);
            CallApi::_private_opt();

            curl_setopt(CallApi::$ch, CURLOPT_URL, "https://dms.inet.vn/api/rms/v1/domain/search");
            curl_setopt(CallApi::$ch, CURLOPT_POSTFIELDS, $this->data_post_fields($query));
            curl_setopt(CallApi::$ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            // this function is called by curl for each header received
            curl_setopt(CallApi::$ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::$ch, CURLOPT_HEADER, 0);
            curl_setopt(CallApi::$ch, CURLOPT_HTTPHEADER, CallApi::$headers);

            $result = $this->_shell_exec();
            $result = json_decode($result, true);

            if(curl_errno(CallApi::$ch)) {
                throw new Exception(curl_error(CallApi::$ch));
            }
            return $result;

        }

        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _check_domain_inet($domain, $opt = array()) {

            $query = array("token" =>$this->token, "name" => $domain);
            CallApi::_private_opt();

            curl_setopt(CallApi::$ch, CURLOPT_URL, "https://dms.inet.vn/api/rms/v1/domain/search");
            curl_setopt(CallApi::$ch, CURLOPT_POSTFIELDS, $this->data_post_fields($query));
            curl_setopt(CallApi::$ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            // this function is called by curl for each header received
            curl_setopt(CallApi::$ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::$ch, CURLOPT_HEADER, 0);
            curl_setopt(CallApi::$ch, CURLOPT_HTTPHEADER, CallApi::$headers);

            $result = $this->_shell_exec();
            $result = json_decode($result, true);

            if(curl_errno(CallApi::$ch)) {
                throw new Exception(curl_error(CallApi::$ch));
            }
            return $result;
        }

        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _is_exist_domain_inet($domain, $registrar, $opt = array()) {

            $query = array("token" =>$this->token, "name" => $domain, "registrar" => '');
            CallApi::_private_opt();

            curl_setopt(CallApi::$ch, CURLOPT_URL, "https://dms.inet.vn/api/rms/v1/domain/checkavailable");
            curl_setopt(CallApi::$ch, CURLOPT_POSTFIELDS, $this->data_post_fields($query));
            curl_setopt(CallApi::$ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            // this function is called by curl for each header received
            curl_setopt(CallApi::$ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::$ch, CURLOPT_HEADER, 0);
            curl_setopt(CallApi::$ch, CURLOPT_HTTPHEADER, CallApi::$headers);

            $result = $this->_shell_exec();
            $result = json_decode($result, true);

            if(curl_errno(CallApi::$ch)) {
                throw new Exception(curl_error(CallApi::$ch));
            }
            return $result;
        }

        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _domain_detail_inet($id, $opt = array()) {

            $query = array("token" =>$this->token, "id" => $id);
            CallApi::_private_opt();

            curl_setopt(CallApi::$ch, CURLOPT_URL, "https://dms.inet.vn/api/rms/v1/domain/detail");
            curl_setopt(CallApi::$ch, CURLOPT_POSTFIELDS, $this->data_post_fields($query));
            curl_setopt(CallApi::$ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            // this function is called by curl for each header received
            curl_setopt(CallApi::$ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::$ch, CURLOPT_HEADER, 0);
            curl_setopt(CallApi::$ch, CURLOPT_HTTPHEADER, CallApi::$headers);

            $result = $this->_shell_exec();
            $result = json_decode($result, true);

            if(curl_errno(CallApi::$ch)) {
                throw new Exception(curl_error(CallApi::$ch));
            }
            return $result;
        }
        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _domain_getrecord_inet($id, $opt = array()) {

            $query = array("token" =>$this->token, "id" => $id);
            CallApi::_private_opt();

            curl_setopt(CallApi::$ch, CURLOPT_URL, "https://dms.inet.vn/api/rms/v1/domain/getrecord");
            curl_setopt(CallApi::$ch, CURLOPT_POSTFIELDS, $this->data_post_fields($query));
            curl_setopt(CallApi::$ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            // this function is called by curl for each header received
            curl_setopt(CallApi::$ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::$ch, CURLOPT_HEADER, 0);
            curl_setopt(CallApi::$ch, CURLOPT_HTTPHEADER, CallApi::$headers);

            $result = $this->_shell_exec();
            $result = json_decode($result, true);

            if(curl_errno(CallApi::$ch)) {
                throw new Exception(curl_error(CallApi::$ch));
            }
            return $result;
        }

        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _domain_lookup_inet($domain, $type, $opt = array()) {

            $query = array("token" =>$this->token, "type" => $type, "domain" => $domain);
            CallApi::_private_opt();

            curl_setopt(CallApi::$ch, CURLOPT_URL, "https://dms.inet.vn/api/public/nslookup/v1/nslookup/lookup");
            curl_setopt(CallApi::$ch, CURLOPT_POSTFIELDS, $this->data_post_fields($query));
            curl_setopt(CallApi::$ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            // this function is called by curl for each header received
            curl_setopt(CallApi::$ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::$ch, CURLOPT_HEADER, 0);
            curl_setopt(CallApi::$ch, CURLOPT_HTTPHEADER, CallApi::$headers);

            $result = $this->_shell_exec();
            $result = json_decode($result, true);

            if(curl_errno(CallApi::$ch)) {
                throw new Exception(curl_error(CallApi::$ch));
            }
            return $result;
        }

        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _domain_whois_inet($domain, $opt = array()) {

            $query = array("token" =>$this->token, "domain" => $domain);
            CallApi::_private_opt();

            curl_setopt(CallApi::$ch, CURLOPT_URL, "https://dms.inet.vn/api/public/whois/v1/whois/directly");
            curl_setopt(CallApi::$ch, CURLOPT_POSTFIELDS, $this->data_post_fields($query));
            curl_setopt(CallApi::$ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            // this function is called by curl for each header received
            curl_setopt(CallApi::$ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::$ch, CURLOPT_HEADER, 0);
            curl_setopt(CallApi::$ch, CURLOPT_HTTPHEADER, CallApi::$headers);

            $result = $this->_shell_exec();
            $result = json_decode($result, true);

            if(curl_errno(CallApi::$ch)) {
                throw new Exception(curl_error(CallApi::$ch));
            }
            return $result;
        }


    }