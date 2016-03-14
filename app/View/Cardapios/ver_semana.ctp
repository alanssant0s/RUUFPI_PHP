<div class="cardapios index">
	<h2><?php echo __('Cardapios'); ?></h2>
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
		$pm = $month;
		if($pm < 10)
			$pm = "0$pm";
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
				}
				if($pm2 < 10)
						$pm2 = "0$pm2";
				if($sab < 10)
					$sab = "0$sab";		

				echo "$pseg/$pm - $sab/$pm2"
			?>&nbsp;</td>
			<td class="actions">
				<?php if($cardapios["$year-$pm-$pseg"] != null){?>
					<?php echo $this->Html->link(__('Pdf'), array('action' => 'view', $cardapios["$year-$pm-$pseg"]['id'])); ?>
					<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $cardapios["$year-$pm-$pseg"]['id'])); ?>
					<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $cardapios["$year-$pm-$pseg"]['id'],$year,$month)); ?>
					<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $cardapios["$year-$pm-$pseg"]['id']), array(), __('Are you sure you want to delete # %s?', $cardapios["$year-$pm-$pseg"]['id'])); ?>
				<?php } else{?>
					<?php echo $this->Html->link(__('Criar'), array('action' => 'add', $year,$month,$seg)); ?>
				<?php }?>
		</td>
		
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>