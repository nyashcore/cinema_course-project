<?php	session_start();
		if(!isset($_SESSION['role'])) { header('location:../authorization?refer=4'); exit(); }?>
<html>
	<head>
		<title>Запросы</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
	</head>
	<body>
<?php 	include $_SERVER['DOCUMENT_ROOT'].'/includes/header.html.php';
		include $_SERVER['DOCUMENT_ROOT'].'/includes/roleconnect.php'; 
		include 'check.php';
		include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php'; ?>
		<br>
		<div align=center>
			<a class=olo href="?q1">Прибыльность жанров</a>
			<a class=olo href="?q2">Прибыльность фильмов</a>
			<a class=olo href="?q3">Процент продаж</a>
		</div>
<?php	if(isset($_REQUEST['q1'])) { include 'query1.php'; }
		if(isset($_REQUEST['q2'])) { include 'query2.php'; }
		if(isset($_REQUEST['q3'])) { include 'query3.php'; } ?>
	</body>
</html>