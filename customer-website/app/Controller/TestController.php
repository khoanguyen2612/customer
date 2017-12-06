<?php
App::uses('AppController', 'Controller');
class TestController extends AppController{
	var $components = array('Computing');

	public function index(){
		$a = $this->Computing->convert();
		pr($a);
		die;
	}
}

?>