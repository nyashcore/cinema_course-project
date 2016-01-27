<?php
		if(isset($_REQUEST['new_user'])) {
		unset($_SESSION['added']);	
		?>
		<div align=center>
		<input type=text value=Роль disabled>
		<input type=text value=Имя disabled>
		<input type=text value=Фамилия disabled>
		<input type=text value=Логин disabled>
		<input type=text value=Пароль disabled>
		<input type=button name=none value=" " style='width:174px;' disabled>
		</div>
			<div align=center><form action="" method=GET>
				<input type=text name=name_r>
				<input type=text name=name_u>
				<input type=text name=surname_u>
				<input type=text name=login_u>
				<input type=text name=pass>
				<input type=submit name=add_user value="добавить" style='width:104px;'>
				<input type=submit name=none value="отмена" style='width:66px;'>
				</form></div><?php
		}
		$sql="SELECT * FROM users JOIN roles using(id_role) order by id_role;";
		try { $result= $pdo->query($sql); }
		catch (PDOException $e) {
			$output = 'Ошибка при извлечении данных'.$e->getMessage();
			include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
			exit();
		}
		$i=0; $a=0; $s=0; $m=0;
		echo "<div align=center><input type=text value=Роль disabled> ";
		echo "<input type=text value=Логин disabled> ";
		echo "<input type=text value=Имя disabled> ";
		echo "<input type=text value=Фамилия disabled> ";
		echo "<input type=text size=16 value='Дата регистрации' disabled> ";
		echo "<input type=text size=16 value='Дата изменения' disabled> ";
		echo "<input type=button value=' ' style='width:175px;' disabled></div><br>";

		while($row=$result->fetch())
		{
			?><div align=center><form action="" method=GET>
			<?php 
				$sql="SELECT name FROM roles order by id_role DESC;";
				try { $result1=$pdo->query($sql); }
				catch (PDOException $e) {
					$output = 'Ошибка при извлечении данных'.$e->getMessage();
					include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
					exit();
				}
				?> <select name=name_r style="width: 175px"> <?php
				while ($row1 = $result1->fetch()) {
					?><option align=center value="<?php echo $row1['name']; ?>"<? if($row1['name']==$row['name']){ echo " selected";} ?><?php if($row['name']=='admin') { echo ' disabled'; } ?><?php if($row1['name']=='admin') { echo ' disabled'; } ?>><?php echo $row1['name']; ?></option><?php
				} ?>
				</select>
				<input type=text<?php if($row['name']=='deleted') { echo ' class="out"'; } ?> name=login_u value="<?php echo $row['login']; ?>"<?php if($row['name']=='admin') { echo ' disabled'; } ?>>
				<input type=text<?php if($row['name']=='deleted') { echo ' class="out"'; } ?> name=name_u value="<?php echo $row['name_u']; ?>"<?php if($row['name']=='admin') { echo ' disabled'; } ?>>
				<input type=text<?php if($row['name']=='deleted') { echo ' class="out"'; } ?> name=surname_u value="<?php echo $row['surname_u']; ?>"<?php if($row['name']=='admin') { echo ' disabled'; } ?>>
				<input type="date" name=date_reg value="<?php echo $row['date_reg']; ?>" disabled>
				<input type="date" name=date_upload value="<?php echo $row['date_upload']; ?>" disabled>
				<input type=hidden name=id_u value="<?php echo $row['id_u']; ?>">
				<input type=submit name=edit_user value="редактировать"<?php if($row['name']=='admin') { echo ' disabled'; } ?>>
				<input type=submit name=del_user value="удалить"<?php if($row['name']=='admin') { echo ' disabled'; } ?>>
				</form></div><?php 
				if($row['name']=='admin') { $a++; }
				if($row['name']=='manager') { $m++; }
				if($row['name']=='seller') { $s++; }
				$i++;
		}
		?><p align=center><input type=button value="Всего пользователей в архиве: <?php echo $i; ?>. Из них активных пользователей: <?php echo $a+$m+$s; ?>, из них администраторов: <?php echo $a; ?>, менеджеров: <?php echo $m; ?>, кассиров: <?php echo $s; ?>." disabled></p><?
?>