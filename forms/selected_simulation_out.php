<?php
	include '../db_connect/db.php';
	
	$aNickName = $_COOKIE['CMO_NICK_NAME'];
	
	mysql_query("DELETE FROM selected_simulation WHERE Nick_Name='$aNickName'");
?>