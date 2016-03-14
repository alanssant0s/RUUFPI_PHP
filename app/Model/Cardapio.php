<?php
App::uses('AppModel', 'Model');
/**
 * Cardapio Model
 *
 * @property Unidade $Unidade
 */
class Cardapio extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'unidade_restaurante_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'semana' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	// public $belongsTo = array(
	// 	'UnidadeRestaurante' => array(
	// 		'className' => 'UnidadeRestaurante',
	// 		'foreignKey' => 'unidade_restaurante_id',
	// 		'conditions' => '',
	// 		'fields' => '',
	// 		'order' => ''
	// 	)
	// );

	// public $hasAndBelongsToMany = array(
 //        'Item' =>
 //            array(
 //                'className' => 'Item',
 //                'joinTable' => 'cardapio_items',
 //                'foreignKey' => 'cardapio_id',
 //                'associationForeignKey' => 'item_id',
 //                'unique' => true,
 //                'conditions' => '',
 //                'fields' => '',
 //                'order' => '',
 //                'limit' => '',
 //                'offset' => '',
 //                'finderQuery' => '',
 //                'with' => ''
 //            )
 //    );
}
