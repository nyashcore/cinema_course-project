<form action =""  method=get>    		
	 <div align=left>
			<?php 
				$sql="select max(line),max(seat) from ticket JOIN session using(id_s)  where id_s='$id_s';";
			try { $result=$pdo->query($sql); }
			catch (PDOException $e) {
				$output = 'Ошибка при извлечении данных'.$e->getMessage();
				include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
				exit();
			}
				$row1=$result->fetch();
				$sql="select line, seat, status,price, id_t from ticket JOIN session using(id_s) where id_s='$id_s' order by line, seat;";
			try { $result=$pdo->query($sql); }
			catch (PDOException $e) {
				$output = 'Ошибка при извлечении данных'.$e->getMessage();
				include $_SERVER['DOCUMENT_ROOT'].'/includes/output.html.php';
				exit();
			}
				$i=1;
				$j=1;
				?><table border=1 align=center style="border-collapse: collapse; border: 2px solid white;"><tbody><tr>
				<th class="out" align=center>р\м</td>
				<?php				
				while($j<=$row1['max(seat)']){
					echo "<th class=out align=center>".$j."</th>";
					$j++;
				}
				?></tr><?php
				while($i<=$row1['max(line)'])
				{
					$j=1;
					?><tr><th class=out align=center><?php echo $i; ?></th><?php
					while($j<=$row1['max(seat)'])
					{
						$row=$result->fetch();	
						?><td class=out align=center>
						<label style="width: 32px; height: 32px; display: block; position: relative;"><input type=checkbox name=box[] id=box value=<?php echo $row['id_t']; ?> <?php if($row['status']==1) echo "checked disabled"; ?> ><span></span></label></td><?php
						$j++;
					}
					$i++;
					?></tr><?php
				}	
					?></tbody></table><?php				
			?>
			<p align=center>
            <input type=reset value=сбросить>
	        <input type=submit name=ssale value=отправить> 
					<?if(isset($_GET['show_all'])) { ?><input type=hidden name=show_all><?php }?>		 
					<input type=hidden name=show>	 
					<input type=hidden name=name_f value="<? echo $_GET["name_f"]; ?>">
					<input type=hidden name=id_s value=<? echo $_GET['id_s']; ?>>
	</p>
</form>