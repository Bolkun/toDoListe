<?php	
	//db_connect
	include '../db_connect/db.php';
			
	$i_id_set = $_POST['item_id'];	
	$m_id = $_POST['mon_id'];
	
	mysql_query ("UPDATE items SET Item_Position='1' WHERE IT_ID = '$i_id_set'");
	
	$query = "SELECT I_Slot, I_ID FROM monsters WHERE M_ID='$m_id'";
	$result = mysql_query($query) or die("Query failed : " . mysql_error());
	while ($aRow = mysql_fetch_array($result)) {
		$i_slot[] = $aRow["I_Slot"];
		$i_id_on[] = $aRow["I_ID"];	
	}
	if ($i_slot[0] == 0){	//nothing on(not NULL!!!)
		mysql_query ("UPDATE monsters SET I_Slot='1', I_ID='$i_id_set' WHERE M_ID='$m_id'");
	} else {
		mysql_query ("UPDATE items SET Item_Position='0' WHERE IT_ID = '$i_id_on[0]'");
		mysql_query ("UPDATE monsters SET I_ID='$i_id_set' WHERE M_ID='$m_id'");
	}
	mysql_free_result($result);
?>