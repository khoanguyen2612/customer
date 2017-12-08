<?php
App::uses('AppController', 'Controller');
class OrderHistorysController extends AppController {
  var $helpers = array('Paginator','Html');
  var $paginate = array();
  public $uses =array('Orderdetail','Account','Order');
  public $name = "OrderHistorys";
    function index(){
      if(!empty($this->Auth->user('id'))){
        $account_id = $this->Auth->user('id');
        $sql = "SELECT accounts.credit,orders.*,order_detail.* FROM accounts , orders , order_detail WHERE accounts.id = orders.account_id AND orders.id = order_detail.order_id AND accounts.id = {$account_id}";
        $data = $this->Order->query($sql);
        //pr($data);die;
        $this->set('data',$data);
      }else{
      }                 
    }
}
