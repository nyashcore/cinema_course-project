<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body bgcolor="white" text ="blue">
		<form action =""  method=get>    		
			<div align=center>
		<?php	include $_SERVER['DOCUMENT_ROOT'].'/includes/date.html.php'; ?>
				<input type=hidden name=<?php if(isset($_REQUEST['q1'])) { echo "q1"; } if(isset($_REQUEST['q2'])) { echo "q2"; } if(isset($_REQUEST['q3'])) { echo "q3"; } ?>>
				<input type=reset value=сбросить>
				<input type=submit name=send value=отправить>
			</div>
		</form>
	</body>
</html>
