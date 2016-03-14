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
				<?php if($cardapios["$year-$pm-$pseg"] != null){?>
					<?php echo $this->Html->link(__('Pdf'), array('action' => 'pdf', $cardapios["$year-$pm-$pseg"]['id'])); ?>
					<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $cardapios["$year-$pm-$pseg"]['id'],$year,$month)); ?>					
				<?php } else{?>
					<?php echo $this->Html->link(__('Criar'), array('action' => 'add', $year,$month,$seg)); ?>
				<?php }?>
		</td>
		
	</tr>
<?php endforeach; ?>