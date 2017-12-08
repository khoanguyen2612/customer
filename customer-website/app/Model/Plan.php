<?php
App::uses('AppModel', 'Model');
class Plan extends AppModel {
    public $useTable = 'plans';
	var $name = "Plan";
    public $belongsTo = array(
		'Cloudserver' => array(
			'className' => 'Cloudserver',
			'foreignKey' => 'plan_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));
    var $hasOne = array(
        'ProductPrice' => array(
            'className' => 'ProductPrice',
            'foreignKey' => 'plan_id',
    ));
}