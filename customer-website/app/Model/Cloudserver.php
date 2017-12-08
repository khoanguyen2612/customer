<?php
App::uses('AppModel', 'Model');
class CloudServer extends AppModel {
    public $useTable = 'cloudservers';
	var $name = "CloudServer";
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
