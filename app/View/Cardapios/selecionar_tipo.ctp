<h1 class="page-header">Selecione o Tipo</h1>

<div class="row placeholders">
  <?php 
    foreach ($tipos as $unit) {
  ?>
  <div class="col-xs-6 col-sm-3 placeholder">
    <?php echo $this->Html->link('<h4 style="position: absolute;border-left-width: 40px;left: 40%;margin-top: 35%;">'.$unit['Type']['name'].'</h4>
    <img src="'.$this->webroot.'img/background.png" class="img-responsive" alt="Generic placeholder thumbnail">', array('controller' => 'cardapios', 'action' => 'selecionar_dia',$unidade_id,$unit['Type']['id']), array('escape' => false));?>
  </div>
  <?php }?>
</div>