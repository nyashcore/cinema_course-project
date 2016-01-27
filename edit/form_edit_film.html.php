<?php 		
		$sql="SELECT * FROM film ORDER BY out_date DESC;";
		try { $result= $pdo->query($sql); }
		catch (PDOException $e) {
			$output = 'Ошибка при извлечении данных'.$e->getMessage();
			include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
			exit();
		}
		$i=0; $j=0;
		echo "<div align=center><input type=text value=Название disabled> ";
		echo "<input type=text value=Режиссёр disabled> ";
		echo "<input type=text value=Жанр disabled> ";
		echo "<input type=text value='Длительность, мин' disabled> ";
		echo "<input type=text size=16 value='Дата премьеры' disabled> ";
		echo "<input type=text size=16 value='Дата окончания' disabled> ";
		echo "<input type=button value=' ' style='width:175px;' disabled></div><br>";
		if(isset($_REQUEST['new_film'])) {
		unset($_SESSION['added']);
		?>
			<div align=center><form action="" method=GET>
				<input type=text name=name_f>
				<input type=text name=director>
				<input type=text name=genre>
				<input type=text name=length>
				<input type="date" name=premiere>
				<input type="date" name=out_date>
				<input type=submit name=add_film value="добавить" style='width:104px;'>
				<input type=submit name=none value="отмена" style='width:66px;'>
				</form></div><?php
		}
		while($row=$result->fetch())
		{
			?><div align=center><form action="" method=GET>
				<input type=text<?php if($row['out_date']<date("Y-m-d")) { echo ' class="out"'; } ?> name=name_f value="<?php echo $row['name_f']; ?>">
				<input type=text<?php if($row['out_date']<date("Y-m-d")) { echo ' class="out"'; } ?> name=director value="<?php echo $row['director']; ?>">
				<input type=text<?php if($row['out_date']<date("Y-m-d")) { echo ' class="out"'; } ?> name=genre value="<?php echo $row['genre']; ?>">
				<input type=text<?php if($row['out_date']<date("Y-m-d")) { echo ' class="out"'; } ?> name=length value="<?php echo $row['length']; ?>">
				<input type="date"<?php if($row['out_date']<date("Y-m-d")) { echo ' class="out"'; } ?> name=premiere value="<?php echo $row['premiere']; ?>">
				<input type="date"<?php if($row['out_date']<date("Y-m-d")) { echo ' class="out"'; } ?> name=out_date value="<?php echo $row['out_date']; ?>">
				<input type=hidden name=id_f value="<?php echo $row['id_f']; ?>">
				<input type=submit name=edit_film value="редактировать">
				<input type=submit name=del_film value="удалить">
				</form></div><?php 
				if($row['premiere']<=date("Y-m-d") && $row['out_date']>=date("Y-m-d")) { $j++; }
				$i++;
		}
		?><p align=center><input type=button value="Всего фильмов в архиве: <?php echo $i; ?>, из них в текущем репертуаре: <?php echo $j; ?>." disabled></p><?
?>