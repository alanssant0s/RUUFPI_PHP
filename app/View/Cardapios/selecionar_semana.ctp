<h1 class="page-header"><?php echo $tipo['Type']['name']?> de <?php echo $unidade['Unidade']['name']?></h1>

<div class="cardapios index">
	<h2><?php
		$pm = $month;
		if($pm < 10)
			$pm = "0$pm";
		echo "$pm/$year"; 
	?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo 'Semana'; ?></th>
			<th class="actions"><?php echo 'Actions'; ?></th>
	</tr>
	</thead>
	<tbody>
	<?php 
  foreach ($darray as $seg): ?>
  <?php   
    $pseg = $seg;
    if($pseg < 10)
      $pseg = "0$pseg";
  ?>
  <tr>
    
      <td><?php
        $pm2 = $month;  
        $sab = $seg+5;
        if($sab > $days){
          $pm2++;
          $sab = $sab-$days;
          if($pm2 == 13){
            $pm2 = 1;
          }
        }
        if($pm2 < 10)
            $pm2 = "0$pm2";
        if($sab < 10)
          $sab = "0$sab";   

        echo "$pseg/$pm - $sab/$pm2"
      ?>&nbsp;</td>
      <td class="actions">
          <?php echo $this->Html->link(__('Selecinar'), array('action' => 'selecionar_dia_semana',$unidade_id,$tipo_id,$year,$month,$seg)); ?>
    </td>
    
  </tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>
	<?php if(sizeof($darray) == 4) echo "<br/>"?>
         <br/>
  <div class="row">
    <div style="padding-top: 5px; padding-right: 0px;" class="col-xs-4 col-sm-2 placeholder">
     <p> Selecione o ano</p>
    </div>
    <?php echo $this->Form->create('Report');?>
      <?php echo $this->Form->input('year', array('class' => 'form-control' ,'label' => false,
            'options' => array(2015 =>2015, 2016 =>2016, 2017 =>2017), 'default' => $year, 'div' => array('class' => 'col-xs-4 col-sm-2 placeholder'), 'onchange' => 'window.location = "'.$this->Html->url(array(
    "controller" => "cardapios",
    "action" => "ver"
)).'/'.$unidade_id.'/'.$tipo_id.'/"+this.value+"'.'/'.$month.'"'
        ));?>
   </div> 

  <div class="row ">
    <?php echo $this->Html->link('<div class="col-xs-4 col-sm-2 placeholder">
      <i class="glyphicon glyphicon-list-alt" ></i>  Janeiro</a>
    </div>',array('controller' => 'cardapios', 'action' => 'selecionar_semana' ,$unidade_id,$tipo_id,$year,1), array('escape' => false));?>

    <?php echo $this->Html->link('<div class="col-xs-4 col-sm-2 placeholder">
      <i class="glyphicon glyphicon-list-alt" ></i>  Fevereiro</a>
    </div>',array('controller' => 'cardapios', 'action' => 'selecionar_semana' ,$unidade_id,$tipo_id,$year,2), array('escape' => false));?>

    <?php echo $this->Html->link('<div class="col-xs-4 col-sm-2 placeholder">
      <i class="glyphicon glyphicon-list-alt" ></i>  Março</a>
    </div>',array('controller' => 'cardapios', 'action' => 'selecionar_semana' ,$unidade_id,$tipo_id,$year,3), array('escape' => false));?>

    <?php echo $this->Html->link('<div class="col-xs-4 col-sm-2 placeholder">
      <i class="glyphicon glyphicon-list-alt" ></i>  Abril</a>
    </div>',array('controller' => 'cardapios', 'action' => 'selecionar_semana' ,$unidade_id,$tipo_id,$year,4), array('escape' => false));?>

    <?php echo $this->Html->link('<div class="col-xs-4 col-sm-2 placeholder">
      <i class="glyphicon glyphicon-list-alt" ></i>  Maio</a>
    </div>',array('controller' => 'cardapios', 'action' => 'selecionar_semana' ,$unidade_id,$tipo_id,$year,5), array('escape' => false));?>

    <?php echo $this->Html->link('<div class="col-xs-4 col-sm-2 placeholder">
      <i class="glyphicon glyphicon-list-alt" ></i>  Junho</a>
    </div>',array('controller' => 'cardapios', 'action' => 'selecionar_semana' ,$unidade_id,$tipo_id,$year,6), array('escape' => false));?>

    <?php echo $this->Html->link('<div class="col-xs-4 col-sm-2 placeholder">
      <i class="glyphicon glyphicon-list-alt" ></i>  Julho</a>
    </div>',array('controller' => 'cardapios', 'action' => 'selecionar_semana' ,$unidade_id,$tipo_id,$year,7), array('escape' => false));?>

    <?php echo $this->Html->link('<div class="col-xs-4 col-sm-2 placeholder">
      <i class="glyphicon glyphicon-list-alt" ></i>  Agosto</a>
    </div>',array('controller' => 'cardapios', 'action' => 'selecionar_semana' ,$unidade_id,$tipo_id,$year,8), array('escape' => false));?>

    <?php echo $this->Html->link('<div class="col-xs-4 col-sm-2 placeholder">
      <i class="glyphicon glyphicon-list-alt" ></i>  Setembro</a>
    </div>',array('controller' => 'cardapios', 'action' => 'selecionar_semana' ,$unidade_id,$tipo_id,$year,9), array('escape' => false));?>

    <?php echo $this->Html->link('<div class="col-xs-4 col-sm-2 placeholder">
      <i class="glyphicon glyphicon-list-alt" ></i>  Outubro</a>
    </div>',array('controller' => 'cardapios', 'action' => 'selecionar_semana' ,$unidade_id,$tipo_id,$year,10), array('escape' => false));?>      
    
    <?php echo $this->Html->link('<div class="col-xs-4 col-sm-2 placeholder">
      <i class="glyphicon glyphicon-list-alt" ></i>  Novembro</a>
    </div>',array('controller' => 'cardapios', 'action' => 'selecionar_semana' ,$unidade_id,$tipo_id,$year,11), array('escape' => false));?>      

    <?php echo $this->Html->link('<div class="col-xs-4 col-sm-2 placeholder">
      <i class="glyphicon glyphicon-list-alt" ></i>  Dezembro</a>
    </div>',array('controller' => 'cardapios', 'action' => 'selecionar_semana' ,$unidade_id,$tipo_id,$year,12), array('escape' => false));?>  
  
  </div>