<?php 
	Class AccountItem extends AppModel{
		public $name = "AccountItem";
		public $useTable="account_items";
		public $belongsTo = array(
			'Domain' => array(
				'className' => 'Domain',
				'foreignKey' => 'domain_id',
			)
		);
	}
