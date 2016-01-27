<?php 	session_start();
		if(!isset($_SESSION['role'])) { header('location:../authorization?refer=4'); exit(); }?>
<html>
	<head>
		<title>Продажа билетов</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
	</head>
	<body>
<?php 	include $_SERVER['DOCUMENT_ROOT'].'/includes/header.html.php';
		include $_SERVER['DOCUMENT_ROOT'].'/includes/roleconnect.php'; 
		include 'check.php';
		include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php';
		if($_GET['show']=='отмена') { unset($_SESSION['box']); }
		if(isset($_GET['sale_ok'])) {
				if(isset($_SESSION['box'])) {
					foreach($_SESSION['box'] as $item) {
						$sql="UPDATE ticket SET status=1 where id_t=$item;";
						try { $result= $pdo->query($sql); }
						catch (PDOException $e){
							$output = 'Ошибка при извлечении данных'.$e->getMessage();
							include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
							exit();
						}
					}
					$output = "<div align=center>Билеты успешно проданы.</div><br>";				
				}
				else {
					$output = "<div align=center>Не удалось продать билеты.</div><br>";
				}
				unset($_GET['show_all']);
				$output = $output."<div align=center><a class=olo href='index.php?refer=2'>Перейти к продаже билетов.</a></div>";
				include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
				unset($_SESSION['box']);
				exit();
		}	
		if(isset($_GET['box'])) { $_SESSION['box']=$_GET['box']; }
		if(isset($_GET['ssale'])) {
			if(!empty($_SESSION['box'])) {
				include 'form_agree.html.php';
				exit();
			}
			else { echo "<br><div align=center>Билеты не выбраны.</div>"; }
		}
		if (!isset($_GET["name_f"])) { include 'form_film.html.php'; exit(); }
		else { unset($_SESSION['show']); }
		$name_f=$_GET["name_f"];
		include 'form_film.html.php';		
		if (!isset($_GET['id_s'])) { 
			include 'form_session.html.php';
			if(isset($_GET['show'])) {
				echo "<div align=center>Сеанс не выбран.</div>";
			}	
			exit();	
		}
		$id_s=$_GET['id_s'];
		if(isset($_GET['show'])) { include 'form_hall.html.php';}
		include 'form_session.html.php';
		?>	
	</body>
</html>
