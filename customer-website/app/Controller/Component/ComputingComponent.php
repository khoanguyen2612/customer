<?php
App::uses('Component', 'Controller');
class ComputingComponent extends Component {

	/*
		input: array($key => value)
		return: $key=value&$key1=$value1...
	*/

    /* tue.phpmailer@gmail.com */
    /**   Convert data (array) to query (http) string   **/
    public function convert($data, &$new = array(), $prefix = null) {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        foreach ($data as $key => $value) {
            $k = isset($prefix) ? $prefix.'['.$key.']' : $key;
            if (is_array($value)) {
                $this->convert($value, $new, $k);
            } else {
                $new[$k] = $value;
            }
        }

        foreach ($new as $key => $value) {
            $new[] = $key . '=' . urlencode($value);
        }

        return implode('&', $new);
    }

    /*
        return data
    */
    public function curl($action, $url) {

	}

	/*
		input: int
		return code, message
	*/
	public function errors($number) {

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
}
?>