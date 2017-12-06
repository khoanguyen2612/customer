<?php
App::uses('AppController', 'Controller');
class TestController extends AppController{
	var $components = array('Computing');

	public function index(){
		$a = $this->Computing->curl('getAccountDetail','?sessionKey=kUrjawcFvPKbWhUEQfJquyMzNz4=&csUserId=6274f4b5-0931-4272-9bde-8f094b252b16&csAccountId=3c9e93c6-0561-49a3-8c52-89b1f12fa8d4');
		pr($a);
		die;
	}
}

?>