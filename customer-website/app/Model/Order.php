<?php
App::uses('AppModel', 'Model');
/**
 * Order Model
 *
 * @property Account $Account
 * @property PaymentMethod $PaymentMethod
 * @property Contact $Contact
 * @property OrderDetail $OrderDetail
 */
class Order extends AppModel {

    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'orders';


    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';


    var $actsAs = array( 'Containable' );
    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Account' => array(
            'className' => 'Account',
            'foreignKey' => 'account_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Orderdetail' => array(
            'className' => 'Orderdetail',
            'foreignKey' => 'order_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
