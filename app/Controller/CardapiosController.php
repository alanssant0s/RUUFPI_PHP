<?php
App::uses('AppController', 'Controller');
/**
 * Cardapios Controller
 *
 * @property Cardapio $Cardapio
 * @property PaginatorComponent $Paginator
 */
class CardapiosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public $uses = array('Cardapio', 'Unidade', 'Type', 'Item', 'CardapioItem', 'UnidadeRestaurante', 'RegistrationsId');


	public function selecionar_unidade(){
		$unidades = $this->Unidade->find('all');
		$this->set(compact('unidades'));
	}

	public function selecionar_tipo($unidade_id){
		$tipos = $this->Type->find('all');
		$this->set(compact('tipos', 'unidade_id'));
	}

	public function selecionar_dia($unidade_id, $unidade_restaurante_id = null, $tipo_id = null,$day=null,$month=null,$year=null){
		if($day != null)
			$date = "$day/$month/$year";
		else
			$date = date('d/m/Y');
		
		$unidadeRestaurantes = $this->UnidadeRestaurante->find('list', array('conditions' => array('unidade_id' => $unidade_id)));
		
		if ($this->request->is(array('post', 'put'))) {
			$date = $this->request->data['day'];
			$tipo_id = $this->request->data['Cardapio']['tipo_id'];
			$cardapio = $this->Cardapio->find('first', array('conditions' => array('day' => $date)));
			$unidade_restaurante_id = $this->request->data['Cardapio']['unidade_restaurante_id'];
		}

		if($unidade_restaurante_id == null){
			$unidade_restaurante_id = $this->UnidadeRestaurante->find('first', array('conditions' => array('unidade_id' => $unidade_id)));			
			$unidade_restaurante_id = $unidade_restaurante_id['UnidadeRestaurante']['id'];
		}
		$this->request->data['Cardapio']['unidade_restaurante_id'] = $unidade_restaurante_id;
		if($tipo_id == null){
			$tipo_id = 1;
		}		
		$this->request->data['type_id'] = $tipo_id;		

		$aux = explode('/', $date);
		$date_ = "$aux[2]-$aux[1]-$aux[0]";

		$rep = $this->Cardapio->find('first', array('conditions' => array(
				'day' => $date_,
				'type_id' => $tipo_id,
				'unidade_restaurante_id' => $unidade_restaurante_id
			)));

		if($rep != null)
			$this->request->data['Cardapio'] = $rep['Cardapio'];

		$itemsNotDis = $this->Item->query("SELECT items.* FROM `cardapio_items`,cardapios,items where cardapio_items.item_id = items.id and cardapio_items.cardapio_id = cardapios.id and unidade_restaurante_id = $unidade_restaurante_id and type_id = $tipo_id and day = '$date_' order by items.item_category_id, items.name");
		$itemsDis = $this->Item->query("SELECT * FROM items where id NOT IN( SELECT items.id FROM `cardapio_items`,cardapios,items where cardapio_items.item_id = items.id and cardapio_items.cardapio_id = cardapios.id and unidade_restaurante_id = $unidade_restaurante_id and type_id = $tipo_id and day = '$date_') order by items.item_category_id, items.name");
		$unidade_name = $this->Unidade->find('first', array('conditions' => array('id' => $unidade_id), 'fields' => 'name'));
		$unidade_name = $unidade_name['Unidade']['name'];
		
		$this->set('data_picker',true);
		$this->set(compact('date', 'itemsDis','itemsNotDis','tipo_id', 'unidade_name', 'list1', 'list2', 'unidade_id', 'date_', 'unidadeRestaurantes', 'unidade_restaurante_id'));
	}

	public function copy(){
		if ($this->request->is(array('post', 'put'))) {
			print_r($this->request->data);
			$cardapio = $this->Cardapio->find('first', array('conditions' => array(
					'unidade_restaurante_id' => $this->request->data['unidade_restaurante_id'], 
					'type_id' => $this->request->data['type'], 
					'day' => $this->request->data['day_'])));
			print_r($cardapio);
			$itemss = $this->CardapioItem->find('all' ,array('conditions' => array( 'cardapio_id = ' => $cardapio['Cardapio']['id'])));
			
			foreach ($this->request->data['checkbox_id'] as $key => $value) {
				if($value){
					$cardapio_ = $this->Cardapio->find('first', array('conditions' => array(
						'unidade_restaurante_id' => $key, 
						'type_id' => $this->request->data['type'], 
						'day' => $this->request->data['day_'])));
					print_r($cardapio_);

					if($cardapio_ != NULL){
						$cardapio["Cardapio"]["id"] = $cardapio_["Cardapio"]["id"];
						$this->CardapioItem->query("DELETE FROM cardapio_items where cardapio_id = ".$cardapio_['Cardapio']['id']);
					}else{
						$cardapio['Cardapio']['id'] = 0;
					}
					$cardapio["Cardapio"]["unidade_restaurante_id"] = $key;
					$this->Cardapio->save($cardapio);
					$cardapio['Cardapio']['id'] = $this->Cardapio->id;
					
					foreach ($itemss as $valuess) {
						print_r($valuess);
						$valuess['CardapioItem']['id'] = 0;
						$valuess['CardapioItem']['cardapio_id'] = $cardapio['Cardapio']['id'];
						$this->CardapioItem->save($valuess);
						
					}
				}
			}
			$this->Session->setFlash('Cardapio atualizado com sucesso.');
		}

		// $this->autoRender = false;
		// $this->render(false);
		// $this->layout = false;
		$d = explode("-", $cardapio['Cardapio']['day']);	
		$this->redirect(array('action' => 'selecionar_dia', $this->request->data['unidade_id'], $this->request->data['unidade_restaurante_id'],$this->request->data['type'],$d[2],$d[1],$d[0]));
	}

	public function save(){
		if ($this->request->is(array('post', 'put'))) {
			print_r($this->request->data);
			$cardapio = $this->Cardapio->find('first', array('conditions' => array(
				'unidade_restaurante_id' => $this->request->data['unidade_restaurante_id'], 
				'type_id' => $this->request->data['type'], 
				'day' => $this->request->data['day_'])));
			if($cardapio == null){
				$cardapio['Cardapio']['unidade_restaurante_id'] = $this->request->data['unidade_restaurante_id'];
				$cardapio['Cardapio']['type_id'] = $this->request->data['type'];
				$cardapio['Cardapio']['day'] = $this->request->data['day_'];
				$cardapio['Cardapio']['horario'] = $this->request->data['horario'];
				$this->Cardapio->save($cardapio);
				print_r($cardapio);
				$cardapio['Cardapio']['id'] = $this->Cardapio->id;
			}else{
				$cardapio['Cardapio']['horario'] = $this->request->data['horario'];
				$this->Cardapio->save($cardapio);
			}
			print_r($cardapio);
			$items = explode("|", $this->request->data['items']);
			$this->CardapioItem->query("DELETE FROM cardapio_items where cardapio_id = ".$cardapio['Cardapio']['id']);
			foreach ($items as $value) {
				if(strlen($value) > 0){
					$this->CardapioItem->create();
					$card_items['CardapioItem']['cardapio_id'] = $cardapio['Cardapio']['id'];
					$card_items['CardapioItem']['item_id'] = $value;
					$this->CardapioItem->save($card_items);
				}
			}
			$this->Session->setFlash('Cardapio atualizado com sucesso.');
		}

		// $this->autoRender = false;
		// $this->render(false);
		// $this->layout = false;
		$d = explode("-", $cardapio['Cardapio']['day']);	
		$this->redirect(array('action' => 'selecionar_dia', $this->request->data['unidade_id'], $this->request->data['unidade_restaurante_id'],$this->request->data['type'],$d[2],$d[1],$d[0]));
	}

