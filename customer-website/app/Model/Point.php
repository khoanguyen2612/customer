<?php
        /* ************************** */
        /* tuent.phpmailer@gmail.com */
        /* ************************** */
        App::uses('AppModel', 'Model');

        /**
         * Point Model
         *
         * @property Account $Account
         * @property OrderDetail $OrderDetail
         * @property Wallet $Wallet
         */
        class Point extends AppModel
        {

            /**
             * Use database config
             *
             * @var string
             */
            public $useDbConfig = 'test';

            /**
             * Display field
             *
             * @var string
             */
            public $displayField = 'id';

            /**
             * Validation rules
             *
             * @var array
             */
            public $validate = array(
                'id' => array(
                    'decimal' => array(
                        'rule' => array('decimal'),
                        //'message' => 'Your custom message here',
                        //'allowEmpty' => false,
                        //'required' => false,
                        //'last' => false, // Stop validation after this rule
                        //'on' => 'create', // Limit validation to 'create' or 'update' operations
                    ),
                ),
            );

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
                'OrderDetail' => array(
                    'className' => 'OrderDetail',
                    'foreignKey' => 'order_detail_id',
                    'conditions' => '',
                    'fields' => '',
                    'order' => ''
                ),
            );
    }
