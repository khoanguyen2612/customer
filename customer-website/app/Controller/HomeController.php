<?php

/**
 *
 */
class HomeController extends AppController
{


	public $uses = array('Account','Supporter', 'Wallet','CloudServers','CreditHistory','Domains','ServiceRequest','Order');
    public $helpers = array('Html', 'Form', 'Js' => array('Jquery'), 'Session');
    public $components = array('Dateday');

    /* tue.phpmailer@gmail.com */
    /* filter inherited data for layout home View*/
    function beforeFilter()
    {
        parent::beforeFilter();
        // for debug
        Configure::write('Cache.disable', true);
        Configure::write('debug', 2);

        $user = $this->Wallet->user_info();
        $name = (isset($user) && count($user)) ? $user['lname'] : 'Bạn chưa login';
        $this->set(compact('name'));
        $total_product = $this->Wallet->get_count_product();
        $this->set(compact('total_product'));

    }

    /* tue.phpmailer@gmail.com */
    /** for view home **/
    public function index() {
        $user = $this->Wallet->user_info();
        $name = (isset($user) && count($user)) ? $user['lname'] : 'Bạn chưa login';
        $this->set(compact('name'));
        $total_product = $this->Wallet->get_count_product();
        $this->set(compact('total_product'));
        
		$user_id=$this->Auth->user('id');

		$cloudservers=$this->CloudServers->find('all',array(
			'conditions'=>array('CloudServers.account_id'=>$user_id)
		));
		$clsv = [0,0,0,0];
		if(isset($cloudservers)){
			foreach ($cloudservers as $item) {
				if($item['CloudServers']['flg_pending']==1){
					$clsv[3]++;
				}
				else{
					$exd=$this->Dateday->expiration_date($item['CloudServers']['expiration_date']);
					if($exd==0){$clsv[0]++;}
					elseif($exd==1){$clsv[1]++;$clsv[0]++;}
					elseif($exd==2){$clsv[2]++;}
				}
			}
		}
		// pr($clsv);die;
		$this->set('clsv',$clsv);

		$domains=$this->Domains->find('all',array(
			'conditions'=>array('Domains.account_id'=>$user_id,'Domains.domain_type'=>1)
		));
		$dmvn = [0,0,0,0];
		if(isset($domains)){
			foreach ($domains as $item) {
				if($item['Domains']['flg_pending']==1){
					$dmvn[3]++;
				}
				else{
					$exd=$this->Dateday->expiration_date($item['Domains']['expiration_date']);
					if($exd==0){$dmvn[0]++;}
					elseif($exd==1){$dmvn[1]++;$dmvn[0]++;}
					elseif($exd==2){$dmvn[2]++;}
				}
			}
		}

		// pr($clsv);die;
		$this->set('dmvn',$dmvn);
		$domains=$this->Domains->find('all',array(
			'conditions'=>array('Domains.account_id'=>$user_id,'Domains.domain_type'=>0)
		));
		$dmqt = [0,0,0,0];
		if(isset($domains)){
			foreach ($domains as $item) {
				if($item['Domains']['flg_pending']==1){
					$dmqt[3]++;
				}
				else{
					$exd=$this->Dateday->expiration_date($item['Domains']['expiration_date']);
					if($exd==0){$dmqt[0]++;}
					elseif($exd==1){$dmqt[1]++;$dmqt[0]++;}
					elseif($exd==2){$dmqt[2]++;}
				}
			}
		}
		$this->set('dmqt',$dmqt);

		$ssls=$this->ServiceRequest->find('all',array(
			'conditions'=>array('ServiceRequest.account_id'=>$user_id,'not' => array('ServiceRequest.ssl_id' => null))
		));
		$countssl = [0,0,0,0];
		if(isset($ssls)){
			foreach ($ssls as $item) {
				if($item['ServiceRequest']['flg_pending']==1){
					$countssl[3]++;
				}
				else{
					$exd=$this->Dateday->expiration_date($item['ServiceRequest']['expiration_date']);
					if($exd==0){$countssl[0]++;}
					elseif($exd==1){$countssl[1]++;$countssl[0]++;}
					elseif($exd==2){$countssl[2]++;}
				}
			}
		}
		// pr($countssl);die;
		$this->set('countssl',$countssl);

		$stogate=$this->Order->find('all',array(
			'conditions'=>array('Order.account_id'=>$user_id)
		));
		$countstogate = [0,0,0,0];
		if(isset($stogate)){
			foreach ($stogate as $item) {
				if($item['Order']['flg_pending']==1){
					$countstogate[3]++;
				}
				else{
					$exd=$this->Dateday->expiration_date($item['Order']['expiration_date']);
					if($exd==0){$countstogate[0]++;}
					elseif($exd==1){$countstogate[1]++;$countstogate[0]++;}
					elseif($exd==2){$countstogate[2]++;}
				}
			}
		}
		// pr($countstogate);die;
		$this->set('countstogate',$countstogate);

	}
}
