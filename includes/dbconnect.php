<?php
	try{
		$pdo = new PDO('mysql:host=localhost;dbname=bmstufilms', "$name", "$password");
	}
	catch(PDOException $e){
		unset($_SESSION['login']);
		unset($_SESSION['scrambled']);
		unset($_SESSION['role']);
		$error=1;
	}
	
		$sql="SET NAMES 'utf8';";
					try { $result= $pdo->query($sql); }
			catch (PDOException $e) {
				$output = 'Ошибка при извлечении данных'.$e->getMessage();
				include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
				exit();
			}
?>