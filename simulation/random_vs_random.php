<style>
	#randomButtonOut {
		float: right;
	}
</style>
<div id='reinerforcement_php'>
	<div id='rf_training'>
		<button class="btn btn-info b_location" id="randomButtonOut" type="button" onclick="rf_training_deaktivate()">End Simulation</button>
		<!--mysql-->
		<?php
			/**************************************load monsters data for agent1 and agent2**************************************/
			$query = "SELECT m.M_ID, m.M_Name, m.M_Image, m.Lvl, m.Hp, m.A, m.D, m.S, m.Sa, m.Sd, m.C_Hp, m.C_A, m.C_D, m.C_S, m.C_Sa, m.C_Sd, m.A1, m.A2, m.A3, m.A4, m.A1_Pp, m.A2_Pp, m.A3_Pp, 			
						m.A4_Pp, m.Hp_Count, m.A_Count, m.D_Count, m.S_Count, m.Sa_Count, m.Sd_Count, ml.M_ID_L, ml.Type1
						FROM monsters m INNER JOIN monster_list ml ON ml.Name = m.M_Name WHERE M_Owner='Reiner Forcement' AND Aktiv='1' ORDER BY M_ID";	
			$result = mysql_query($query) or die("Query failed : " . mysql_error());
			while ($aRow = mysql_fetch_array($result)) {
				//Agent1
				$a1_m_id[] = $aRow["M_ID"];
				$a1_m_name[] = $aRow["M_Name"];
				$a1_m_image[] = $aRow["M_Image"];
				$a1_m_lvl[] = $aRow["Lvl"];
				$a1_m_hp_stat[] = $aRow["Hp"];
				$a1_m_a_stat[] = $aRow["A"];
				$a1_m_d_stat[] = $aRow["D"];
				$a1_m_s_stat[] = $aRow["S"];
				$a1_m_sa_stat[] = $aRow["Sa"];
				$a1_m_sd_stat[] = $aRow["Sd"];
				$a1_m_c_hp[] = $aRow["C_Hp"];
				$a1_m_c_a[] = $aRow["C_A"];
				$a1_m_c_d[] = $aRow["C_D"];
				$a1_m_c_s[] = $aRow["C_S"];
				$a1_m_c_sa[] = $aRow["C_Sa"];
				$a1_m_c_sd[] = $aRow["C_Sd"];
				$a1_m_a1[] = $aRow["A1"];
				$a1_m_a2[] = $aRow["A2"];
				$a1_m_a3[] = $aRow["A3"];
				$a1_m_a4[] = $aRow["A4"];
				$a1_m_a1_pp[] = $aRow["A1_Pp"];
				$a1_m_a2_pp[] = $aRow["A2_Pp"];
				$a1_m_a3_pp[] = $aRow["A3_Pp"];
				$a1_m_a4_pp[] = $aRow["A4_Pp"];
				$a1_hp_count[] = $aRow["Hp_Count"];
				$a1_a_count[] = $aRow["A_Count"];
				$a1_d_count[] = $aRow["D_Count"];
				$a1_s_count[] = $aRow["S_Count"];
				$a1_sa_count[] = $aRow["Sa_Count"];
				$a1_sd_count[] = $aRow["Sd_Count"];
				$a1_ml_id[] = $aRow["M_ID_L"];
				$a1_m_type1[] = $aRow["Type1"];
				//Agent2
				$a2_m_id[] = $aRow["M_ID"];
				$a2_m_name[] = $aRow["M_Name"];
				$a2_m_image[] = $aRow["M_Image"];
				$a2_m_lvl[] = $aRow["Lvl"];
				$a2_m_hp_stat[] = $aRow["Hp"];
				$a2_m_a_stat[] = $aRow["A"];
				$a2_m_d_stat[] = $aRow["D"];
				$a2_m_s_stat[] = $aRow["S"];
				$a2_m_sa_stat[] = $aRow["Sa"];
				$a2_m_sd_stat[] = $aRow["Sd"];
				$a2_m_c_hp[] = $aRow["C_Hp"];
				$a2_m_c_a[] = $aRow["C_A"];
				$a2_m_c_d[] = $aRow["C_D"];
				$a2_m_c_s[] = $aRow["C_S"];
				$a2_m_c_sa[] = $aRow["C_Sa"];
				$a2_m_c_sd[] = $aRow["C_Sd"];
				$a2_m_a1[] = $aRow["A1"];
				$a2_m_a2[] = $aRow["A2"];
				$a2_m_a3[] = $aRow["A3"];
				$a2_m_a4[] = $aRow["A4"];
				$a2_m_a1_pp[] = $aRow["A1_Pp"];
				$a2_m_a2_pp[] = $aRow["A2_Pp"];
				$a2_m_a3_pp[] = $aRow["A3_Pp"];
				$a2_m_a4_pp[] = $aRow["A4_Pp"];
				$a2_hp_count[] = $aRow["Hp_Count"];
				$a2_a_count[] = $aRow["A_Count"];
				$a2_d_count[] = $aRow["D_Count"];
				$a2_s_count[] = $aRow["S_Count"];
				$a2_sa_count[] = $aRow["Sa_Count"];
				$a2_sd_count[] = $aRow["Sd_Count"];
				$a2_ml_id[] = $aRow["M_ID_L"];
				$a2_m_type1[] = $aRow["Type1"];
			}
			if (mysql_num_rows($result)==0){	
				$a1_anz_aktiv_monster = 0;
				$a2_anz_aktiv_monster = 0;
			} else {
				$a1_anz_aktiv_monster = count($a1_m_name);
				$a2_anz_aktiv_monster = count($a2_m_name);
			}
			mysql_free_result($result);
			/**************************************load monsters attacks data for agent1 and agent2**************************************/
			for($i=0; $i<$a1_anz_aktiv_monster; $i++){
				$query = "SELECT Pp, Type, Category, Power, Accuracy, Goal, Chans_Crita, Critic_Damag, Hp_Stat, A_Stat, D_Stat, S_Stat, Sa_Stat, Sd_Stat FROM atack_list WHERE Name='$a1_m_a1[$i]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					//Agent1
					$a1_m_a1_pp[] = $aRow["Pp"];
					$a1_m_a1_c_pp[] = $aRow["Pp"];
					$a1_m_a1_type[] = $aRow["Type"];
					$a1_m_a1_category[] = $aRow["Category"];
					$a1_m_a1_power[] = $aRow["Power"];
					$a1_m_a1_accuracy[] = $aRow["Accuracy"];
					$a1_m_a1_goal[] = $aRow["Goal"];
					$a1_m_a1_chans_crita[] = $aRow["Chans_Crita"];
					$a1_m_a1_critic_damag[] = $aRow["Critic_Damag"];
					$a1_m_a1_hp_stat[] = $aRow["Hp_Stat"];
					$a1_m_a1_a_stat[] = $aRow["A_Stat"];
					$a1_m_a1_d_stat[] = $aRow["D_Stat"];
					$a1_m_a1_s_stat[] = $aRow["S_Stat"];
					$a1_m_a1_sa_stat[] = $aRow["Sa_Stat"];
					$a1_m_a1_sd_stat[] = $aRow["Sd_Stat"];
					//Agent2
					$a2_m_a1_pp[] = $aRow["Pp"];
					$a2_m_a1_c_pp[] = $aRow["Pp"];
					$a2_m_a1_type[] = $aRow["Type"];
					$a2_m_a1_category[] = $aRow["Category"];
					$a2_m_a1_power[] = $aRow["Power"];
					$a2_m_a1_accuracy[] = $aRow["Accuracy"];
					$a2_m_a1_goal[] = $aRow["Goal"];
					$a2_m_a1_chans_crita[] = $aRow["Chans_Crita"];
					$a2_m_a1_critic_damag[] = $aRow["Critic_Damag"];
					$a2_m_a1_hp_stat[] = $aRow["Hp_Stat"];
					$a2_m_a1_a_stat[] = $aRow["A_Stat"];
					$a2_m_a1_d_stat[] = $aRow["D_Stat"];
					$a2_m_a1_s_stat[] = $aRow["S_Stat"];
					$a2_m_a1_sa_stat[] = $aRow["Sa_Stat"];
					$a2_m_a1_sd_stat[] = $aRow["Sd_Stat"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category, Power, Accuracy, Goal, Chans_Crita, Critic_Damag, Hp_Stat, A_Stat, D_Stat, S_Stat, Sa_Stat, Sd_Stat FROM atack_list WHERE Name='$a1_m_a2[$i]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					//Agent1
					$a1_m_a2_pp[] = $aRow["Pp"];
					$a1_m_a2_c_pp[] = $aRow["Pp"];
					$a1_m_a2_type[] = $aRow["Type"];
					$a1_m_a2_category[] = $aRow["Category"];
					$a1_m_a2_power[] = $aRow["Power"];
					$a1_m_a2_accuracy[] = $aRow["Accuracy"];
					$a1_m_a2_goal[] = $aRow["Goal"];
					$a1_m_a2_chans_crita[] = $aRow["Chans_Crita"];
					$a1_m_a2_critic_damag[] = $aRow["Critic_Damag"];
					$a1_m_a2_hp_stat[] = $aRow["Hp_Stat"];
					$a1_m_a2_a_stat[] = $aRow["A_Stat"];
					$a1_m_a2_d_stat[] = $aRow["D_Stat"];
					$a1_m_a2_s_stat[] = $aRow["S_Stat"];
					$a1_m_a2_sa_stat[] = $aRow["Sa_Stat"];
					$a1_m_a2_sd_stat[] = $aRow["Sd_Stat"];
					//Agent2
					$a2_m_a2_pp[] = $aRow["Pp"];
					$a2_m_a2_c_pp[] = $aRow["Pp"];
					$a2_m_a2_type[] = $aRow["Type"];
					$a2_m_a2_category[] = $aRow["Category"];
					$a2_m_a2_power[] = $aRow["Power"];
					$a2_m_a2_accuracy[] = $aRow["Accuracy"];
					$a2_m_a2_goal[] = $aRow["Goal"];
					$a2_m_a2_chans_crita[] = $aRow["Chans_Crita"];
					$a2_m_a2_critic_damag[] = $aRow["Critic_Damag"];
					$a2_m_a2_hp_stat[] = $aRow["Hp_Stat"];
					$a2_m_a2_a_stat[] = $aRow["A_Stat"];
					$a2_m_a2_d_stat[] = $aRow["D_Stat"];
					$a2_m_a2_s_stat[] = $aRow["S_Stat"];
					$a2_m_a2_sa_stat[] = $aRow["Sa_Stat"];
					$a2_m_a2_sd_stat[] = $aRow["Sd_Stat"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category, Power, Accuracy, Goal, Chans_Crita, Critic_Damag, Hp_Stat, A_Stat, D_Stat, S_Stat, Sa_Stat, Sd_Stat FROM atack_list WHERE Name='$a1_m_a3[$i]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					//Agent1
					$a1_m_a3_pp[] = $aRow["Pp"];
					$a1_m_a3_c_pp[] = $aRow["Pp"];
					$a1_m_a3_type[] = $aRow["Type"];
					$a1_m_a3_category[] = $aRow["Category"];
					$a1_m_a3_power[] = $aRow["Power"];
					$a1_m_a3_accuracy[] = $aRow["Accuracy"];
					$a1_m_a3_goal[] = $aRow["Goal"];
					$a1_m_a3_chans_crita[] = $aRow["Chans_Crita"];
					$a1_m_a3_critic_damag[] = $aRow["Critic_Damag"];
					$a1_m_a3_hp_stat[] = $aRow["Hp_Stat"];
					$a1_m_a3_a_stat[] = $aRow["A_Stat"];
					$a1_m_a3_d_stat[] = $aRow["D_Stat"];
					$a1_m_a3_s_stat[] = $aRow["S_Stat"];
					$a1_m_a3_sa_stat[] = $aRow["Sa_Stat"];
					$a1_m_a3_sd_stat[] = $aRow["Sd_Stat"];
					//Agent2
					$a2_m_a3_pp[] = $aRow["Pp"];
					$a2_m_a3_c_pp[] = $aRow["Pp"];
					$a2_m_a3_type[] = $aRow["Type"];
					$a2_m_a3_category[] = $aRow["Category"];
					$a2_m_a3_power[] = $aRow["Power"];
					$a2_m_a3_accuracy[] = $aRow["Accuracy"];
					$a2_m_a3_goal[] = $aRow["Goal"];
					$a2_m_a3_chans_crita[] = $aRow["Chans_Crita"];
					$a2_m_a3_critic_damag[] = $aRow["Critic_Damag"];
					$a2_m_a3_hp_stat[] = $aRow["Hp_Stat"];
					$a2_m_a3_a_stat[] = $aRow["A_Stat"];
					$a2_m_a3_d_stat[] = $aRow["D_Stat"];
					$a2_m_a3_s_stat[] = $aRow["S_Stat"];
					$a2_m_a3_sa_stat[] = $aRow["Sa_Stat"];
					$a2_m_a3_sd_stat[] = $aRow["Sd_Stat"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category, Power, Accuracy, Goal, Chans_Crita, Critic_Damag, Hp_Stat, A_Stat, D_Stat, S_Stat, Sa_Stat, Sd_Stat FROM atack_list WHERE Name='$a1_m_a4[$i]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					//Agent1
					$a1_m_a4_pp[] = $aRow["Pp"];
					$a1_m_a4_c_pp[] = $aRow["Pp"];
					$a1_m_a4_type[] = $aRow["Type"];
					$a1_m_a4_category[] = $aRow["Category"];
					$a1_m_a4_power[] = $aRow["Power"];
					$a1_m_a4_accuracy[] = $aRow["Accuracy"];
					$a1_m_a4_goal[] = $aRow["Goal"];
					$a1_m_a4_chans_crita[] = $aRow["Chans_Crita"];
					$a1_m_a4_critic_damag[] = $aRow["Critic_Damag"];
					$a1_m_a4_hp_stat[] = $aRow["Hp_Stat"];
					$a1_m_a4_a_stat[] = $aRow["A_Stat"];
					$a1_m_a4_d_stat[] = $aRow["D_Stat"];
					$a1_m_a4_s_stat[] = $aRow["S_Stat"];
					$a1_m_a4_sa_stat[] = $aRow["Sa_Stat"];
					$a1_m_a4_sd_stat[] = $aRow["Sd_Stat"];
					//Agent2
					$a2_m_a4_pp[] = $aRow["Pp"];
					$a2_m_a4_c_pp[] = $aRow["Pp"];
					$a2_m_a4_type[] = $aRow["Type"];
					$a2_m_a4_category[] = $aRow["Category"];
					$a2_m_a4_power[] = $aRow["Power"];
					$a2_m_a4_accuracy[] = $aRow["Accuracy"];
					$a2_m_a4_goal[] = $aRow["Goal"];
					$a2_m_a4_chans_crita[] = $aRow["Chans_Crita"];
					$a2_m_a4_critic_damag[] = $aRow["Critic_Damag"];
					$a2_m_a4_hp_stat[] = $aRow["Hp_Stat"];
					$a2_m_a4_a_stat[] = $aRow["A_Stat"];
					$a2_m_a4_d_stat[] = $aRow["D_Stat"];
					$a2_m_a4_s_stat[] = $aRow["S_Stat"];
					$a2_m_a4_sa_stat[] = $aRow["Sa_Stat"];
					$a2_m_a4_sd_stat[] = $aRow["Sd_Stat"];
				}
				mysql_free_result($result);
			}
			//load all data of type effectivity
			$query = "SELECT Counter, Type1, Type2, Effectivity FROM types_effectivity";	
			$result = mysql_query($query) or die("Query failed : " . mysql_error());
			while ($aRow = mysql_fetch_array($result)) {
				$rf_te_counter[] = $aRow["Counter"];
				$rf_te_type1[] = $aRow["Type1"];
				$rf_te_type2[] = $aRow["Type2"];
				$rf_te_effectivity[] = $aRow["Effectivity"];
			}
			$rf_anz_types_effectivity = count($rf_te_counter);
			mysql_free_result($result);
		?>
		<?php
			//DELETE
			//mysql_query("DELETE FROM score WHERE Agent1='Random' AND Agent2='Random'");
			echo "<div id='battleProtokol' style='margin-left: 33.33%; margin-top: 50px;'>";
				$rf_datetime = date('Y-m-d H:i:s');
				$play = 100;
				$rf_points1 = 0;
				$rf_points2 = 0;
				for($i=0; $i<$play; $i++){
					//agent1 (Random) start card
					$a1_m_start = rand(0, 5);
					echo "Agent1: Choose: $a1_m_name[$a1_m_start] ($a1_m_c_hp[$a1_m_start])<br>";
					//agent2 (Random) start card
					$a2_m_start = rand(0, 5);
					echo "Agent2: Choose: $a2_m_name[$a2_m_start] ($a2_m_c_hp[$a2_m_start])<br>";
					//win cases
					$a1_sum_c_hp = $a1_m_c_hp[$a1_m_start] + $a1_m_c_hp[1] + $a1_m_c_hp[2] + $a1_m_c_hp[3] + $a1_m_c_hp[4] + $a1_m_c_hp[5];
					$a2_sum_c_hp = $a2_m_c_hp[$a2_m_start] + $a2_m_c_hp[1] + $a2_m_c_hp[2] + $a2_m_c_hp[3] + $a2_m_c_hp[4] + $a2_m_c_hp[5];
					$rf_round = 1;
					while(($a1_sum_c_hp != 0) || ($a2_sum_c_hp != 0)){
						//agent1 select action: 0,1,2,3 - atacks , 4 - change
						$a1_action_available = array();
						if($a1_m_a1_c_pp[$a1_m_start] != 0){
							$a1_action_available[] = 0;
						}
						if($a1_m_a2_c_pp[$a1_m_start] != 0){
							$a1_action_available[] = 1;
						}
						if($a1_m_a3_c_pp[$a1_m_start] != 0){
							$a1_action_available[] = 2;
						}
						if($a1_m_a4_c_pp[$a1_m_start] != 0){
							$a1_action_available[] = 3;
						}
						//Action 4
						$a1_cards_available_to_change = array();
						for($j=0; $j<$a1_anz_aktiv_monster; $j++){
							if(($a1_m_c_hp[$j] != 0) && ($a1_m_start != $j)){
								$a1_cards_available_to_change[] = $j;
							}
						}
						$a1_anz_cards_available_to_change = count($a1_cards_available_to_change);
						if($a1_anz_cards_available_to_change != 0){
							$a1_action_available[] = 4;
						}
						$a1_anz_action_available = count($a1_action_available);
						$a1_action_decision = rand(0, $a1_anz_action_available - 1);
						$a1_action = $a1_action_available[$a1_action_decision];
						//echo "Agent1: Action: $a1_action<br>";
						//agent2 select action: 0,1,2,3 - atacks , 4 - change
						$a2_action_available = array();
						if($a2_m_a1_c_pp[$a2_m_start] != 0){
							$a2_action_available[] = 0;
						}
						if($a2_m_a2_c_pp[$a2_m_start] != 0){
							$a2_action_available[] = 1;
						}
						if($a2_m_a3_c_pp[$a2_m_start] != 0){
							$a2_action_available[] = 2;
						}
						if($a2_m_a4_c_pp[$a2_m_start] != 0){
							$a2_action_available[] = 3;
						}
						//Action 4
						$a2_cards_available_to_change = array();
						for($j=0; $j<$a2_anz_aktiv_monster; $j++){
							if(($a2_m_c_hp[$j] != 0) && ($a2_m_start != $j)){
								$a2_cards_available_to_change[] = $j;
							}
						}
						$a2_anz_cards_available_to_change = count($a2_cards_available_to_change);
						if($a2_anz_cards_available_to_change != 0){
							$a2_action_available[] = 4;
						}
						$a2_anz_action_available = count($a2_action_available);
						$a2_action_decision = rand(0, $a2_anz_action_available - 1);
						$a2_action = $a2_action_available[$a2_action_decision];
						//echo "Agent2: Action: $a2_action<br>";
						echo "<p style='text-align: center; color: rgb(51 51 51); font-weight: bold; font-size: 16px; padding-top: 15px;'>Round: $rf_round</p>";
						if($a1_action == 4){
							//set stats back
							$a1_m_c_a[$a1_m_start] = $a1_m_a_stat[$a1_m_start];
							$a1_m_c_d[$a1_m_start] = $a1_m_d_stat[$a1_m_start];
							$a1_m_c_s[$a1_m_start] = $a1_m_s_stat[$a1_m_start];
							$a1_m_c_sa[$a1_m_start] = $a1_m_sa_stat[$a1_m_start];
							$a1_m_c_sd[$a1_m_start] = $a1_m_sd_stat[$a1_m_start];
							$a1_m_a1_c_pp[$a1_m_start] = $a1_m_a1_pp[$a1_m_start];
							$a1_m_a2_c_pp[$a1_m_start] = $a1_m_a2_pp[$a1_m_start];
							$a1_m_a3_c_pp[$a1_m_start] = $a1_m_a3_pp[$a1_m_start];
							$a1_m_a4_c_pp[$a1_m_start] = $a1_m_a4_pp[$a1_m_start];
							$a1_a_count[$a1_m_start] = 0;
							$a1_d_count[$a1_m_start] = 0;
							$a1_s_count[$a1_m_start] = 0;
							$a1_sa_count[$a1_m_start] = 0;
							$a1_sd_count[$a1_m_start] = 0;
							//change card
							$a1_change_decision = rand(0, $a1_anz_cards_available_to_change - 1);
							$a1_m_start = $a1_cards_available_to_change[$a1_change_decision];
							echo "Agent1: Repick: $a1_m_name[$a1_m_start]<br>";
						}
						if($a2_action == 4){
							//set stats back
							$a2_m_c_a[$a2_m_start] = $a2_m_a_stat[$a2_m_start];
							$a2_m_c_d[$a2_m_start] = $a2_m_d_stat[$a2_m_start];
							$a2_m_c_s[$a2_m_start] = $a2_m_s_stat[$a2_m_start];
							$a2_m_c_sa[$a2_m_start] = $a2_m_sa_stat[$a2_m_start];
							$a2_m_c_sd[$a2_m_start] = $a2_m_sd_stat[$a2_m_start];
							$a2_m_a1_c_pp[$a2_m_start] = $a2_m_a1_pp[$a2_m_start];
							$a2_m_a2_c_pp[$a2_m_start] = $a2_m_a2_pp[$a2_m_start];
							$a2_m_a3_c_pp[$a2_m_start] = $a2_m_a3_pp[$a2_m_start];
							$a2_m_a4_c_pp[$a2_m_start] = $a2_m_a4_pp[$a2_m_start];
							$a2_a_count[$a2_m_start] = 0;
							$a2_d_count[$a2_m_start] = 0;
							$a2_s_count[$a2_m_start] = 0;
							$a2_sa_count[$a2_m_start] = 0;
							$a2_sd_count[$a2_m_start] = 0;
							//change card
							$a2_change_decision = rand(0, $a2_anz_cards_available_to_change - 1);
							$a2_m_start = $a2_cards_available_to_change[$a2_change_decision];
							echo "Agent2: Repick: $a2_m_name[$a2_m_start]<br>";
						}
						//compare speed
						if($a1_m_c_s[$a1_m_start] >= $a2_m_c_s[$a2_m_start]){
							//agent1 starts
							if($a1_action != 4){
								if($a1_action == 0){		//atack1
									$a1_atack_res = action_atack('agent1', $a1_m_name[$a1_m_start], $a1_m_lvl[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start],
									$a2_m_name[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start], $a2_m_type1[$a2_m_start],  
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									/*atacks*/
									$a1_m_a1[$a1_m_start],
									$a1_m_a1_type[$a1_m_start], $a1_m_a1_category[$a1_m_start], $a1_m_a1_power[$a1_m_start], $a1_m_a1_accuracy[$a1_m_start], $a1_m_a1_goal[$a1_m_start], $a1_m_a1_chans_crita[$a1_m_start], 
									$a1_m_a1_critic_damag[$a1_m_start], $a1_m_a1_hp_stat[$a1_m_start], $a1_m_a1_a_stat[$a1_m_start], $a1_m_a1_d_stat[$a1_m_start], $a1_m_a1_s_stat[$a1_m_start], $a1_m_a1_sa_stat[$a1_m_start], 
									$a1_m_a1_sd_stat[$a1_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);

									//Aktualisieren data
									$a2_m_c_hp[$a2_m_start] = $a1_atack_res[0];
									$a2_m_damage = $a1_atack_res[1];
									$a2_m_status = $a1_atack_res[2];
									$a2_m_effectivity = $a1_atack_res[3];
									$a2_m_c_a[$a2_m_start] = $a1_atack_res[4];
									$a2_m_c_d[$a2_m_start] = $a1_atack_res[5];
									$a2_m_c_s[$a2_m_start] = $a1_atack_res[6];
									$a2_m_c_sa[$a2_m_start] = $a1_atack_res[7];
									$a2_m_c_sd[$a2_m_start] = $a1_atack_res[8];
									$a2_a_count[$a2_m_start] = $a1_atack_res[9];
									$a2_d_count[$a2_m_start] = $a1_atack_res[10];
									$a2_s_count[$a2_m_start] = $a1_atack_res[11];
									$a2_sa_count[$a2_m_start] = $a1_atack_res[12];
									$a2_sd_count[$a2_m_start] = $a1_atack_res[13];
									
									$a1_m_c_a[$a1_m_start] = $a1_atack_res[14];
									$a1_m_c_d[$a1_m_start] = $a1_atack_res[15];
									$a1_m_c_s[$a1_m_start] = $a1_atack_res[16];
									$a1_m_c_sa[$a1_m_start] = $a1_atack_res[17];
									$a1_m_c_sd[$a1_m_start] = $a1_atack_res[18];
									$a1_a_count[$a1_m_start] = $a1_atack_res[19];
									$a1_d_count[$a1_m_start] = $a1_atack_res[20];
									$a1_s_count[$a1_m_start] = $a1_atack_res[21];
									$a1_sa_count[$a1_m_start] = $a1_atack_res[22];
									$a1_sd_count[$a1_m_start] = $a1_atack_res[23];
									
									//Aktualisieren PP
									$a1_m_a1_c_pp[$a1_m_start] = $a1_m_a1_c_pp[$a1_m_start] - 1;
									
									echo "Agent1: $a1_m_name[$a1_m_start] used (A1)$a1_m_a1[$a1_m_start]: -$a2_m_damage <br> Status: $a2_m_status. Effectivity: $a2_m_effectivity A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start]; <br>$a2_m_name[$a2_m_start]: C_HP: $a2_m_c_hp[$a2_m_start] A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br>"; 
								} else if($a1_action == 1){	//atack2
									$a1_atack_res = action_atack('agent1', $a1_m_name[$a1_m_start], $a1_m_lvl[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start],
									$a2_m_name[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start], $a2_m_type1[$a2_m_start], 
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									/*atacks*/
									$a1_m_a2[$a1_m_start],
									$a1_m_a2_type[$a1_m_start], $a1_m_a2_category[$a1_m_start], $a1_m_a2_power[$a1_m_start], $a1_m_a2_accuracy[$a1_m_start], $a1_m_a2_goal[$a1_m_start], $a1_m_a2_chans_crita[$a1_m_start], 
									$a1_m_a2_critic_damag[$a1_m_start], $a1_m_a2_hp_stat[$a1_m_start], $a1_m_a2_a_stat[$a1_m_start], $a1_m_a2_d_stat[$a1_m_start], $a1_m_a2_s_stat[$a1_m_start], $a1_m_a2_sa_stat[$a1_m_start], 
									$a1_m_a2_sd_stat[$a1_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a2_m_c_hp[$a2_m_start] = $a1_atack_res[0];
									$a2_m_damage = $a1_atack_res[1];
									$a2_m_status = $a1_atack_res[2];
									$a2_m_effectivity = $a1_atack_res[3];
									$a2_m_c_a[$a2_m_start] = $a1_atack_res[4];
									$a2_m_c_d[$a2_m_start] = $a1_atack_res[5];
									$a2_m_c_s[$a2_m_start] = $a1_atack_res[6];
									$a2_m_c_sa[$a2_m_start] = $a1_atack_res[7];
									$a2_m_c_sd[$a2_m_start] = $a1_atack_res[8];
									$a2_a_count[$a2_m_start] = $a1_atack_res[9];
									$a2_d_count[$a2_m_start] = $a1_atack_res[10];
									$a2_s_count[$a2_m_start] = $a1_atack_res[11];
									$a2_sa_count[$a2_m_start] = $a1_atack_res[12];
									$a2_sd_count[$a2_m_start] = $a1_atack_res[13];
									
									$a1_m_c_a[$a1_m_start] = $a1_atack_res[14];
									$a1_m_c_d[$a1_m_start] = $a1_atack_res[15];
									$a1_m_c_s[$a1_m_start] = $a1_atack_res[16];
									$a1_m_c_sa[$a1_m_start] = $a1_atack_res[17];
									$a1_m_c_sd[$a1_m_start] = $a1_atack_res[18];
									$a1_a_count[$a1_m_start] = $a1_atack_res[19];
									$a1_d_count[$a1_m_start] = $a1_atack_res[20];
									$a1_s_count[$a1_m_start] = $a1_atack_res[21];
									$a1_sa_count[$a1_m_start] = $a1_atack_res[22];
									$a1_sd_count[$a1_m_start] = $a1_atack_res[23];
									
									//Aktualisieren PP
									$a1_m_a2_c_pp[$a1_m_start] = $a1_m_a2_c_pp[$a1_m_start] - 1;
									
									echo "Agent1: $a1_m_name[$a1_m_start] used (A2)$a1_m_a2[$a1_m_start]: -$a2_m_damage <br> Status: $a2_m_status. Effectivity: $a2_m_effectivity A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br> $a2_m_name[$a2_m_start]: C_HP: $a2_m_c_hp[$a2_m_start] A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br>";	
								}else if($a1_action == 2){	//atack3
									$a1_atack_res = action_atack('agent1', $a1_m_name[$a1_m_start], $a1_m_lvl[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start],
									$a2_m_name[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start], $a2_m_type1[$a2_m_start], 
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									/*atacks*/
									$a1_m_a3[$a1_m_start],
									$a1_m_a3_type[$a1_m_start], $a1_m_a3_category[$a1_m_start], $a1_m_a3_power[$a1_m_start], $a1_m_a3_accuracy[$a1_m_start], $a1_m_a3_goal[$a1_m_start], $a1_m_a3_chans_crita[$a1_m_start], 
									$a1_m_a3_critic_damag[$a1_m_start], $a1_m_a3_hp_stat[$a1_m_start], $a1_m_a3_a_stat[$a1_m_start], $a1_m_a3_d_stat[$a1_m_start], $a1_m_a3_s_stat[$a1_m_start], $a1_m_a3_sa_stat[$a1_m_start], 
									$a1_m_a3_sd_stat[$a1_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a2_m_c_hp[$a2_m_start] = $a1_atack_res[0];
									$a2_m_damage = $a1_atack_res[1];
									$a2_m_status = $a1_atack_res[2];
									$a2_m_effectivity = $a1_atack_res[3];
									$a2_m_c_a[$a2_m_start] = $a1_atack_res[4];
									$a2_m_c_d[$a2_m_start] = $a1_atack_res[5];
									$a2_m_c_s[$a2_m_start] = $a1_atack_res[6];
									$a2_m_c_sa[$a2_m_start] = $a1_atack_res[7];
									$a2_m_c_sd[$a2_m_start] = $a1_atack_res[8];
									$a2_a_count[$a2_m_start] = $a1_atack_res[9];
									$a2_d_count[$a2_m_start] = $a1_atack_res[10];
									$a2_s_count[$a2_m_start] = $a1_atack_res[11];
									$a2_sa_count[$a2_m_start] = $a1_atack_res[12];
									$a2_sd_count[$a2_m_start] = $a1_atack_res[13];
									
									$a1_m_c_a[$a1_m_start] = $a1_atack_res[14];
									$a1_m_c_d[$a1_m_start] = $a1_atack_res[15];
									$a1_m_c_s[$a1_m_start] = $a1_atack_res[16];
									$a1_m_c_sa[$a1_m_start] = $a1_atack_res[17];
									$a1_m_c_sd[$a1_m_start] = $a1_atack_res[18];
									$a1_a_count[$a1_m_start] = $a1_atack_res[19];
									$a1_d_count[$a1_m_start] = $a1_atack_res[20];
									$a1_s_count[$a1_m_start] = $a1_atack_res[21];
									$a1_sa_count[$a1_m_start] = $a1_atack_res[22];
									$a1_sd_count[$a1_m_start] = $a1_atack_res[23];
									
									//Aktualisieren PP
									$a1_m_a3_c_pp[$a1_m_start] = $a1_m_a3_c_pp[$a1_m_start] - 1;
									
									echo "Agent1: $a1_m_name[$a1_m_start] used (A3)$a1_m_a3[$a1_m_start]: -$a2_m_damage <br> Status: $a2_m_status. Effectivity: $a2_m_effectivity A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br> $a2_m_name[$a2_m_start]: C_HP: $a2_m_c_hp[$a2_m_start] A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br>";
								}else if($a1_action == 3){	//atack4
									$a1_atack_res = action_atack('agent1', $a1_m_name[$a1_m_start], $a1_m_lvl[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start],
									$a2_m_name[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start], $a2_m_type1[$a2_m_start], 
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									/*atacks*/
									$a1_m_a4[$a1_m_start],
									$a1_m_a4_type[$a1_m_start], $a1_m_a4_category[$a1_m_start], $a1_m_a4_power[$a1_m_start], $a1_m_a4_accuracy[$a1_m_start], $a1_m_a4_goal[$a1_m_start], $a1_m_a4_chans_crita[$a1_m_start], 
									$a1_m_a4_critic_damag[$a1_m_start], $a1_m_a4_hp_stat[$a1_m_start], $a1_m_a4_a_stat[$a1_m_start], $a1_m_a4_d_stat[$a1_m_start], $a1_m_a4_s_stat[$a1_m_start], $a1_m_a4_sa_stat[$a1_m_start], 
									$a1_m_a4_sd_stat[$a1_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a2_m_c_hp[$a2_m_start] = $a1_atack_res[0];
									$a2_m_damage = $a1_atack_res[1];
									$a2_m_status = $a1_atack_res[2];
									$a2_m_effectivity = $a1_atack_res[3];
									$a2_m_c_a[$a2_m_start] = $a1_atack_res[4];
									$a2_m_c_d[$a2_m_start] = $a1_atack_res[5];
									$a2_m_c_s[$a2_m_start] = $a1_atack_res[6];
									$a2_m_c_sa[$a2_m_start] = $a1_atack_res[7];
									$a2_m_c_sd[$a2_m_start] = $a1_atack_res[8];
									$a2_a_count[$a2_m_start] = $a1_atack_res[9];
									$a2_d_count[$a2_m_start] = $a1_atack_res[10];
									$a2_s_count[$a2_m_start] = $a1_atack_res[11];
									$a2_sa_count[$a2_m_start] = $a1_atack_res[12];
									$a2_sd_count[$a2_m_start] = $a1_atack_res[13];
									
									$a1_m_c_a[$a1_m_start] = $a1_atack_res[14];
									$a1_m_c_d[$a1_m_start] = $a1_atack_res[15];
									$a1_m_c_s[$a1_m_start] = $a1_atack_res[16];
									$a1_m_c_sa[$a1_m_start] = $a1_atack_res[17];
									$a1_m_c_sd[$a1_m_start] = $a1_atack_res[18];
									$a1_a_count[$a1_m_start] = $a1_atack_res[19];
									$a1_d_count[$a1_m_start] = $a1_atack_res[20];
									$a1_s_count[$a1_m_start] = $a1_atack_res[21];
									$a1_sa_count[$a1_m_start] = $a1_atack_res[22];
									$a1_sd_count[$a1_m_start] = $a1_atack_res[23];
									
									//Aktualisieren PP
									$a1_m_a4_c_pp[$a1_m_start] = $a1_m_a4_c_pp[$a1_m_start] - 1;
									
									echo "Agent1: $a1_m_name[$a1_m_start] used (A4)$a1_m_a4[$a1_m_start]: -$a2_m_damage <br> Status: $a2_m_status. Effectivity: $a2_m_effectivity A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br> $a2_m_name[$a2_m_start]: C_HP: $a2_m_c_hp[$a2_m_start] A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br>";
								}
							}
							//agent2 goes
							if(($a2_action != 4) && ($a2_m_c_hp[$a2_m_start] != 0)){
								if($a2_action == 0){		//atack1
									$a2_atack_res = action_atack('agent2', $a2_m_name[$a2_m_start], $a2_m_lvl[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start],
									$a1_m_name[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start], $a1_m_type1[$a1_m_start], 
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									/*atacks*/
									$a2_m_a1[$a2_m_start],
									$a2_m_a1_type[$a2_m_start], $a2_m_a1_category[$a2_m_start], $a2_m_a1_power[$a2_m_start], $a2_m_a1_accuracy[$a2_m_start], $a2_m_a1_goal[$a2_m_start], $a2_m_a1_chans_crita[$a2_m_start], 
									$a2_m_a1_critic_damag[$a2_m_start], $a2_m_a1_hp_stat[$a2_m_start], $a2_m_a1_a_stat[$a2_m_start], $a2_m_a1_d_stat[$a2_m_start], $a2_m_a1_s_stat[$a2_m_start], $a2_m_a1_sa_stat[$a2_m_start], 
									$a2_m_a1_sd_stat[$a2_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a1_m_c_hp[$a1_m_start] = $a2_atack_res[0];
									$a1_m_damage = $a2_atack_res[1];
									$a1_m_status = $a2_atack_res[2];
									$a1_m_effectivity = $a2_atack_res[3];
									$a1_m_c_a[$a1_m_start] = $a2_atack_res[4];
									$a1_m_c_d[$a1_m_start] = $a2_atack_res[5];
									$a1_m_c_s[$a1_m_start] = $a2_atack_res[6];
									$a1_m_c_sa[$a1_m_start] = $a2_atack_res[7];
									$a1_m_c_sd[$a1_m_start] = $a2_atack_res[8];
									$a1_a_count[$a1_m_start] = $a2_atack_res[9];
									$a1_d_count[$a1_m_start] = $a2_atack_res[10];
									$a1_s_count[$a1_m_start] = $a2_atack_res[11];
									$a1_sa_count[$a1_m_start] = $a2_atack_res[12];
									$a1_sd_count[$a1_m_start] = $a2_atack_res[13];
									
									$a2_m_c_a[$a2_m_start] = $a2_atack_res[14];
									$a2_m_c_d[$a2_m_start] = $a2_atack_res[15];
									$a2_m_c_s[$a2_m_start] = $a2_atack_res[16];
									$a2_m_c_sa[$a2_m_start] = $a2_atack_res[17];
									$a2_m_c_sd[$a2_m_start] = $a2_atack_res[18];
									$a2_a_count[$a2_m_start] = $a2_atack_res[19];
									$a2_d_count[$a2_m_start] = $a2_atack_res[20];
									$a2_s_count[$a2_m_start] = $a2_atack_res[21];
									$a2_sa_count[$a2_m_start] = $a2_atack_res[22];
									$a2_sd_count[$a2_m_start] = $a2_atack_res[23];
									
									//Aktualisieren PP
									$a2_m_a1_c_pp[$a2_m_start] = $a2_m_a1_c_pp[$a2_m_start] - 1;
									
									echo "Agent2: $a2_m_name[$a2_m_start] used (A1)$a2_m_a1[$a2_m_start]: -$a1_m_damage <br> Status: $a1_m_status. Effectivity: $a1_m_effectivity A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br> $a1_m_name[$a1_m_start]: C_HP: $a1_m_c_hp[$a1_m_start] A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br>";
								} else if($a2_action == 1){	//atack2
									$a2_atack_res = action_atack('agent2', $a2_m_name[$a2_m_start], $a2_m_lvl[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start],
									$a1_m_name[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start], $a1_m_type1[$a1_m_start], 
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									/*atacks*/
									$a2_m_a2[$a2_m_start],
									$a2_m_a2_type[$a2_m_start], $a2_m_a2_category[$a2_m_start], $a2_m_a2_power[$a2_m_start], $a2_m_a2_accuracy[$a2_m_start], $a2_m_a2_goal[$a2_m_start], $a2_m_a2_chans_crita[$a2_m_start], 
									$a2_m_a2_critic_damag[$a2_m_start], $a2_m_a2_hp_stat[$a2_m_start], $a2_m_a2_a_stat[$a2_m_start], $a2_m_a2_d_stat[$a2_m_start], $a2_m_a2_s_stat[$a2_m_start], $a2_m_a2_sa_stat[$a2_m_start], 
									$a2_m_a2_sd_stat[$a2_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a1_m_c_hp[$a1_m_start] = $a2_atack_res[0];
									$a1_m_damage = $a2_atack_res[1];
									$a1_m_status = $a2_atack_res[2];
									$a1_m_effectivity = $a2_atack_res[3];
									$a1_m_c_a[$a1_m_start] = $a2_atack_res[4];
									$a1_m_c_d[$a1_m_start] = $a2_atack_res[5];
									$a1_m_c_s[$a1_m_start] = $a2_atack_res[6];
									$a1_m_c_sa[$a1_m_start] = $a2_atack_res[7];
									$a1_m_c_sd[$a1_m_start] = $a2_atack_res[8];
									$a1_a_count[$a1_m_start] = $a2_atack_res[9];
									$a1_d_count[$a1_m_start] = $a2_atack_res[10];
									$a1_s_count[$a1_m_start] = $a2_atack_res[11];
									$a1_sa_count[$a1_m_start] = $a2_atack_res[12];
									$a1_sd_count[$a1_m_start] = $a2_atack_res[13];
									
									$a2_m_c_a[$a2_m_start] = $a2_atack_res[14];
									$a2_m_c_d[$a2_m_start] = $a2_atack_res[15];
									$a2_m_c_s[$a2_m_start] = $a2_atack_res[16];
									$a2_m_c_sa[$a2_m_start] = $a2_atack_res[17];
									$a2_m_c_sd[$a2_m_start] = $a2_atack_res[18];
									$a2_a_count[$a2_m_start] = $a2_atack_res[19];
									$a2_d_count[$a2_m_start] = $a2_atack_res[20];
									$a2_s_count[$a2_m_start] = $a2_atack_res[21];
									$a2_sa_count[$a2_m_start] = $a2_atack_res[22];
									$a2_sd_count[$a2_m_start] = $a2_atack_res[23];
									
									//Aktualisieren PP
									$a2_m_a2_c_pp[$a2_m_start] = $a2_m_a2_c_pp[$a2_m_start] - 1;
									
									echo "Agent2: $a2_m_name[$a2_m_start] used (A2)$a2_m_a2[$a2_m_start]: -$a1_m_damage <br> Status: $a1_m_status. Effectivity: $a1_m_effectivity A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br> $a2_m_name[$a2_m_start]: C_HP: $a1_m_c_hp[$a1_m_start] A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br>";
								}else if($a2_action == 2){	//atack3
									$a2_atack_res = action_atack('agent2', $a2_m_name[$a2_m_start], $a2_m_lvl[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start],
									$a1_m_name[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start], $a1_m_type1[$a1_m_start], 
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									/*atacks*/
									$a2_m_a3[$a2_m_start],
									$a2_m_a3_type[$a2_m_start], $a2_m_a3_category[$a2_m_start], $a2_m_a3_power[$a2_m_start], $a2_m_a3_accuracy[$a2_m_start], $a2_m_a3_goal[$a2_m_start], $a2_m_a3_chans_crita[$a2_m_start], 
									$a2_m_a3_critic_damag[$a2_m_start], $a2_m_a3_hp_stat[$a2_m_start], $a2_m_a3_a_stat[$a2_m_start], $a2_m_a3_d_stat[$a2_m_start], $a2_m_a3_s_stat[$a2_m_start], $a2_m_a3_sa_stat[$a2_m_start], 
									$a2_m_a3_sd_stat[$a2_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a1_m_c_hp[$a1_m_start] = $a2_atack_res[0];
									$a1_m_damage = $a2_atack_res[1];
									$a1_m_status = $a2_atack_res[2];
									$a1_m_effectivity = $a2_atack_res[3];
									$a1_m_c_a[$a1_m_start] = $a2_atack_res[4];
									$a1_m_c_d[$a1_m_start] = $a2_atack_res[5];
									$a1_m_c_s[$a1_m_start] = $a2_atack_res[6];
									$a1_m_c_sa[$a1_m_start] = $a2_atack_res[7];
									$a1_m_c_sd[$a1_m_start] = $a2_atack_res[8];
									$a1_a_count[$a1_m_start] = $a2_atack_res[9];
									$a1_d_count[$a1_m_start] = $a2_atack_res[10];
									$a1_s_count[$a1_m_start] = $a2_atack_res[11];
									$a1_sa_count[$a1_m_start] = $a2_atack_res[12];
									$a1_sd_count[$a1_m_start] = $a2_atack_res[13];
									
									$a2_m_c_a[$a2_m_start] = $a2_atack_res[14];
									$a2_m_c_d[$a2_m_start] = $a2_atack_res[15];
									$a2_m_c_s[$a2_m_start] = $a2_atack_res[16];
									$a2_m_c_sa[$a2_m_start] = $a2_atack_res[17];
									$a2_m_c_sd[$a2_m_start] = $a2_atack_res[18];
									$a2_a_count[$a2_m_start] = $a2_atack_res[19];
									$a2_d_count[$a2_m_start] = $a2_atack_res[20];
									$a2_s_count[$a2_m_start] = $a2_atack_res[21];
									$a2_sa_count[$a2_m_start] = $a2_atack_res[22];
									$a2_sd_count[$a2_m_start] = $a2_atack_res[23];
									
									//Aktualisieren PP
									$a2_m_a3_c_pp[$a2_m_start] = $a2_m_a3_c_pp[$a2_m_start] - 1;
									
									echo "Agent2: $a2_m_name[$a2_m_start] used (A3)$a2_m_a3[$a2_m_start]: -$a1_m_damage <br> Status: $a1_m_status. Effectivity: $a1_m_effectivity A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br> $a1_m_name[$a1_m_start]: C_HP: $a1_m_c_hp[$a1_m_start] A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br>";
								}else if($a2_action == 3){	//atack4
									$a2_atack_res = action_atack('agent2', $a2_m_name[$a2_m_start], $a2_m_lvl[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start],
									$a1_m_name[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start], $a1_m_type1[$a1_m_start],  
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									/*atacks*/
									$a2_m_a4[$a2_m_start],
									$a2_m_a4_type[$a2_m_start], $a2_m_a4_category[$a2_m_start], $a2_m_a4_power[$a2_m_start], $a2_m_a4_accuracy[$a2_m_start], $a2_m_a4_goal[$a2_m_start], $a2_m_a4_chans_crita[$a2_m_start], 
									$a2_m_a4_critic_damag[$a2_m_start], $a2_m_a4_hp_stat[$a2_m_start], $a2_m_a4_a_stat[$a2_m_start], $a2_m_a4_d_stat[$a2_m_start], $a2_m_a4_s_stat[$a2_m_start], $a2_m_a4_sa_stat[$a2_m_start], 
									$a2_m_a4_sd_stat[$a2_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a1_m_c_hp[$a1_m_start] = $a2_atack_res[0];
									$a1_m_damage = $a2_atack_res[1];
									$a1_m_status = $a2_atack_res[2];
									$a1_m_effectivity = $a2_atack_res[3];
									$a1_m_c_a[$a1_m_start] = $a2_atack_res[4];
									$a1_m_c_d[$a1_m_start] = $a2_atack_res[5];
									$a1_m_c_s[$a1_m_start] = $a2_atack_res[6];
									$a1_m_c_sa[$a1_m_start] = $a2_atack_res[7];
									$a1_m_c_sd[$a1_m_start] = $a2_atack_res[8];
									$a1_a_count[$a1_m_start] = $a2_atack_res[9];
									$a1_d_count[$a1_m_start] = $a2_atack_res[10];
									$a1_s_count[$a1_m_start] = $a2_atack_res[11];
									$a1_sa_count[$a1_m_start] = $a2_atack_res[12];
									$a1_sd_count[$a1_m_start] = $a2_atack_res[13];
									
									$a2_m_c_a[$a2_m_start] = $a2_atack_res[14];
									$a2_m_c_d[$a2_m_start] = $a2_atack_res[15];
									$a2_m_c_s[$a2_m_start] = $a2_atack_res[16];
									$a2_m_c_sa[$a2_m_start] = $a2_atack_res[17];
									$a2_m_c_sd[$a2_m_start] = $a2_atack_res[18];
									$a2_a_count[$a2_m_start] = $a2_atack_res[19];
									$a2_d_count[$a2_m_start] = $a2_atack_res[20];
									$a2_s_count[$a2_m_start] = $a2_atack_res[21];
									$a2_sa_count[$a2_m_start] = $a2_atack_res[22];
									$a2_sd_count[$a2_m_start] = $a2_atack_res[23];
									
									//Aktualisieren PP
									$a2_m_a4_c_pp[$a2_m_start] = $a2_m_a4_c_pp[$a2_m_start] - 1;
									
									echo "Agent2: $a2_m_name[$a2_m_start] used (A4)$a2_m_a4[$a2_m_start]: -$a1_m_damage <br> Status: $a1_m_status. Effectivity: $a1_m_effectivity A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br> $a1_m_name[$a1_m_start]: C_HP: $a1_m_c_hp[$a1_m_start] A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br>";
								}
							}
						}else{
							//agent2 starts
							if($a2_action != 4){
								if($a2_action == 0){		//atack1
									$a2_atack_res = action_atack('agent2', $a2_m_name[$a2_m_start], $a2_m_lvl[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start],
									$a1_m_name[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start], $a1_m_type1[$a1_m_start], 
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									/*atacks*/
									$a2_m_a1[$a2_m_start],
									$a2_m_a1_type[$a2_m_start], $a2_m_a1_category[$a2_m_start], $a2_m_a1_power[$a2_m_start], $a2_m_a1_accuracy[$a2_m_start], $a2_m_a1_goal[$a2_m_start], $a2_m_a1_chans_crita[$a2_m_start], 
									$a2_m_a1_critic_damag[$a2_m_start], $a2_m_a1_hp_stat[$a2_m_start], $a2_m_a1_a_stat[$a2_m_start], $a2_m_a1_d_stat[$a2_m_start], $a2_m_a1_s_stat[$a2_m_start], $a2_m_a1_sa_stat[$a2_m_start], 
									$a2_m_a1_sd_stat[$a2_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a1_m_c_hp[$a1_m_start] = $a2_atack_res[0];
									$a1_m_damage = $a2_atack_res[1];
									$a1_m_status = $a2_atack_res[2];
									$a1_m_effectivity = $a2_atack_res[3];
									$a1_m_c_a[$a1_m_start] = $a2_atack_res[4];
									$a1_m_c_d[$a1_m_start] = $a2_atack_res[5];
									$a1_m_c_s[$a1_m_start] = $a2_atack_res[6];
									$a1_m_c_sa[$a1_m_start] = $a2_atack_res[7];
									$a1_m_c_sd[$a1_m_start] = $a2_atack_res[8];
									$a1_a_count[$a1_m_start] = $a2_atack_res[9];
									$a1_d_count[$a1_m_start] = $a2_atack_res[10];
									$a1_s_count[$a1_m_start] = $a2_atack_res[11];
									$a1_sa_count[$a1_m_start] = $a2_atack_res[12];
									$a1_sd_count[$a1_m_start] = $a2_atack_res[13];
									
									$a2_m_c_a[$a2_m_start] = $a2_atack_res[14];
									$a2_m_c_d[$a2_m_start] = $a2_atack_res[15];
									$a2_m_c_s[$a2_m_start] = $a2_atack_res[16];
									$a2_m_c_sa[$a2_m_start] = $a2_atack_res[17];
									$a2_m_c_sd[$a2_m_start] = $a2_atack_res[18];
									$a2_a_count[$a2_m_start] = $a2_atack_res[19];
									$a2_d_count[$a2_m_start] = $a2_atack_res[20];
									$a2_s_count[$a2_m_start] = $a2_atack_res[21];
									$a2_sa_count[$a2_m_start] = $a2_atack_res[22];
									$a2_sd_count[$a2_m_start] = $a2_atack_res[23];
									
									//Aktualisieren PP
									$a2_m_a1_c_pp[$a2_m_start] = $a2_m_a1_c_pp[$a2_m_start] - 1;
									
									echo "Agent2: $a2_m_name[$a2_m_start] used (A1)$a2_m_a1[$a2_m_start]: -$a1_m_damage <br> Status: $a1_m_status. Effectivity: $a1_m_effectivity A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br> $a1_m_name[$a1_m_start]: C_HP: $a1_m_c_hp[$a1_m_start] A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br>";
								} else if($a2_action == 1){	//atack2
									$a2_atack_res = action_atack('agent2', $a2_m_name[$a2_m_start], $a2_m_lvl[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start],
									$a1_m_name[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start], $a1_m_type1[$a1_m_start], 
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									/*atacks*/
									$a2_m_a2[$a2_m_start],
									$a2_m_a2_type[$a2_m_start], $a2_m_a2_category[$a2_m_start], $a2_m_a2_power[$a2_m_start], $a2_m_a2_accuracy[$a2_m_start], $a2_m_a2_goal[$a2_m_start], $a2_m_a2_chans_crita[$a2_m_start], 
									$a2_m_a2_critic_damag[$a2_m_start], $a2_m_a2_hp_stat[$a2_m_start], $a2_m_a2_a_stat[$a2_m_start], $a2_m_a2_d_stat[$a2_m_start], $a2_m_a2_s_stat[$a2_m_start], $a2_m_a2_sa_stat[$a2_m_start], 
									$a2_m_a2_sd_stat[$a2_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a1_m_c_hp[$a1_m_start] = $a2_atack_res[0];
									$a1_m_damage = $a2_atack_res[1];
									$a1_m_status = $a2_atack_res[2];
									$a1_m_effectivity = $a2_atack_res[3];
									$a1_m_c_a[$a1_m_start] = $a2_atack_res[4];
									$a1_m_c_d[$a1_m_start] = $a2_atack_res[5];
									$a1_m_c_s[$a1_m_start] = $a2_atack_res[6];
									$a1_m_c_sa[$a1_m_start] = $a2_atack_res[7];
									$a1_m_c_sd[$a1_m_start] = $a2_atack_res[8];
									$a1_a_count[$a1_m_start] = $a2_atack_res[9];
									$a1_d_count[$a1_m_start] = $a2_atack_res[10];
									$a1_s_count[$a1_m_start] = $a2_atack_res[11];
									$a1_sa_count[$a1_m_start] = $a2_atack_res[12];
									$a1_sd_count[$a1_m_start] = $a2_atack_res[13];
									
									$a2_m_c_a[$a2_m_start] = $a2_atack_res[14];
									$a2_m_c_d[$a2_m_start] = $a2_atack_res[15];
									$a2_m_c_s[$a2_m_start] = $a2_atack_res[16];
									$a2_m_c_sa[$a2_m_start] = $a2_atack_res[17];
									$a2_m_c_sd[$a2_m_start] = $a2_atack_res[18];
									$a2_a_count[$a2_m_start] = $a2_atack_res[19];
									$a2_d_count[$a2_m_start] = $a2_atack_res[20];
									$a2_s_count[$a2_m_start] = $a2_atack_res[21];
									$a2_sa_count[$a2_m_start] = $a2_atack_res[22];
									$a2_sd_count[$a2_m_start] = $a2_atack_res[23];
									
									//Aktualisieren PP
									$a2_m_a2_c_pp[$a2_m_start] = $a2_m_a2_c_pp[$a2_m_start] - 1;
									
									echo "Agent2: $a2_m_name[$a2_m_start] used (A2)$a2_m_a2[$a2_m_start]: -$a1_m_damage <br> Status: $a1_m_status. Effectivity: $a1_m_effectivity A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br> $a2_m_name[$a2_m_start]: C_HP: $a1_m_c_hp[$a1_m_start] A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br>";
								}else if($a2_action == 2){	//atack3
									$a2_atack_res = action_atack('agent2', $a2_m_name[$a2_m_start], $a2_m_lvl[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start],
									$a1_m_name[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start], $a1_m_type1[$a1_m_start], 
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									/*atacks*/
									$a2_m_a3[$a2_m_start],
									$a2_m_a3_type[$a2_m_start], $a2_m_a3_category[$a2_m_start], $a2_m_a3_power[$a2_m_start], $a2_m_a3_accuracy[$a2_m_start], $a2_m_a3_goal[$a2_m_start], $a2_m_a3_chans_crita[$a2_m_start], 
									$a2_m_a3_critic_damag[$a2_m_start], $a2_m_a3_hp_stat[$a2_m_start], $a2_m_a3_a_stat[$a2_m_start], $a2_m_a3_d_stat[$a2_m_start], $a2_m_a3_s_stat[$a2_m_start], $a2_m_a3_sa_stat[$a2_m_start], 
									$a2_m_a3_sd_stat[$a2_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a1_m_c_hp[$a1_m_start] = $a2_atack_res[0];
									$a1_m_damage = $a2_atack_res[1];
									$a1_m_status = $a2_atack_res[2];
									$a1_m_effectivity = $a2_atack_res[3];
									$a1_m_c_a[$a1_m_start] = $a2_atack_res[4];
									$a1_m_c_d[$a1_m_start] = $a2_atack_res[5];
									$a1_m_c_s[$a1_m_start] = $a2_atack_res[6];
									$a1_m_c_sa[$a1_m_start] = $a2_atack_res[7];
									$a1_m_c_sd[$a1_m_start] = $a2_atack_res[8];
									$a1_a_count[$a1_m_start] = $a2_atack_res[9];
									$a1_d_count[$a1_m_start] = $a2_atack_res[10];
									$a1_s_count[$a1_m_start] = $a2_atack_res[11];
									$a1_sa_count[$a1_m_start] = $a2_atack_res[12];
									$a1_sd_count[$a1_m_start] = $a2_atack_res[13];
									
									$a2_m_c_a[$a2_m_start] = $a2_atack_res[14];
									$a2_m_c_d[$a2_m_start] = $a2_atack_res[15];
									$a2_m_c_s[$a2_m_start] = $a2_atack_res[16];
									$a2_m_c_sa[$a2_m_start] = $a2_atack_res[17];
									$a2_m_c_sd[$a2_m_start] = $a2_atack_res[18];
									$a2_a_count[$a2_m_start] = $a2_atack_res[19];
									$a2_d_count[$a2_m_start] = $a2_atack_res[20];
									$a2_s_count[$a2_m_start] = $a2_atack_res[21];
									$a2_sa_count[$a2_m_start] = $a2_atack_res[22];
									$a2_sd_count[$a2_m_start] = $a2_atack_res[23];
									
									//Aktualisieren PP
									$a2_m_a3_c_pp[$a2_m_start] = $a2_m_a3_c_pp[$a2_m_start] - 1;
									
									echo "Agent2: $a2_m_name[$a2_m_start] used (A3)$a2_m_a3[$a2_m_start]: -$a1_m_damage <br> Status: $a1_m_status. Effectivity: $a1_m_effectivity A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br> $a1_m_name[$a1_m_start]: C_HP: $a1_m_c_hp[$a1_m_start] A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br>";
								}else if($a2_action == 3){	//atack4
									$a2_atack_res = action_atack('agent2', $a2_m_name[$a2_m_start], $a2_m_lvl[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start],
									$a1_m_name[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start], $a1_m_type1[$a1_m_start],  
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									/*atacks*/
									$a2_m_a4[$a2_m_start],
									$a2_m_a4_type[$a2_m_start], $a2_m_a4_category[$a2_m_start], $a2_m_a4_power[$a2_m_start], $a2_m_a4_accuracy[$a2_m_start], $a2_m_a4_goal[$a2_m_start], $a2_m_a4_chans_crita[$a2_m_start], 
									$a2_m_a4_critic_damag[$a2_m_start], $a2_m_a4_hp_stat[$a2_m_start], $a2_m_a4_a_stat[$a2_m_start], $a2_m_a4_d_stat[$a2_m_start], $a2_m_a4_s_stat[$a2_m_start], $a2_m_a4_sa_stat[$a2_m_start], 
									$a2_m_a4_sd_stat[$a2_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a1_m_c_hp[$a1_m_start] = $a2_atack_res[0];
									$a1_m_damage = $a2_atack_res[1];
									$a1_m_status = $a2_atack_res[2];
									$a1_m_effectivity = $a2_atack_res[3];
									$a1_m_c_a[$a1_m_start] = $a2_atack_res[4];
									$a1_m_c_d[$a1_m_start] = $a2_atack_res[5];
									$a1_m_c_s[$a1_m_start] = $a2_atack_res[6];
									$a1_m_c_sa[$a1_m_start] = $a2_atack_res[7];
									$a1_m_c_sd[$a1_m_start] = $a2_atack_res[8];
									$a1_a_count[$a1_m_start] = $a2_atack_res[9];
									$a1_d_count[$a1_m_start] = $a2_atack_res[10];
									$a1_s_count[$a1_m_start] = $a2_atack_res[11];
									$a1_sa_count[$a1_m_start] = $a2_atack_res[12];
									$a1_sd_count[$a1_m_start] = $a2_atack_res[13];
									
									$a2_m_c_a[$a2_m_start] = $a2_atack_res[14];
									$a2_m_c_d[$a2_m_start] = $a2_atack_res[15];
									$a2_m_c_s[$a2_m_start] = $a2_atack_res[16];
									$a2_m_c_sa[$a2_m_start] = $a2_atack_res[17];
									$a2_m_c_sd[$a2_m_start] = $a2_atack_res[18];
									$a2_a_count[$a2_m_start] = $a2_atack_res[19];
									$a2_d_count[$a2_m_start] = $a2_atack_res[20];
									$a2_s_count[$a2_m_start] = $a2_atack_res[21];
									$a2_sa_count[$a2_m_start] = $a2_atack_res[22];
									$a2_sd_count[$a2_m_start] = $a2_atack_res[23];
									
									//Aktualisieren PP
									$a2_m_a4_c_pp[$a2_m_start] = $a2_m_a4_c_pp[$a2_m_start] - 1;
									
									echo "Agent2: $a2_m_name[$a2_m_start] used (A4)$a2_m_a4[$a2_m_start]: -$a1_m_damage <br> Status: $a1_m_status. Effectivity: $a1_m_effectivity A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br> $a1_m_name[$a1_m_start]: C_HP: $a1_m_c_hp[$a1_m_start] A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br>";
								}
							}
							//agent1 goes
							if(($a1_action != 4) && ($a1_m_c_hp[$a1_m_start] != 0)){
								if($a1_action == 0){		//atack1
									$a1_atack_res = action_atack('agent1', $a1_m_name[$a1_m_start], $a1_m_lvl[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start],
									$a2_m_name[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start], $a2_m_type1[$a2_m_start],  
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									/*atacks*/
									$a1_m_a1[$a1_m_start],
									$a1_m_a1_type[$a1_m_start], $a1_m_a1_category[$a1_m_start], $a1_m_a1_power[$a1_m_start], $a1_m_a1_accuracy[$a1_m_start], $a1_m_a1_goal[$a1_m_start], $a1_m_a1_chans_crita[$a1_m_start], 
									$a1_m_a1_critic_damag[$a1_m_start], $a1_m_a1_hp_stat[$a1_m_start], $a1_m_a1_a_stat[$a1_m_start], $a1_m_a1_d_stat[$a1_m_start], $a1_m_a1_s_stat[$a1_m_start], $a1_m_a1_sa_stat[$a1_m_start], 
									$a1_m_a1_sd_stat[$a1_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);

									//Aktualisieren data
									$a2_m_c_hp[$a2_m_start] = $a1_atack_res[0];
									$a2_m_damage = $a1_atack_res[1];
									$a2_m_status = $a1_atack_res[2];
									$a2_m_effectivity = $a1_atack_res[3];
									$a2_m_c_a[$a2_m_start] = $a1_atack_res[4];
									$a2_m_c_d[$a2_m_start] = $a1_atack_res[5];
									$a2_m_c_s[$a2_m_start] = $a1_atack_res[6];
									$a2_m_c_sa[$a2_m_start] = $a1_atack_res[7];
									$a2_m_c_sd[$a2_m_start] = $a1_atack_res[8];
									$a2_a_count[$a2_m_start] = $a1_atack_res[9];
									$a2_d_count[$a2_m_start] = $a1_atack_res[10];
									$a2_s_count[$a2_m_start] = $a1_atack_res[11];
									$a2_sa_count[$a2_m_start] = $a1_atack_res[12];
									$a2_sd_count[$a2_m_start] = $a1_atack_res[13];
									
									$a1_m_c_a[$a1_m_start] = $a1_atack_res[14];
									$a1_m_c_d[$a1_m_start] = $a1_atack_res[15];
									$a1_m_c_s[$a1_m_start] = $a1_atack_res[16];
									$a1_m_c_sa[$a1_m_start] = $a1_atack_res[17];
									$a1_m_c_sd[$a1_m_start] = $a1_atack_res[18];
									$a1_a_count[$a1_m_start] = $a1_atack_res[19];
									$a1_d_count[$a1_m_start] = $a1_atack_res[20];
									$a1_s_count[$a1_m_start] = $a1_atack_res[21];
									$a1_sa_count[$a1_m_start] = $a1_atack_res[22];
									$a1_sd_count[$a1_m_start] = $a1_atack_res[23];
									
									//Aktualisieren PP
									$a1_m_a1_c_pp[$a1_m_start] = $a1_m_a1_c_pp[$a1_m_start] - 1;
									
									echo "Agent1: $a1_m_name[$a1_m_start] used (A1)$a1_m_a1[$a1_m_start]: -$a2_m_damage <br> Status: $a2_m_status. Effectivity: $a2_m_effectivity A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start]; <br>$a2_m_name[$a2_m_start]: C_HP: $a2_m_c_hp[$a2_m_start] A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br>"; 
								} else if($a1_action == 1){	//atack2
									$a1_atack_res = action_atack('agent1', $a1_m_name[$a1_m_start], $a1_m_lvl[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start],
									$a2_m_name[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start], $a2_m_type1[$a2_m_start], 
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									/*atacks*/
									$a1_m_a2[$a1_m_start],
									$a1_m_a2_type[$a1_m_start], $a1_m_a2_category[$a1_m_start], $a1_m_a2_power[$a1_m_start], $a1_m_a2_accuracy[$a1_m_start], $a1_m_a2_goal[$a1_m_start], $a1_m_a2_chans_crita[$a1_m_start], 
									$a1_m_a2_critic_damag[$a1_m_start], $a1_m_a2_hp_stat[$a1_m_start], $a1_m_a2_a_stat[$a1_m_start], $a1_m_a2_d_stat[$a1_m_start], $a1_m_a2_s_stat[$a1_m_start], $a1_m_a2_sa_stat[$a1_m_start], 
									$a1_m_a2_sd_stat[$a1_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a2_m_c_hp[$a2_m_start] = $a1_atack_res[0];
									$a2_m_damage = $a1_atack_res[1];
									$a2_m_status = $a1_atack_res[2];
									$a2_m_effectivity = $a1_atack_res[3];
									$a2_m_c_a[$a2_m_start] = $a1_atack_res[4];
									$a2_m_c_d[$a2_m_start] = $a1_atack_res[5];
									$a2_m_c_s[$a2_m_start] = $a1_atack_res[6];
									$a2_m_c_sa[$a2_m_start] = $a1_atack_res[7];
									$a2_m_c_sd[$a2_m_start] = $a1_atack_res[8];
									$a2_a_count[$a2_m_start] = $a1_atack_res[9];
									$a2_d_count[$a2_m_start] = $a1_atack_res[10];
									$a2_s_count[$a2_m_start] = $a1_atack_res[11];
									$a2_sa_count[$a2_m_start] = $a1_atack_res[12];
									$a2_sd_count[$a2_m_start] = $a1_atack_res[13];
									
									$a1_m_c_a[$a1_m_start] = $a1_atack_res[14];
									$a1_m_c_d[$a1_m_start] = $a1_atack_res[15];
									$a1_m_c_s[$a1_m_start] = $a1_atack_res[16];
									$a1_m_c_sa[$a1_m_start] = $a1_atack_res[17];
									$a1_m_c_sd[$a1_m_start] = $a1_atack_res[18];
									$a1_a_count[$a1_m_start] = $a1_atack_res[19];
									$a1_d_count[$a1_m_start] = $a1_atack_res[20];
									$a1_s_count[$a1_m_start] = $a1_atack_res[21];
									$a1_sa_count[$a1_m_start] = $a1_atack_res[22];
									$a1_sd_count[$a1_m_start] = $a1_atack_res[23];
									
									//Aktualisieren PP
									$a1_m_a2_c_pp[$a1_m_start] = $a1_m_a2_c_pp[$a1_m_start] - 1;
									
									echo "Agent1: $a1_m_name[$a1_m_start] used (A2)$a1_m_a2[$a1_m_start]: -$a2_m_damage <br> Status: $a2_m_status. Effectivity: $a2_m_effectivity A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br> $a2_m_name[$a2_m_start]: C_HP: $a2_m_c_hp[$a2_m_start] A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br>";	
								}else if($a1_action == 2){	//atack3
									$a1_atack_res = action_atack('agent1', $a1_m_name[$a1_m_start], $a1_m_lvl[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start],
									$a2_m_name[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start], $a2_m_type1[$a2_m_start], 
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									/*atacks*/
									$a1_m_a3[$a1_m_start],
									$a1_m_a3_type[$a1_m_start], $a1_m_a3_category[$a1_m_start], $a1_m_a3_power[$a1_m_start], $a1_m_a3_accuracy[$a1_m_start], $a1_m_a3_goal[$a1_m_start], $a1_m_a3_chans_crita[$a1_m_start], 
									$a1_m_a3_critic_damag[$a1_m_start], $a1_m_a3_hp_stat[$a1_m_start], $a1_m_a3_a_stat[$a1_m_start], $a1_m_a3_d_stat[$a1_m_start], $a1_m_a3_s_stat[$a1_m_start], $a1_m_a3_sa_stat[$a1_m_start], 
									$a1_m_a3_sd_stat[$a1_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a2_m_c_hp[$a2_m_start] = $a1_atack_res[0];
									$a2_m_damage = $a1_atack_res[1];
									$a2_m_status = $a1_atack_res[2];
									$a2_m_effectivity = $a1_atack_res[3];
									$a2_m_c_a[$a2_m_start] = $a1_atack_res[4];
									$a2_m_c_d[$a2_m_start] = $a1_atack_res[5];
									$a2_m_c_s[$a2_m_start] = $a1_atack_res[6];
									$a2_m_c_sa[$a2_m_start] = $a1_atack_res[7];
									$a2_m_c_sd[$a2_m_start] = $a1_atack_res[8];
									$a2_a_count[$a2_m_start] = $a1_atack_res[9];
									$a2_d_count[$a2_m_start] = $a1_atack_res[10];
									$a2_s_count[$a2_m_start] = $a1_atack_res[11];
									$a2_sa_count[$a2_m_start] = $a1_atack_res[12];
									$a2_sd_count[$a2_m_start] = $a1_atack_res[13];
									
									$a1_m_c_a[$a1_m_start] = $a1_atack_res[14];
									$a1_m_c_d[$a1_m_start] = $a1_atack_res[15];
									$a1_m_c_s[$a1_m_start] = $a1_atack_res[16];
									$a1_m_c_sa[$a1_m_start] = $a1_atack_res[17];
									$a1_m_c_sd[$a1_m_start] = $a1_atack_res[18];
									$a1_a_count[$a1_m_start] = $a1_atack_res[19];
									$a1_d_count[$a1_m_start] = $a1_atack_res[20];
									$a1_s_count[$a1_m_start] = $a1_atack_res[21];
									$a1_sa_count[$a1_m_start] = $a1_atack_res[22];
									$a1_sd_count[$a1_m_start] = $a1_atack_res[23];
									
									//Aktualisieren PP
									$a1_m_a3_c_pp[$a1_m_start] = $a1_m_a3_c_pp[$a1_m_start] - 1;
									
									echo "Agent1: $a1_m_name[$a1_m_start] used (A3)$a1_m_a3[$a1_m_start]: -$a2_m_damage <br> Status: $a2_m_status. Effectivity: $a2_m_effectivity A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br> $a2_m_name[$a2_m_start]: C_HP: $a2_m_c_hp[$a2_m_start] A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br>";
								}else if($a1_action == 3){	//atack4
									$a1_atack_res = action_atack('agent1', $a1_m_name[$a1_m_start], $a1_m_lvl[$a1_m_start], $a1_m_c_hp[$a1_m_start], $a1_m_c_a[$a1_m_start], $a1_m_c_d[$a1_m_start], $a1_m_c_s[$a1_m_start], $a1_m_c_sa[$a1_m_start], $a1_m_c_sd[$a1_m_start],
									$a2_m_name[$a2_m_start], $a2_m_c_hp[$a2_m_start], $a2_m_c_a[$a2_m_start], $a2_m_c_d[$a2_m_start], $a2_m_c_s[$a2_m_start], $a2_m_c_sa[$a2_m_start], $a2_m_c_sd[$a2_m_start], $a2_m_type1[$a2_m_start], 
									$a2_hp_count[$a2_m_start], $a2_a_count[$a2_m_start], $a2_d_count[$a2_m_start], $a2_s_count[$a2_m_start], $a2_sa_count[$a2_m_start], $a2_sd_count[$a2_m_start],
									$a1_hp_count[$a1_m_start], $a1_a_count[$a1_m_start], $a1_d_count[$a1_m_start], $a1_s_count[$a1_m_start], $a1_sa_count[$a1_m_start], $a1_sd_count[$a1_m_start],
									/*atacks*/
									$a1_m_a4[$a1_m_start],
									$a1_m_a4_type[$a1_m_start], $a1_m_a4_category[$a1_m_start], $a1_m_a4_power[$a1_m_start], $a1_m_a4_accuracy[$a1_m_start], $a1_m_a4_goal[$a1_m_start], $a1_m_a4_chans_crita[$a1_m_start], 
									$a1_m_a4_critic_damag[$a1_m_start], $a1_m_a4_hp_stat[$a1_m_start], $a1_m_a4_a_stat[$a1_m_start], $a1_m_a4_d_stat[$a1_m_start], $a1_m_a4_s_stat[$a1_m_start], $a1_m_a4_sa_stat[$a1_m_start], 
									$a1_m_a4_sd_stat[$a1_m_start], /*arrays->*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity);
									
									//Aktualisieren data
									$a2_m_c_hp[$a2_m_start] = $a1_atack_res[0];
									$a2_m_damage = $a1_atack_res[1];
									$a2_m_status = $a1_atack_res[2];
									$a2_m_effectivity = $a1_atack_res[3];
									$a2_m_c_a[$a2_m_start] = $a1_atack_res[4];
									$a2_m_c_d[$a2_m_start] = $a1_atack_res[5];
									$a2_m_c_s[$a2_m_start] = $a1_atack_res[6];
									$a2_m_c_sa[$a2_m_start] = $a1_atack_res[7];
									$a2_m_c_sd[$a2_m_start] = $a1_atack_res[8];
									$a2_a_count[$a2_m_start] = $a1_atack_res[9];
									$a2_d_count[$a2_m_start] = $a1_atack_res[10];
									$a2_s_count[$a2_m_start] = $a1_atack_res[11];
									$a2_sa_count[$a2_m_start] = $a1_atack_res[12];
									$a2_sd_count[$a2_m_start] = $a1_atack_res[13];
									
									$a1_m_c_a[$a1_m_start] = $a1_atack_res[14];
									$a1_m_c_d[$a1_m_start] = $a1_atack_res[15];
									$a1_m_c_s[$a1_m_start] = $a1_atack_res[16];
									$a1_m_c_sa[$a1_m_start] = $a1_atack_res[17];
									$a1_m_c_sd[$a1_m_start] = $a1_atack_res[18];
									$a1_a_count[$a1_m_start] = $a1_atack_res[19];
									$a1_d_count[$a1_m_start] = $a1_atack_res[20];
									$a1_s_count[$a1_m_start] = $a1_atack_res[21];
									$a1_sa_count[$a1_m_start] = $a1_atack_res[22];
									$a1_sd_count[$a1_m_start] = $a1_atack_res[23];
									
									//Aktualisieren PP
									$a1_m_a4_c_pp[$a1_m_start] = $a1_m_a4_c_pp[$a1_m_start] - 1;
									
									echo "Agent1: $a1_m_name[$a1_m_start] used (A4)$a1_m_a4[$a1_m_start]: -$a2_m_damage <br> Status: $a2_m_status. Effectivity: $a2_m_effectivity A: $a1_a_count[$a1_m_start]; D: $a1_d_count[$a1_m_start]; S: $a1_s_count[$a1_m_start]; Sa: $a1_sa_count[$a1_m_start]; Sd: $a1_sd_count[$a1_m_start];<br> $a2_m_name[$a2_m_start]: C_HP: $a2_m_c_hp[$a2_m_start] A: $a2_a_count[$a2_m_start]; D: $a2_d_count[$a2_m_start]; S: $a2_s_count[$a2_m_start]; Sa: $a2_sa_count[$a2_m_start]; Sd: $a2_sd_count[$a2_m_start];<br>";
								}
							}
						}
						//pp check
						$a1_sum_c_pp = $a1_m_a1_c_pp[$a1_m_start] + $a1_m_a2_c_pp[$a1_m_start] + $a1_m_a3_c_pp[$a1_m_start] + $a1_m_a4_c_pp[$a1_m_start];
						$a2_sum_c_pp = $a2_m_a1_c_pp[$a2_m_start] + $a2_m_a2_c_pp[$a2_m_start] + $a2_m_a3_c_pp[$a2_m_start] + $a2_m_a4_c_pp[$a2_m_start];
						if($a1_sum_c_pp == 0){
							$a1_m_c_hp[$a1_m_start] = 0;
							echo "Agent1: All PP=0<br>";
						}
						if($a2_sum_c_pp == 0){
							$a2_m_c_hp[$a2_m_start] = 0;
							echo "Agent2: All PP=0<br>";
						}
						
						//change monster in the same round if dead
						$a1_cards_available_to_change = array();
						for($j=0; $j<$a1_anz_aktiv_monster; $j++){
							if(($a1_m_c_hp[$j] != 0) && ($a1_m_start != $j)){
								$a1_cards_available_to_change[] = $j;
							}
						}
						$a1_anz_cards_available_to_change = count($a1_cards_available_to_change);
						if(($a1_m_c_hp[$a1_m_start] == 0) && ($a1_anz_cards_available_to_change != 0)){
							$a1_change_decision = rand(0, $a1_anz_cards_available_to_change - 1);
							$a1_m_start = $a1_cards_available_to_change[$a1_change_decision];
							echo "Agent1: Choose: $a1_m_name[$a1_m_start]<br>";
						}
						$a2_cards_available_to_change = array();
						for($j=0; $j<$a2_anz_aktiv_monster; $j++){
							if(($a2_m_c_hp[$j] != 0) && ($a2_m_start != $j)){
								$a2_cards_available_to_change[] = $j;
							}
						}
						$a2_anz_cards_available_to_change = count($a2_cards_available_to_change);
						if(($a2_m_c_hp[$a2_m_start] == 0) && ($a2_anz_cards_available_to_change != 0)){
							$a2_change_decision = rand(0, $a2_anz_cards_available_to_change - 1);
							$a2_m_start = $a2_cards_available_to_change[$a2_change_decision];
							echo "Agent2: choose: $a2_m_name[$a2_m_start]<br>";
						}

						//check c_hp
						$a1_sum_c_hp = $a1_m_c_hp[$a1_m_start] + $a1_m_c_hp[1] + $a1_m_c_hp[2] + $a1_m_c_hp[3] + $a1_m_c_hp[4] + $a1_m_c_hp[5];
						$a2_sum_c_hp = $a2_m_c_hp[$a2_m_start] + $a2_m_c_hp[1] + $a2_m_c_hp[2] + $a2_m_c_hp[3] + $a2_m_c_hp[4] + $a2_m_c_hp[5];
						$rf_round++;
						if($a1_sum_c_hp == 0){break;}
						if($a2_sum_c_hp == 0){break;}
						/*******************************************while ends*************************************************************/
					}
					
					//table
					echo "<br><table style='width:100%'>";
						echo "<tr>";
							echo "<th>Agent1</th>";
							echo "<th>HP</th>";
							echo "<th>Agent2</th>";
							echo "<th>HP</th>";
						echo "</tr>";
						for($t=0; $t<6; $t++){
							echo "<tr>";
								echo "<td>$a1_m_name[$t]</td>";
								echo "<td>$a1_m_c_hp[$t]</td>";
								echo "<td>$a2_m_name[$t]</td>";
								echo "<td>$a2_m_c_hp[$t]</td>";
						echo "</tr>";
						}
					echo "</table><br>";
					//result
					if($a1_sum_c_hp == 0){
						echo "<br><strong>Agent2 Wins!</strong><br>";
						$rf_points2 = $rf_points2 + 1;
					} else if($a2_sum_c_hp == 0){
						echo "<br><strong>Agent1 Wins!</strong><br>";
						$rf_points1 = $rf_points1 + 1;
					}
					//score 
					mysql_query ("UPDATE score SET Datetime='$rf_datetime', Match_Played='$play', Points1='$rf_points1', Points2='$rf_points2' WHERE Agent1='Random' AND Agent2='Random'");
					//$current_match = $i + 1;
					//$sql_insert = "INSERT INTO score VALUES ('', '$rf_datetime', 'Random', 'Random', '$current_match', '$rf_points1', '$rf_points2');";
					//$result_insert = mysql_query($sql_insert) or die(mysql_error());
					//set back values for new play
					for($b=0; $b<$a1_anz_aktiv_monster; $b++){
						//Agent1
						$a1_m_c_hp[$b] = $a1_m_hp_stat[$b];
						$a1_m_c_a[$b] = $a1_m_a_stat[$b];
						$a1_m_c_d[$b] = $a1_m_d_stat[$b];
						$a1_m_c_s[$b] = $a1_m_s_stat[$b];
						$a1_m_c_sa[$b] = $a1_m_sa_stat[$b];
						$a1_m_c_sd[$b] = $a1_m_sd_stat[$b];
						$a1_m_a1_c_pp[$b] = $a1_m_a1_pp[$b];
						$a1_m_a2_c_pp[$b] = $a1_m_a2_pp[$b];
						$a1_m_a3_c_pp[$b] = $a1_m_a3_pp[$b];
						$a1_m_a4_c_pp[$b] = $a1_m_a4_pp[$b];
						$a1_a_count[$b] = 0;
						$a1_d_count[$b] = 0;
						$a1_s_count[$b] = 0;
						$a1_sa_count[$b] = 0;
						$a1_sd_count[$b] = 0;
						//Agent2
						$a2_m_c_hp[$b] = $a2_m_hp_stat[$b];
						$a2_m_c_a[$b] = $a2_m_a_stat[$b];
						$a2_m_c_d[$b] = $a2_m_d_stat[$b];
						$a2_m_c_s[$b] = $a2_m_s_stat[$b];
						$a2_m_c_sa[$b] = $a2_m_sa_stat[$b];
						$a2_m_c_sd[$b] = $a2_m_sd_stat[$b];
						$a2_m_a1_c_pp[$b] = $a2_m_a1_pp[$b];
						$a2_m_a2_c_pp[$b] = $a2_m_a2_pp[$b];
						$a2_m_a3_c_pp[$b] = $a2_m_a3_pp[$b];
						$a2_m_a4_c_pp[$b] = $a2_m_a4_pp[$b];
						$a2_a_count[$b] = 0;
						$a2_d_count[$b] = 0;
						$a2_s_count[$b] = 0;
						$a2_sa_count[$b] = 0;
						$a2_sd_count[$b] = 0;
					}
				}
				//show score
				$query = "SELECT Match_Played, Points1, Points2 FROM score WHERE Agent1='Random' AND Agent2='Random'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					//Agent1
					$match_played[] = $aRow["Match_Played"];
					$a1_points1[] = $aRow["Points1"];
					$a2_points2[] = $aRow["Points2"];
				}
				echo "<br><p style='font-weight: cursor;'>In $match_played[0] matches<br> Agent1 score $a1_points1[0] points<br> Agent2 score $a2_points2[0] points</p>";
				mysql_free_result($result);
			echo "</div>";
		?>
	</div>
</div>
<?php
	function action_atack($agent, $a1_m_name, $a1_m_lvl, $a1_m_c_hp, $a1_m_c_a, $a1_m_c_d, $a1_m_c_s, $a1_m_c_sa, $a1_m_c_sd,
						$a2_m_name, $a2_m_c_hp, $a2_m_c_a, $a2_m_c_d, $a2_m_c_s, $a2_m_c_sa, $a2_m_c_sd, $a2_m_type1,
						$a2_m_a_hp_count, $a2_m_a_a_count, $a2_m_a_d_count, $a2_m_a_s_count, $a2_m_a_sa_count, $a2_m_a_sd_count,
						$a1_m_a_hp_count, $a1_m_a_a_count, $a1_m_a_d_count, $a1_m_a_s_count, $a1_m_a_sa_count, $a1_m_a_sd_count,
						/*atacks*/
						$a_m_a_name,
						$a_m_a_type, $a_m_a_category, $a_m_a_power, $a_m_a_accuracy, $a_m_a_goal, $a_m_a_chans_crita, 
						$a_m_a_critic_damag, $a_m_a_hp_stat, $a_m_a_a_stat, $a_m_a_d_stat, $a_m_a_s_stat, $a_m_a_sa_stat, 
						$a_m_a_sd_stat, /*arrays*/ $rf_te_type1, $rf_te_type2, $rf_te_effectivity){
		//check accuracy 
		$a_m_a_accuracy_random = rand(1, 100);
		$a_m_a_critical_random = rand(1, 100);
		
		//check critical 
		if($a_m_a_critical_random <= $a_m_a_chans_crita){
			$a_m_a_critical = $a_m_a_critic_damag;
			$a_m_a_status_protokol = 'critical';
		} else {
			$a_m_a_critical = 1;
			$a_m_a_status_protokol = 'no critical';
		}
		
		//check type effectivity 
		for($i=0; $i<count($rf_te_type1); $i++){
			if(($a_m_a_type == $rf_te_type1[$i]) && ($a2_m_type1 == $rf_te_type2[$i])){
				$a_m_a_type = $rf_te_effectivity[$i];
			}
		}
		if($a_m_a_type == 0.5){
			$a_m_a_effectivity_protokol = 'not effective';
		} else if($a_m_a_type == 1){
			$a_m_a_effectivity_protokol = 'normal';
		} else if($a_m_a_type == 2){
			$a_m_a_effectivity_protokol = 'effective';
		}else if($a_m_a_type == 0){
			$a_m_a_effectivity_protokol = 'no effect';
		}
		
		//check random
		$a_m_a_random = rand(85, 100);
		$a_m_a_random = (float)($a_m_a_random / 100);
		
		if($a_m_a_accuracy_random <= $a_m_a_accuracy){
			if($a_m_a_goal == 1){	//damage Enemy
				if($a_m_a_category == 1){ 		//physic damage
					//Damage=(((2*lvl+10)/250)*(Attack/Defense)*Base + 2)*STAB*Type*Critical*Other*(rand(0.85,1))
					$a2_m_c_hp_res = (int)($a2_m_c_hp - (((2 * $a1_m_lvl + 10) / 250) * ($a1_m_c_a / $a2_m_c_d) * $a_m_a_power + 2) * $a_m_a_type * $a_m_a_critical * $a_m_a_random);
					$a2_m_c_damage_res = $a2_m_c_hp - $a2_m_c_hp_res;
				} else if($a_m_a_category == 2){ //special damage
					//Damage=(((2*lvl+10)/250)*(Attack/Defense)*Base + 2)*STAB*Type*Critical*Other*(rand(0.85,1))
					$a2_m_c_hp_res = (int)($a2_m_c_hp - (((2 * $a1_m_lvl + 10) / 250) * ($a1_m_c_sa / $a2_m_c_sd) * $a_m_a_power + 2) * $a_m_a_type * $a_m_a_critical * $a_m_a_random);
					$a2_m_c_damage_res = $a2_m_c_hp - $a2_m_c_hp_res;
				}
				if($a2_m_c_hp_res < 0){
					$a2_m_c_hp_res = 0;
				}
				//check stats
				//A
				if(($a_m_a_a_stat != 0) && ($a2_m_a_a_count < 3) && ($a2_m_a_a_count > -3)){
					$a2_m_a_c_a_res = $a2_m_c_a / $a_m_a_a_stat;
					$a2_m_a_a_count = $a2_m_a_a_count - 1;
				} else {
					$a2_m_a_c_a_res = $a2_m_c_a;
				}
				//D
				if(($a_m_a_d_stat != 0) && ($a2_m_a_d_count < 3) && ($a2_m_a_d_count > -3)){
					$a2_m_a_c_d_res = $a2_m_c_d / $a_m_a_d_stat;
					$a2_m_a_d_count = $a2_m_a_d_count - 1;
				} else {
					$a2_m_a_c_d_res = $a2_m_c_d;
				}
				//S
				if(($a_m_a_s_stat != 0) && ($a2_m_a_s_count < 3) && ($a2_m_a_s_count > -3)){
					$a2_m_a_c_s_res = $a2_m_c_s / $a_m_a_s_stat;
					$a2_m_a_s_count = $a2_m_a_s_count - 1;
				} else {
					$a2_m_a_c_s_res = $a2_m_c_s;
				}
				//Sa
				if(($a_m_a_sa_stat != 0) && ($a2_m_a_sa_count < 3) && ($a2_m_a_sa_count > -3)){
					$a2_m_a_c_sa_res = $a2_m_c_sa / $a_m_a_sa_stat;
					$a2_m_a_sa_count = $a2_m_a_sa_count - 1;
				} else {
					$a2_m_a_c_sa_res = $a2_m_c_sa;
				}
				//Sd
				if(($a_m_a_sd_stat != 0) && ($a2_m_a_sd_count < 3) && ($a2_m_a_sd_count > -3)){
					$a2_m_a_c_sd_res = $a2_m_c_sd / $a_m_a_sd_stat;
					$a2_m_a_sd_count = $a2_m_a_sd_count - 1;
				} else {
					$a2_m_a_c_sd_res = $a2_m_c_sd;
				}
				$a1_m_a_c_a_res = $a1_m_c_a;
				$a1_m_a_c_d_res = $a1_m_c_d;
				$a1_m_a_c_s_res = $a1_m_c_s;
				$a1_m_a_c_sa_res = $a1_m_c_sa;
				$a1_m_a_c_sd_res = $a1_m_c_sd;
				
			} else if($a_m_a_goal == 2){
				$a2_m_c_hp_res = $a2_m_c_hp;		
				$a2_m_c_damage_res = 0;
				//A
				if(($a_m_a_a_stat != 0) && ($a1_m_a_a_count < 3) && ($a1_m_a_a_count > -3)){
					$a1_m_a_c_a_res = $a1_m_c_a * $a_m_a_a_stat;
					$a1_m_a_a_count = $a1_m_a_a_count + 1;
				} else {
					$a1_m_a_c_a_res = $a1_m_c_a;
				}
				//D
				if(($a_m_a_d_stat != 0) && ($a1_m_a_d_count < 3) && ($a1_m_a_d_count > -3)){
					$a1_m_a_c_d_res = $a1_m_c_d * $a_m_a_d_stat;
					$a1_m_a_d_count = $a1_m_a_d_count + 1;
				} else {
					$a1_m_a_c_d_res = $a1_m_c_d;
				}
				//S
				if(($a_m_a_s_stat != 0) && ($a1_m_a_s_count < 3) && ($a1_m_a_s_count > -3)){
					$a1_m_a_c_s_res = $a1_m_c_s * $a_m_a_s_stat;
					$a1_m_a_s_count = $a1_m_a_s_count + 1; 
				} else {
					$a1_m_a_c_s_res = $a1_m_c_s;
				}
				//Sa
				if(($a_m_a_sa_stat != 0) && ($a1_m_a_sa_count < 3) && ($a1_m_a_sa_count > -3)){
					$a1_m_a_c_sa_res = $a1_m_c_sa * $a_m_a_sa_stat;
					$a1_m_a_sa_count = $a1_m_a_sa_count + 1; 
				} else {
					$a1_m_a_c_sa_res = $a1_m_c_sa;
				}
				//Sd
				if(($a_m_a_sd_stat != 0) && ($a1_m_a_sd_count < 3) && ($a1_m_a_sd_count > -3)){
					$a1_m_a_c_sd_res = $a1_m_c_sd * $a_m_a_sd_stat;
					$a1_m_a_sd_count = $a1_m_a_sd_count + 1;  
				} else {
					$a1_m_a_c_sd_res = $a1_m_c_sd;
				}
				$a2_m_a_c_a_res = $a2_m_c_a;
				$a2_m_a_c_d_res = $a2_m_c_d;
				$a2_m_a_c_s_res = $a2_m_c_s;
				$a2_m_a_c_sa_res = $a2_m_c_sa;
				$a2_m_a_c_sd_res = $a2_m_c_sd;
			}
		} else {
			//miss
			$a_m_a_status_protokol = 'missed';
			//give values
			$a2_m_c_hp_res = $a2_m_c_hp;		
			$a2_m_c_damage_res = 0;
			
			$a1_m_a_c_a_res = $a1_m_c_a;
			$a1_m_a_c_d_res = $a1_m_c_d;
			$a1_m_a_c_s_res = $a1_m_c_s;
			$a1_m_a_c_sa_res = $a1_m_c_sa;
			$a1_m_a_c_sd_res = $a1_m_c_sd;
			
			$a2_m_c_hp_res = $a2_m_c_hp;
			$a2_m_a_c_a_res = $a2_m_c_a;
			$a2_m_a_c_d_res = $a2_m_c_d;
			$a2_m_a_c_s_res = $a2_m_c_s;
			$a2_m_a_c_sa_res = $a2_m_c_sa;
			$a2_m_a_c_sd_res = $a2_m_c_sd;
		}

		//Protokol
		/*$query = "SELECT Round FROM a1_a2_protokol WHERE User='$agent' ORDER BY Round DESC";	
		$result = mysql_query($query) or die("Query failed : " . mysql_error());
		while ($aRow = mysql_fetch_array($result)) {
			$a_m_a_round[] = $aRow["Round"];
		}
		if (mysql_num_rows($result)==0){	//check if result empty
			$a_m_a_anz_round = 1;
			$sql_insert = "INSERT INTO a1_a2_protokol VALUES ('', '$a_m_a_anz_round', '$agent', '$a1_m_name', '$a2_m_name', '$a_m_a_name', '$a2_m_c_damage_res', '$a_m_a_status_protokol', '$a_m_a_effectivity_protokol', 0, $a1_m_a_a_count, $a1_m_a_d_count, $a1_m_a_s_count, $a1_m_a_sa_count, $a1_m_a_sd_count);";
			$result_insert = mysql_query($sql_insert) or die(mysql_error());
		} else {
			$a_m_a_anz_round = $a_m_a_round[0] + 1;
			$sql_insert = "INSERT INTO a1_a2_protokol VALUES ('', '$a_m_a_anz_round', '$agent', '$a1_m_name', '$a2_m_name', '$a_m_a_name', '$a2_m_c_damage_res', '$a_m_a_status_protokol', '$a_m_a_effectivity_protokol', 0, $a1_m_a_a_count, $a1_m_a_d_count, $a1_m_a_s_count, $a1_m_a_sa_count, $a1_m_a_sd_count);";
			$result_insert = mysql_query($sql_insert) or die(mysql_error());
		}*/
		
		//Pack data in array
		//array(a2_C_HP, a2_A_stat, a2_D_stat, a2_S_stat, a2_SA_stat, a2_SD_stat, a2_A_count, a2_D_count, a2_S_count, a2_SA_count, a2_SD_count,
		//				 a1_A_stat, a1_D_stat, a1_S_stat, a1_SA_stat, a1_SD_stat, a1_A_count, a1_D_count, a1_S_count, a1_SA_count, a1_SD_count);
		
		return array($a2_m_c_hp_res, $a2_m_c_damage_res, $a_m_a_status_protokol, $a_m_a_effectivity_protokol, $a2_m_a_c_a_res, $a2_m_a_c_d_res, $a2_m_a_c_s_res, $a2_m_a_c_sa_res, $a2_m_a_c_sd_res, $a2_m_a_a_count, $a2_m_a_d_count, $a2_m_a_s_count, $a2_m_a_sa_count, $a2_m_a_sd_count, $a1_m_a_c_a_res, $a1_m_a_c_d_res, $a1_m_a_c_s_res, $a1_m_a_c_sa_res, $a1_m_a_c_sd_res, $a1_m_a_a_count, $a1_m_a_d_count, $a1_m_a_s_count, $a1_m_a_sa_count, $a1_m_a_sd_count);
	}
?>