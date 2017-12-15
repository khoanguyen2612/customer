<?php 
 	App::uses('AppController', 'Controller');
    App::uses('CakeTime', 'Utility');

    //load define API Domain
    App::import('Vendor', 'CONSTANTS/CONSTANTS');
    App::import('Vendor', 'Api_helper/CallApi');
    App::import('Vendor', 'Api_helper/Httpd');
class DomainsManagerController extends AppController{
	public $uses = array('AccountItem','Domain');
	public $helpers = array('Paginator','Html','Form','Session');
	private $token = '';
	public function beforeFilter(){
		parent::beforeFilter();
		if(!$this->Auth->loggedIn()){
			return $this->redirect($this->Auth->loginAction);
		}
		$this->layout= "home";
	}
	public function index(){
		$df_limit = 10;
		$options['joins'] = array(
			array('table' => 'account_items',
				'alias' => 'AccountItem',
				'type' => 'INNER',
				'conditions' => array(
					'AccountItem.domain_id = Domain.id',
					'AccountItem.account_id' => $this->Auth->user('id'),
				)));
		
		if($this->Session->check('limit')){
			$options['limit'] = $this->Session->read('limit');
		}else{
			$options['limit'] = $df_limit;
		}
		if($this->request->is('get')){
			$this->Paginator->settings = $options;
			$data = $this->Paginator->Paginate('Domain');
			$this->set('title_for_layout','Quản lý Tên Miền');
			$this->view = 'index';
			$this->retrive_data($options);
		}
		if($this->request->is('post')){
			$this->layout = 'ajax_domains';
			if(isset($this->data['limit'])){
				$this->Session->write('limit',$this->data['limit']);
				$options['limit'] = $this->data['limit'];
				$this->retrive_data($options);			
			}else
			if(isset($this->data['action']) && $this->data['action'] == 'search'){
				
				$options['conditions'] = array(
					'Domain.domain_name' =>$this->data['domain_name'],
					'Domain.domain_type' =>$this->data['domain_type'],
					'Domain.domain_status' =>$this->data['domain_status'],
					'Domain.created_date >=' =>$this->data['start'],
					'Domain.expiration_date <=' =>$this->data['end'],
				);
				foreach($options['conditions'] as $key => $value){
					if($value == ''){
						unset($options['conditions'][$key]);
					}
				}
				unset($options['limit']);
				$data = $this->Domain->find('all',$options);
				$this->set('data',$data);
				$this->view = 'result';
				$this->set('data',$data);
				// $this->set('limit',$options['limit']);
				$this->view = 'result';
				//pr($options);die;
			}else
			if(isset($this->data['action']) && $this->data['action'] == 'sort'){
				$order_by = ($this->data['order_by'] == 'sort-up')? 'ASC' : 'DESC';
				//echo $order_by;die;
				$options['order'] = array($this->data['field'] => $order_by);
				$this->view = 'sort_data';
				$this->retrive_data($options);
			}

		}
		

	}

	private function retrive_data($options){
		$this->Paginator->settings = $options;
		$data = $this->Paginator->Paginate('Domain');
		$this->set('title_for_layout','Quản lý Tên Miền');
		$this->set('data',$data);
		$this->set('limit',$options['limit']);
	}

	public function whois_domain(){
        if($this->RequestHandler->isAjax()){
        	$this->layout = 'ajax';
        	// pr($this->request->data);die;
        	$domain_name=$this->request->data['domain_name'];
			$whois = array("domainName" => $domain_name);
			$ch = curl_init("https://dms.inet.vn/api/public/whois/v1/whois/directly");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($whois));
			$datadomain = curl_exec($ch);
			$datadomain = json_decode($datadomain, true);
			 pr($datadomain);die;
			$this->set('datadomain',$datadomain);
			curl_close($ch);
		}
	}
	public function whois_protect(){
		$domain_name=$this->request->data['domain_name'];
		$data = $this->Domain->find('first',array('conditions'=> array( 'domain_name' => $domain_name)));
		$ex_domain_id = $data['Domain']['ex_domain_id'];
		$Login = array("email" => INET_API_USERNAME, "password" => INET_API_PASSWORD);
		$ch = curl_init("https://dms.inet.vn/api/sso/v1/user/signin");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($Login));
			$output = curl_exec($ch);
			$output = json_decode($output, true);
			$token =  ($output['session']['token']);
			curl_close($ch);
			
			$data = array("id" => $ex_domain_id,"token"=>$token);
			$data_json = json_encode($data);
			//var_dump($data_json);die;
			$ch = curl_init("https://dms.inet.vn/api/rms/v1/domain/privacyprotection");
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");   
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array
				(                                                                          
				'Content-Type:application/json; charset=UTF-8',  
				'token: '.$token                                                                             
			    )                                                                       
			);
			$output = curl_exec($ch);
			$output = json_decode($output, true);
			$this->set('dataWhois',$output);
			curl_close($ch);		
	}public function update_ns(){
		
	}
}
