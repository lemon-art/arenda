<?

	//вычисляет разницу в днях
	//$d = new DateTime( date("Y-m-d",strtotime($_GET['data_start'])) );
	//echo $d->diff( new DateTime( date("Y-m-d",strtotime($_GET['data_finish'])) ) )->format("%d");
	


echo (strtotime($_GET['data_finish']) - strtotime($_GET['data_start']))/3600/24;
	
?>