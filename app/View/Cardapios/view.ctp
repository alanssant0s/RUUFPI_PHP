<div class="cardapios view">
<h2><?php echo __('Cardapio'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unidade'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cardapio['Unidade']['name'], array('controller' => 'unidades', 'action' => 'view', $cardapio['Unidade']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Semana'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['semana']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Almoco 1'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['almoco_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Almoco 2'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['almoco_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Almoco 3'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['almoco_3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Almoco 4'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['almoco_4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Almoco 5'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['almoco_5']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Almoco 6'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['almoco_6']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Janta 1'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['janta_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Janta 2'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['janta_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Janta 3'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['janta_3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Janta 4'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['janta_4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Janta 5'); ?></dt>
		<dd>
			<?php echo h($cardapio['Cardapio']['janta_5']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cardapio'), array('action' => 'edit', $cardapio['Cardapio']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cardapio'), array('action' => 'delete', $cardapio['Cardapio']['id']), array(), __('Are you sure you want to delete # %s?', $cardapio['Cardapio']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cardapios'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cardapio'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
	</ul>
</div>
