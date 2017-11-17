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
    var $components = array('Session', 'Cookie', 'Paginator', 'Auth', 'Email');
    public $helpers = array('Session', 'Html', 'Form');
    var $uses = array('Account', 'Cart');


    public function beforeFilter()
    {
        // setup authentication
        $this->__configAuth();
        parent::beforeFilter();
        $this->Auth->allow();

        $this->set('current_user', $this->Auth->user());
        // setup layout
        $this->__configLayout();
        


   
    }

    private function __configAuth()
    {
        $this->Auth->loginAction = array('controller' => 'Users', 'action' => 'login');
       	//$this->Auth->loginRedirect = array('controller' => 'Users', 'action' => 'index');
        $this->Auth->logoutRedirect = array('controller' => 'Users', 'action' => 'login');
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