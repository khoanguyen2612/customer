<?php 
class DomainsManagerController extends AppController{
	public $uses = array('AccountItem','Domain');
	public $helpers = array('Paginator','Html','Form','Session');
	
	public function beforeFilter(){
		if(!$this->Auth->loggedIn()){
			return $this->redirect($this->Auth->loginAction);
		}
		$this->layout= "home";
	}
	public function index(){

		$options['conditions'] =  array(
			'account_id' => $this->Auth->user('id'),
		);
		$df_limit = 10;
		if($this->Session->check('limit')){
				$options['limit'] = $this->Session->read('limit');
			}else{
				$options['limit'] = $df_limit;
			}
		if($this->request->is('get')){
			$this->Paginator->settings = $options;
			$data = $this->Paginator->Paginate('AccountItem');
			$this->set('title_for_layout','Quản lý Tên Miền');
			$this->view = 'index';
		}

		if($this->request->is('post')){
			$this->layout = 'ajax_domains';
			if(isset($this->data['limit'])){
				$this->Session->write('limit',$this->data['limit']);
				$options['limit'] = $this->data['limit'];
				$this->Paginator->settings = $options;
				$data = $this->Paginator->Paginate('AccountItem');
				
			}else
			if(isset($this->data['action']) && $this->data['action'] == 'search'){
				//echo $this->data['input'];die;
						$options['joins'] = array(
						array('table' => 'account_items',
							'alias' => 'AccountItem',
							'type' => 'INNER',
							'conditions' => array(
								'AccountItem.domain_id = Domain.id',
								'Domain.domain_name' => 'hongovietnam.vn',
								'AccountItem.account_id' => $this->Auth->user('id'),
							)));
						$this->Paginator->settings = $options;
						$data = $this->Paginator->Paginate('Domain');
						$this->view = 'result';
			}
			// else
			// if(isset($this->data['action']) && $this->data['action'] == 'sort'){

			// }

		}

		$this->set('title_for_layout','Quản lý Tên Miền');
		$this->set('data',$data);
		$this->set('limit',$options['limit']);

	}
	// public function config_data(){
	// 	// if($this->request->is('post')){
	// 		// $this->AccountItem->unbindModel(
 //        	// array('belongsTo' => array('Domain')), true
 //    		// );
	// 		 //$this->AccountItem->recursive = 1;
	// 		 //$this->Domain->recursive = -1;
	// 		// $options['joins'] = array(
	// 		// array('table' => 'account_items',
	// 		// 	'alias' => 'AccountItem',
	// 		// 	'type' => 'INNER',
	// 		// 	'conditions' => array(
	// 		// 		'AccountItem.domain_id = Domain.id',
	// 		// 		'Domain.domain_name' => 'hongovietnam.vn',
	// 		// 		'AccountItem.account_id' => 4
	// 		// 	)
	// 		// )
	// 		// );
	// 		// //$this->Paginator->settings = $options;
	// 		// $data = $this->Domain->find('all',$options);
	// 		// pr($data);die;

	// 	// }
	// }

	// public function sort_data(){

	// }
	

}
