<?php
App::uses('AppModel', 'Model');
class Cloudserver extends AppModel {
    public $useTable = 'cloudservers';
	var $name = "Cloudserver";
	var $hasMany = array(
         'Plan' => array(
            'className' => 'Plan',
            'foreignKey' => 'id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ));
    
}