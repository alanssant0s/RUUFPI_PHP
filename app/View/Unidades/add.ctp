<div class="unidades form">
<?php echo $this->Form->create('Unidade'); ?>
	<fieldset>
		<legend><?php echo __('Add Unidade'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Unidades'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Cardapios'), array('controller' => 'cardapios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cardapio'), array('controller' => 'cardapios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
