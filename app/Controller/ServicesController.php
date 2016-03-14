<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class ServicesController extends AppController {

	public $uses = array('Cardapio','ItemCategory', 'Item', 'UnidadeRestaurante', 'RegistrationsId');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('get_cardapio', 'get_categories', 'get_items', 'registration_id');
    }

	public function get_cardapio($year, $month, $seg, $unidade_id) {
		$this->layout = false;
		$this->autoRender = false;
		$segD = new DateTime("$year-$month-$seg");
		$sabD = new DateTime("$year-$month-$seg");
		$sabD->add(new DateInterval('P5D'));

		// echo $segD->format('Y-m-d')." - - ".$sabD->format('Y-m-d');

		$pm = $month;
		if($pm < 10)
				$pm = "0$pm";
		$ps = $seg;
		if($ps < 10)
			$ps = "0$ps";

				
		$cardapio = $this->Cardapio->query("SELECT cardapios.*,items.id,items.item_category_id,items.name FROM cardapios,cardapio_items,items,unidade_restaurantes 
			where items.id = cardapio_items.item_id and cardapios.id = cardapio_items.cardapio_id and cardapios.unidade_restaurante_id = unidade_restaurantes.id 
			and day BETWEEN '".$segD->format('Y-m-d')."' and '".$sabD->format('Y-m-d')."' and unidade_id = $unidade_id order by unidade_restaurante_id,day,type_id");
		
		$result['Success'] = 'true';
		$result['Data'] = $cardapio;



		echo json_encode($result);
		// echo "<br/><br/><br/>";
		// echo json_encode($cardapio);
	}

	public function get_categories() {
		$this->layout = false;
		$this->autoRender = false;
		$categories = $this->ItemCategory->find('all');

		$result['Success'] = 'true';
		$result['Data'] = $categories;

		echo json_encode($result);
	}

	public function get_items() {
		$this->layout = false;
		$this->autoRender = false;

		$items = $this->Item->find('all');

		$result['Success'] = 'true';
		$result['Data'] = $items;

		echo json_encode($result);
	}

	public function registration_id() {
		$this->layout = false;
		$this->autoRender = false;

		if ($this->request->is('post')) {
			$find = $this->RegistrationsId->find("all", ['conditions' => ['registration_id' => $this->request->data['RegistrationsId']['registration_id']]]);
			if(sizeof($find) == 0)
				$this->RegistrationsId->create();
			else
				$this->request->data['RegistrationsId']['id'] = $find[0]['RegistrationsId']['id'];
			
			$this->request->data['RegistrationsId']['work'] = 1;
			if ($this->RegistrationsId->save($this->request->data)) {
				echo json_encode(['Result' => 'Sucess']);
			} else {
				echo json_encode($this->request->data);
			}
		}
	}
}