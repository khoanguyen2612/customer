<?php

/**
 *
 */
class HomeController extends AppController
{

	public $uses = array('Account','Supporter', 'Wallet',);
    public $helpers = array('Html', 'Form', 'Js' => array('Jquery'), 'Session');

    /* tue.phpmailer@gmail.com */
    /* filter inherited data for layout home View*/
    function beforeFilter()
    {
        parent::beforeFilter();
        // for debug
        Configure::write('Cache.disable', true);
        Configure::write('debug', 2);

        $user = $this->Wallet->user_info();
        $name = (isset($user) && count($user)) ? $user['name'] : 'Bạn chưa login';
        $this->set(compact('name'));
        $total_product = $this->Wallet->get_count_product();
        $this->set(compact('total_product'));

    }

    /* tue.phpmailer@gmail.com */
    /** for view home **/
    public function index() {
        $user = $this->Wallet->user_info();
        $name = (isset($user) && count($user)) ? $user['name'] : 'Bạn chưa login';
        $this->set(compact('name'));
        $total_product = $this->Wallet->get_count_product();
        $this->set(compact('total_product'));

	}
}
