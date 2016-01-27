<?php	
	try { $pdo = new PDO('mysql:host=localhost;dbname=mysql', "rolechecker", "rolecheck"); }
	catch(PDOException $e){
		$output="<p align=center>Невозможно подключиться к серверу БД<br></p>".$e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		unset($_SESSION['login']);
		unset($_SESSION['scrambled']);
		unset($_SESSION['role']);
		exit();
	}
	$sql="SELECT Select_priv from db where user='$name';";
	try { $result= $pdo->query($sql); }
	catch (PDOException $e) {
		$output = 'Ошибка при извлечении данных'.$e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		exit();
	}
	$row=$result->fetch();
	if(!strstr($row['Select_priv'],'Y')) { echo "<p align=center>У вас недостаточно прав.</p>"; exit(); }
	if($name!='admin' && $name!='manager') { echo "<p align=center>У вас недостаточно прав.</p>"; exit(); }
?>