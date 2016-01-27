<p align=center><b>Прибыльность фильмов</b></p>
<?php	if(!isset($_GET['send'])) {
			include 'form_date.html.php';
			exit();
		}
		$start_date=$_GET['start_date'];
		$end_date=$_GET['end_date'];
		include 'form_date.html.php';	
		$sql="SELECT sum(proceeds_s),name_f,100*sum(proceeds_s)/(select sum(proceeds_s) FROM session
		where date_s>'$start_date' and date_s<'$end_date') as a from session join film using(id_f) 
		where date_s>'$start_date' and date_s<'$end_date' group by id_f;";
		try { $result=$pdo->query($sql); }
		catch (PDOException $e) {
			$output = 'Ошибка при извлечении данных'.$e->getMessage();
			include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
			exit();
		}
		while ($row = $result->fetch())
			$arr[] = array('sum(proceeds_s)' => $row['sum(proceeds_s)'], 'name_f' => $row['name_f'], 'a' => $row['a']);
		if (!empty($arr)) { include 'arr_output.html.php'; }
		else {
			$output = '<br>Нет результатов<br>';
			include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		} ?>