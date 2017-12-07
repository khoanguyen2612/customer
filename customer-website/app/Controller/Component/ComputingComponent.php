<?php
//App::uses('Component', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
class ComputingComponent extends Component {
	var $components = array('Session','Auth');
	var $uses = array('Account');
	/*
		input: array($key => value)
		return: $key=value&$key1=$value1...
	*/
    /* tue.phpmailer@gmail.com */
    /**   Convert data (array) to query (http) string   **/
    function initialize(Controller $controller ) {
        $this->Controller = $controller;
    }
    public function convert($data, &$new = array(), $prefix = null) {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        foreach ($data as $key => $value) {
            $k = $key;
            if (is_array($value)) {
                $this->convert($value, $new);
            } else {
                $new[$k] = $value;
            }
        }

        $params = array();
        foreach ($new as $key => $value) {
            $params[] = $key . '=' . urlencode($value);
        }
        return '?' . implode('&', $params);
    }
    /*
        return data
    */
    public function curl($action, $string) {
    	Configure::load('config', 'default');
		$ip = Configure::read('ip');
		$url = 'http://'.$ip.'/mcloudapi/api/'.$action.$string;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 500);
		$result = json_decode(curl_exec($ch));
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($httpcode != 200){
			$result = $this->errors($httpcode);
		} 
		/*else {
			if($result->status->code != 1){
				$this->errors($result->status->code);
			} else {
				if(empty($result->data)){
					$this->errors(0);
				}			
			}
		}*/
		return $result;
	}

	/*
		input: int
		return code, message
	*/
	public function errors($httpcode){
		$result = new stdClass();
		$result->status = new stdClass();
		switch ($httpcode) {
		    case 404:
		        $result->status->code = 0;
				$result->status->des = '404 Not Found';
		        break;
	        case 500:
		        $result->status->code = 0;
				$result->status->des = 'Error 500';
				// $this->check_session();
		        break;
		    default:
		    	$result->status->code = 0;
				$result->status->des = 'Lỗi không xác định';
		}
		return $result;
	}

	/*
		input array(username,password)
		return data
	*/
	public function login($data = null) {
		if(empty($data)){
			Configure::load('config', 'default');
			$username = Configure::read('username');
			$password = Configure::read('password');
			$domain = Configure::read('domain');
			$data = array(
				'username' => $username,
				'password' => $password,
				'domain' => $domain
			);
		}
		$url = $this->convert($data);
		$data1 = $this->curl('userLogin',$url);
		if($data1->status->code == 1 && !empty($data1->data)){
			$this->save_session($data1);
		} else {
			return $data1;
		}
	}

	/*
		input: array()
		return
	*/
	public function save_session($data) {
		$loged_time = new DateTime();
		//pr($loged_time->format('Y-m-d H:i:s'));die;
		// $this->Session->write('data.loged_time','2017-12-07 13:25:02');
		$this->Session->write('data.loged_time',$loged_time->format('Y-m-d H:i:s'));
		$this->Session->write('data.csUserId',$data->data->loginresponse->userid);
		$this->Session->write('data.sessionKey',$data->data->loginresponse->sessionkey);
		$this->Session->write('data.accountId',$data->data->getAccountDetail->id);
		$this->Session->write('data.domainId',$data->data->getDomainDetail->id);
		$this->Session->write('data.csDomainId',$data->data->loginresponse->domainid);
		$this->Session->write('data.zoneId',$data->data->configForClient->defaultZoneId);
		$this->Session->write('data.currencyCode',$data->data->getAccountDetail->currency);
		return;
	}

	/*
	return boolean
	*/
	public function check_session(){
		Configure::load('config', 'default');
		$fontend_url = Configure::read('fontend_url');
		// pr($fontend_url);die;
		if($this->Session->check('data')){
			$data = $this->Session->read('data');
			$current_time = strtotime(date('d-m-Y H:i:s'));
			$exp_time = strtotime($data['loged_time']) + 1800;
			if($current_time > $exp_time){
				$this->Session->setFlash('Bạn cần đăng nhập lại để thực hiện thao tác này','default',array('class'=>'alert alert-danger'));
				$this->Auth->logout();
				return $this->Controller->redirect(array('controller'=>'Users','action'=>'login'));
			}else{
				return true;
			}
		}else{
				$Account = ClassRegistry::init('Account');
				$info = $Account->find('first',array('conditions' => array('Account.id' => $this->Auth->user('id'))));
				// pr($info);die;
				if(empty($info['Account']['lname']) || empty($info['Account']['fname'])||empty($info['Account']['email']) ||empty($info['Account']['address']) || empty($info['Account']['phonenumber'])||empty($info['Account']['add_contact']) ||empty($info['Account']['country']) || empty($info['Account']['nickname'])){
					$this->Session->setFlash('Bạn cần cập nhật thông tin tài khoản để thực hiện thao tác này','default',array('class'=>'alert alert-danger'));
					if(isset($info['Organization'])){
						return $this->Controller->redirect($fontend_url.'/members/profile_group');
					}else{
						return $this->Controller->redirect($fontend_url.'/members/profile_user');
					}
				}
				else{
					$this->login();
				}
			}
	}
}
?>