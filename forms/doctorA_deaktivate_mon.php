<?php	
	//db_connect
	include '../db_connect/db.php';
			
	$m_id_deaktivated = $_POST['m_id_deaktivate'];
	
	mysql_query ("UPDATE monsters SET Aktiv='0', Start='0' WHERE M_ID = '$m_id_deaktivated'");
?>