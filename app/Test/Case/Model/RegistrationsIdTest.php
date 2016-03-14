<?php
App::uses('RegistrationsId', 'Model');

/**
 * RegistrationsId Test Case
 *
 */
class RegistrationsIdTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.registrations_id'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RegistrationsId = ClassRegistry::init('RegistrationsId');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RegistrationsId);

		parent::tearDown();
	}

}
