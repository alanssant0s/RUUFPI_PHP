<div class="unidades form">
<?php echo $this->Form->create('Unidade'); ?>
	<fieldset>
		<legend><?php echo __('Edit Unidade'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Unidade.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Unidade.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Cardapios'), array('controller' => 'cardapios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cardapio'), array('controller' => 'cardapios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
