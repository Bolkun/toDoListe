<?php
	include '../db_connect/db.php';
	
	$choice = $_POST['player_choice'];
	
	$aNickName = $_COOKIE['CMO_NICK_NAME'];
	
	$query = "SELECT Value FROM selected_simulation";	
	$result = mysql_query($query) or die("Query failed : " . mysql_error());
	while ($aRow = mysql_fetch_array($result)) {
		$ss_value[] = $aRow["Value"];
	}
	if(mysql_num_rows($result)==0){	//check if result empty
		$sql_insert = "INSERT INTO selected_simulation VALUES ('', '$choice', '$aNickName');";
		$result_insert = mysql_query($sql_insert) or die(mysql_error());
	} else {
		mysql_query ("UPDATE selected_simulation SET Value='$choice' WHERE Nick_Name='$aNickName'");
	}
	mysql_free_result($result);
?>