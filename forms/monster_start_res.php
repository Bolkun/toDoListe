<?php
	//db_connect
	include '../db_connect/db.php';
			
	$monster_id = $_POST['m_id'];
	$monster_start = $_POST['start'];	//old		
	
	mysql_query ("UPDATE monsters SET Start='1' WHERE M_ID='$monster_id'");
	mysql_query ("UPDATE monsters SET Start='0' WHERE M_ID='$monster_start'");
?>