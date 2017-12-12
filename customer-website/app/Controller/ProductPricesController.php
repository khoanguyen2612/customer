<?php

//include_once('../Config/constants.php');
//load define API Domain
//*** tue.phpmailer@gmail.com ***//
App::import('Vendor', 'CONSTANTS/CONSTANTS');
//*** end add CONSTANTS ***//

    class ProductPricesController extends AppController
    {
        //add for layout customer view
        public $ext = '.html';
        //use Model,
        public $use = array('ProductPrice',);
        //use Helper,
        public $helpers = array('Html', 'Form', 'Session');

        //use private varial,
        private $token = '';

        //@ThangNT //
        public function result_search()
        {
            $this->ext = ".html";

            $this->set('title_for_layout', 'Kiểm Tra Tên Miền');
            $data_dm = $this->ProductPrice->find('all', array('conditions' => array('product_type' => "1")));
            $this->set('data_dm', $data_dm);

            /* login lay chuoi json tu api*/
            $Login = array("email" => INET_API_USERNAME, "password" => INET_API_PASSWORD);
            $ch = curl_init("https://dms.inet.vn/api/sso/v1/user/signin");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($Login));
            $output = curl_exec($ch);
            $output = json_decode($output, true);
            $this->token = ($output['session']['token']);
            curl_close($ch);
            /**********/
            if ($this->request->is('post')) // neu co data tu form gui len
            {
                $dm_post = explode("\r\n", $this->data['dm_input']); // tach cac domain xuong dong

                foreach ($dm_post as $key => $val) {
                    $dm_post[$key] = preg_replace('/\s+/', '', $val);;//xoa khoang trang trong data gui len
                    $suffix_exist[$key] = strstr($dm_post[$key], '.'); //ten mien search nhap duoi thi tach duoi ten mien
                    $dm_post[$key] = str_replace($suffix_exist[$key], '', $dm_post[$key]); // xoa duoi ten mien
                    if (empty($dm_post[$key])) { // khong nhap  ten mien thi unset bien
                        unset($dm_post[$key]);
                        unset($suffix_exist[$key]);
                    } else if (empty($suffix_exist[$key])) {
                        unset($suffix_exist[$key]);
                    }
                }
                if (isset($this->data['suffix_key'])) {
                    // neu tich chon loai ten mien

                    $search_key = $this->data['suffix_key'];
                    // tao mang ten mien tim kiem va check toi api
                    $index = 0;
                    //pr($suffix_exist);die;
                    foreach ($suffix_exist as $sf_exist_key => $sf_exist_val) {
                        foreach ($data_dm as $key => $val) {
                            if ($val['ProductPrice']['product_name'] == $sf_exist_val) {
                                $result[$index] = $this->check_avaiable($dm_post[$sf_exist_key] . $sf_exist_val, $val['ProductPrice']['domain_type']);
                                $index++;
                            }
                        }
                    }
                    foreach ($search_key as $search_key) {
                        foreach ($dm_post as $s_key => $row) {

                            $data_search[$index]['domain_name'] = $row . $data_dm[$search_key]['ProductPrice']['product_name'];
                            if ($data_dm[$search_key]['ProductPrice']['domain_type'] == 0) {
                                $data_search[$index]['domain_type'] = '1';
                            } else {
                                $data_search[$index]['domain_type'] = '0';
                            }
                            //pr($data_search[$key]['domain_name'] );
                            // lay trang thai api gui ve
                            $result[$index] = $this->check_avaiable($data_search[$index]['domain_name'], $data_search[$index]['domain_type']);
                            // lay thong tin gia san pham
                            $result[$index]['ProductPrice'] = $data_dm[$search_key]['ProductPrice'];
                            $index++;
                        }
                    }


                } else {
                    // xu ly khong tich chon ten mien
                    $index = 0;
                    // check ten mien theo duoi gui len
                    foreach ($data_dm as $data_key => $data_val) {
                        for ($i = 0; $i < count($dm_post); $i++) {
                            if (isset($suffix_exist[$i]) && $suffix_exist[$i] == $data_val['ProductPrice']['product_name']) {
                                $result[$index] = $this->check_avaiable($dm_post[$i] . $suffix_exist[$i], $data_val['ProductPrice']['domain_type']);
                                $result[$index]['ProductPrice'] = $data_val['ProductPrice'];
                                unset($dm_post[$i]);
                                unset($suffix_exist[$i]);
                                $index++;
                            }
                            // check ten mien con lai theo duoi pho bien
                            if ($data_val['ProductPrice']['domain_common'] == 1) {
                                foreach ($dm_post as $val) {
                                    $result[$index] = $this->check_avaiable($val . $data_val['ProductPrice']['product_name'], $data_val['ProductPrice']['domain_type']);
                                    $result[$index]['ProductPrice'] = $data_val['ProductPrice'];
                                    $index++;
                                }
                            }
                        }
                    }
                }
                //pr($result);
                $this->set('title_for_layout', 'Kết Quả Tìm Kiếm Tên Miền');
                $this->set('result', $result);
            };

        }
        //@ThangNT //
        private function check_avaiable($dm_name = null, $dm_type = null)
        {
            $this->ext = ".html";
            $registrar = ($dm_type == '0') ? 'inet' : 'inet-global';
            $dm_check = array("name" => $dm_name, "registrar" => $registrar);
            $data_json = json_encode($dm_check);
            $ch = curl_init("https://dms.inet.vn/api/rms/v1/domain/checkavailable");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array
                (
                    'Content-Type:application/json; charset=UTF-8',
                    'token: ' . $this->token
                )
            );
            $output = curl_exec($ch);
            $output = json_decode($output, true);
            curl_close($ch);
            return $output;
        }
        //@ThangNT //
        public function register_domain()
        {
            $this->ext = ".html";

            $data = $this->ProductPrice->find('all', array(
                'conditions' => array('product_type LIKE' => "1")
            ));
            $this->set('data', $data);
            //LOGIN
            $Login = array("email" => INET_API_USERNAME, "password" => INET_API_PASSWORD);
            $ch = curl_init("https://dms.inet.vn/api/sso/v1/user/signin");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($Login));
            $output = curl_exec($ch);
            $output = json_decode($output, true);
            $token = ($output['session']['token']);
            curl_close($ch);
            if ($this->request->is('post')) {
                //pr($this->request->data);die;
                if (isset($this->request->data['Data'])) {
                    $request = ($this->request->data['Data']);
                    //pr($request); die;
                    $check = strstr($request['add_doamin'], '.');
                    $str = str_replace($check, '', $request['add_doamin']);
                    $this->set('check', $check);

                    if
                    (
                        ($data = $this->ProductPrice->find('all', array('conditions' => array('product_name LIKE' => "$check%")))) && ($check != "")
                    ) {
                        $data1 = $this->ProductPrice->find('all');
                        $this->set('data1', $data1);
                        $request1 = $request['add_doamin'];
                        $this->set('request1', $request1);
                        //--------------------------------------------------------------------------
                        $checkDomain = array("name" => $request1, "registrar" => "inet");

                        $data_string = json_encode($checkDomain);


                        $ch = curl_init("https://dms.inet.vn/api/rms/v1/domain/checkavailable");

                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        //curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array
                            (
                                'Content-Type:application/json; charset=UTF-8',
                                'token: ' . $token
                            )
                        );

                        $output = curl_exec($ch);
                        $output = json_decode($output, true);
                        $this->set('output', $output);
                        curl_close($ch);
                        //------------------------------------------------------------
                        $request3 = $str;
                        $this->set('request3', $request3);
                        //------------------------------------------------------------
                        $data1 = $this->ProductPrice->find('all', array('conditions' => array('product_type LIKE' => "1")));
                        $this->set('data1', $data1);
                        $i = 0;
                        foreach ($data1 as $item) {
                            $test = $str . $item['ProductPrice']['product_name'];
                            //pr($test);die;
                            //CHECK
                            $checkDomain = array("name" => $test, "registrar" => "inet");

                            $data_string = json_encode($checkDomain);


                            $ch = curl_init("https://dms.inet.vn/api/rms/v1/domain/checkavailable");

                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            //curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array
                                (
                                    'Content-Type:application/json; charset=UTF-8',
                                    'token: ' . $token
                                )
                            );

                            $output1 = curl_exec($ch);
                            $output1 = json_decode($output1, true);
                            $output2[$i] = $output1;

                            $i++;


                        }

                        $this->set('output2', $output2);
                        curl_close($ch);
                    } else {
                        $request2 = ($this->request->data['Data']);
                        $this->set('request2', $request2);
                        //------------------------------------------------------------
                        $data1 = $this->ProductPrice->find('all', array('conditions' => array('product_type LIKE' => "1")));
                        $this->set('data1', $data1);
                        $i = 0;

                        foreach ($data1 as $item) {
                            $test = $request['add_doamin'] . $item['ProductPrice']['product_name'];
                            //pr($test); die;
                            //CHECK
                            $checkDomain = array("name" => $test, "registrar" => "inet");

                            $data_string = json_encode($checkDomain);


                            $ch = curl_init("https://dms.inet.vn/api/rms/v1/domain/checkavailable");

                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            //curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array
                                (
                                    'Content-Type:application/json; charset=UTF-8',
                                    'token: ' . $token
                                )
                            );

                            $output = curl_exec($ch);
                            $output = json_decode($output, true);
                            $output1[$i] = $output;
                            $i++;

                        }

                        $this->set('output1', $output1);
                        curl_close($ch);
                        //
                    };

                } else {
                    $request = ($this->request->data);
                    $check = strstr($request['add_doamin'], '.');
                    $str = str_replace($check, '', $request['add_doamin']);
                    $this->set('check', $check);

                    if
                    (
                        ($data = $this->ProductPrice->find('all', array('conditions' => array('product_name LIKE' => "$check%")))) && ($check != "")
                    ) {
                        $data1 = $this->ProductPrice->find('all', array('conditions' => array('product_type LIKE' => "1")));
                        $this->set('data1', $data1);
                        $request1 = $request['add_doamin'];
                        $this->set('request1', $request1);

                        //--------------------------------------------------------------------------
                        $checkDomain = array("name" => $request1, "registrar" => "inet");

                        $data_string = json_encode($checkDomain);


                        $ch = curl_init("https://dms.inet.vn/api/rms/v1/domain/checkavailable");

                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        //curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array
                            (
                                'Content-Type:application/json; charset=UTF-8',
                                'token: ' . $token
                            )
                        );

                        $output = curl_exec($ch);
                        $output = json_decode($output, true);
                        $this->set('output', $output);
                        curl_close($ch);
                        //------------------------------------------------------------------------------


                        $request3 = $str;
                        $this->set('request3', $request3);
                        //------------------------------------------------------------
                        $data1 = $this->ProductPrice->find('all', array(
                            'conditions' => array('product_type LIKE' => "1")
                        ));
                        $this->set('data1', $data1);
                        $i = 0;
                        foreach ($data1 as $item) {
                            $test = $str . $item['ProductPrice']['product_name'];
                            //pr($test);die;
                            //CHECK
                            $checkDomain = array("name" => $test, "registrar" => "inet");

                            $data_string = json_encode($checkDomain);


                            $ch = curl_init("https://dms.inet.vn/api/rms/v1/domain/checkavailable");

                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            //curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array
                                (
                                    'Content-Type:application/json; charset=UTF-8',
                                    'token: ' . $token
                                )
                            );

                            $output1 = curl_exec($ch);
                            $output1 = json_decode($output1, true);
                            $output2[$i] = $output1;

                            $i++;

                        }

                        $this->set('output2', $output2);
                        curl_close($ch);

                    } else {
                        $request2 = ($this->request->data);
                        //pr($request2); die;
                        $this->set('request2', $request2);
                        //------------------------------------------------------------
                        $data1 = $this->ProductPrice->find('all', array('conditions' => array('product_type LIKE' => "1")));
                        $this->set('data1', $data1);
                        $i = 0;
                        foreach ($data1 as $item) {
                            $test = $request['add_doamin'] . $item['ProductPrice']['product_name'];

                            //CHECK
                            $checkDomain = array("name" => $test, "registrar" => "inet");

                            $data_string = json_encode($checkDomain);


                            $ch = curl_init("https://dms.inet.vn/api/rms/v1/domain/checkavailable");

                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            //curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array
                                (
                                    'Content-Type:application/json; charset=UTF-8',
                                    'token: ' . $token
                                )
                            );

                            $output = curl_exec($ch);
                            $output = json_decode($output, true);
                            $output1[$i] = $output;
                            $i++;


                        }
                        $this->set('output1', $output1);
                        curl_close($ch);
                    };
                }
            }
        }
        //@ThangNT //
        public function whois_domain()
        {
            $this->ext = ".html";
            if ($this->request->is('post')) {
                $this->layout = 'ajax';
                // pr($this->request->data);die;
                $domain_name = $this->request->data['domain_name'];
                $whois = array("domainName" => $domain_name);
                $ch = curl_init("https://dms.inet.vn/api/public/whois/v1/whois/directly");

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($whois));

                $datadomain = curl_exec($ch);
                $datadomain = json_decode($datadomain, true);
                // pr($datadomain);die;
                $this->set('datadomain', $datadomain);
                curl_close($ch);
            }
        }
        //@ThangNT //
        public function domain_transfer()
        {

        }
        //@ThangNT //
        public function price()
        {
            $this->ext = ".html";
            $data = $this->ProductPrice->find('all', array(
                'conditions' => array('ProductPrice.product_type' => "1"),
            ));
            $this->set('data', $data);

        }

    }

?>



