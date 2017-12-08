<?php
App::uses('AppController', 'Controller');
class ServiceManagementsController extends AppController {
  	var $paginate = array();
  	public $uses = array('Account','CloudServer','ProductPrice','Plan');
  	public $helpers = array('Paginator','Html','Form','Session');
  	public $name = "ServiceManagements";
	public function index() {
		$this->set('title_for_layout','Quản lý CloudServer');
		$account_id = $this->Auth->user('id');
		$conditions = array('CloudServer.account_id' =>$account_id);
		$sql = "SELECT accounts.nickname,cloudservers.*,plans.*,product_price.* FROM accounts , cloudservers , plans , product_price WHERE accounts.id = cloudservers.account_id AND cloudservers.plan_id = plans.id AND plans.id = product_price.plan_id AND accounts.id = {$account_id}";
		$dq = $this->CloudServer->query($sql);
		$this->set('data',$dq);
	}
	public function search(){
		$this->layout ='ajax_domains';
		if (isset($this->data['action']) && $this->data['action'] == 'search') {
		$options = array(
			'ProductPrice.product_id' => $this->data['product_id'],
			'CloudServer.startday >=' => $this->data['reg_from'],
			'CloudServer.startday <=' => $this->data['reg_to'],
			'CloudServer.endday >=' => $this->data['exp_from'],
			'CloudServer.endday >=' => $this->data['exp_to']
		 );
		}
		$account_id = $this->Auth->user('id');
		$conditions = array('CloudServer.account_id' =>$account_id);
		$reg_from = date('Y-m-d',strtotime($this->data['reg_from']));
		$reg_to = date('Y-m-d',strtotime($this->data['reg_to']));
		$exp_from = date('Y-m-d',strtotime($this->data['exp_from']));
		$exp_to = date('Y-m-d',strtotime($this->data['exp_to']));
		$day = date('Y-m-d');
		if (!empty($this->data['product_id']) && !empty($this->data['reg_from']) && !empty($this->data['reg_to']) && !empty($this->data['exp_from']) && !empty($this->data['exp_to']) ) {
			$sql_a ="SELECT accounts.nickname,cloudservers.*,plans.*,product_price.* FROM accounts , cloudservers , plans , product_price WHERE accounts.id = cloudservers.account_id AND cloudservers.plan_id = plans.id AND plans.id = product_price.plan_id AND accounts.id = {$account_id} AND product_price.product_id = {$this->data['product_id']} AND (cloudservers.startday BETWEEN '{$reg_from}' AND '{$reg_to}') AND (cloudservers.endday BETWEEN '{$exp_from}' AND '{$exp_to}')";
		}else if(!empty($this->data['product_id']) && !empty($this->data['reg_from']) && !empty($this->data['reg_to'])){
			$sql_a ="SELECT accounts.nickname,cloudservers.*,plans.*,product_price.* FROM accounts , cloudservers , plans , product_price WHERE accounts.id = cloudservers.account_id AND cloudservers.plan_id = plans.id AND plans.id = product_price.plan_id AND accounts.id = {$account_id} AND product_price.product_id = {$this->data['product_id']} AND (cloudservers.endday BETWEEN '{$exp_from}' AND '{$exp_to}')";
		}else if(!empty($this->data['product_id']) && !empty($this->data['exp_from']) && !empty($this->data['exp_to'])){
			$sql_a ="SELECT accounts.nickname,cloudservers.*,plans.*,product_price.* FROM accounts , cloudservers , plans , product_price WHERE accounts.id = cloudservers.account_id AND cloudservers.plan_id = plans.id AND plans.id = product_price.plan_id AND accounts.id = {$account_id} AND product_price.product_id = {$this->data['product_id']} AND (cloudservers.startday BETWEEN '{$reg_from}' AND '{$reg_to}')";
		}else if(!empty($this->data['product_id'])){
			$sql_a ="SELECT accounts.nickname,cloudservers.*,plans.*,product_price.* FROM accounts INNER JOIN cloudservers ON accounts.id = cloudservers.account_id INNER JOIN plans ON plans.id = cloudservers.plan_id INNER JOIN product_price ON product_price.plan_id = plans.id WHERE accounts.id = {$account_id} AND product_price.plan_id = {$this->data['product_id']}";

		}else if(!empty($this->data['reg_from']) && !empty($this->data['reg_to']) && !empty($this->data['exp_from']) && !empty($this->data['exp_to'])){
			$sql_a ="SELECT accounts.nickname,cloudservers.*,plans.*,product_price.* FROM accounts , cloudservers , plans , product_price WHERE accounts.id = cloudservers.account_id AND cloudservers.plan_id = plans.id AND plans.id = product_price.plan_id AND accounts.id = {$account_id} AND (cloudservers.startday BETWEEN '{$reg_from}' AND '{$reg_to}') AND (cloudservers.endday BETWEEN '{$exp_from}' AND '{$exp_to}')";
		}else if (!empty($this->data['reg_from'])) {
			if (!empty( $this->data['reg_to'])) {
				$sql_a ="SELECT accounts.nickname,cloudservers.*,plans.*,product_price.* FROM accounts , cloudservers , plans , product_price WHERE accounts.id = cloudservers.account_id AND cloudservers.plan_id = plans.id AND plans.id = product_price.plan_id AND accounts.id = {$account_id} AND (cloudservers.startday BETWEEN '{$reg_from}' AND '{$reg_to}')";
			}else{
				$sql_a ="SELECT accounts.nickname,cloudservers.*,plans.*,product_price.* FROM accounts , cloudservers , plans , product_price WHERE accounts.id = cloudservers.account_id AND cloudservers.plan_id = plans.id AND plans.id = product_price.plan_id AND accounts.id = {$account_id} AND (cloudservers.startday BETWEEN '{$reg_from}' AND '{$day}')";
			}
		}else if (!empty($this->data['exp_from'])) {
			if (!empty($this->data['exp_to'])) {
				$sql_a ="SELECT accounts.nickname,cloudservers.*,plans.*,product_price.* FROM accounts , cloudservers , plans , product_price WHERE accounts.id = cloudservers.account_id AND cloudservers.plan_id = plans.id AND plans.id = product_price.plan_id AND accounts.id = {$account_id} AND (cloudservers.endday BETWEEN '{$exp_from}' AND '{$exp_to}')";
			}else{
				$sql_a ="SELECT accounts.nickname,cloudservers.*,plans.*,product_price.* FROM accounts , cloudservers , plans , product_price WHERE accounts.id = cloudservers.account_id AND cloudservers.plan_id = plans.id AND plans.id = product_price.plan_id AND accounts.id = {$account_id} AND (cloudservers.endday BETWEEN '{$exp_from}' AND '{$day}')";
			}	
		}
		else {
			$sql_a = "SELECT accounts.nickname,cloudservers.*,plans.*,product_price.* FROM accounts , cloudservers , plans , product_price WHERE accounts.id = cloudservers.account_id AND cloudservers.plan_id = plans.id AND plans.id = product_price.plan_id AND accounts.id = {$account_id}";
		}
		$data =  $this->CloudServer->query($sql_a);
		$this->set('data',$data);
		$this->view = 'result';
	}
}