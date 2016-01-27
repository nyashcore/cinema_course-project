try { $result=$pdo->query($sql); }
catch (PDOException $e) {
	$output = 'Ошибка при извлечении данных'.$e->getMessage();
	include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
	exit();
}