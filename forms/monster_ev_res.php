<?php
	//db_connect
	include '../db_connect/db.php';
			
	$monster_id = $_POST['m_id'];
	$monster_stat = $_POST['stat'];	//Hp_Ev
	$monster_amount = $_POST['amount'];	
	
	mysql_query ("UPDATE monsters SET $monster_stat=$monster_stat+$monster_amount, Ev=Ev-$monster_amount WHERE M_ID='$monster_id'");
?>