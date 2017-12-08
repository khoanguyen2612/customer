<?php
    /**
     * Application level Controller
     *
     * This file is application-wide controller file. You can put all
     * application-wide controller-related methods here.
     *
     * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
     * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
     *
     * Licensed under The MIT License
     * For full copyright and license information, please see the LICENSE.txt
     * Redistributions of files must retain the above copyright notice.
     *
     * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
     * @link          https://cakephp.org CakePHP(tm) Project
     * @package       app.Controller
     * @since         CakePHP(tm) v 0.2.9
     * @license       https://opensource.org/licenses/mit-license.php MIT License
     */

    App::uses('Controller', 'Controller');
    App::uses('CakeEmail', 'Network/Email');

    /**
     * Application Controller
     *
     * Add your application-wide methods in the class below, your controllers
     * will inherit them.
     *
     * @package        app.Controller
     * @link        https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
     */
    class AppController extends Controller
    {
        var $components = array('Session', 'Cookie', 'Paginator', 'Auth', 'Email',);
        public $helpers = array('Session', 'Html', 'Form');
        var $uses = array('Account', 'Cart', 'Wallet', 'Account', 'DepositHistory',);

        public function beforeFilter()
        {
            //the first for App Controller
            // setup layout
            $this->__configLayout();

            // setup authentication
            $this->__configAuth();
            parent::beforeFilter();
            $this->Auth->allow();
            $this->set('current_user', $this->Auth->user());

            //Menu information
            //**** tue.phpmailer@gmail.com ****//
            // check is login
            $_is_login = $this->Wallet->user_info();
            if (count($_is_login) ) {
                $user = $this->Wallet->user_info();
                $name = (isset($user) && count($user)) ? $user['lname'] : 'Bạn chưa login';
                $this->set(compact('name'));
                // wallet account deposit, point
                $deposit = (isset($user) && count($user)) ? $user['deposit'] : 0;
                $_record_dep = $this->Account->find('first',
                    array('fields' => array('Account.id', 'deposit', 'lname', 'credit'),
                        'conditions' => array('Account.id =' => $user['id']),
                        'recursive' => 0,
                    )
                );
                $deposit = $_record_dep['Account']['deposit'];
                $this->set(compact('deposit'));
                // wallet account deposit, point
                $_record_dep = $this->DepositHistory->find('all',
                    array('fields' => array('DepositHistory.id', 'account_id', 'tong_nap', 'SUM(DepositHistory.tong_nap) as deposit_total'),
                        'conditions' => array('DepositHistory.account_id =' => $user['id'] ),
                        'recursive' => 0,
                        'group' => array('account_id'), // fields to GROUP BY
                    )
                );
                $deposit_total = (count($_record_dep) > 0) ? $_record_dep[0][0]['deposit_total'] : 0;
                $this->set(compact('deposit_total'));
                // wallet account deposit, point
                $total_point = (isset($user) && count($user)) ? $user['total_point'] : 0;
                $this->set(compact('total_point'));
                $credit = (isset($user) && count($user)) ? $user['credit'] : 0;
                $this->set(compact('credit'));
                // wallet account total product
                $total_product = $this->Wallet->get_count_product();
                $this->set(compact('total_product'));
                //Menu information
            }

        }

        private function __configAuth()
        {
            $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
            $this->Auth->loginRedirect = array('controller' => 'home', 'action' => 'index');
            $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
            $this->Auth->authenticate = array(
                'Form' => array(
                    // 'passwordHasher' => 'Blowfish',
                    'userModel' => 'Account',
                    'fields' => array(
                        'username' => 'nickname',
                        'password' => 'login_password'
                    )
                ),
            );

            $this->Auth->authorize = 'controller';
            $this->Auth->unauthorizedRedirect = false;
        }

        private function __configLayout()
        {
            $this->layout = "home";
        }

}