/**
 * index method
 *
 * @return void
 */

	public function selecionar_semana($unidade_id, $tipo_id,$year=null,$month=null) {
		$unidade = $this->Unidade->find('first', array('conditions' => array('id' => $unidade_id), 'fields' => 'name'));
		$tipo = $this->Type->find('first', array('conditions' => array('id' => $tipo_id), 'fields' => 'name'));

		if($year == null || $month == null){
			$year = date('Y');
			$month = date('m')+1-1;
		}

		$days_ = array('Sun' => 2, 'Mon' => 1, 'Tue' => 7, 'Wed' => 6, 'Thu' => 5, 'Fri' => 4, 'Sat' => 3);
		$months = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
		$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

		$D = DateTime::createFromFormat('Y/d/m', ($year.'/1/'.$month));
		$dayOne = $D->format('D');
				
		$cardapios = $this->Cardapio->find('all', array('conditions' => array("day BETWEEN '$year-$month-01' AND '$year-$month-$days'", 'unidade_id' => $unidade_id),
			'order' => 'day'));

		$seg = $days_[$dayOne];
		
		$D = "";

		$rCard = array();
		$i = 0;
		$sobra = 0;
		while($seg <= $days){
			$darray[$seg] = $seg;
			$pm = $month;
			if($pm < 10)
				$pm = "0$pm";
			$pseg = $seg;
			if($pseg < 10)
				$pseg = "0$pseg";
			$data = "$year-$pm-$pseg";			
			
					$sobra--;
					$rCard[$data] = NULL;
				
			$seg+=7;		
			$i++;				
		}

		$this->set('cardapios',$rCard);
		$this->set(compact('unidade_id','tipo_id','year', 'month', 'days','tipo','unidade', 'darray'));
	}
	public function pdf($id) {
		$this->layout = 'pdf';
		$options = array('conditions' => array('Cardapio.' . $this->Cardapio->primaryKey => $id));
		$cardapio = $this->Cardapio->find('first', $options);
		$seg = $cardapio['Cardapio']['semana'];
		$day = explode('-',$seg);
		//$days = array();
		$days[0] = $day[2].'/'.$day[1].'/'.$day[0];
		for($i = 0; $i < 5; $i++){
			$d = $day[2]+1+$i;
			$m = $day[1]+1-1;
			$y = $day[0];
			$last_day = cal_days_in_month(CAL_GREGORIAN, $day[1], $day[0]);
			if($d > $last_day){
				$d = $d - $last_day;
				$m = $day[1]+1;

				if($m == 13){
					$m = 1;
					$y = $day[0]+1;
				}
			}
			$pm = $m;
			if($pm < 10)
				$pm = "0$pm";
			$pseg = $d;
			if($pseg < 10)
				$pseg = "0$pseg";
			
			

			$days[$i+1] = "$pseg/$pm/$y";
		}
		
		$this->set('days',$days);
		$this->set('cardapio', $cardapio);		
	}

	public function ver_semana($year, $month) {
		$days_ = array('Sun' => 2, 'Mon' => 1, 'Tue' => 7, 'Wed' => 6, 'Thu' => 5, 'Fri' => 4, 'Sat' => 3);
		$months = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
		$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

		$D = DateTime::createFromFormat('Y/d/m', ($year.'/1/'.$month));
		$dayOne = $D->format('D');
				
		$cardapios = $this->Cardapio->find('all', array('conditions' => array("semana BETWEEN '$year-$month-01' AND '$year-$month-$days'"),
			'order' => 'semana'));

		$seg = $days_[$dayOne];
		
		$D = "";
		$rCard = array();
		$i = 0;
		$sobra = 0;
		while($seg <= $days){
			$darray[$seg] = $seg;
			$pm = $month;
			if($pm < 10)
				$pm = "0$pm";
			$pseg = $seg;
			if($pseg < 10)
				$pseg = "0$pseg";
			$data = "$year-$pm-$pseg";			
			if(sizeof($cardapios) > $i+$sobra){
				if($cardapios[$i+$sobra]['Cardapio']['semana'] == $data){
					$rCard[$data] = $cardapios[$i+$sobra]['Cardapio'];					
				}else{
					$sobra--;
					$rCard[$data] = NULL;
				}
			}else{
				$rCard[$data] = NULL;
			}
			$seg+=7;		
			$i++;				
		}

		$this->set('cardapios',$rCard);
		$this->set('darray',$darray);
		$this->set('year',$year);
		$this->set('month',$month);
		$this->set('days',$days);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cardapio->exists($id)) {
			throw new NotFoundException(__('Invalid cardapio'));
		}
		$options = array('conditions' => array('Cardapio.' . $this->Cardapio->primaryKey => $id));
		$this->set('cardapio', $this->Cardapio->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($year = null, $month = null, $iseg = null) {

		$days_ = array('Sun' => 2, 'Mon' => 1, 'Tue' => 7, 'Wed' => 6, 'Thu' => 5, 'Fri' => 4, 'Sat' => 3);
		$months = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
		
		if($year == null || $month == null){
			$year = date('Y');
			$month = date('m');

			$D = DateTime::createFromFormat('Y/d/m', ($year.'/'.date('d').'/'.$month));
			$dayOne = $D->format('D');
			$days__ = array('Sun' => -1, 'Mon' => 0, 'Tue' => 1, 'Wed' => 2, 'Thu' => 3, 'Fri' => 4, 'Sat' => -2);
			if($iseg == null)
				$iseg = date('d') - $days__[$dayOne];

		}
		$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

		if ($this->request->is('post')) {
			$this->Cardapio->create();
			$this->request->data['Cardapio']['unidade_id'] = $this->Auth->user('unidade_id');
			$this->request->data['Cardapio']['semana'] = $this->request->data['Cardapio']['year'].
			"-".($this->request->data['Cardapio']['month'] + 1)."-".$this->request->data['Cardapio']['semana'];
			for($i = 0; $i < 6; $i++){
				$this->request->data['Cardapio']['almoco_'.($i+1)] = '<div>'.str_replace("\r\n",'<br/>',$this->request->data['Cardapio']['almoco_'.($i+1)]).'</div>';

				if($i < 5)
					$this->request->data['Cardapio']['janta_'.($i+1)] = '<div>'.str_replace("\r\n",'<br/>',$this->request->data['Cardapio']['janta_'.($i+1)]).'</div>';
			}
			if ($this->Cardapio->save($this->request->data)) {
				$this->Session->setFlash(__('The cardapio has been saved.'));
				return $this->redirect(array('action' => 'ver',$year,$month));
			} else {
				$this->Session->setFlash(__('The cardapio could not be saved. Please, try again.'));
			}
		}		

		$D = DateTime::createFromFormat('Y/d/m', ($year.'/1/'.$month));
		$dayOne = $D->format('D');
		
		$seg = $days_[$dayOne];
		
		$D = "";
		while($seg <= $days){
			$darray[$seg] = $seg;
			$seg+=7;
		}

		$this->request->data['Cardapio']['h_almoco'] = '11:00 AAS 13:30 HORAS';
		$this->request->data['Cardapio']['h_janta'] = '17:00 AAS 19:00 HORAS';
		$this->request->data['Cardapio']['h_sab'] = '11:00 AAS 13:00 HORAS';
		
		$this->set('darray',$darray);
		$this->set('year',$year);
		$this->set('month',$month);
		$this->set('months_array',$months);
		$this->set('seg',$iseg);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id, $year, $month) {
		if (!$this->Cardapio->exists($id)) {
			throw new NotFoundException(__('Invalid cardapio'));
		}

		$days_ = array('Sun' => 2, 'Mon' => 1, 'Tue' => 7, 'Wed' => 6, 'Thu' => 5, 'Fri' => 4, 'Sat' => 3);
		$months = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
		
		
		$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Cardapio']['version']++;
			for($i = 0; $i < 6; $i++){
				$this->request->data['Cardapio']['almoco_'.($i+1)] = '<div>'.str_replace("\r\n",'<br/>',$this->request->data['Cardapio']['almoco_'.($i+1)]).'</div>';

				if($i < 5)
					$this->request->data['Cardapio']['janta_'.($i+1)] = '<div>'.str_replace("\r\n",'<br/>',$this->request->data['Cardapio']['janta_'.($i+1)]).'</div>';
			}
			if ($this->Cardapio->save($this->request->data)) {
				$this->Session->setFlash(__('The cardapio has been saved.'));
				return $this->redirect(array('action' => 'ver',$year,$month));
			} else {
				$this->Session->setFlash(__('The cardapio could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cardapio.' . $this->Cardapio->primaryKey => $id));
			$cardapio = $this->Cardapio->find('first', $options);
			for($i = 0; $i < 6; $i++){
				$cardapio['Cardapio']['almoco_'.($i+1)] = str_replace('<br/>',"\r\n",$cardapio['Cardapio']['almoco_'.($i+1)]);
				$cardapio['Cardapio']['almoco_'.($i+1)] = str_replace('<div>','',$cardapio['Cardapio']['almoco_'.($i+1)]);
				$cardapio['Cardapio']['almoco_'.($i+1)] = str_replace('</div>','',$cardapio['Cardapio']['almoco_'.($i+1)]);
				if($i < 5){
					$cardapio['Cardapio']['janta_'.($i+1)] = str_replace('<br/>',"\r\n",$cardapio['Cardapio']['janta_'.($i+1)]);
					$cardapio['Cardapio']['janta_'.($i+1)] = str_replace('<div>','',$cardapio['Cardapio']['janta_'.($i+1)]);
					$cardapio['Cardapio']['janta_'.($i+1)] = str_replace('</div>','',$cardapio['Cardapio']['janta_'.($i+1)]);
				}
			}
			$this->request->data = $cardapio;
		}
		$D = DateTime::createFromFormat('Y/d/m', ($year.'/1/'.$month));
		$dayOne = $D->format('D');
		
		$seg = $days_[$dayOne];
		
		$D = "";
		while($seg <= $days){
			$darray[$seg] = $seg;
			$seg+=7;
		}
		
		$this->set('darray',$darray);
		$this->set('year',$year);
		$this->set('month',$month);
		$this->set('months_array',$months);
  	}

  	public function update($unidade_id){
  		$this->layout = false;
		$this->autoRender = false;
		$this->updateDevices($unidade_id);
	}
  	private function updateDevices($unidade_id){
  		$this->layout = false;
		$this->autoRender = false;
  		define('__GOOGLE_GCM_HTTP_URL__', 'https://android.googleapis.com/gcm/send'); // HTTP CHOOSE
		define('__GOOGLE_API_KEY__', 'AIzaSyAf4SlCPrq1kGjgzU4IO62Rh0nQLdJz8vY');

		$devices = $this->RegistrationsId->find('all', ['conditions' =>
			['unidade_id' => $unidade_id,
			'work' => 1]
		]);

		$registrationIDs = array();
		for($i = 0; $i < count($devices); $i++){
			$registrationIDs[] = $devices[$i]['RegistrationsId']['registration_id'];
		}

		$tam = ceil(count($registrationIDs) / 1000); // GCM PERMITE APENAS 1000 REGISTROS POR ENVIO
		for($i = $c = 0; $i < $tam; $i++){
			
			$gcmIds = array();
			for($j = 0; $j < 1000 && isset($registrationIDs[$j + $c]); $j++){
				$gcmIds[] = $registrationIDs[$j + $c];
			}
			$c += 1000;
		
			
			// PAYLOAD DATA
				$data = array('title'=>'Cardápio foi atualizado',
								'author'=>'RU UFPI',
								'action'=>'update');
			
			// SET POST VARIABLES
				$fields = array('registration_ids'=>$gcmIds,
								//'notification_key'=>'',
								'collapse_key'=>'my_type',
								'delay_while_idle'=>false,
								'time_to_live'=>(60*60*24*7),
								'restricted_package_name'=>'com.agenciaflex.ruufpi',
								'dry_run'=>false,
								'data'=>$data);
								
			// HEADER
				$headers = array('Authorization: key='.__GOOGLE_API_KEY__, 'Content-Type: application/json');

			// OPEN CONNECTION
				$ch = curl_init();

			// SET CURL
				curl_setopt( $ch, CURLOPT_URL, __GOOGLE_GCM_HTTP_URL__ );
				curl_setopt( $ch, CURLOPT_POST, true );
				curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
				curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);


			// SEND POST
				$result = curl_exec($ch);
				var_dump($result); // RAW RESULT
				echo '<br /><br />';
				
			// RESULT JSON
				$html = '';
				$resultJson = json_decode($result);
				foreach($resultJson as $key=>$value){
					if(is_array($value)){
						$html .= $key.'=>{<br />';
						$i = 0;
						
						foreach($value as $k=>$v){
							$html .= '&nbsp;&nbsp;&nbsp;&nbsp;{&nbsp;';
							foreach($v as $kObj=>$vObj){
								$html .= $kObj.'=>'.$vObj;
								
								// UPDATE REG ID
									if(strcasecmp($kObj, 'registration_id') == 0 && strlen( trim($vObj) ) > 0){
										$devices[$i]['RegistrationsId']['registration_id'] = $vObj;
										$return = 0;
										if($this->RegistrationsId->save($devices[$i])){
											$return = 1;
										}
										$html .= $return == 1 ? ' (atualizado)' : utf8_decode(' (bug na atualização)');
									}
								// DELETE REG ID
									else if(strcasecmp($kObj, 'error') == 0 && strcasecmp($vObj, 'NotRegistered') == 0){
										$this->RegistrationsId->id = $devices[$i]['RegistrationsId']['id'];
										$return = 0;
										if ($this->RegistrationsId->delete()){
												$return = 1;
										}
										$html .= $return == 1 ? ' (removido)' : utf8_decode(' (bug na remoção)');
									}
									else if(strcasecmp($kObj, 'error') == 0 && strcasecmp($vObj, 'MismatchSenderId') == 0){
										$this->RegistrationsId->id = $devices[$i]['RegistrationsId']['id'];
										$return = 0;
										if ($this->RegistrationsId->delete()){
												$return = 1;
										}
										$html .= $return == 1 ? ' (removido)' : utf8_decode(' (bug na remoção)');
									}
									
								$html .= '<br />';
							}
							$html = rtrim($html, '<br />');
							$html .= '&nbsp;}<br />';
							$i++;
						}
						$html .= '}<br />';
					}
					else{
						$html .= $key.'=>'.$value.'<br />';
					}
				}
				echo $html; // PRINT RESULT
				
			// CLOSE CONNECTION
				curl_close($ch);
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
		$this->Cardapio->id = $id;
		if (!$this->Cardapio->exists()) {
			throw new NotFoundException(__('Invalid cardapio'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Cardapio->delete()) {
			$this->Session->setFlash(__('The cardapio has been deleted.'));
		} else {
			$this->Session->setFlash(__('The cardapio could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
