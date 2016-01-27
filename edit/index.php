<?php	session_start();
		if(!isset($_SESSION['role'])) { header('location:../authorization?refer=4'); exit(); } ?>
<html>
	<head>
		<title>Редактирование</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
	</head>
	<body>
<?php 	include $_SERVER['DOCUMENT_ROOT'].'/includes/header.html.php';
		include $_SERVER['DOCUMENT_ROOT'].'/includes/roleconnect.php'; 
		if($_SESSION['role']=="1") { $table='users'; }
		else if($_SESSION['role']=="2") { $table='film'; }
		else { echo "<p align=center>У вас недостаточно прав.</p>"; exit(); }
		include 'check.php';
		include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php';
		if(isset($_GET['edit_film'])) {
			$id_f=$_GET['id_f'];
			$name_f=$_GET['name_f'];
			$director=$_GET['director'];
			$genre=$_GET['genre'];
			$length=$_GET['length'];
			$premiere=$_GET['premiere'];
			$out_date=$_GET['out_date'];
			$sql="UPDATE film SET name_f='$name_f', director='$director', genre='$genre', length='$length', premiere='$premiere', out_date='$out_date' WHERE id_f=$id_f;";	
			try { $result= $pdo->query($sql); }
			catch (PDOException $e) {
				$output = 'Ошибка при извлечении данных'.$e->getMessage();
				include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
				exit();
			}
		}
		if(isset($_GET['del_film'])) { include 'form_del_film.html.php'; }
		if(isset($_GET['del_film_ok'])) {
			$id_f=$_GET['id_f'];
			$out_date=date("Y-m-d", time()-(60*60*24));
			$sql="UPDATE film SET out_date='$out_date' WHERE id_f=$id_f;";	
			try { $result= $pdo->query($sql); }
			catch (PDOException $e) {
				$output = 'Ошибка при извлечении данных'.$e->getMessage();
				include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
				exit();
			}
		}
		if(isset($_GET['del_film_db'])) {
			$id_f=$_GET['id_f'];
			$sql="DELETE FROM film WHERE id_f=$id_f;";	
			try { $result= $pdo->query($sql); }
			catch (PDOException $e) {
				$output = 'Ошибка при извлечении данных'.$e->getMessage();
				include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
				exit();
			}
		}
		if(isset($_GET['add_film'])) {	
			if(!isset($_SESSION['added'])){
				$_SESSION['added']=1;
				$name_f=$_GET['name_f'];
				$director=$_GET['director'];
				$genre=$_GET['genre'];
				$length=$_GET['length'];
				$premiere=$_GET['premiere'];
				$out_date=$_GET['out_date'];
				$sql="INSERT film VALUES(NULL, '$name_f', '$director', '$genre', 0, $length, '$premiere', '$out_date');";	
				try { $result= $pdo->query($sql); }
				catch (PDOException $e) {
					$output = 'Ошибка при извлечении данных'.$e->getMessage();
					include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
					exit();
				}
			}
		}
		if(isset($_GET['edit_user'])) {
			$id_u=$_GET['id_u'];
			$name_r=$_GET['name_r'];
			$name_u=$_GET['name_u'];
			$surname_u=$_GET['surname_u'];
			$login_u=$_GET['login_u'];
			$date_upload=date("Y-m-d");
			$sql="SELECT id_role FROM roles WHERE name='$name_r';";
			try { $result= $pdo->query($sql); }
			catch (PDOException $e) {
				$output = 'Ошибка при извлечении данных'.$e->getMessage();
				include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
				exit();
			}
			$row=$result->fetch();
			$id_role=$row['id_role'];
			$sql="UPDATE users SET name_u='$name_u', surname_u='$surname_u', id_role=$id_role, login='$login_u', date_upload='$date_upload' WHERE id_u=$id_u;";	
			try { $result= $pdo->query($sql); }
			catch (PDOException $e) {
				$output = 'Ошибка при извлечении данных'.$e->getMessage();
				include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
				exit();
			}
		}
		if(isset($_GET['del_user'])) { include 'form_del_user.html.php'; }
		if(isset($_GET['del_user_ok'])) {
			$id_u=$_GET['id_u'];
			$date_upload=date("Y-m-d");
			$out_date=date("Y-m-d");
			$sql="UPDATE users SET id_role=4, date_upload='$date_upload' WHERE id_u=$id_u;";	
			try { $result= $pdo->query($sql); }
			catch (PDOException $e) {
				$output = 'Ошибка при извлечении данных'.$e->getMessage();
				include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
				exit();
			}
		}
			if(isset($_GET['del_user_db'])) {
				$id_u=$_GET['id_u'];
				$out_date=date("Y-m-d");
				$sql="DELETE FROM users WHERE id_u=$id_u;";	
				try { $result= $pdo->query($sql); }
				catch (PDOException $e) {
					$output = 'Ошибка при извлечении данных'.$e->getMessage();
					include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
					exit();
				}
			}
		if(isset($_GET['add_user']) && $_GET['login_u']!='' && $_GET['pass']!='') {			
			if(!isset($_SESSION['added'])){
				$_SESSION['added']=1;
				$name_u=$_GET['name_u'];
				$surname_u=$_GET['surname_u'];
				$name_r=$_GET['name_r'];
				$login_u=$_GET['login_u'];
				$pass=$_GET['pass'];
				$scram=md5($pass);
				$date_reg=date("Y-m-d");
				$date_upload=date("Y-m-d");
				$sql="SELECT id_role FROM roles WHERE name='$name_r';";
				try { $result= $pdo->query($sql); }
				catch (PDOException $e) {
					$output = 'Ошибка при извлечении данных'.$e->getMessage();
					include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
					exit();
				}
				$row=$result->fetch();
				$id_role=$row['id_role'];				
				$sql="INSERT users VALUES(NULL, '$name_u', '$surname_u', '$login_u', '$scram', '$date_reg', $id_role, '$date_upload');";	
				try { $result= $pdo->query($sql); }
				catch (PDOException $e) {
					$output = 'Ошибка при извлечении данных'.$e->getMessage();
					include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
					exit();
				}
			}
		}
		if($_SESSION['role']=="2") {?>
			<p align=center>
				<a class=olo href="?new_film">Добавить фильм</a>
			</p><?php 
			include 'form_edit_film.html.php';
			exit();
		}
		if($_SESSION['role']=="1") {?>
			<p align=center>
				<a class=olo href="?new_user">Добавить пользователя</a>
			</p><?php 
			include 'form_edit_user.html.php';
			exit();
		} ?>
	</body>
</html>