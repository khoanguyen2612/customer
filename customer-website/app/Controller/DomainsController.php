<?php 
	App::uses('AppController', 'Controller');
	App::uses('CakeEmail', 'Network/Email');
	class DomainsController extends AppController
	{	
  		public $uses =array('ProductPrice');
  		public $name = "Domains";
        public $helpers = array('Html', 'Form', 'Session');
        public function product_price(){
        	$this->set('title_for_layout','Bảng Giá Tên Miền');
		}
		public function domain_transfer(){
			$this->set('title_for_layout','Chuyển Đổi Nhà Cung Cấp');
			$data0 = $this->ProductPrice->query("SELECT * FROM `product_price` WHERE `product_type` = 1 AND `product_name` LIKE '%.vn'");
        	$this->set('data0',$data0);
        	$data1 = $this->ProductPrice->query("SELECT * FROM `product_price` WHERE `product_type` = 1 AND `product_name` NOT LIKE '%.vn'");
        	$this->set('data1',$data1); 
		}
		public function sendmail(){
			if(!empty($this->Auth->user('id'))){
				$email=$this->Auth->user('email');
				var_dump($email);die;
				$Email = new CakeEmail('default');
      			$Email->from($email);
    			$Email->to(array('vtvtest1@gmail.com' => 'VTC'));
    			$Email->subject('Chuyển Đổi Nhà Cung Cấp');
    			$Email->send('My message');
			}
			
		}
	}