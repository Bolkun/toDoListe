<?php	
	//db_connect
	include '../db_connect/db.php';

	//heal and restore pp
	$m_id_dd = $_POST['m_id_d'];
	$max_hp_dd = $_POST['max_hp'];
	$max_pp1_dd = $_POST['max_pp1'];
	$max_pp2_dd = $_POST['max_pp2'];
	$max_pp3_dd = $_POST['max_pp3'];
	$max_pp4_dd = $_POST['max_pp4'];
	
	mysql_query ("UPDATE monsters SET C_Hp='$max_hp_dd', A1_Pp='$max_pp1_dd', A2_Pp='$max_pp2_dd', A3_Pp='$max_pp3_dd', A4_Pp='$max_pp4_dd' WHERE M_ID = '$m_id_dd'");
?>