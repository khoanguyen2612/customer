<?php
App::uses('AppController', 'Controller');
class OrderDetailsController extends AppController {
  public $uses =array('Orderdetail','Account','Order');
  public $name = "OrderDetails";
    function index(){
      $conditions = array('Order.account_id'=>5);
      $allOrder = $this->Order('all',array('conditions'=>$conditions));
      $arr = [];
      foreach ($allOrder as $order){
          $order_id = $order['Order']['id'];
          $conditions = array('Orderdetail.order_id'=>$order_id);
          $allOrderDetail = $this->Orderdetail('all',array('conditions'=>$conditions));
          $arr[] = $allOrderDetail;
      }

      $this->set('data',$arr);
        pr($arr);die;
    }
}
