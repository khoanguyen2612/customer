<?php
App::uses('Component', 'Controller');
class ComputingComponent extends Component {

	/*
		input: array($key => value)
		return: $key=value&$key1=$value1...
	*/
    /* tue.phpmailer@gmail.com */
    /**   Convert data (array) to query (http) string   **/
    /*      Example:
             $data = array(
                "csUserId" => '6274f4b5-0931-4272-9bde-8f094b252b16',
                "sessionKey" => 'h0lXTyaehhRzU7pmy6YrgczQwPk=',
                "accountId" => '15126298400862612',
                "domainId" => '151262984064640',
                "zoneId" => '15126298406613',
                "os" => 'CENTOS',
                "currencyCode" => 'VND',
                "sessionKeyTest" => 'rdyT4Vu2zAOKZ7RSd0oP05FdNvk=',
            );
            Note Fix: Error ---> character '=' // don'nt permission in raw URL
            $str_tmp = $this->Computing->convert($data);
            Debugger::dump($data);
            Debugger::dump($str_tmp);
            Debugger::dump(utf8_decode(urldecode($str_tmp)));
    */

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
            $params[$key] = ($value); // $prefix = null, remove if need $prefix not true
        }

        return '?'. htmlentities( http_build_query($params));
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
	public function login($data) {

	}

	/*
		input: array()
		return
	*/
	public function save_cookie($data) {
		
	}

	/*
	return boolean
	*/
	public function check_session(){

	}
}
?>