<?php	
	//db_connect
	include '../db_connect/db.php';
			
	$i_id = $_POST['item_id'];	
	
	mysql_query ("UPDATE items SET Item_Position='0' WHERE IT_ID = '$i_id'");
	mysql_query ("UPDATE monsters SET I_Slot='0', I_ID='0' WHERE I_ID = '$i_id'");
?>