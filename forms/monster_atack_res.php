<?php	
	//db_connect
	include '../db_connect/db.php';
	
	$aNickName = $_COOKIE['CMO_NICK_NAME'];
	
	$atack_name_used = $_POST['atack_name_used'];
	$nr_atack = $_POST['nr_atack'];
	$nr_pp = $_POST['nr_pp'];
	
	//select user stats
	$query = "SELECT m.M_ID, m.M_Name, m.M_Image, m.Lvl, m.Hp, m.A, m.D, m.S, m.Sa, m.Sd, m.C_Hp, m.C_A, m.C_D, m.C_S, m.C_Sa, m.C_Sd, m.Exp, m.A1, m.A2, m.A3, m.A4, m.A1_Pp, m.A2_Pp, m.A3_Pp, m.A4_Pp, m.Start, m.Hp_Count, m.A_Count, m.D_Count, m.S_Count, m.Sa_Count, m.Sd_Count, ml.M_ID_L, ml.Type1, ml.Type2, ml.Exp_Group
			  FROM monsters m INNER JOIN monster_list ml ON ml.Name = m.M_Name WHERE M_Owner='$aNickName' AND Start='1'";	
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
		$f_hp_count[] = $aRow["Hp_Count"];
		$f_a_count[] = $aRow["A_Count"];
		$f_d_count[] = $aRow["D_Count"];
		$f_s_count[] = $aRow["S_Count"];
		$f_sa_count[] = $aRow["Sa_Count"];
		$f_sd_count[] = $aRow["Sd_Count"];
		$f_ml_id[] = $aRow["M_ID_L"];
		$f_m_type1[] = $aRow["Type1"];
		$f_m_type2[] = $aRow["Type2"];
		$f_exp_group[] = $aRow["Exp_Group"];
	}
	mysql_free_result($result);
	
	//select wild monster stats
	$query = "SELECT wm.M_ID, wm.M_Name, wm.Lvl, wm.Hp AS wmHp, wm.A, wm.D, wm.S, wm.Sa, wm.Sd, wm.C_Hp, wm.C_A, wm.C_D, wm.C_S, wm.C_Sa, wm.C_Sd, wm.Hp_Count, wm.A_Count, wm.D_Count, wm.S_Count, wm.Sa_Count, wm.Sd_Count, wm.A1, wm.A2, wm.A3, wm.A4, ml.M_ID_L, ml.Type1, ml.ML_Image, ml.Hp AS mlHp, ml.Atk, ml.Def, ml.Spd, ml.Sp_A, ml.Sp_D
			  FROM wild_monsters wm INNER JOIN monster_list ml ON ml.Name = wm.M_Name WHERE For_User='$aNickName' ORDER BY M_ID";	
	$result = mysql_query($query) or die("Query failed : " . mysql_error());
	while ($aRow = mysql_fetch_array($result)) {
		$w_m_id[] = $aRow["M_ID"];
		$w_m_name[] = $aRow["M_Name"];
		$w_m_lvl[] = $aRow["Lvl"];
		$w_m_hp_stat[] = $aRow["wmHp"];
		$w_m_a_stat[] = $aRow["A"];
		$w_m_d_stat[] = $aRow["D"];
		$w_m_s_stat[] = $aRow["S"];
		$w_m_sa_stat[] = $aRow["Sa"];
		$w_m_sd_stat[] = $aRow["Sd"];
		$w_m_c_hp[] = $aRow["C_Hp"];
		$w_m_c_a[] = $aRow["C_A"];
		$w_m_c_d[] = $aRow["C_D"];
		$w_m_c_s[] = $aRow["C_S"];
		$w_m_c_sa[] = $aRow["C_Sa"];
		$w_m_c_sd[] = $aRow["C_Sd"];
		$w_hp_count[] = $aRow["Hp_Count"];
		$w_a_count[] = $aRow["A_Count"];
		$w_d_count[] = $aRow["D_Count"];
		$w_s_count[] = $aRow["S_Count"];
		$w_sa_count[] = $aRow["Sa_Count"];
		$w_sd_count[] = $aRow["Sd_Count"];
		$w_m_a1[] = $aRow["A1"];
		$w_m_a2[] = $aRow["A2"];
		$w_m_a3[] = $aRow["A3"];
		$w_m_a4[] = $aRow["A4"];
		$w_m_id_l[] = $aRow["M_ID_L"];
		$w_ml_image[] = $aRow["ML_Image"];
		$w_ml_type1[] = $aRow["Type1"];
		$w_ml_hp[] = $aRow["mlHp"];
		$w_ml_atk[] = $aRow["Atk"];
		$w_ml_def[] = $aRow["Def"];
		$w_ml_spd[] = $aRow["Spd"];
		$w_ml_sp_a[] = $aRow["Sp_A"];
		$w_ml_sp_d[] = $aRow["Sp_D"];
	}
	mysql_free_result($result);
	
	//select all atacks
	$query = "SELECT A_L_ID, Name, Pp, Type, Category, Power, Accuracy, Goal, Chans_Crita, Critic_Damag, Hp_Stat, A_Stat, D_Stat, S_Stat, Sa_Stat, Sd_Stat FROM atack_list";	
	$result = mysql_query($query) or die("Query failed : " . mysql_error());
	while ($aRow = mysql_fetch_array($result)) {
		$ma_a_l_id[] = $aRow["A_L_ID"];
		$ma_name[] = $aRow["Name"];
		$ma_pp[] = $aRow["Pp"];
		$ma_type[] = $aRow["Type"];
		$ma_category[] = $aRow["Category"];
		$ma_power[] = $aRow["Power"];
		$ma_accuracy[] = $aRow["Accuracy"];
		$ma_goal[] = $aRow["Goal"];
		$ma_chans_crita[] = $aRow["Chans_Crita"];
		$ma_critic_damag[] = $aRow["Critic_Damag"];
		$ma_hp_stat[] = $aRow["Hp_Stat"];
		$ma_a_stat[] = $aRow["A_Stat"];
		$ma_d_stat[] = $aRow["D_Stat"];
		$ma_s_stat[] = $aRow["S_Stat"];
		$ma_sa_stat[] = $aRow["Sa_Stat"];
		$ma_sd_stat[] = $aRow["Sd_Stat"];
	}
	$anz_atacks_list = count($ma_a_l_id);
	
	mysql_free_result($result);
	
	//find user atacks position
	for($i=0; $i<$anz_atacks_list; $i++){
		if($atack_name_used == $ma_name[$i]){
			$ma_position = $i;
		}
	}
	//find wild monster atacks
	for($i=0; $i<$anz_atacks_list; $i++){
		if($w_m_a1[0] == $ma_name[$i]){
			$wa_position1 = $i;
		}
		if($w_m_a2[0] == $ma_name[$i]){
			$wa_position2 = $i;
		}
		if($w_m_a3[0] == $ma_name[$i]){
			$wa_position3 = $i;
		}
		if($w_m_a4[0] == $ma_name[$i]){
			$wa_position4 = $i;
		}
	}
	
	//find type effectivity
	$query = "SELECT Counter, Type1, Type2, Effectivity FROM types_effectivity";	
	$result = mysql_query($query) or die("Query failed : " . mysql_error());
	while ($aRow = mysql_fetch_array($result)) {
		$te_counter[] = $aRow["Counter"];
		$te_type1[] = $aRow["Type1"];
		$te_type2[] = $aRow["Type2"];
		$te_effectivity[] = $aRow["Effectivity"];
	}
	$anz_types_effectivity = count($te_counter);
	//find effectivity value of user
	for($i=0; $i<$anz_types_effectivity; $i++){
		if(($ma_type[$ma_position] == $te_type1[$i]) && ($w_ml_type1[0] == $te_type2[$i])){
			$type = $te_effectivity[$i];
		}
	}
	
	mysql_free_result($result);
	
	//compare speed
	if($f_m_s_stat[0] >= $w_m_s_stat[0]){	//also when equel user starts
		/******************************************************************************user goes 1-st************************************************************************************/
		//check accuracy of atack
		$f_m_accuracy_random = rand(1, 100);
		$f_m_critical_random = rand(1, 100);
		
		if($f_m_critical_random <= $ma_chans_crita[$ma_position]){
			$critical = $ma_critic_damag[$ma_position];
			$status_protokol = 'faster, critical';
		} else {
			$critical = 1;
			$status_protokol = 'faster, no critical';
		}
		//type effectivity protokol
		if($type == 0.5){
			$effectivity_protokol = 'not effective';
		} else if($type == 1){
			$effectivity_protokol = 'normal';
		} else if($type == 2){
			$effectivity_protokol = 'effective';
		}else if($type == 0){
			$effectivity_protokol = 'no effect';
		}
		
		$random = rand(85, 100);
		$random = (float)($random / 100);
		
		if($f_m_accuracy_random <= $ma_accuracy[$ma_position]){
			if($ma_goal[$ma_position] == 1){	//damage Enemy
				if($ma_category[$ma_position] == 1){ //physic damage
					//Damage=(((2*lvl+10)/250)*(Attack/Defense)*Base + 2)*STAB*Type*Critical*Other*(rand(0.85,1))
					$f_m_c_hp_res = (int) ($w_m_c_hp[0] - (((2 * $f_m_lvl[0] + 10) / 250) * ($f_m_c_a[0] / $w_m_c_d[0]) * $ma_power[$ma_position] + 2) * $type * $critical * $random);
					$f_m_c_damage_res = $w_m_c_hp[0] - $f_m_c_hp_res;
				} else if($ma_category[$ma_position] == 2){ //special damage
					//Damage=(((2*lvl+10)/250)*(Attack/Defense)*Base + 2)*STAB*Type*Critical*Other*(rand(0.85,1))
					$f_m_c_hp_res = (int)($w_m_c_hp[0] - (((2 * $f_m_lvl[0] + 10) / 250) * ($f_m_c_sa[0] / $w_m_c_sd[0]) * $ma_power[$ma_position] + 2) * $type * $critical * $random);
					$f_m_c_damage_res = $w_m_c_hp[0] - $f_m_c_hp_res;
				}
				//update C_Hp
				if($f_m_c_hp_res >= 0){
					mysql_query ("UPDATE wild_monsters SET C_Hp='$f_m_c_hp_res' WHERE For_User='$aNickName'");
				} else {
					mysql_query ("UPDATE wild_monsters SET C_Hp='0' WHERE For_User='$aNickName'");
				}
				if(($ma_hp_stat[$ma_position] != 0) && ($w_hp_count[0] < 3) && ($w_hp_count[0] > -3)){
					$w_m_c_hp_res = $w_m_c_hp[0] / $ma_hp_stat[$ma_position];
					if($w_m_c_hp_res <= 0){
						$w_m_c_hp_res=0;
					}
					mysql_query ("UPDATE wild_monsters SET C_Hp='$w_m_c_hp_res' WHERE For_User='$aNickName'");
					if($ma_hp_stat[$ma_position] == 1.5){
						mysql_query ("UPDATE wild_monsters SET Hp_Count=Hp_Count - 1 WHERE For_User='$aNickName'");
					} 
				}
				if(($ma_a_stat[$ma_position] != 0) && ($w_a_count[0] < 3) && ($w_a_count[0] > -3)){
					$w_m_c_a_res = $w_m_c_a[0] / $ma_a_stat[$ma_position];
					mysql_query ("UPDATE wild_monsters SET C_A='$w_m_c_a_res' WHERE For_User='$aNickName'");
					if($ma_a_stat[$ma_position] == 1.5){
						mysql_query ("UPDATE wild_monsters SET A_Count=A_Count - 1 WHERE For_User='$aNickName'");
					} 
				}
				if(($ma_d_stat[$ma_position] != 0) && ($w_d_count[0] < 3) && ($w_d_count[0] > -3)){
					$w_m_c_d_res = $w_m_c_d[0] / $ma_d_stat[$ma_position];
					mysql_query ("UPDATE wild_monsters SET C_D='$w_m_c_d_res' WHERE For_User='$aNickName'");
					if($ma_d_stat[$ma_position] == 1.5){
						mysql_query ("UPDATE wild_monsters SET D_Count=D_Count - 1 WHERE For_User='$aNickName'");
					}
				}
				if(($ma_s_stat[$ma_position] != 0) && ($w_s_count[0] < 3) && ($w_s_count[0] > -3)){
					$w_m_c_s_res = $w_m_c_s[0] / $ma_s_stat[$ma_position];
					mysql_query ("UPDATE wild_monsters SET C_S='$w_m_c_s_res' WHERE For_User='$aNickName'");
					if($ma_s_stat[$ma_position] == 1.5){
						mysql_query ("UPDATE wild_monsters SET S_Count=S_Count - 1 WHERE For_User='$aNickName'");
					} 
				}
				if(($ma_sa_stat[$ma_position] != 0) && ($w_sa_count[0] < 3) && ($w_sa_count[0] > -3)){
					$w_m_c_sa_res = $w_m_c_sa[0] / $ma_sa_stat[$ma_position];
					mysql_query ("UPDATE wild_monsters SET C_Sa='$w_m_c_sa_res' WHERE For_User='$aNickName'");
					if($ma_sa_stat[$ma_position] == 1.5){
						mysql_query ("UPDATE wild_monsters SET Sa_Count=Sa_Count - 1 WHERE For_User='$aNickName'");
					} 
				}
				if(($ma_sd_stat[$ma_position] != 0) && ($w_sd_count[0] < 3) && ($w_sd_count[0] > -3)){
					$w_m_c_sd_res = $w_m_c_sd[0] / $ma_sd_stat[$ma_position];
					mysql_query ("UPDATE wild_monsters SET C_Sd='$w_m_c_sd_res' WHERE For_User='$aNickName'");
					if($ma_sd_stat[$ma_position] == 1.5){
						mysql_query ("UPDATE wild_monsters SET Sd_Count=Sd_Count - 1 WHERE For_User='$aNickName'");
					}
				}
			} else if($ma_goal[$ma_position] == 2){	
				
				if(($ma_hp_stat[$ma_position] != 0) && ($f_hp_count[0] < 3) && ($f_hp_count[0] > -3)){
					$f_m_c_hp_res = $f_m_c_hp[0] * $ma_hp_stat[$ma_position];
					if($f_m_c_hp_res <= 0){
						$f_m_c_hp_res = 0;
					}
					mysql_query ("UPDATE monsters SET C_Hp='$f_m_c_hp_res' WHERE M_Owner='$aNickName' AND Start='1'");
					if($ma_hp_stat[$ma_position] == 1.5){
						mysql_query ("UPDATE monsters SET Hp_Count=Hp_Count + 1 WHERE M_Owner='$aNickName' AND Start='1'");
					} 
				}
				if(($ma_a_stat[$ma_position] != 0) && ($f_a_count[0] < 3) && ($f_a_count[0] > -3)){
					$f_m_c_a_res = $f_m_c_a[0] * $ma_a_stat[$ma_position];
					mysql_query ("UPDATE monsters SET C_A='$f_m_c_a_res' WHERE M_Owner='$aNickName' AND Start='1'");
					if($ma_a_stat[$ma_position] == 1.5){
						mysql_query ("UPDATE monsters SET A_Count=A_Count + 1 WHERE M_Owner='$aNickName' AND Start='1'");
					} 
				}
				if(($ma_d_stat[$ma_position] != 0) && ($f_d_count[0] < 3) && ($f_d_count[0] > -3)){
					$f_m_c_d_res = $f_m_c_d[0] * $ma_d_stat[$ma_position];
					mysql_query ("UPDATE monsters SET C_D='$f_m_c_d_res' WHERE M_Owner='$aNickName' AND Start='1'");
					if($ma_d_stat[$ma_position] == 1.5){
						mysql_query ("UPDATE monsters SET D_Count=D_Count + 1 WHERE M_Owner='$aNickName' AND Start='1'");
					} 
				}
				if(($ma_s_stat[$ma_position] != 0) && ($f_s_count[0] < 3) && ($f_s_count[0] > -3)){
					$f_m_c_s_res = $f_m_c_s[0] * $ma_s_stat[$ma_position];
					mysql_query ("UPDATE monsters SET C_S='$f_m_c_s_res' WHERE M_Owner='$aNickName' AND Start='1'");
					if($ma_s_stat[$ma_position] == 1.5){
						mysql_query ("UPDATE monsters SET S_Count=S_Count + 1 WHERE M_Owner='$aNickName' AND Start='1'");
					} 
				}
				if(($ma_sa_stat[$ma_position] != 0) && ($f_sa_count[0] < 3) && ($f_sa_count[0] > -3)){
					$f_m_c_sa_res = $f_m_c_sa[0] * $ma_sa_stat[$ma_position];
					mysql_query ("UPDATE monsters SET C_Sa='$f_m_c_sa_res' WHERE M_Owner='$aNickName' AND Start='1'");
					if($ma_sa_stat[$ma_position] == 1.5){
						mysql_query ("UPDATE monsters SET Sa_Count=Sa_Count + 1 WHERE M_Owner='$aNickName' AND Start='1'");
					}
				}
				if(($ma_sd_stat[$ma_position] != 0) && ($f_sd_count[0] < 3) && ($f_sd_count[0] > -3)){
					$f_m_c_sd_res = $f_m_c_sd[0] * $ma_sd_stat[$ma_position];
					mysql_query ("UPDATE monsters SET C_Sd='$f_m_c_sd_res' WHERE M_Owner='$aNickName' AND Start='1'");
					if($ma_sd_stat[$ma_position] == 1.5){
						mysql_query ("UPDATE monsters SET Sd_Count=Sd_Count + 1 WHERE M_Owner='$aNickName' AND Start='1'");
					} 
				}
				$f_m_c_hp_res = $w_m_c_hp[0];
			}
		} else {
			//miss
			$status_protokol = 'missed';
			$f_m_c_hp_res = $w_m_c_hp[0];
		}

		//Expirience
		if(($f_m_c_hp_res <= 0) && ($f_m_lvl[0]<100)){
			$exp_up = $f_exp_group[0] * $f_m_lvl[0];
			if($f_m_exp[0] == $exp_up){
				//level up, exp 0
				mysql_query ("UPDATE monsters SET Exp='0', Lvl=Lvl + 1, Exp_Up='$exp_up' WHERE M_Owner='$aNickName' AND Start='1'");
			} else {
				mysql_query ("UPDATE monsters SET Exp=Exp + 1, Exp_Up='$exp_up' WHERE M_Owner='$aNickName' AND Start='1'");
			}
		}
		//Protokol
		if($f_m_c_hp_res > 0){
			$query = "SELECT Round FROM protokol WHERE User='$aNickName' ORDER BY Round DESC";	
			$result = mysql_query($query) or die("Query failed : " . mysql_error());
			while ($aRow = mysql_fetch_array($result)) {
				$p_round[] = $aRow["Round"];
			}
			if (mysql_num_rows($result)==0){	//check if result empty
				$f_anz_round = 1;
				$sql_insert = "INSERT INTO protokol VALUES ('', '$f_anz_round', '$aNickName', '$f_m_name[0]', '$w_m_name[0]', '$ma_name[$ma_position]', '$f_m_c_damage_res', '$status_protokol', '$effectivity_protokol', $f_hp_count[0], $f_a_count[0], $f_d_count[0], $f_s_count[0], $f_sa_count[0], $f_sd_count[0]);";
				$result_insert = mysql_query($sql_insert) or die(mysql_error());
			} else {
				$f_anz_round = $p_round[0] + 1;
				$sql_insert = "INSERT INTO protokol VALUES ('', '$f_anz_round', '$aNickName', '$f_m_name[0]', '$w_m_name[0]', '$ma_name[$ma_position]', '$f_m_c_damage_res', '$status_protokol', '$effectivity_protokol', $f_hp_count[0], $f_a_count[0], $f_d_count[0], $f_s_count[0], $f_sa_count[0], $f_sd_count[0]);";
				$result_insert = mysql_query($sql_insert) or die(mysql_error());
			}
			mysql_free_result($result);
			
		} else {
			mysql_query ("DELETE FROM protokol WHERE User='$aNickName'");
		}
		//Money
		$money = rand(1, 200);
		if($f_m_c_hp_res <= 0){
			mysql_query ("UPDATE items SET Item_Amount = Item_Amount + $money WHERE Item_Owner='$aNickName' AND IL_ID='1'");
		}
		/*********************************************************************************************wild goes 2-d*****************************************************************/
		if($f_m_c_hp_res > 0){	//wenn lebendig greift zurück
			$w_m_choose_atack_random = rand(1, 4);
			if($w_m_choose_atack_random == 1){
				$wa_position = $wa_position1;
			}
			if($w_m_choose_atack_random == 2){
				$wa_position = $wa_position2;
			}
			if($w_m_choose_atack_random == 3){
				$wa_position = $wa_position3;
			}
			if($w_m_choose_atack_random == 4){
				$wa_position = $wa_position4;
			}
			//find effectivity value of wild
			for($i=0; $i<$anz_types_effectivity; $i++){
				if(($ma_type[$wa_position] == $te_type1[$i]) && ($f_m_type1[0] == $te_type2[$i])){
					$w_type = $te_effectivity[$i];
				}
			}
			//check accuracy of atack
			$w_m_accuracy_random = rand(1, 100);
			$w_m_critical_random = rand(1, 100);
			
			if($w_m_critical_random <= $ma_chans_crita[$wa_position]){
				$w_critical = $ma_critic_damag[$wa_position];
				$status_protokol = 'critical';
			} else {
				$w_critical = 1;
				$status_protokol = 'no critical';
			}
			
			//type effectivity protokol
			if($w_type == 0.5){
				$effectivity_protokol = 'not effective';
			} else if($w_type == 1){
				$effectivity_protokol = 'normal';
			} else if($w_type == 2){
				$effectivity_protokol = 'effective';
			}else if($w_type == 0){
				$effectivity_protokol = 'no effect';
			}
			
			$w_random = rand(85, 100);
			$w_random = (float)($w_random / 100);
			
			if($w_m_accuracy_random <= $ma_accuracy[$wa_position]){
				if($ma_goal[$wa_position] == 1){	//damage Enemy
					if($ma_category[$wa_position] == 1){ //physic damage
						//Damage=(((2*lvl+10)/250)*(Attack/Defense)*Base + 2)*STAB*Type*Critical*Other*(rand(0.85,1))
						//$w_m_c_hp_res = (int) ($f_m_c_hp[0] - (((2 * $w_m_lvl[0] + 10) / 250) * ($w_m_a_stat[0] / $f_m_d_stat[0]) * $ma_power[$wa_position] + 2) * $w_type * $w_critical * $w_random);
						$w_m_c_hp_res = (int) ($f_m_c_hp[0] - (((2 * $w_m_lvl[0] + 10) / 250) * ($w_m_c_a[0] / $f_m_c_d[0]) * $ma_power[$wa_position] + 2) * $w_type * $w_critical * $w_random);
						$w_m_c_damage_res = $f_m_c_hp[0] - $w_m_c_hp_res;
					} else if($ma_category[$wa_position] == 2){ //special damage
						//Damage=(((2*lvl+10)/250)*(Attack/Defense)*Base + 2)*STAB*Type*Critical*Other*(rand(0.85,1))
						$w_m_c_hp_res = (int)($f_m_c_hp[0] - (((2 * $w_m_lvl[0] + 10) / 250) * ($w_m_c_sa[0] / $f_m_c_sd[0]) * $ma_power[$wa_position] + 2) * $w_type * $w_critical * $w_random);
						$w_m_c_damage_res = $f_m_c_hp[0] - $w_m_c_hp_res;
					}
					//update C_Hp
					if($w_m_c_hp_res >= 0){
						mysql_query ("UPDATE monsters SET C_Hp='$w_m_c_hp_res' WHERE M_Owner='$aNickName' AND Start='1'");
					} else {
						mysql_query ("UPDATE monsters SET C_Hp='0' WHERE M_Owner='$aNickName' AND Start='1'");
					}
				} 
				
			} else {
				//miss
				$status_protokol = 'missed';
				$w_m_c_hp_res = $f_m_c_hp[0];
			}
			//Protokol
			if($w_m_c_hp_res > 0){
				$sql_insert = "INSERT INTO protokol VALUES ('', '$f_anz_round', '$aNickName', '$w_m_name[0]', '$f_m_name[0]', '$ma_name[$wa_position]', '$w_m_c_damage_res', '$status_protokol', '$effectivity_protokol', 0, 0, 0, 0, 0, 0);";
				$result_insert = mysql_query($sql_insert) or die(mysql_error());
			} else {
				mysql_query ("DELETE FROM protokol WHERE User='$aNickName'");
			}
			
		}	else {
			//wenn tot dann delete
			//mysql_query("DELETE FROM wild_monsters WHERE For_User='$aNickName'");
		}
	} else {
		/******************************************************************************+wild goes 1-st***********************************************************+**************************/
		$w_m_choose_atack_random = rand(1, 4);
		if($w_m_choose_atack_random == 1){
			$wa_position = $wa_position1;
		}
		if($w_m_choose_atack_random == 2){
			$wa_position = $wa_position2;
		}
		if($w_m_choose_atack_random == 3){
			$wa_position = $wa_position3;
		}
		if($w_m_choose_atack_random == 4){
			$wa_position = $wa_position4;
		}
		//find effectivity value of wild
		for($i=0; $i<$anz_types_effectivity; $i++){
			if(($ma_type[$wa_position] == $te_type1[$i]) && ($f_m_type1[0] == $te_type2[$i])){
				$w_type = $te_effectivity[$i];
			}
		}
		//check accuracy of atack
		$w_m_accuracy_random = rand(1, 100);
		$w_m_critical_random = rand(1, 100);
		
		if($w_m_critical_random <= $ma_chans_crita[$wa_position]){
			$w_critical = $ma_critic_damag[$wa_position];
			$status_protokol = 'critical';
		} else {
			$w_critical = 1;
			$status_protokol = 'no critical';
		}
		
		//type effectivity protokol
		if($w_type == 0.5){
			$effectivity_protokol = 'not effective';
		} else if($w_type == 1){
			$effectivity_protokol = 'normal';
		} else if($w_type == 2){
			$effectivity_protokol = 'effective';
		}else if($w_type == 0){
			$effectivity_protokol = 'no effect';
		}
		
		$w_random = rand(85, 100);
		$w_random = (float)($w_random / 100);
		
		if($w_m_accuracy_random <= $ma_accuracy[$wa_position]){
			if($ma_goal[$wa_position] == 1){	//damage Enemy
				if($ma_category[$wa_position] == 1){ //physic damage
					//Damage=(((2*lvl+10)/250)*(Attack/Defense)*Base + 2)*STAB*Type*Critical*Other*(rand(0.85,1))
					//$w_m_c_hp_res = (int) ($f_m_c_hp[0] - (((2 * $w_m_lvl[0] + 10) / 250) * ($w_m_a_stat[0] / $f_m_d_stat[0]) * $ma_power[$wa_position] + 2) * $w_type * $w_critical * $w_random);
					$w_m_c_hp_res = (int) ($f_m_c_hp[0] - (((2 * $w_m_lvl[0] + 10) / 250) * ($w_m_c_a[0] / $f_m_c_d[0]) * $ma_power[$wa_position] + 2) * $w_type * $w_critical * $w_random);
					$w_m_c_damage_res = $f_m_c_hp[0] - $w_m_c_hp_res;
				} else if($ma_category[$wa_position] == 2){ //special damage
					//Damage=(((2*lvl+10)/250)*(Attack/Defense)*Base + 2)*STAB*Type*Critical*Other*(rand(0.85,1))
					$w_m_c_hp_res = (int)($f_m_c_hp[0] - (((2 * $w_m_lvl[0] + 10) / 250) * ($w_m_c_sa[0] / $f_m_c_sd[0]) * $ma_power[$wa_position] + 2) * $w_type * $w_critical * $w_random);
					$w_m_c_damage_res = $f_m_c_hp[0] - $w_m_c_hp_res;
				}
				//update C_Hp
				if($w_m_c_hp_res >= 0){
					mysql_query ("UPDATE monsters SET C_Hp='$w_m_c_hp_res' WHERE M_Owner='$aNickName' AND Start='1'");
				} else {
					mysql_query ("UPDATE monsters SET C_Hp='0' WHERE M_Owner='$aNickName' AND Start='1'");
				}
			} 
			
		} else {
			//miss
			$status_protokol = 'missed';
			$w_m_c_hp_res = $f_m_c_hp[0];
		}
		//Protokol
		if($w_m_c_hp_res > 0){
			$query = "SELECT Round FROM protokol WHERE User='$aNickName' ORDER BY Round DESC";	
			$result = mysql_query($query) or die("Query failed : " . mysql_error());
			while ($aRow = mysql_fetch_array($result)) {
				$p_round[] = $aRow["Round"];
			}
			if (mysql_num_rows($result)==0){	//check if result empty
				$f_anz_round = 1;
				$sql_insert = "INSERT INTO protokol VALUES ('', '$f_anz_round', '$aNickName', '$w_m_name[0]', '$f_m_name[0]', '$ma_name[$wa_position]', '$w_m_c_damage_res', '$status_protokol', '$effectivity_protokol',  0, 0, 0, 0, 0, 0);";
				$result_insert = mysql_query($sql_insert) or die(mysql_error());
			} else {
				$f_anz_round = $p_round[0] + 1;
				$sql_insert = "INSERT INTO protokol VALUES ('', '$f_anz_round', '$aNickName', '$w_m_name[0]', '$f_m_name[0]', '$ma_name[$wa_position]', '$w_m_c_damage_res', '$status_protokol', '$effectivity_protokol',  0, 0, 0, 0, 0, 0);";
				$result_insert = mysql_query($sql_insert) or die(mysql_error());
			}
			mysql_free_result($result);
			
		} else {
			mysql_query ("DELETE FROM protokol WHERE User='$aNickName'");
		}
		/************************************************************************************************user goes 2-d************************************************************************/
		if($w_m_c_hp_res >= 0){
			//check accuracy of atack
			$f_m_accuracy_random = rand(1, 100);
			$f_m_critical_random = rand(1, 100);
			
			if($f_m_critical_random <= $ma_chans_crita[$ma_position]){
				$critical = $ma_critic_damag[$ma_position];
				$status_protokol = 'faster, critical';
			} else {
				$critical = 1;
				$status_protokol = 'faster, no critical';
			}
			//type effectivity protokol
			if($type == 0.5){
				$effectivity_protokol = 'not effective';
			} else if($type == 1){
				$effectivity_protokol = 'normal';
			} else if($type == 2){
				$effectivity_protokol = 'effective';
			}else if($type == 0){
				$effectivity_protokol = 'no effect';
			}
			
			$random = rand(85, 100);
			$random = (float)($random / 100);
			
			if($f_m_accuracy_random <= $ma_accuracy[$ma_position]){
				if($ma_goal[$ma_position] == 1){	//damage Enemy
					if($ma_category[$ma_position] == 1){ //physic damage
						//Damage=(((2*lvl+10)/250)*(Attack/Defense)*Base + 2)*STAB*Type*Critical*Other*(rand(0.85,1))
						$f_m_c_hp_res = (int) ($w_m_c_hp[0] - (((2 * $f_m_lvl[0] + 10) / 250) * ($f_m_c_a[0] / $w_m_c_d[0]) * $ma_power[$ma_position] + 2) * $type * $critical * $random);
						$f_m_c_damage_res = $w_m_c_hp[0] - $f_m_c_hp_res;
					} else if($ma_category[$ma_position] == 2){ //special damage
						//Damage=(((2*lvl+10)/250)*(Attack/Defense)*Base + 2)*STAB*Type*Critical*Other*(rand(0.85,1))
						$f_m_c_hp_res = (int)($w_m_c_hp[0] - (((2 * $f_m_lvl[0] + 10) / 250) * ($f_m_c_sa[0] / $w_m_c_sd[0]) * $ma_power[$ma_position] + 2) * $type * $critical * $random);
						$f_m_c_damage_res = $w_m_c_hp[0] - $f_m_c_hp_res;
					}
					//update C_Hp
					if($f_m_c_hp_res >= 0){
						mysql_query ("UPDATE wild_monsters SET C_Hp='$f_m_c_hp_res' WHERE For_User='$aNickName'");
					} else {
						mysql_query ("UPDATE wild_monsters SET C_Hp='0' WHERE For_User='$aNickName'");
					}
					if(($ma_hp_stat[$ma_position] != 0) && ($w_hp_count[0] < 3) && ($w_hp_count[0] > -3)){
						$w_m_c_hp_res = $w_m_c_hp[0] / $ma_hp_stat[$ma_position];
						if($w_m_c_hp_res < 0){
							$w_m_c_hp_res=0;
						}
						mysql_query ("UPDATE wild_monsters SET C_Hp='$w_m_c_hp_res' WHERE For_User='$aNickName'");
						if($ma_hp_stat[$ma_position] == 1.5){
							mysql_query ("UPDATE wild_monsters SET Hp_Count=Hp_Count - 1 WHERE For_User='$aNickName'");
						}
					}
					if(($ma_a_stat[$ma_position] != 0) && ($w_a_count[0] < 3) && ($w_a_count[0] > -3)){
						$w_m_c_a_res = $w_m_c_a[0] / $ma_a_stat[$ma_position];
						mysql_query ("UPDATE wild_monsters SET C_A='$w_m_c_a_res' WHERE For_User='$aNickName'");
						if($ma_a_stat[$ma_position] == 1.5){
							mysql_query ("UPDATE wild_monsters SET A_Count=A_Count - 1 WHERE For_User='$aNickName'");
						}
					}
					if(($ma_d_stat[$ma_position] != 0) && ($w_d_count[0] < 3) && ($w_d_count[0] > -3)){
						$w_m_c_d_res = $w_m_c_d[0] / $ma_d_stat[$ma_position];
						mysql_query ("UPDATE wild_monsters SET C_D='$w_m_c_d_res' WHERE For_User='$aNickName'");
						if($ma_d_stat[$ma_position] == 1.5){
							mysql_query ("UPDATE wild_monsters SET D_Count=D_Count - 1 WHERE For_User='$aNickName'");
						} 
					}
					if(($ma_s_stat[$ma_position] != 0) && ($w_s_count[0] < 3) && ($w_s_count[0] > -3)){
						$w_m_c_s_res = $w_m_c_s[0] / $ma_s_stat[$ma_position];
						mysql_query ("UPDATE wild_monsters SET C_S='$w_m_c_s_res' WHERE For_User='$aNickName'");
						if($ma_s_stat[$ma_position] == 1.5){
							mysql_query ("UPDATE wild_monsters SET S_Count=S_Count - 1 WHERE For_User='$aNickName'");
						} 
					}
					if(($ma_sa_stat[$ma_position] != 0) && ($w_sa_count[0] < 3) && ($w_sa_count[0] > -3)){
						$w_m_c_sa_res = $w_m_c_sa[0] / $ma_sa_stat[$ma_position];
						mysql_query ("UPDATE wild_monsters SET C_Sa='$w_m_c_sa_res' WHERE For_User='$aNickName'");
						if($ma_sa_stat[$ma_position] == 1.5){
							mysql_query ("UPDATE wild_monsters SET Sa_Count=Sa_Count - 1 WHERE For_User='$aNickName'");
						}
					}
					if(($ma_sd_stat[$ma_position] != 0) && ($w_sd_count[0] < 3) && ($w_sd_count[0] > -3)){
						$w_m_c_sd_res = $w_m_c_sd[0] / $ma_sd_stat[$ma_position];
						mysql_query ("UPDATE wild_monsters SET C_Sd='$w_m_c_sd_res' WHERE For_User='$aNickName'");
						if($ma_sd_stat[$ma_position] == 1.5){
							mysql_query ("UPDATE wild_monsters SET Sd_Count=Sd_Count - 1 WHERE For_User='$aNickName'");
						} 
					}
				} else if($ma_goal[$ma_position] == 2){	
					//$f_m_c_hp_res = $w_m_c_hp[0];
					if(($ma_hp_stat[$ma_position] != 0) && ($f_hp_count[0] < 3) && ($f_hp_count[0] > -3)){
						$f_m_c_hp_res = $f_m_c_hp[0] * $ma_hp_stat[$ma_position];
						if($f_m_c_hp_res <= 0){
							$f_m_c_hp_res = 0;
						}
						mysql_query ("UPDATE monsters SET C_Hp='$f_m_c_hp_res' WHERE M_Owner='$aNickName' AND Start='1'");
						if($ma_hp_stat[$ma_position] == 1.5){
							mysql_query ("UPDATE monsters SET Hp_Count=Hp_Count + 1 WHERE M_Owner='$aNickName' AND Start='1'");
						} 
					}
					if(($ma_a_stat[$ma_position] != 0) && ($f_a_count[0] < 3) && ($f_a_count[0] > -3)){
						$f_m_c_a_res = $f_m_c_a[0] * $ma_a_stat[$ma_position];
						mysql_query ("UPDATE monsters SET C_A='$f_m_c_a_res' WHERE M_Owner='$aNickName' AND Start='1'");
						if($ma_a_stat[$ma_position] == 1.5){
							mysql_query ("UPDATE monsters SET A_Count=A_Count + 1 WHERE M_Owner='$aNickName' AND Start='1'");
						}
					}
					if(($ma_d_stat[$ma_position] != 0) && ($f_d_count[0] < 3) && ($f_d_count[0] > -3)){
						$f_m_c_d_res = $f_m_c_d[0] * $ma_d_stat[$ma_position];
						mysql_query ("UPDATE monsters SET C_D='$f_m_c_d_res' WHERE M_Owner='$aNickName' AND Start='1'");
						if($ma_d_stat[$ma_position] == 1.5){
							mysql_query ("UPDATE monsters SET D_Count=D_Count + 1 WHERE M_Owner='$aNickName' AND Start='1'");
						} 
					}
					if(($ma_s_stat[$ma_position] != 0) && ($f_s_count[0] < 3) && ($f_s_count[0] > -3)){
						$f_m_c_s_res = $f_m_c_s[0] * $ma_s_stat[$ma_position];
						mysql_query ("UPDATE monsters SET C_S='$f_m_c_s_res' WHERE M_Owner='$aNickName' AND Start='1'");
						if($ma_s_stat[$ma_position] == 1.5){
							mysql_query ("UPDATE monsters SET S_Count=S_Count + 1 WHERE M_Owner='$aNickName' AND Start='1'");
						} 
					}
					if(($ma_sa_stat[$ma_position] != 0) && ($f_sa_count[0] < 3) && ($f_sa_count[0] > -3)){
						$f_m_c_sa_res = $f_m_c_sa[0] * $ma_sa_stat[$ma_position];
						mysql_query ("UPDATE monsters SET C_Sa='$f_m_c_sa_res' WHERE M_Owner='$aNickName' AND Start='1'");
						if($ma_sa_stat[$ma_position] == 1.5){
							mysql_query ("UPDATE monsters SET Sa_Count=Sa_Count + 1 WHERE M_Owner='$aNickName' AND Start='1'");
						}
					}
					if(($ma_sd_stat[$ma_position] != 0) && ($f_sd_count[0] < 3) && ($f_sd_count[0] > -3)){
						$f_m_c_sd_res = $f_m_c_sd[0] * $ma_sd_stat[$ma_position];
						mysql_query ("UPDATE monsters SET C_Sd='$f_m_c_sd_res' WHERE M_Owner='$aNickName' AND Start='1'");
						if($ma_sd_stat[$ma_position] == 1.5){
							mysql_query ("UPDATE monsters SET Sd_Count=Sd_Count + 1 WHERE M_Owner='$aNickName' AND Start='1'");
						} 
					}
					$f_m_c_hp_res = $w_m_c_hp[0];
				}
			} else {
				//miss
				$status_protokol = 'missed';
				$f_m_c_hp_res = $w_m_c_hp[0];
			}

			//Expirience
			if(($f_m_c_hp_res <= 0) && ($f_m_lvl[0]<100)){
				$exp_up = $f_exp_group[0] * $f_m_lvl[0];
				if($f_m_exp[0] == $exp_up){
					//level up, exp 0
					mysql_query ("UPDATE monsters SET Exp='0', Lvl=Lvl + 1, Exp_Up='$exp_up' WHERE M_Owner='$aNickName' AND Start='1'");
				} else {
					mysql_query ("UPDATE monsters SET Exp=Exp + 1, Exp_Up='$exp_up' WHERE M_Owner='$aNickName' AND Start='1'");
				}
			}
			//Protokol
			if($f_m_c_hp_res > 0){
				$sql_insert = "INSERT INTO protokol VALUES ('', '$f_anz_round', '$aNickName', '$f_m_name[0]', '$w_m_name[0]', '$ma_name[$ma_position]', '$f_m_c_damage_res', '$status_protokol', '$effectivity_protokol', $f_hp_count[0], $f_a_count[0], $f_d_count[0], $f_s_count[0], $f_sa_count[0], $f_sd_count[0]);";
				$result_insert = mysql_query($sql_insert) or die(mysql_error());
			} else {
				mysql_query ("DELETE FROM protokol WHERE User='$aNickName'");
			}
			//Money
			$money = rand(1, 200);
			if($f_m_c_hp_res <= 0){
				mysql_query ("UPDATE items SET Item_Amount = Item_Amount + $money WHERE Item_Owner='$aNickName' AND IL_ID='1'");
			}
			
		}	
	}	

		
	
	mysql_query ("UPDATE monsters SET $nr_pp = $nr_pp - 1 WHERE Start='1' AND $nr_atack='$atack_name_used'");
?>