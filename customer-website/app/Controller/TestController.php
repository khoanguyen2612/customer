<?php
App::uses('AppController', 'Controller');
class TestController extends AppController{
	var $components = array('Computing','Cookie');

	public function index(){
		$a = $this->Computing->curl('getAccountDetail','?sessionKey=kUrjawcFvPKbWhUEQfJquyMzNz4=&csUserId=6274f4b5-0931-4272-9bde-8f094b252b16&csAccountId=3c9e93c6-0561-49a3-8c52-89b1f12fa8d4');
		pr($a);
		die;
	}

	public function create_instance(){
		$data = array(
			'csUserId' => '6274f4b5-0931-4272-9bde-8f094b252b16',
			'sessionKey' => 'lv8NUh+a+tb2+LE3Mi0QXjuiT/A=',
			'accountId' => '15125517800812010',
			'domainId' => '151255178004946',
			'zoneId' => '15125517801010',
			'os' => 'CENTOS',
			'currencyCode' => 'VND'
		);
		$this->Cookie->write('data',$data,false);
		$data = $this->Cookie->read('data');
		pr($data);
		die;
	}
}

?>