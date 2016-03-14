<div class="unidades view">
<h2><?php echo __('Unidade'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($unidade['Unidade']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($unidade['Unidade']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Unidade'), array('action' => 'edit', $unidade['Unidade']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Unidade'), array('action' => 'delete', $unidade['Unidade']['id']), array(), __('Are you sure you want to delete # %s?', $unidade['Unidade']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidade'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cardapios'), array('controller' => 'cardapios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cardapio'), array('controller' => 'cardapios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Cardapios'); ?></h3>
	<?php if (!empty($unidade['Cardapio'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Unidade Id'); ?></th>
		<th><?php echo __('Semana'); ?></th>
		<th><?php echo __('Almoco 1'); ?></th>
		<th><?php echo __('Almoco 2'); ?></th>
		<th><?php echo __('Almoco 3'); ?></th>
		<th><?php echo __('Almoco 4'); ?></th>
		<th><?php echo __('Almoco 5'); ?></th>
		<th><?php echo __('Almoco 6'); ?></th>
		<th><?php echo __('Janta 1'); ?></th>
		<th><?php echo __('Janta 2'); ?></th>
		<th><?php echo __('Janta 3'); ?></th>
		<th><?php echo __('Janta 4'); ?></th>
		<th><?php echo __('Janta 5'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($unidade['Cardapio'] as $cardapio): ?>
		<tr>
			<td><?php echo $cardapio['id']; ?></td>
			<td><?php echo $cardapio['unidade_id']; ?></td>
			<td><?php echo $cardapio['semana']; ?></td>
			<td><?php echo $cardapio['almoco_1']; ?></td>
			<td><?php echo $cardapio['almoco_2']; ?></td>
			<td><?php echo $cardapio['almoco_3']; ?></td>
			<td><?php echo $cardapio['almoco_4']; ?></td>
			<td><?php echo $cardapio['almoco_5']; ?></td>
			<td><?php echo $cardapio['almoco_6']; ?></td>
			<td><?php echo $cardapio['janta_1']; ?></td>
			<td><?php echo $cardapio['janta_2']; ?></td>
			<td><?php echo $cardapio['janta_3']; ?></td>
			<td><?php echo $cardapio['janta_4']; ?></td>
			<td><?php echo $cardapio['janta_5']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cardapios', 'action' => 'view', $cardapio['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cardapios', 'action' => 'edit', $cardapio['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cardapios', 'action' => 'delete', $cardapio['id']), array(), __('Are you sure you want to delete # %s?', $cardapio['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cardapio'), array('controller' => 'cardapios', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($unidade['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Unidade Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Role'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($unidade['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['unidade_id']; ?></td>
			<td><?php echo $user['name']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['role']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array(), __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
