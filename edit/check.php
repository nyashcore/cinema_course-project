<?php	
	try{ $pdo = new PDO('mysql:host=localhost;dbname=mysql', "rolechecker", "rolecheck"); }
	catch(PDOException $e){
		$output = "<p align=center>Невозможно подключиться к серверу БД<br></p>".$e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		unset($_SESSION['login']);
		unset($_SESSION['scrambled']);
		unset($_SESSION['role']);
		exit();
	}
	$sql="SELECT Table_priv from mysql.tables_priv where Table_name='$table' and user='$name';";
	try { $result= $pdo->query($sql); }
	catch (PDOException $e) {
		$output = 'Ошибка при извлечении данных'.$e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		exit();
	}
	$sql="SELECT Select_priv, Update_priv, Delete_priv, Insert_priv from db where user='$name';";
	try { $result1= $pdo->query($sql); }
	catch (PDOException $e) {
		$output = 'Ошибка при извлечении данных'.$e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		exit();
	}
	$row=$result->fetch();
	$row1=$result1->fetch();
	if(	(!strstr($row['Table_priv'],'Update') && !strstr($row1['Update_priv'],'Y'))
		|| (!strstr($row['Table_priv'],'Delete') && !strstr($row1['Delete_priv'],'Y'))
		|| (!strstr($row['Table_priv'],'Insert') && !strstr($row1['Insert_priv'],'Y'))
		|| !strstr($row1['Select_priv'],'Y'))
		{ echo "<p align=center>У вас недостаточно прав.</p>"; exit(); }
?>