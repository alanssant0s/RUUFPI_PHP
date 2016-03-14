<div class="cardapios form">
<?php echo $this->Form->create('Cardapio'); ?>
	<fieldset>
		<legend><?php echo __('Add Cardapio'); ?></legend>
	<?php
		echo '<div class="row">';

		echo '<div class="col-xs-6 col-md-3">';
        echo $this->Form->input('year', array('label' => 'Ano','class' => 'form-control',
            'options' => array(2014 => 2014, 2015 =>2015), 'default' => $year
        ));
        echo '</div>';

        echo '<div class="col-xs-6 col-md-3" style="margin-left:80px">';
        echo $this->Form->input('month', array('class' => 'form-control',
            'options' => $months_array, 'default' => $month-1, 'onchange' => 'window.location = "'.$this->Html->url(array(
    "controller" => "cardapios",
    "action" => "add"
)).'/'.$year.'/"+(parseInt(this.value)+1)'));
        echo '</div>';

        echo '<div class="col-xs-6 col-md-3" style="margin-left:80px">';
        echo $this->Form->input('semana', array('label' => 'Segunda','class' => 'form-control',
            'options' => $darray, 'default' => $seg
        ));
        echo '</div>';

        echo '</div>';	

        echo '<h4>Segunda</h4>';
        echo '<div class="row">';

        echo '<div class="col-xs-6 col-md-5">';
		echo $this->Form->input('almoco_1', array('label' => 'Almoço' ,'class' => 'form-control', 'style' => '', 'rows' => '10'));
		echo '</div>';

		echo '<div class="col-xs-6 col-md-5">';// style="margin-left:75px">';
		echo $this->Form->input('janta_1', array('label' => 'Janta' ,'class' => 'form-control', 'style' => '', 'rows' => '10'));
		echo '</div>';

		echo '</div>';


		echo '<h4>Terça</h4>';
        echo '<div class="row">';

        echo '<div class="col-xs-6 col-md-5">';
		echo $this->Form->input('almoco_2', array('label' => 'Almoço' ,'class' => 'form-control', 'style' => '', 'rows' => '10'));
		echo '</div>';

		echo '<div class="col-xs-6 col-md-5">';// style="margin-left:75px">';
		echo $this->Form->input('janta_2', array('label' => 'Janta' ,'class' => 'form-control', 'style' => '', 'rows' => '10'));
		echo '</div>';

		echo '</div>';


		echo '<h4>Quarta</h4>';
        echo '<div class="row">';

        echo '<div class="col-xs-6 col-md-5">';
		echo $this->Form->input('almoco_3', array('label' => 'Almoço' ,'class' => 'form-control', 'style' => '', 'rows' => '10'));
		echo '</div>';

		echo '<div class="col-xs-6 col-md-5">';// style="margin-left:75px">';
		echo $this->Form->input('janta_3', array('label' => 'Janta' ,'class' => 'form-control', 'style' => '', 'rows' => '10'));
		echo '</div>';

		echo '</div>';


		echo '<h4>Quinta</h4>';
        echo '<div class="row">';

        echo '<div class="col-xs-6 col-md-5">';
		echo $this->Form->input('almoco_4', array('label' => 'Almoço' ,'class' => 'form-control', 'style' => '', 'rows' => '10'));
		echo '</div>';

		echo '<div class="col-xs-6 col-md-5">';// style="margin-left:75px">';
		echo $this->Form->input('janta_4', array('label' => 'Janta' ,'class' => 'form-control', 'style' => '', 'rows' => '10'));
		echo '</div>';

		echo '</div>';


		echo '<h4>Sexta</h4>';
        echo '<div class="row">';

        echo '<div class="col-xs-6 col-md-5">';
		echo $this->Form->input('almoco_5', array('label' => 'Almoço' ,'class' => 'form-control', 'style' => '', 'rows' => '10'));
		echo '</div>';

		echo '<div class="col-xs-6 col-md-5">';// style="margin-left:75px">';
		echo $this->Form->input('janta_5', array('label' => 'Janta' ,'class' => 'form-control', 'style' => '', 'rows' => '10'));
		echo '</div>';

		echo '</div>';


		echo '<h4>Sábado</h4>';
        echo '<div class="row">';

        echo '<div class="col-xs-6 col-md-5">';
		echo $this->Form->input('almoco_6', array('label' => 'Almoço' ,'class' => 'form-control', 'style' => '', 'rows' => '10'));
		echo '</div>';

		echo '</div><br/>';

		echo '<h4>Horários de Funcionamento</h4>';
        echo '<div class="row">';

        echo '<div class="col-xs-6 col-md-5">';
		echo $this->Form->input('h_almoco', array('label' => 'Almoço' ,'class' => 'form-control', 'style' => '', 'rows' => '2'));
		echo '</div>';

		echo '<div class="col-xs-6 col-md-5">';// style="margin-left:75px">';
		echo $this->Form->input('h_janta', array('label' => 'Janta' ,'class' => 'form-control', 'style' => '', 'rows' => '2'));
		echo '</div>';

		echo '<div class="col-xs-6 col-md-5">';// style="margin-left:75px">';
		echo $this->Form->input('h_sab', array('label' => 'Sábado' ,'class' => 'form-control', 'style' => '', 'rows' => '2'));
		echo '</div>';

		echo '</div><br/>';

	?>
	</fieldset>
<?php echo $this->Form->end(array('label' => 'Criar cardápio', 'class' => 'btn btn-primary btn-lg')); ?>
