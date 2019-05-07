<?php	
	//db_connect
	include '../db_connect/db.php';
	
	$aNickName = $_COOKIE['CMO_NICK_NAME'];
	
	$m_old_start = $_POST['old_start_id'];	
	$m_new_start = $_POST['new_start_id'];	
	
	mysql_query ("UPDATE monsters SET Start='0', C_A=A, C_D=D, C_S=S, C_Sa=Sa, C_Sd=Sd, A_Count='0', D_Count='0', S_Count='0', Sa_Count='0', Sd_Count='0' WHERE M_ID='$m_old_start'");
	mysql_query("DELETE FROM wild_monsters WHERE For_User='$aNickName'");
	mysql_query ("UPDATE monsters SET Start='1' WHERE M_ID='$m_new_start'");
?>