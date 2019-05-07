<?php	
	//db_connect
	include '../db_connect/db.php';
	
	$aNickName = $_COOKIE['CMO_NICK_NAME'];
	
	$m_id_buy_res = $_POST['m_id_buy'];
	
	mysql_query ("UPDATE items SET Item_Amount=Item_Amount-1000 WHERE Item_Owner='$aNickName' AND IL_ID='1'");
	mysql_query ("UPDATE monsters SET M_Owner='$aNickName' WHERE M_ID = '$m_id_buy_res'");
?>