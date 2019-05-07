<?php	
	//db_connect
	include '../db_connect/db.php';
			
	$m_id_aktivated = $_POST['m_id_aktivate'];
	
	mysql_query ("UPDATE monsters SET Aktiv='1' WHERE M_ID = '$m_id_aktivated'");
?>