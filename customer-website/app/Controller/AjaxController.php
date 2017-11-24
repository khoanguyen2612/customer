<?php
App::uses('AppController', 'Controller');
class AjaxController extends OrderDetailsController {
	public $uses =array('Orderdetail','Account','Order');
  	public $name = "OrderDetails";
  	$today = date("Y-m-d");
  	var_dump($today);die;
  	$another_date = "2011-08-16";
  	if (strtotime($today) > strtotime($another_date)) {
    echo "Yesterday";
  } else {
    echo "Tomorrow";
  }
}