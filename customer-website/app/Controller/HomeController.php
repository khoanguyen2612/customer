<?php

/**
 *
 */
class HomeController extends AppController
{


	public $uses = array('Account','Supporter', 'Wallet','CloudServer','CreditHistory','Domains','ServiceRequest','Order','DepositHistory',);
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

        // check is login
        $_is_login = $this->Wallet->user_info();
        if (count($_is_login) == 0) {
            $this->Session->setFlash('<code>Bạn chưa Login.</code>');
            $this->redirect(array("controller" => "users",
                    "action" => "login",
                )
            );
        }

        //Menu information
        $user = $this->Wallet->user_info();
        $name = (isset($user) && count($user)) ? $user['lname'] : 'Bạn chưa login';
        $this->set(compact('name'));
        // wallet account deposit, point
        $deposit = (isset($user) && count($user)) ? $user['deposit'] : 0;
        $_record_dep = $this->Account->find('first',
            array('fields' => array('Account.id', 'deposit', 'lname', 'credit'),
                'conditions' => array('Account.id =' => $user['id']),
                'recursive' => 0,
            )
        );
        $deposit = $_record_dep['Account']['deposit'];
        $this->set(compact('deposit'));
        // wallet account deposit, point
        $_record_dep = $this->DepositHistory->find('all',
            array('fields' => array('DepositHistory.id', 'account_id', 'tong_nap', 'SUM(DepositHistory.tong_nap) as deposit_total'),
                'conditions' => array('DepositHistory.account_id =' => $user['id'] ),
                'recursive' => 0,
                'group' => array('account_id'), // fields to GROUP BY
            )
        );

        $deposit_total = (count($_record_dep) > 0) ? $_record_dep[0][0]['deposit_total'] : 0;
        $this->set(compact('deposit_total'));
        // wallet account deposit, point
        $total_point = (isset($user) && count($user)) ? $user['total_point'] : 0;
        $this->set(compact('total_point'));
        $credit = (isset($user) && count($user)) ? $user['credit'] : 0;
        $this->set(compact('credit'));
        // wallet account total product
        $total_product = $this->Wallet->get_count_product();
        $this->set(compact('total_product'));
        //Menu information

    }

    /* tue.phpmailer@gmail.com */
    /** for view home **/
    public function index() {

        
		$user_id=$this->Auth->user('id');

		$cloudservers=$this->CloudServer->find('all',array(
			'conditions'=>array('CloudServer.account_id'=>$user_id)
		));
		$clsv = [0,0,0,0];
		if(isset($cloudservers)){
			foreach ($cloudservers as $item) {
				if($item['CloudServer']['flg_pending']==1){
					$clsv[3]++;
				}
				else{
					$exd=$this->Dateday->expiration_date($item['CloudServer']['expiration_date']);
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
