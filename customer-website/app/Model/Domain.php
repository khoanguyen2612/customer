<?php
class Domain extends AppModel{
	public $useTable = 'domains';
	public $name = 'Domain';
	public $hasMany = array(
		'AccountItem' => array(
			'className'=>'AccountItem',
			'foreginKey' => 'domain_id',
		)
	);
}