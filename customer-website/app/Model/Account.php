<?php 
	Class Account extends AppModel
	{
		public $useTable="accounts";

		var $hasOne = array(
	        'Organization' => array(
	            'className' => 'Organization',
	            'foreignKey' => 'account_id'
	        )
	    );	}

