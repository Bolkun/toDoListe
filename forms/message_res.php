<?php	
	//db_connect
	include '../db_connect/db.php';

	//heal and restore pp
	$user_mes = $_POST['User'];
	$toUser_mes = $_POST['toUser'];
	$messageText_mes = $_POST['messageText'];
	
	$time_mes = date('H:i:s');	// 17:16:17
	$date_mes = date('Y-m-d');	//2018-06-29
	
	$sql_insert = "INSERT INTO chat VALUES ('', '$date_mes', '$time_mes', '$user_mes', '$toUser_mes', '$messageText_mes')";
	$result_insert = mysql_query($sql_insert) or die(mysql_error());
?>