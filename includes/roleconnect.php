<?php
	$login=$_SESSION['login'];
	$scrambled=$_SESSION['scrambled'];
	try{
		$pdo = new PDO('mysql:host=localhost;dbname=bmstufilms', "rolechecker", "rolecheck");
	}
	catch(PDOException $e){
		$output = "<p align=center>Невозможно подключиться к серверу БД<br></p>".$e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		unset($_SESSION['login']);
		unset($_SESSION['scrambled']);
		unset($_SESSION['role']);
		exit();
	}
	$sql="SELECT id_role from users WHERE login='$login' and password='$scrambled';";
	try{
		$result= $pdo->query($sql);
	}
	catch (PDOException $e){
		$output = 'Ошибка при извлечении данных'.$e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		exit();
	}
	$row=$result->fetch();
	$role=$row['id_role'];
	$sql="SELECT name,password from roles WHERE id_role='$role';";
	try{
		$result= $pdo->query($sql);
	}
	catch (PDOException $e){
		$output = 'Ошибка при извлечении данных'.$e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		exit();
	}
	$row=$result->fetch();
	$name=$row['name'];
	$password=$row['password'];
?>