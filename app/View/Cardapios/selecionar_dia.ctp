<h1 class="page-header">Cardapio - <?php echo $unidade_name;?></h1>
<div class="well">
  <div class="row">
    <div class="col-xs-3">
       <?php echo $this->Form->create('Cardapio', array('class' => 'form-horizontal')); ?>
         <fieldset>
          <div class="control-group">
            <div class="controls">
             <div class="input-prepend input-group">
               <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span><input type="text" style="width: 200px" name="day" id="day" class="form-control" value="<?php echo $date?>" /> 
             </div>
            </div>
          </div>
         </fieldset>  
       

       <script type="text/javascript">
       $(document).ready(function() {
          $('#day').daterangepicker({ singleDatePicker: true }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
          });
       });
       </script>
     </div>

     <div class="col-xs-4">
      <?php
        echo $this->Form->input('Cardapio.unidade_restaurante_id');
     ?>
     </div>

     <div class="col-xs-2">
      <?php
        $options = array('1' => 'Almoço', '2' => 'Janta');
        $attributes = array('legend' => false, 'default' => $tipo_id);
        echo $this->Form->radio('tipo_id', $options, $attributes);
     ?>
     </div>

     <div class="col-xs-1">
       <input class="btn btn-primary" type="submit" value="Acessar"></form>
     </div>     
     </form>
  </div>
</div>

<script language="JavaScript">
function move(MenuOrigem, MenuDestino){
    var arrMenuOrigem = new Array();
    var arrMenuDestino = new Array();
    var arrLookup = new Array();
    var i;
    for (i = 0; i < MenuDestino.options.length; i++){
        arrLookup[MenuDestino.options[i].text] = MenuDestino.options[i].value;
        arrMenuDestino[i] = MenuDestino.options[i].text;
    }
    var fLength = 0;
    var tLength = arrMenuDestino.length;
    for(i = 0; i < MenuOrigem.options.length; i++){
        arrLookup[MenuOrigem.options[i].text] = MenuOrigem.options[i].value;
        if (MenuOrigem.options[i].selected && MenuOrigem.options[i].value != ""){
            arrMenuDestino[tLength] = MenuOrigem.options[i].text;
            tLength++;
        }
        else{
            arrMenuOrigem[fLength] = MenuOrigem.options[i].text;
            fLength++;
        }
    }
    arrMenuOrigem.sort();
    arrMenuDestino.sort();
    MenuOrigem.length = 0;
    MenuDestino.length = 0;
    var c;
    for(c = 0; c < arrMenuOrigem.length; c++){
        var no = new Option();
        no.value = arrLookup[arrMenuOrigem[c]];
        no.text = arrMenuOrigem[c];
        MenuOrigem[c] = no;
    }
    for(c = 0; c < arrMenuDestino.length; c++){
        var no = new Option();
        no.value = arrLookup[arrMenuDestino[c]];
        no.text = arrMenuDestino[c];
        MenuDestino[c] = no;
   }
}
function send(MenuOrigem){
  var send = "";
  for(i = 0; i < MenuOrigem.options.length; i++){
      send += MenuOrigem.options[i].value + "|";      
  }
  document.getElementById("items").value = send;
  document.getElementById("horario").value = document.getElementById("CardapioHorario").value;
}

// function sendCopy(MenuOrigem){
//   document.getElementById("horario_").value = document.getElementById("CardapioHorario").value;
// }
</script>
  <?php
    if($tipo_id == 1)
      $tipo = "Almoço";
    else
      $tipo = "Janta";
  ?>
  <h3 class="page-header"><?php echo $date." - ".$tipo;?></h1>
  <?php echo $this->Form->create('Cardapio', array('class' => 'form-horizontal', 'action' => 'save')); ?>
    <table>
        <tr>
          <th style="width:200;">Items Disponíveis</th>
          <th></th>
          <th style="width:200;">Items no Cardápio</th>
        </tr>
        <tr>
          <td>
              <select class="form-control" multiple size="10" name="list1" style="width:150">
                <?php
                  foreach ($itemsDis as $value) {
                      echo "<option value='".$value['items']['id']."'>".$value['items']['name']."</option>";
                  }
                ?>
              </select>
          </td>
          <td align="center" valign="middle">
              <input class="form-control" type="button" onClick="move(this.form.list2,this.form.list1)" value="<<">
              <input class="form-control" type="button" onClick="move(this.form.list1,this.form.list2)" value=">>">
          </td>
          <td>
              <select class="form-control" multiple size="10" name="list2" style="width:150">
                <?php
                  foreach ($itemsNotDis as $value) {
                      echo "<option value='".$value['items']['id']."'>".$value['items']['name']."</option>";
                  }
                ?>
              </select>
          </td>
        
          <td><?php 
          
          if(!isset($this->request->data['Cardapio']['horario']) || strlen($this->request->data['Cardapio']['horario']) == 0)
            if($tipo_id == 1)
              $this->request->data['Cardapio']['horario'] = "11:00 às 13:30";
            else
              $this->request->data['Cardapio']['horario'] = "17:00 às 19:00";
          

          echo $this->Form->input('horario',array());?></td>
        </tr>
    </table>
    <br/>
    <input type="hidden" name="unidade_id" value="<?php echo $unidade_id?>">
    <input type="hidden" name="unidade_restaurante_id" value="<?php echo $unidade_restaurante_id?>">
    <input type="hidden" id="items" name="items" value="">
    <input type="hidden" id="horario" name="horario" value="">
    <input type="hidden" id="day_" name="day_" value="<?php echo $date_;?>">
    <input type="hidden" id="type" name="type" value="<?php echo $tipo_id;?>">
    <input class="btn btn-primary" type="submit" value="Salvar Cardápido" onclick="send(this.form.list2)">
</form>

<?php echo $this->Form->create('Cardapio', array('class' => 'form-horizontal', 'action' => 'copy')); ?>
  <input type="hidden" name="unidade_id" value="<?php echo $unidade_id?>">
  <input type="hidden" name="unidade_restaurante_id" value="<?php echo $unidade_restaurante_id?>">
  <input type="hidden" id="horario" name="horario" value="">
  <input type="hidden" id="day_" name="day_" value="<?php echo $date_;?>">
  <input type="hidden" id="type" name="type" value="<?php echo $tipo_id;?>">
  
  <br/><br/>
    <?php 
    foreach ($unidadeRestaurantes as $key => $value) {
      // var_dump($value);
      if($key != $unidade_restaurante_id){
        echo $this->Form->checkbox('checkbox_id.'.$key, ['label' => $value]);
        echo " $value"; 
        echo "<br/>";
      }
    }
    ?>
    <br/>
  <input class="btn btn-primary" type="submit" value="Copiar Cardápido" onclick="send(this.form.list2)">
</form>

