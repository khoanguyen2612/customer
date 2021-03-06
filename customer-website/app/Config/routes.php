<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */

	// Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	Router::connect('/', array('controller' => 'users', 'action' => 'login', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/orderhistory', array('controller' => 'OrderHistorys', 'action' => 'index'));
	Router::connect('/cloudserver', array('controller' => 'ServiceManagements', 'action' => 'index'));

    /** config route for WalletController **/
    /*tue.phpmailer@gmail.com*/
    Router::connect('/wallet', array('controller' => 'Wallet', 'action' => 'index'));
    Router::connect('/wallet/', array('controller' => 'Wallet', 'action' => 'index'));
    Router::connect('/wallet/add_money_found', array('controller' => 'Wallet', 'action' => 'add_money_found'));
    // add route Wallet Cart
    Router::connect('/walletcart', array('controller' => 'WalletCart', 'action' => 'index', 'view'));
    Router::connect('/walletcart/', array('controller' => 'WalletCart', 'action' => 'index', 'view'));
    // add route Domain looking
    Router::connect('/domainslookup', array('controller' => 'DomainNsLookup', 'action' => 'index', 'view'));
    Router::connect('/domainslookup/', array('controller' => 'DomainNsLookup', 'action' => 'index', 'view'));
    Router::connect('/domains', array('controller' => 'DomainsManager', 'action' => 'index'));
    // add route Wallet Cart

    /** end config route for WalletController **/

    /** config route for domain search from [fontend] website **/
    /*tue.phpmailer@gmail.com*/
    Router::connect('/domain/register', array('controller' => 'ProductPrices', 'action' => 'register_domain'));
    Router::connect('/domain/search', array('controller' => 'ProductPrices', 'action' => 'result_search'));
    Router::connect('/domain/transfer', array('controller' => 'ProductPrices', 'action' => 'domain_transfer'));
    Router::connect('/domain/price', array('controller' => 'ProductPrices', 'action' => 'price'));
    /** end config route for domain search from [fontend] website  **/
    Router::parseExtensions('json', 'xml');
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
