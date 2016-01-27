<br><?php 	
		$sum=0;
		$id_s=$_GET['id_s'];
		$sql="SELECT date_s,time_s,name_h from session JOIN hall using(id_h) where id_s=$id_s;";
		try { $result=$pdo->query($sql); }
		catch (PDOException $e) {
			$output = 'Ошибка при извлечении данных'.$e->getMessage();
			include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
			exit();
		}
		$row=$result->fetch();
		echo "<div align=center>Фильм: ".$_GET["name_f"].", зал: ".$row['name_h'].", дата: ".$row['date_s'].", время: ".$row['time_s']."<br>Выбранные билеты:<br>";
		if(isset($_SESSION['box'])){
			foreach($_SESSION['box'] as $item){
				$sql="SELECT seat,line,price FROM ticket WHERE id_t=$item;";
				try { $result= $pdo->query($sql); }
				catch (PDOException $e) {
					$output = 'Ошибка при извлечении данных'.$e->getMessage();
					include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
					exit();
				}
				$row=$result->fetch();
				echo "ряд: ".$row['line'].", место: ".$row['seat'].", цена: ".$row['price']." руб.<br>";
				$sum=$sum+$row['price'];
			}
		}
		echo "Общая стоимость: ".$sum." руб.";
?><form action="" method=GET>
					<?php if(isset($_GET['show_all'])) { ?><input type=hidden name=show_all><?php }?>
					<input type=hidden name=name_f value="<? echo $_GET["name_f"]; ?>">
					<input type=hidden name=id_s value=<? echo $_GET['id_s']; ?>>	
	<br><input type=submit name=sale_ok id=sale_ok value="подтвердить">
	<input type=submit name=show value="отмена"></div>
</form></div>