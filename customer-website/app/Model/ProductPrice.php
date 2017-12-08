<?php 
	Class ProductPrice extends AppModel
	{
		public $useTable="product_price";
		var $hasOne = array(
        'Plan' => array(
            'className' => 'Plan',
            'foreignKey' => 'id',
    ));

	}
?>