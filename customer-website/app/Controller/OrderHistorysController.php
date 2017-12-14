<?php
App::uses('AppController', 'Controller');
class OrderHistorysController extends AppController {
  var $helpers = array('Paginator','Html');
  var $paginate = array();
  public function beforeFilter(){
    parent::beforeFilter();
    if(!$this->Auth->loggedIn()){
      return $this->redirect($this->Auth->loginAction);
    }
    $this->layout= "home";
  }
  
  public $uses =array('Orderdetail','Account','Order');
  public $name = "OrderHistorys";
    function index(){
      $this->set('title_for_layout','Lịch Sử Giao Dich');
      if(!empty($this->Auth->user('id'))){
        $account_id = $this->Auth->user('id');
        $sql = "SELECT accounts.credit,orders.*,order_detail.* FROM accounts , orders , order_detail WHERE accounts.id = orders.account_id AND orders.id = order_detail.order_id AND accounts.id = {$account_id}";
        $data = $this->Order->query($sql);
        $this->set('data',$data); 
      }else{
      }                 
    }
}
