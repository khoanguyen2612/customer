<?php
/******************************************************************************
 * tue.phpmailer@gmail.com                                                    *
 ******************************************************************************/

App::uses('AppModel', 'Model');
App::uses('CakeSession', 'Model/Datasource');
App::uses('CakeTime', 'Utility');

App::import('Model', 'Order');
App::import('Model', 'OrderDetail');

class Cart extends AppModel
{

    //public $useTable = false;
    public $useTable = 'orders';
    public $actsAs = array('Containable');


    /*
     * add a product to cart
     */
    public function addProduct($cart_item = array())
    {

        $check_cart = CakeSession::read('cart');
        $all_cart = ( !isset($check_cart) ) ?  array() : CakeSession::read('cart');
        $all_cart = ( is_null($check_cart) ) ?  array() : CakeSession::read('cart');

        //array_unshift($all_cart, $cart_item); // push value elements onto first array

        if (count($cart_item) > 0) {
            //array_push($all_cart, $cart_item); // push value elements onto the end of array
            $all_cart['list'][] = $cart_item['product'];
            $all_cart[] = $cart_item;  // push value elements onto the end of array
        }

        $this->saveProduct($all_cart);
        //Save item in DB table
        //$this->saveDbItemCart($cart_item);
    }

    /*
     * get total count of products
     */
    public function getCount()
    {

        $all_cart = $this->readProduct();

        if (isset($all_cart['list'])) {
            return count($all_cart['list']);
        }
        else
            return count($all_cart);
    }

    /*
     * save data to session
     */
    public function saveProduct($data)
    {

        return CakeSession::write('cart', $data);
    }

    /*
     * read cart data from session
     */
    public function readProduct()
    {

        return CakeSession::read('cart');
    }

    public function saveCart($data)
    {

        return CakeSession::write('cart', $data);
    }

    /*
     * read cart data from session
     */
    public function readCart()
    {

        return CakeSession::read('cart');
    }

    public function removeCart()
    {

        return CakeSession::delete('cart');
    }

    public function remove_it($id_it = null)
    {

        $id_it = (int) $id_it;
        $al_it_cart = $this->readProduct();

        if ( !isset($al_it_cart['list']) ) {
            return $al_it_cart;
        }

        $list_item_in_cart = $al_it_cart['list'];
        unset($al_it_cart['list']);

        if ( count($al_it_cart) == 1 ) {
            if ( $id_it > 0 ) {
                foreach ($al_it_cart as $key => $item) {
                    if ((int)$item['product']['id'] == $id_it) {
                        $key_store = $key;
                        break;
                    }
                }
                if (isset($key_store)) {
                    CakeSession::delete('cart');
                    return null;
                };
            }
        }

        if ( $id_it > 0 ) {
            foreach ($al_it_cart as $key => $item) {
                if ((int)$item['product']['id'] == $id_it) {
                    $key_store = $key;
                    break;
                }
            }

            if (isset($key_store)) {
                unset($al_it_cart[$key_store]);
            };

            $key_store = null;
            foreach ($list_item_in_cart as $key => $item) {
                if ((int)$item['id'] == $id_it) {
                    $key_store = $key;
                    break;
                }
            }
            if (!is_null($key_store)) {
                unset($list_item_in_cart[$key_store]);
            };
        }

        $cart = array();
        $cart['list'] = $list_item_in_cart;
        foreach ($al_it_cart as $item) {
            $cart[] = $item;
        }
        CakeSession::delete('cart');
        return $this->saveCart($cart);
    }

    public function checkoutCart()
    {
        $all_cart = $this->readProduct();
        return CakeSession::delete('cart');
    }

    public function saveDbCart()
    {
        Configure::write('debug', 2);
        // Save Order to DB
        $order_detail = array();
        // get all item cart
        $all_cart = $this->readProduct();
        if (isset($all_cart['list']))
            array_shift($all_cart);  // shift an element off the beginning of array ---> UNSET value $all_cart['list'])
        // end get all item cart
        // init Order
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
            CakeSession::delete('order_code');
            return CakeSession::delete('cart');
                // write log empty cart
        }
        //delete session after save production in DB
        CakeSession::delete('order_code');
        return CakeSession::delete('cart');
    }


    private function saveDbItemCart($item =array())
    {
        $order_detail = array();
        if (!empty($item)) {
            $order_detail['order_id'] = $item['order']['id'];
            $order_detail['product_id'] = $item['product']['id'];
            $order_detail['domain_name'] = $item['product']['product_name'];

            $order_detail['action_id'] = 0;
            $order_detail['order_type'] = 1;
            $order_detail['order_dtl_status'] = 1;
            $order_detail['price'] = $item['product']['price']; // int
            $order_detail['quantity'] = 1;  // int
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
                $OrderDetail->save($order_detail);

            } catch (Exception $e) {
                echo 'Error insert order_detail:' . $e->getMessage();
            }
        }

    }

}




