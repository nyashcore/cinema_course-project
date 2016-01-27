<p align=center><b>Процент продаж</b></p>
<?php	if(!isset($_GET['send'])) {
			include 'form_date.html.php';
			exit();
		}
		$start_date=$_GET['start_date'];
		$end_date=$_GET['end_date'];
		include 'form_date.html.php';	
		$sql="select sum(status) as c,count(id_t) as s, name_f,genre from session JOIN ticket USING(id_s) JOIN film USING(id_f)
		where date_s>'$start_date' and date_s<'$end_date' group by name_f;";
		try { $result=$pdo->query($sql); }
		catch (PDOException $e) {
			$output = 'Ошибка при извлечении данных'.$e->getMessage();
			include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
			exit();
		}
		while ($row = $result->fetch())
			$arr[] = array('name_f' => $row['name_f'], 's' => $row['s'], 'c' => $row['c'], 'un' => $row['s']-$row['c'], 'proc' => $row['c']/$row['s'],'genre' => $row['genre']);
		if (!empty($arr)) { include 'arr_output.html.php'; }
		else {
			$output = '<br>Нет результатов<br>';
			include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		} ?>