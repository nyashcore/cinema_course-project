<?php
	if(isset($_GET['show_all'])) {
		$sql="SELECT id_h, id_s, date_s,time_s,name_h FROM session JOIN film using(id_f) JOIN hall using(id_h) where name_f='$name_f' and date_s>=curdate() order by date_s, time_s;";
	}
	else {
		$date=date("Y-m-d", time()+(3*60*60*24)); 
		$sql="SELECT id_h, id_s, date_s,time_s,name_h FROM session JOIN film using(id_f) JOIN hall using(id_h) where name_f='$name_f' and date_s>=curdate() and date_s<='$date' order by date_s, time_s;";
	}
	try { $result=$pdo->query($sql); }
	catch (PDOException $e) {
		$output = 'Ошибка при извлечении данных'.$e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		exit();
	}?> 
	<form action="" method=GET>
		<div align=center><?php
			if(empty($name_f)) { echo "Фильм не выбран."; exit(); }
			$i=0; ?>
			<table class="out" border=1 width=50%>
				<tbody>
					<?php while ($row = $result->fetch())
					{
						$i++;
						if($i==1) {	?>
							<tr>
								<th class="out">&nbsp;</th>
								<th class="out">Зал</th>
								<th class="out">Дата сеанса</th>
								<th class="out">Время сеанса</th>
							</tr><?php 
						} ?>
						<tr align=center>
							<td class="out"><input type=radio name=id_s value="<?php echo $row['id_s']; ?>"<?php if($row['id_s']==$id_s) {echo " checked";} ?>></td>
							<td class="out"><?php echo $row['name_h']; ?></td>
							<td class="out"><?php echo $row['date_s']; ?></td>
							<td class="out"><?php echo $row['time_s']; ?></td>
						</tr><?php
					} ?>
				</tbody>
			</table><br><?php
			if(empty($i)) {
				echo "<div align=center>Нет предстоящих сеансов.</div>";
				exit();
			}					
			if(isset($_GET['show_all'])) { ?><input type=hidden name=show_all><?php } ?>
			<input type=hidden name=name_f value="<? echo $name_f; ?>">
			<input type=reset name=reset value="сбросить">
			<input type=submit name=show value="вывести схему зала">
		</div>
	</form>