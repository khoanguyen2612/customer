<?php
App::uses('AppController', 'Controller');
class OrderDetailsController extends AppController {
  public $uses =array('Orderdetail','Account','Order');
  public $name = "OrderDetails";
    function index(){
        $account_id = $this->Account->find('first',array('Account.id'=>'id'));
        $conditions = array('Order.account_id' =>$account_id['Account']['id']);
        $allOrder = $this->Order->find('all',array('conditions'=>$conditions));
        $arr =[];
        foreach ($allOrder as $order){
            $order_id = $order['Order']['id'];
            $conditions = array('Orderdetail.order_id'=>$order_id);
            $allOrderDetail = $this->Orderdetail->find('all',array('conditions'=>$conditions));
            $arr[] = $allOrderDetail;
        }
         $arr = array('Account' => array('Account.id'=>$account_id['Account']['id'],'Account.credit'=>$account_id['Account']['credit']),
             'Orderdetail'=>$allOrderDetail);
        $this->set('data',$arr);

    }
}
