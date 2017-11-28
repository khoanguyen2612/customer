<?php
App::uses('AppController', 'Controller');
AuthComponent::user('id');
<<<<<<< HEAD:customer-website/app/Controller/OrderHistorysController.php
class OrderHistorysController extends AppController {
=======
class OrderDetailsController extends AppController {
>>>>>>> 8cce337546c4a42d96cdd4303f7e86fe8f735a70:customer-website/app/Controller/OrderDetailsController.php
  var $helpers = array('Paginator','Html');
  var $paginate = array();
  public $uses =array('Orderdetail','Account','Order');
  public $name = "OrderHistorys";
    function index(){
        $account_id = $this->Auth->user('id');
<<<<<<< HEAD:customer-website/app/Controller/OrderHistorysController.php
        $conditions = array('Order.account_id' =>$account_id);
        // $account_id = $this->Account->find('first',array('Account.id'=>'id'));
        // $conditions = array('Order.account_id' =>$account_id['Account']['id']);
=======
        //$account_id = $this->Account->find('first',array('Account.id'=>'id'));
        $conditions = array('Order.account_id' =>$account_id);
>>>>>>> 8cce337546c4a42d96cdd4303f7e86fe8f735a70:customer-website/app/Controller/OrderDetailsController.php
        $allOrder = $this->Order->find('all',array('conditions'=>$conditions));
        $arr =[];
        foreach ($allOrder as $order){
            $order_id = $order['Order']['id'];
            $conditions = array('Orderdetail.order_id'=>$order_id);
            $allOrderDetail = $this->Orderdetail->find('all',array('conditions'=>$conditions));
            $arr[] = $allOrderDetail;
        }
        $dem = count($allOrderDetail);
         $arr = array('Account' => array(
          'Account.id'=>$account_id['Account']['id'],
          'Account.credit'=>$account_id['Account']['credit']),
          'Orderdetail'=>$allOrderDetail);
       
        $this->set('data',$arr);                  
    }
}

