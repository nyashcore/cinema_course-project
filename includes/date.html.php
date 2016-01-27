<label for=start_date>Начальная дата</label>
<input type=date name=start_date id=start_date<?php if(isset($start_date)) { echo " value=$start_date"; } ?>>
<label for=end_date>Конечная дата</label>		
<input type=date name=end_date id=end_date<?php if(isset($end_date)) { echo " value=$end_date"; } ?>>