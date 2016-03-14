<?php
App::uses('Cardapio', 'Model');

/**
 * Cardapio Test Case
 *
 */
class CardapioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cardapio',
		'app.unidade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cardapio = ClassRegistry::init('Cardapio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cardapio);

		parent::tearDown();
	}

}
