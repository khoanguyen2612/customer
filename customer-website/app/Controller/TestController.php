<?php
App::uses('AppController', 'Controller');
class TestController extends AppController{
	var $components = array('Computing','Session');

	public function index(){
		$a = $this->Computing->curl('getAccountDetail','?sessionKey=kUrjawcFvPKbWhUEQfJquyMzNz4=&csUserId=6274f4b5-0931-4272-9bde-8f094b252b16&csAccountId=3c9e93c6-0561-49a3-8c52-89b1f12fa8d4');
		pr($a);
		die;
	}

	public function create_instance($page = 1){
		// $this->Computing->login();


		$data = $this->Session->read('data');
		Configure::load('config', 'default');

		if ($this->request->is('post')){
			$Data_Form = $this->request->data;

			$data6 = array(
				'csUserId' => $data['csUserId'],
				'sessionKey' => $data['sessionKey'],
				'username' => Configure::read('username'),
				'password' => Configure::read('password'),
				'csDomainId' => $data['csDomainId'],
				'methodPay' => 1,
				'accountId' => $data['accountId'],
				'arrServicePriceId' => $Data_Form['hdd_id'].','.$Data_Form['ram_cpu_id'],
				'domainId' => $data['domainId'],
				'name' => $Data_Form['CreateInstance']['Name'],
				'group' => $Data_Form['CreateInstance']['group'],
				'zoneId' => $data['zoneId'],
				'days' => 30,
				'mCsId' => null,
				'mName' => null,
				'autoExtend' => 1
			);
			$url6 = $this->Computing->convert1($data6);
			// pr($data6);
			// die;
			$result6 = $this->Computing->curl('paymentInstance',$url6);

			if($result6->status->code == 1){
				$this->Session->setFlash($result6->status->des,'default',array('class' => 'alert alert-success'));
			} else {
				$this->Session->setFlash($result6->status->des,'default',array('class' => 'alert alert-danger'));
			}
			$this->redirect(array('action' => 'create_instance'));
			// pr($result6);
			// die;
		}

		$data1 = array(
			'csUserId' => $data['csUserId'],
			'sessionKey' => $data['sessionKey'],
			'domainId' => $data['domainId'],
			'zoneId' => $data['zoneId'],
			'os' => 'CENTOS',
			'currencyCode' => $data['currencyCode'],
			'pageNum' => $page
		);
		$url1 = $this->Computing->convert1($data1);
		$result1 = $this->Computing->curl('getTemplateByOs',$url1);

		$data2 = array(
			'csUserId' => $data['csUserId'],
			'sessionKey' => $data['sessionKey'],
			'domainId' => $data['domainId'],
			'zoneId' => $data['zoneId'],
			'accountId' => $data['accountId'],
			'os' => 'CENTOS',
			'currencyCode' => $data['currencyCode'],
			'serviceName' => $result1->data[0]->name
		);
		$url2 = $this->Computing->convert1($data2);
		$result2 = $this->Computing->curl('getTemplateByName',$url2);

		$data3 = array(
			'csUserId' => $data['csUserId'],
			'sessionKey' => $data['sessionKey'],
			'domainId' => $data['domainId'],
			'zoneId' => $data['zoneId'],
			'accountId' => $data['accountId'],
			'os' => null,
			'currencyCode' => $data['currencyCode'],
			'serviceType' => 'Service',
			'pageNum' => $page
		);
		$url3 = $this->Computing->convert1($data3);
		$result3 = $this->Computing->curl('getServiceByServiceType0',$url3);

		$data4 = array(
			'csUserId' => $data['csUserId'],
			'sessionKey' => $data['sessionKey'],
			'accountId' => $data['accountId'],
		);
		$url4 = $this->Computing->convert1($data4);
		$result4 = $this->Computing->curl('getListServicePriceDays',$url4);

		$data5 = array(
			'csUserId' => $data['csUserId'],
			'sessionKey' => $data['sessionKey'],
			'zoneId' => $data['zoneId'],
			'accountId' => $data['accountId'],
		);
		$url5 = $this->Computing->convert1($data5);
		$result5 = $this->Computing->curl('getGroupNameOfVMs',$url5);

		$data_view = array(
			'hdd_id' => $result2->data[0]->lstServicePrice[0]->id,
			'ram_cpu_id_1' => $result3->data[0]->lstServicePrice[0]->id,
			'ram_cpu_id_2' => $result3->data[1]->lstServicePrice[0]->id,
			'list_group' => $result5->data
		);
		$this->set('data',$data_view);
		// pr($data_view);
		// die;
	}
}

?>