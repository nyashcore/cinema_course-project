<?php session_start(); ?>
<html>
	<head>
		<title>Авторизация</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
	</head>
	<body>
<?php 	if($_POST['act']=="выйти"){
			unset($_SESSION['login']);
			unset($_SESSION['scrambled']);
			unset($_SESSION['role']);
		}
		if($_POST['act']=="войти"){ 
			$login=$_POST['login'];
			$password=$_POST['password'];
			$scrambled=md5($password);
			$_SESSION['login']=$login;
			$_SESSION['scrambled']=$scrambled;
			include $_SERVER['DOCUMENT_ROOT'].'/includes/roleconnect.php'; 
			include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php';
			$_SESSION['role']=$role;
			$_SESSION['name']=$name;
		}
		include $_SERVER['DOCUMENT_ROOT'].'/includes/header.html.php';
		if(isset($error)){
			$output = "<div align=center>Введён неверный логин или пароль.<br>";
			include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		}	
		if(!isset($_SESSION['role'])){ echo "<p align=center>Для работы с системой необходимо авторизоваться.</p>"; }
		else{		
			echo "<br><div align=center>Вы вошли как $_SESSION[login] ($_SESSION[name])</div><br>";
			include 'form_exit.html.php';
			exit();
		}
		include 'form_enter.html.php'; ?>
	</body>
</html>