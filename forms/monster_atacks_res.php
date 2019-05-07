<?php
	//db_connect
	include '../db_connect/db.php';
			
	$monster_id = $_POST['m_id'];
	$monster_slot = $_POST['slot'];	//A1, A2, A3, A4
	$monster_atack = $_POST['atack'];	
	
	$monster_pp_set_0 = $monster_slot .'_Pp';
	
	mysql_query ("UPDATE monsters SET $monster_slot='$monster_atack', $monster_pp_set_0='0' WHERE M_ID='$monster_id'");
	
?>