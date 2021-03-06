<?php
/******************************************************************************
 * tue.phpmailer@gmail.com                                                    *
 ******************************************************************************/

App::uses('AppModel', 'Model');
App::uses('CakeSession', 'Model/Datasource');
App::uses('CakeTime', 'Utility');

App::import('Model', 'Order');
App::import('Model', 'OrderDetail');

// for debug
ini_set('memory_limit', '-1');

class Wallet extends AppModel
{

    public $useTable = false;
    public $actsAs = array('Containable');

    /*
     * get user info
     */
    public function user_info()
    {
        $user = CakeSession::read("Auth.User");
        return ( count($user) ) ? $user: array();
    }

    /*
     * add a product to
     */
    public function add_money($wallet_item = array())
    {
        App::import('Model', 'Order');
        $Order = new Order();
        $Order->setDataSource('default');

        $Order->unbindModel(
            array('belongsTo' => array('Account'))
        );
    }

    public function deposits($amount = array())
    {
        $user = $this->user_info();
        $account_id = (isset($user) && count($user) )? $user['id'] : null;

        Debugger::dump($account_id);

        if (!is_null($account_id) ) {

            App::import('Model', 'Account');
            $Account = new Account();
            $Account->setDataSource('default');
            $Account->unbindModel(
                array('hasOne' => array('Organization'))
            );

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $db = ConnectionManager::getDataSource('default');
            try {

                $_acc = $db->read($Account, array('fields' => array('Account.id', 'deposit', 'lname', 'credit'),
                                                    'conditions' => array('Account.id =' => $account_id),
                                                    //'recursive' => 5,
                                                    //'order' => 'Order.id ASC',
                                                    //'limit' => 1,
                ));

                $_acc = $_acc[0]['Account'];
                $depo = intval(($_acc['deposit'] + $amount['amount']));
                $result = $db->update($Account, array('deposit'), array($depo), array('id =' => $account_id));

                if ($result) {
                    App::import('Model', 'DepositHistory');
                    $DepositHistory = new DepositHistory();

                    try {
                        $db->create($DepositHistory, array('account_id', 'order_detail_id','tong_nap', 'ngay_giao_dich', 'reference_number'),
                            array($account_id, $amount['trans_ref_no'], $amount['amount'], date("Y-m-d H:i:s"), $amount['reference_number'])
                        );
                    } catch (Exception $e) {
                        throw new Exception('Error insert table order ' . $e->getMessage());
                    };

                }

            } catch (Exception $e) {
                throw new Exception('Error insert table order ' . $e->getMessage());
            };
        }
    }

    public function refund($amount = array())
    {

    }

    /*
    * read a product from cart
    */
    public function rWalletProduct()
    {
            // for debug
            Configure::write('Cache.disable', true);
            Configure::write('debug', 25);

            $user = $this->user_info();
            $account_id = (isset($user) && count($user) )? $user['id'] : null;

            App::import('Model', 'Order');
            $Order = new Order();
            $Order->setDataSource('default');

            $Order->unbindModel(
                array('belongsTo' => array('Account'))
            );

            $all_order = $Order->find('first',
                array('fields' => array('Order.id AS order_id', 'account_id', 'order_code', 'order_datetime', 'order_status', 'address_payment', 'created_date'),
                    'conditions' => array('address_payment LIKE' => '%%', 'account_id =' => $account_id),
                    'recursive' => 5,
                    'order' => 'Order.id ASC',
                    'limit' => 1,
                )
            );

            return $all_order;

    }

    /*
     * get total count of products
     */
    public function get_count_product()
    {

            Configure::write('Cache.disable', true);
            Configure::write('debug', 25);

            $user = $this->user_info();
            $account_id = isset($user['id']) ? $user['id'] : null;

            App::import('Model', 'Order');
            $Order = new Order();
            $Order->setDataSource('default');

            $Order->unbindModel(
                array('belongsTo' => array('Account'))
            );

            $all_order = $Order->find('all',
                array ( 'fields' => array('Order.id AS order_id', 'account_id', 'order_code', 'order_datetime', 'order_status', 'address_payment', 'created_date'),
                        'conditions' => array('address_payment LIKE' => '%%', 'account_id =' => $account_id),
                        'recursive' => 5,
                )
            );

            $total_product = 0;
            if ( !empty($all_order) ) {
                foreach ($all_order as $value) {
                    $total_product += count($value['Orderdetail']);
                }
            }

            return $total_product;
    }

    /*
     * get total count of products
     */
    public function get_current_product()
    {
            // for debug
            Configure::write('Cache.disable', true);
            Configure::write('debug', 25);

            $user = $this->user_info();
            $account_id = $user['id'];

            App::import('Model', 'Order');
            $Order = new Order();
            $Order->setDataSource('default');

            $Order->unbindModel(
                array('belongsTo' => array('Account'))
            );

            $all_order = $Order->find('all',
                array('fields' => array('Order.id AS order_id', 'account_id', 'order_code', 'order_datetime', 'order_status', 'address_payment', 'created_date'),
                    'conditions' => array('address_payment LIKE' => '%%', 'account_id =' => $account_id),
                    'recursive' => 5,
                    'order' => 'Order.id ASC',
                    'limit' => 1,
                )
            );

            $total_product = 0;
            if (!empty($all_order)) {
                foreach ($all_order as $value) {
                    $total_product += count($value['Orderdetail']);
                }
            }

            return $total_product;
    }

