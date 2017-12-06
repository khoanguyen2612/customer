<?php
App::uses('Component', 'Controller');
class ComputingComponent extends Component {

	/*
		input: array($key => value)
		return: $key=value&$key1=$value1...
	*/
	public function convert($data){

	}

	/*
		return data
	*/
	public function curl($action,$string){
		Configure::load('config', 'default');
		$ip = Configure::read('ip');
		$url = 'http://'.$ip.'/mcloudapi/api/'.$action.$string;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 100);
		$result = json_decode(curl_exec($ch));
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($httpcode != 200){
			$result = $this->errors($httpcode);
			return $result;
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
	public function login($data){

	}

	/*
		input: array()
		return
	*/
	public function save_cookie($data){
		
	}

	/*
	return boolean
	*/
	public function check_session(){

	}
}
?>