<p align=center><b>Прибыльность жанров</b></p>
<?php	if(!isset($_GET['send'])) {
			include 'form_date.html.php'; 
			exit();
		}
		$start_date=$_GET['start_date'];
		$end_date=$_GET['end_date'];
		include 'form_date.html.php';	
		$sql="select sum(proceeds_s) as su, genre as genr, count(id_f) as nu, sum(proceeds_s)/count(id_f) as aver from session join film using(id_f)
		where date_s>'$start_date' and date_s<'$end_date' group by genre;";
		try { $result=$pdo->query($sql); }
		catch (PDOException $e) {
			$output = 'Ошибка при извлечении данных'.$e->getMessage();
			include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
			exit();
		}
		while ($row=$result->fetch())
			{ $arr[] = array('su' => $row['su'], 'genr' => $row['genr'], 'nu' => $row['nu'], 'aver' => $row['aver']); }
		if (!empty($arr)) { include 'arr_output.html.php'; }
		else {
			$output = '<br>Нет результатов<br>';
			include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
		} ?>