    public function save_wallet($data)
    {
        return CakeSession::write('wallet', $data);
    }

    /*
     * read wallet data from session
     */
    public function read_wallet()
    {
        return CakeSession::read('wallet');
    }

    public function remove_wallet()
    {
        return CakeSession::delete('wallet');
    }
    /*
     * save_db data from session
     */
    public function save_db_wallet()
    {
        //for debug
        Configure::write('debug', 2);
        // Save Order to DB
        $order_detail = array();
        $user = CakeSession::read("Auth.User");
        $_acc_id = ( isset($user) && isset($user['id'])) ? $user['id'] : null;
        $_name_acc = ( isset($user) && isset($user['name'])) ? $user['name'] : null;
        $_address_acc = ( isset($user) && isset($user['address'])) ? $user['address'] : null;

        $_new_order = array (
            'Order' => array
            (
                //'id' => null, // for new create a Order
                'account_id' => $_acc_id,
                'order_type' => '1',
                'order_code' => CakeSession::read('order_code'),
                'order_datetime' => CakeTime::format(date('m/d/Y H:i:s'), '%m/%d/%Y %H:%M:%S', 'N/A', 'Asia/Ho_Chi_Minh'),
                'order_status' => '3',
                'no_more_email' => '1',
            )
        );

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $db = ConnectionManager::getDataSource('default');

        App::import('Model', 'Order');
        $Order = new Order();
        $_new_order_id = null;

        try {
            $db->create($Order, array('accountant', 'name','address_payment','account_id', 'order_type', 'order_code', 'order_datetime', 'order_status', 'no_more_email'),
                array($_name_acc, $_name_acc, $_address_acc, $_acc_id, '1', CakeSession::read('order_code'), date("Y-m-d H:i:s"), '3', '1')
            );
        } catch (Exception $e) {
            throw new Exception('Error insert table order ' . $e->getMessage());
        };

        $_new_order_id = $db->lastInsertId();

        if (!empty($all_cart) && count($all_cart) > 0 && $_new_order_id > 0) {

            foreach ($all_cart as $item) {
                $order_detail['order_id'] = $_new_order_id;
                $order_detail['product_id'] = $item['product']['id'];
                $order_detail['domain_name'] = $item['product']['product_name'];
                $order_detail['action_id'] = 0;
                $order_detail['order_type'] = 1;
                $order_detail['order_dtl_status'] = 1;
                $order_detail['price'] = $item['product']['price']; // int
                $order_detail['quantity'] = ($item['product']['month_exp'] == 0) ? $item['product']['month_exp'] : $item['product']['year_exp'];  // int
                $order_detail['amount'] = 0;
                $order_detail['total'] = 0;
                $order_detail['discount'] = 0;
                $order_detail['code_affilates'] = 'CODE_AFF_0321A';
                $order_detail['code_qc'] = 'CODE_QC_0321A';
                $order_detail['notes'] = 'Thông tin note khách hàng mua sản phẩm'; // string
                $order_detail['payment_method'] = 0;
                $date_getmoney = CakeTime::format(date('Y-m-d H:i:s'), '%Y-%m-%d %H:%M:%S', 'N/A', 'Asia/Ho_Chi_Minh');
                $order_detail['date_getmoney'] = $date_getmoney; // string, varchar
                $order_detail['money_kd'] = 0;
                $order_detail['flg_renew'] = 0;
                $order_detail['hosting_id'] = 0;
                $order_detail['customer_id'] = 0;
                $order_detail['campainh'] = 'ký tự, unknow value ?';  // varchar
                $order_detail['totenten'] = 'ký tự, unknow value ?';  // varchar
                $order_detail['csr_string'] = 'ký tự, unknow value ?';  // varchar
                $order_detail['payment_activator'] = 'Người active Payment'; // string
                $order_detail['auth_code_tranfer'] = 'ACT_0321A'; // string
                $order_detail['detail_id_sub'] = 0;
                $order_detail['flg_smartphone'] = 0;
                $order_detail['user_confirm_active'] = 'UCA_0321A'; // string
                $order_detail['ketoan_update'] = $date_getmoney;  // datetime
                $order_detail['note_ketoan'] = 'Ghi nhớ cho kế toán'; // string

                try {
                    App::import('Model', 'OrderDetail');
                    $OrderDetail = new OrderDetail();
                    $OrderDetail->setDataSource('default');
                    $OrderDetail->save($order_detail);

                } catch (Exception $e) {
                    throw new Exception('Error insert table order_detail ' . $e->getMessage());
                };
            }
        }

        else {

            return CakeSession::delete('wallet');
                // write log empty cart
        }
        //delete session after save  in DB
        return CakeSession::delete('wallet');
    }

}




