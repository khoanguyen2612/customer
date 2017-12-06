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
	public function curl($action,$url){

	}

	/*
		input: int
		return code, message
	*/
	public function errors($number){

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
}
?>