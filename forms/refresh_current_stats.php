<?php
	//db_connect
	include '../db_connect/db.php';	
	
	$aNickName = $_COOKIE['CMO_NICK_NAME'];
	
	$query = "SELECT m.M_ID, m.M_Name, m.M_Image, m.Lvl, m.Hp, m.A, m.D, m.S, m.Sa, m.Sd, m.C_Hp, m.C_A, m.C_D, m.C_S, m.C_Sa, m.C_Sd, m.Exp, m.A1, m.A2, m.A3, m.A4, m.A1_Pp, m.A2_Pp, m.A3_Pp, m.A4_Pp, m.Start, ml.M_ID_L, ml.Type1, ml.Type2, ml.Exp_Group
						  FROM monsters m INNER JOIN monster_list ml ON ml.Name = m.M_Name WHERE M_Owner='$aNickName' AND Aktiv='1' ORDER BY M_ID";	
	$result = mysql_query($query) or die("Query failed : " . mysql_error());
	while ($aRow = mysql_fetch_array($result)) {
		$f_m_id[] = $aRow["M_ID"];
		$f_m_name[] = $aRow["M_Name"];
		$f_m_image[] = $aRow["M_Image"];
		$f_m_lvl[] = $aRow["Lvl"];
		$f_m_hp_stat[] = $aRow["Hp"];
		$f_m_a_stat[] = $aRow["A"];
		$f_m_d_stat[] = $aRow["D"];
		$f_m_s_stat[] = $aRow["S"];
		$f_m_sa_stat[] = $aRow["Sa"];
		$f_m_sd_stat[] = $aRow["Sd"];
		$f_m_c_hp[] = $aRow["C_Hp"];
		$f_m_c_a[] = $aRow["C_A"];
		$f_m_c_d[] = $aRow["C_D"];
		$f_m_c_s[] = $aRow["C_S"];
		$f_m_c_sa[] = $aRow["C_Sa"];
		$f_m_c_sd[] = $aRow["C_Sd"];
		$f_m_exp[] = $aRow["Exp"];
		$f_m_a1[] = $aRow["A1"];
		$f_m_a2[] = $aRow["A2"];
		$f_m_a3[] = $aRow["A3"];
		$f_m_a4[] = $aRow["A4"];
		$f_m_a1_pp[] = $aRow["A1_Pp"];
		$f_m_a2_pp[] = $aRow["A2_Pp"];
		$f_m_a3_pp[] = $aRow["A3_Pp"];
		$f_m_a4_pp[] = $aRow["A4_Pp"];
		$f_start[] = $aRow["Start"];
		$f_ml_id[] = $aRow["M_ID_L"];
		$f_m_type1[] = $aRow["Type1"];
		$f_m_type2[] = $aRow["Type2"];
		$f_exp_group[] = $aRow["Exp_Group"];
	}
	if (mysql_num_rows($result)==0){	//check if result empty
		$f_anz_aktiv_monster = 0;
	} else {
		$f_anz_aktiv_monster = count($f_m_name);
	}
	mysql_free_result($result);
	
	for($i=0; $i<$f_anz_aktiv_monster; $i++){
		//fill current stats
		mysql_query ("UPDATE monsters SET C_A='$f_m_a_stat[$i]', C_D='$f_m_d_stat[$i]', C_S='$f_m_s_stat[$i]', C_Sa='$f_m_sa_stat[$i]', C_Sd='$f_m_sd_stat[$i]', A_Count='0', D_Count='0', S_Count='0', Sa_Count='0', Sd_Count='0' WHERE M_ID='$f_m_id[$i]'");
	}
?>