<?php
App::uses('AppController', 'Controller');
/**
 * RegistrationsIds Controller
 *
 * @property RegistrationsId $RegistrationsId
 * @property PaginatorComponent $Paginator
 */
class RegistrationsIdsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RegistrationsId->recursive = 0;
		$this->set('registrationsIds', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RegistrationsId->exists($id)) {
			throw new NotFoundException(__('Invalid registrations id'));
		}
		$options = array('conditions' => array('RegistrationsId.' . $this->RegistrationsId->primaryKey => $id));
		$this->set('registrationsId', $this->RegistrationsId->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RegistrationsId->create();
			if ($this->RegistrationsId->save($this->request->data)) {
				$this->Session->setFlash(__('The registrations id has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registrations id could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RegistrationsId->exists($id)) {
			throw new NotFoundException(__('Invalid registrations id'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RegistrationsId->save($this->request->data)) {
				$this->Session->setFlash(__('The registrations id has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registrations id could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RegistrationsId.' . $this->RegistrationsId->primaryKey => $id));
			$this->request->data = $this->RegistrationsId->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RegistrationsId->id = $id;
		if (!$this->RegistrationsId->exists()) {
			throw new NotFoundException(__('Invalid registrations id'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RegistrationsId->delete()) {
			$this->Session->setFlash(__('The registrations id has been deleted.'));
		} else {
			$this->Session->setFlash(__('The registrations id could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
