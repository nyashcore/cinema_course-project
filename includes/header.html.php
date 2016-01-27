<table class="header">
	<tbody>
		<tr>
		<td width="25%" align=center><a class="header"<?php if($_REQUEST['refer']==1 || ($_SESSION['refer'] == 1 && !isset($_REQUEST['refer']))){ echo ' style="color:black"'; $_SESSION['refer']=1; }?> href="../query?refer=1">
			<font size="5">Запросы</font></a></td>
		<td width="25%" align=center><a class="header"<?php if($_REQUEST['refer']==2 || ($_SESSION['refer'] == 2 && !isset($_REQUEST['refer']))){ echo ' style="color:black"'; $_SESSION['refer']=2; }?> href="../sale?refer=2">
			<font size="5">Продажа билетов</font></a></td>
		<td width="25%" align=center><a class="header"<?php if($_REQUEST['refer']==3 || ($_SESSION['refer'] == 3 && !isset($_REQUEST['refer']))){ echo ' style="color:black"'; $_SESSION['refer']=3; }?> href="../edit?refer=3">
			<font size="5">Редактирование</font></a></td>
		<td width="25%" align=center><a class="header"<?php if($_REQUEST['refer']==4 || ($_SESSION['refer'] == 4 && !isset($_REQUEST['refer']))){ echo ' style="color:black"'; $_SESSION['refer']=4; }?> href="../authorization?refer=4">
			<font size="5"><?php if(!isset($_SESSION[login])){ echo "Авторизация"; } else { echo "$_SESSION[login] ($_SESSION[name])"; } ?></font></a></td></tr>
	</tbody>
</table>