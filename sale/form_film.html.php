<form action="" method=get>    		
	<div align=center>	
        <br><label for=genre> Выберите фильм </label>
		<select name="name_f">
	<?php 	if(empty($name_f)){echo "<option value=$name_f>$name_f</option>";}
			$date=date("Y-m-d");
			$sql="SELECT name_f FROM film where out_date>='$date' group by name_f;";
			try { $result=$pdo->query($sql); }
			catch (PDOException $e) {
				$output = 'Ошибка при извлечении данных'.$e->getMessage();
				include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
				exit();
			}
			$i=0;
			while ($row = $result->fetch()) {
				$i++;
				?><option value="<?php echo $row['name_f']; ?>"<? if($row['name_f']==$name_f){ echo " selected";} ?>><?php echo $row['name_f']; ?></option><?php
			}
			if ($i < 1) {
				$output = '<br>База данных пуста<br>';
				include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
			} ?>
		</select>
		<label for=show_all>Все сеансы</label>
		<input type=checkbox name=show_all id=show_all<?php if(isset($_GET['show_all'])) { echo " checked"; }?>>
		<input type=reset value=сбросить>
	    <input type=submit name=option_film value=отправить>
	</div>
</form>