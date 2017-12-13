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
    App::import('Vendor', 'Api_helper/Httpd');

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
        public $components = array('Acl', 'RequestHandler', 'Computing', );
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
            $name = (isset($user) && count($user)) ? $user['lname'] : 'Bạn chưa login';
            $this->set(compact('name'));

            $total_product = $this->Wallet->get_count_product();
            $this->set(compact('total_product'));

        }

        private function _filter_inet ($lookup_inet) {
            switch ($lookup_inet['status']) {
                case 'SUCCESS' :
                    $look_info = $lookup_inet['data'];
                    if (is_string($look_info))
                        $look_info = explode(' ', $look_info);
                    if (is_array($look_info) && count($look_info)) {
                        $_arr = $look_info;
                        if (is_array( $first_value = array_shift($_arr))) {
                            $_arr = $_tmp = array();
                            foreach ($look_info as $key => $value) {
                                if (is_array($value)) {
                                    foreach ($value as $_key => $_value) {
                                        $_tmp[$_key. '_' .$key] = $_value;
                                    }
                                }
                                $_arr = array_merge($_tmp, $_arr);
                            }
                            return $_arr;
                        }
                    }
                    break;
                case 'FAILURE' :
                    $look_info = $lookup_inet['error'];
                    break;
                default:
                    $look_info = array('Không có phản hồi từ nhà cung cấp.');
                    break;
            }
            return $look_info;
        }

        //init view layout
        function index()
        {

            $is_lg = $this->is_login();
            $res = $this->request->data;

            $lookup = $ipv4 = $ipv6 = $cname = $mx = $ns = $soa = $srv = $txt = array('status' => (string)'', 'data' => array(), 'error' =>  array(), );

            $domain = isset($res['domain']) ? $res['domain'] : 'codelovers.vn';
            //lookup
            $lookup = $this->lookup_inet( array("domain"=> $domain, "type"=>  "lookup"));

            $lookup = $this->_filter_inet($lookup);

            //ipv4 infor
            $ipv4 = $this->lookup_inet( array("domain"=> $domain, "type"=>  "ipv4"));
            $ipv4 = $this->_filter_inet($ipv4);
            //ipv6 infor
            $ipv6 = $this->lookup_inet( array("domain"=> $domain, "type"=>  "ipv6"));
            $ipv6 = $this->_filter_inet($ipv6);
            //cname infor
            $cname = $this->lookup_inet( array("domain"=> $domain, "type"=>  "cname"));
            $cname = $this->_filter_inet($cname);
            //mx infor
            $mx = $this->lookup_inet( array("domain"=> $domain, "type"=>  "mx"));
            $mx = $this->_filter_inet($mx);
            //ns infor
            $ns = $this->lookup_inet( array("domain"=> $domain, "type"=>  "ns"));
            $ns = $this->_filter_inet($ns);
            //soa infor
            $soa = $this->lookup_inet( array("domain"=> $domain, "type"=>  "soa"));
            $soa = $this->_filter_inet($soa);
            //srv infor
            $srv = $this->lookup_inet( array("domain"=> $domain, "type"=>  "srv"));
            $srv = $this->_filter_inet($srv);
            //txt infor
            $txt = $this->lookup_inet( array("domain"=> $domain, "type"=>  "srv"));
            $txt = $this->_filter_inet($txt);

            if ($this->request->is('post') || $this->request->is('get')) {
                $this->set(compact('is_lg'));
                $this->set(compact('domain'));
                $this->set(compact('lookup'));
                $this->set(compact('ipv4'));
                $this->set(compact('ipv6'));
                $this->set(compact('cname'));
                $this->set(compact('mx'));
                $this->set(compact('ns'));
                $this->set(compact('soa'));
                $this->set(compact('srv'));
                $this->set(compact('txt'));
            }
        }

        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function is_login()
        {
            $query = array("email" => INET_API_USERNAME, "password" => INET_API_PASSWORD);
            $ch = curl_init("https://dms.inet.vn/api/sso/v1/user/signin");
            curl_setopt($ch, CURLOPT_USERAGENT, UAgent::_random_user_agent());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data_json_post_fields($query));
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); // set httpd resp
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true); // set fresh resp
            curl_setopt($ch, CURLOPT_FORBID_REUSE, true); // set forbid reuse resp
            curl_setopt($ch, CURLOPT_HEADER, 0);      // set header resp
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
            ));

            $result = curl_exec($ch);
            $info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch); // close resource handler
            $result = json_decode($result, true);
            $this->token = (isset($result['session'])) ? $result['session']['token']: ''; // token is string
            return (isset($result['status']) && $result['status'] == 'SUCCESS') ? true: false;
        }

        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function lookup_inet($query, $url= "/public/nslookup/v1/nslookup/lookup")
        {

            $ch = curl_init("https://dms.inet.vn/api" . $url);
            curl_setopt($ch, CURLOPT_USERAGENT, UAgent::_random_user_agent());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data_json_post_fields($query));
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); // set httpd resp
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true); // set fresh resp
            curl_setopt($ch, CURLOPT_FORBID_REUSE, true); // set forbid reuse resp
            curl_setopt($ch, CURLOPT_HEADER, 0);      // set header resp
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Accept: application/json",
            ));

            $result = curl_exec($ch);
            curl_close($ch); // close resource handler
            $result = json_decode($result, true);
            return $result;
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
        private function _shell_close() {
            return curl_close(CallApi::getCh());
        }
        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _shell_exec() {
            $result = curl_exec(CallApi::getCh());
            $content_type = curl_getinfo(CallApi::getCh(), CURLINFO_CONTENT_TYPE);
            return (array('result' => $result, 'content_type' => $content_type)) ;
        }
        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _auth_token_inet($query = array())
        {
            $query = array("email" => INET_API_USERNAME, "password" => INET_API_PASSWORD);

            CallApi::_init();
            CallApi::setHeaders("Content-Type: application/json"); // CallApi::setHeaders("Content-Type: application/json charset=UTF-8") don't need;
            CallApi::_private_opt();

            curl_setopt(CallApi::getCh(), CURLOPT_URL, "https://dms.inet.vn/api/sso/v1/user/signin");
            curl_setopt(CallApi::getCh(), CURLOPT_POSTFIELDS, $this->data_json_post_fields($query));
            curl_setopt(CallApi::getCh(), CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt(CallApi::getCh(), CURLOPT_POST, 1);
            // this function is called by curl for each header received
            curl_setopt(CallApi::getCh(), CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::getCh(), CURLOPT_HEADER, 0);
            curl_setopt(CallApi::getCh(), CURLOPT_HTTPHEADER, CallApi::getHeaders());

            $result = $this->_shell_exec();
            $result = json_decode($result['result'], true);

            if(curl_errno(CallApi::getCh())) {
                throw new Exception(curl_error(CallApi::getCh()));
            }

            curl_close(CallApi::getCh());
            $this->token = (isset($result['session'])) ? $result['session']['token'] : ''; // token is string
            return (isset($result['session'])) ? $result['session'] : ( count($result) > 0) ? $result : array();
        }
        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _get_domain_inet($domain, $opt = array()) {

            $query = array("token" => $this->token, "name" => $domain);
            Debugger::dump($query);
            $ch = curl_init("https://dms.inet.vn/api/rms/v1/domain/search");
            curl_setopt($ch, CURLOPT_USERAGENT, UAgent::_random_user_agent());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data_json_post_fields($query));
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); // set httpd resp
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true); // set fresh resp
            curl_setopt($ch, CURLOPT_FORBID_REUSE, true); // set forbid reuse resp
            curl_setopt($ch, CURLOPT_HEADER, 0);      // set header resp
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
            ));

            $result = curl_exec($ch);
            $info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch); // close resource handler
            $result = json_decode($result, true);

            return $result;
        }
        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _is_exist_domain_inet($domain, $registrar, $opt = array()) {

            $query = array("token" => $this->token, "name" => $domain, "registrar" => '');

            CallApi::_init();
            CallApi::setHeaders("Content-Type: application/json");
            CallApi::_private_opt();

            curl_setopt(CallApi::getCh(), CURLOPT_URL, "https://dms.inet.vn/api/rms/v1/domain/checkavailable");
            curl_setopt(CallApi::getCh(), CURLOPT_POSTFIELDS, $this->data_json_post_fields($query));
            curl_setopt(CallApi::getCh(), CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt(CallApi::getCh(), CURLOPT_POST, 1);
            // this function is called by curl for each header received
            curl_setopt(CallApi::getCh(), CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::getCh(), CURLOPT_HEADER, 0);
            curl_setopt(CallApi::getCh(), CURLOPT_HTTPHEADER, CallApi::getHeaders());

            $result = $this->_shell_exec();
            $result = json_decode($result['result'], true);
            if(curl_errno(CallApi::getCh())) {
                throw new Exception(curl_error(CallApi::getCh()));
            }
            curl_close(CallApi::getCh());
            return $result;
        }
        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _domain_detail_inet($id, $opt = array()) {

            $query = array("token" => $this->token, "id" => $id);
            CallApi::_init();
            CallApi::setHeaders("Content-Type: application/json");
            CallApi::_private_opt();

            curl_setopt(CallApi::getCh(), CURLOPT_URL, "https://dms.inet.vn/api/rms/v1/domain/detail");
            curl_setopt(CallApi::getCh(), CURLOPT_POSTFIELDS, $this->data_json_post_fields($query));
            curl_setopt(CallApi::getCh(), CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt(CallApi::getCh(), CURLOPT_POST, 1);
            // this function is called by curl for each header received
            curl_setopt(CallApi::getCh(), CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::getCh(), CURLOPT_HEADER, 0);
            curl_setopt(CallApi::getCh(), CURLOPT_HTTPHEADER, CallApi::getHeaders());

            $result = $this->_shell_exec();
            $result = json_decode($result['result'], true);

            if(curl_errno(CallApi::getCh())) {
                throw new Exception(curl_error(CallApi::getCh()));
            }
            curl_close(CallApi::getCh());

            return $result;

        }
        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _domain_getrecord_inet($id, $opt = array()) {

            $query = array("token" => $this->token, "id" => $id);

            CallApi::_init();
            CallApi::setHeaders("Content-Type: application/json");
            CallApi::_private_opt();

            curl_setopt(CallApi::getCh(), CURLOPT_URL, "https://dms.inet.vn/api/rms/v1/domain/getrecord");
            curl_setopt(CallApi::getCh(), CURLOPT_POSTFIELDS, $this->data_json_post_fields($query));
            curl_setopt(CallApi::getCh(), CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt(CallApi::getCh(), CURLOPT_POST, 1);
            // this function is called by curl for each header received
            curl_setopt(CallApi::getCh(), CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::getCh(), CURLOPT_HEADER, 0);
            curl_setopt(CallApi::getCh(), CURLOPT_HTTPHEADER, CallApi::getHeaders());

            $result = $this->_shell_exec();
            $result = json_decode($result['result'], true);

            if(curl_errno(CallApi::getCh())) {
                throw new Exception(curl_error(CallApi::getCh()));
            }

            curl_close(CallApi::getCh());
            return $result;
        }

        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _domain_lookup_inet($domain, $type, $opt = array()) {

            $query = array("token" => $this->token, "type" => $type, "domain" => $domain);

            CallApi::_init();
            CallApi::setHeaders("Content-Type: application/json");
            CallApi::_private_opt();

            curl_setopt(CallApi::getCh(), CURLOPT_URL, "https://dms.inet.vn/api/public/nslookup/v1/nslookup/lookup");
            curl_setopt(CallApi::getCh(), CURLOPT_POSTFIELDS, $this->data_json_post_fields($query));
            curl_setopt(CallApi::getCh(), CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt(CallApi::getCh(), CURLOPT_POST, 1);
            // this function is called by curl for each header received
            curl_setopt(CallApi::getCh(), CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::getCh(), CURLOPT_HEADER, 0);
            curl_setopt(CallApi::getCh(), CURLOPT_HTTPHEADER, CallApi::getHeaders());

            $result = $this->_shell_exec();
            $result = json_decode($result['result'], true);
            if(curl_errno(CallApi::getCh())) {
                throw new Exception(curl_error(CallApi::getCh()));
            }
            curl_close(CallApi::getCh());

            return $result;
        }

        /** tue.phpmailer@gmail.com **/
        /** get iNET API **/
        private function _domain_whois_inet($domain, $opt = array()) {

            $query = array("token" => $this->token, "domain" => $domain);

            CallApi::_init();
            CallApi::setHeaders("Content-Type: application/json");
            CallApi::_private_opt();

            curl_setopt(CallApi::getCh(), CURLOPT_URL, "https://dms.inet.vn/api/public/whois/v1/whois/directly");
            curl_setopt(CallApi::getCh(), CURLOPT_POSTFIELDS, $this->data_json_post_fields($query));
            curl_setopt(CallApi::getCh(), CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt(CallApi::getCh(), CURLOPT_POST, 1);
            // this function is called by curl for each header received
            curl_setopt(CallApi::getCh(), CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(CallApi::getCh(), CURLOPT_HEADER, 0);
            curl_setopt(CallApi::getCh(), CURLOPT_HTTPHEADER, CallApi::getHeaders());

            $result = $this->_shell_exec();
            $result = json_decode($result['result'], true);

            if(curl_errno(CallApi::getCh())) {
                throw new Exception(curl_error(CallApi::getCh()));
            }

            curl_close(CallApi::getCh());
            return $result;
        }

    }