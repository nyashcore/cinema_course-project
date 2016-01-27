<div align=center>
	<table class=out border=1 width=50%>                              
		<tbody> 
			<tr>
				<?php if(isset($_REQUEST['q1'])) { ?>
					<th class=out align=center>жанр</th>
					<th class=out align=center>выручка, руб.</th>
					<th class=out align=center>количество сеансов</th>
					<th class=out align=center>в среднем за сеанс, руб.</th>
				<?php }
				if(isset($_REQUEST['q2'])) { ?>
					<th class=out align=center>Фильм</th>
					<th class=out align=center>Кассовые сборы за период</th>
					<th class=out align=center>Процент</th>		
				<?php }	
				if(isset($_REQUEST['q3'])) { ?>
					<th class=out align=center>фильм</th>
					<th class=out align=center>жанр</th>
					<th class=out align=center>билетов продано</th>
					<th class=out align=center>билетов не продано</th>
					<th class=out align=center>процент продаж</th>
				<?php } ?>
			</tr>
			<?php foreach ($arr as $ar): ?>    
			<tr>
				<?php if(isset($_REQUEST['q1'])) { ?>
					<td class=out align=center><?php echo $ar['genr']; ?></td> 	
					<td class=out align=center><?php echo $ar['su']; ?></td>
					<td class=out align=center><?php echo $ar['nu']; ?></td> 
					<td class=out align=center><?php echo (int)$ar['aver']; ?></td> 
				<?php }
				if(isset($_REQUEST['q2'])) { ?>
					<td class=out align=center><?php echo $ar['name_f']; ?></td>
					<td class=out align=center><?php echo $ar['sum(proceeds_s)']; ?></td> 
					<td class=out align=center><?php echo (int)(100*$ar['a'])/100; ?></td> 
				<?php }
				if(isset($_REQUEST['q3'])) { ?>
					<td class=out align=center><?php echo $ar['name_f']; ?></td> 
					<td class=out align=center><?php echo $ar['genre']; ?></td>
					<td class=out align=center><?php echo $ar['c']; ?></td>
					<td class=out align=center><?php echo $ar['un']; ?></td> 
					<td class=out align=center><?php echo (int)(10000*$ar['proc'])/100; ?></td> 
				<?php } ?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>	