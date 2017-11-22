<?php

/**
 *
 */
class HomeController extends AppController
{

	public $uses = array('Account','Supporter');
    public $helpers = array('Html', 'Form', 'Js' => array('Jquery'), 'Session');
	public function index(){
	}
}
