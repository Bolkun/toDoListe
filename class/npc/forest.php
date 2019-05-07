<style>
	#forestAktive {
		
	}
	#forestDeaktive {
		width: 250px;
		position: absolute;
		float: right;
		top: 0px;
		right: 0px;
	}
	.f_image {
		width: 150px;
	}
	progress.f_current_hp {
		margin-top: -20px;
	}
	progress.f_current_exp {
		margin-top: -4px;
	}
	progress.f_current_hp:after { 
		content: attr(value);
	}
	progress.f_current_exp:after { 
	   content: attr(value);
	}
	#battleField {
		background-color: rgb(56 58 59);
		width: 33.33%;
		float: left;
	}
	#battleProtokol {
		background-color: rgb(218 218 218);
		border-radius: 3px;
		width: 33.33%;
		float: left;
		height: 80%;
		overflow-y: auto;
		text-align: left;
	}
	#battleProtokol img {
	   width: 100%;
	   height: 100%;
	}
	#randomMonster {
		background-color: rgb(56 58 59);
		width: 33.33%;
		float: left;
	}
	#forest_start {	
		border-radius: 3px; 
		font-weight: bold; 
		background-color: rgb(92, 184, 92);
		color: rgb(51 51 51) !important;
		width: 100%;
	}
	.f_image {
		height: 150px;
		width: 150px;
	}
	.b_f_atack {
		padding: 0;
		width: 90px;
		line-height: 1.1;
	}
	.f_atack_type {
		width: 38px;
		height: 38px;
	}
	.change_f_m {
		color: green;
		border: 1px solid green;
		width: 110px;
		padding-bottom: -4px;
	}
	
	#forest_monster p {
		border-radius: 3px;
		font-weight: bold;
		color: rgb(51 51 51) !important;
		background-color: rgb(92, 184, 92);
		width: 100%;
	}

</style>
<div id='forest'>
	<div style='text-align: right;'>
		<button style='margin-right: 100px; margin-top: 5px;' class="btn btn-info b_location" id="forestAktive" type="button" onclick="forest_mode_aktivate()">Forest</button>
	</div>
	<div id='show_forest' style='display: none;'>
		<div id="forest_main">
			<button class="btn btn-info" id="forestDeaktive" type="button" onclick="forest_mode_deaktivate()">Forest Out</button>
			<?php
				$query = "SELECT m.M_ID, m.M_Name, m.M_Image, m.Lvl, m.Hp, m.A, m.D, m.S, m.Sa, m.Sd, m.C_Hp, m.C_A, m.C_D, m.C_S, m.C_Sa, m.C_Sd, m.Exp, m.Exp_Up, m.A1, m.A2, m.A3, m.A4, m.A1_Pp, m.A2_Pp, m.A3_Pp, m.A4_Pp, m.Start, m.Hp_Count, m.A_Count, m.D_Count, m.S_Count, m.Sa_Count, m.Sd_Count, ml.M_ID_L, ml.Type1, ml.Type2, ml.Exp_Group
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
					$f_exp_up[] = $aRow["Exp_Up"];
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
				if (mysql_num_rows($result)==0){	//check if result empty
					$f_anz_aktiv_monster = 0;
				} else {
					$f_anz_aktiv_monster = count($f_m_name);
				}
				mysql_free_result($result);
				//check if wild monster for user exists
				$query = "SELECT wm.M_ID, wm.M_Name, wm.Lvl, wm.Hp AS wmHp, wm.A, wm.D, wm.S, wm.Sa, wm.Sd, wm.C_Hp, wm.C_A, wm.C_D, wm.C_S, wm.C_Sa, wm.C_Sd, wm.Hp_Count, wm.A_Count, wm.D_Count, wm.S_Count, wm.Sa_Count, wm.Sd_Count, wm.A1, wm.A2, wm.A3, wm.A4, ml.M_ID_L, ml.ML_Image, ml.Hp AS mlHp, ml.Atk, ml.Def, ml.Spd, ml.Sp_A, ml.Sp_D
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
					$w_ml_hp[] = $aRow["mlHp"];
					$w_ml_atk[] = $aRow["Atk"];
					$w_ml_def[] = $aRow["Def"];
					$w_ml_spd[] = $aRow["Spd"];
					$w_ml_sp_a[] = $aRow["Sp_A"];
					$w_ml_sp_d[] = $aRow["Sp_D"];
				}
				if (mysql_num_rows($result)==0){	//check if result empty
					$w_anz_monster = 0;
					$w_m_c_hp[0]=0;
				} else {
					$w_anz_monster = count($w_m_name);
					if($w_m_c_hp[0] <= 0){
						mysql_query("DELETE FROM wild_monsters WHERE M_ID='$w_m_id[0]'");
						$w_anz_monster = 0;
					}
					//fill curent stats
					if($w_m_c_a[0] <= 0){	//if 1 value 0 
						mysql_query ("UPDATE wild_monsters SET C_A='$w_m_a_stat[0]', C_D='$w_m_d_stat[0]', C_S='$w_m_s_stat[0]', C_Sa='$w_m_sa_stat[0]', C_Sd='$w_m_sd_stat[0]' WHERE For_User='$aNickName'");
					}
				}
				mysql_free_result($result);
				if($f_anz_aktiv_monster == 0){
					echo "You have no active monsters! Go to doctorA and activate some.";
				} else {
					for($i=0; $i<$f_anz_aktiv_monster; $i++){
						//find start
						if($f_start[$i]==1){
							$f_start_position = $i;
						}
					}
					echo "<div id='battleField' style=''>";
						echo "<table id='fUserMonster' style='margin: 0 auto; background-color: rgb(56 58 59);'>";
							echo "<tr>";
								echo "<td>";
									echo "<div id='fMonster0' style='text-align: center; margin: 0 auto;'>";
											echo "<div id='forest_start'><p style='color: rgb(51 51 51);'>#$f_ml_id[$f_start_position] $f_m_name[$f_start_position] $f_m_lvl[$f_start_position]-lvl</p></div>";
											echo "<img class='f_image' src='img_monsters/$f_m_image[$f_start_position]'>";
											//echo "<p><progress class='f_current_hp' style='width: 150px;' value='$f_m_c_hp[$f_start_position]' max='$f_m_hp_stat[$f_start_position]'></progress><br>";	
											//echo "<progress class='f_current_exp' style='width: 150px;' value='$f_m_exp[$f_start_position]' max='$f_exp_up[$f_start_position]'></progress></p>";
											$f_progress_hp0 = ($f_m_c_hp[$f_start_position] * 100) / $f_m_hp_stat[$f_start_position];
											$f_progress_exp0 = ($f_m_exp[$f_start_position] * 100) / $f_exp_up[$f_start_position];
											?>
											<div class="progress">
											  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo "$f_m_c_hp[$f_start_position]"; ?>"
											  aria-valuemin="0" aria-valuemax="<?php echo "$f_m_hp_stat[$f_start_position]"; ?>" style="width:<?php echo "$f_progress_hp0";  ?>%">
												<?php echo "$f_m_c_hp[$f_start_position]"; ?> 
											  </div>
											</div>
											<div class="progress" style="margin-top: -18px";>
											  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo "$f_m_exp[$f_start_position]"; ?>"
											  aria-valuemin="0" aria-valuemax="<?php echo "$f_exp_up[$f_start_position]"; ?>" style="width:<?php if($f_m_lvl[$f_start_position]<100){echo "$f_progress_exp0";}else{echo"1000";} ?>%">
												<?php echo "$f_m_exp[$f_start_position]"; ?> 
											  </div>
											</div>
											<?php
											//stats up
											echo "<div style='color: white; position: absolute; margin: -220px 230px;'>";
												if($f_hp_count[$f_start_position] != 0){
													echo "HP: $f_hp_count[$f_start_position]<br>";
												}
												if($f_a_count[$f_start_position] != 0){
													echo "A: $f_a_count[$f_start_position]<br>";
												}
												if($f_d_count[$f_start_position] != 0){
													echo "D: $f_d_count[$f_start_position]<br>";
												}
												if($f_s_count[$f_start_position] != 0){
													echo "S: $f_s_count[$f_start_position]<br>";
												}
												if($f_sa_count[$f_start_position] != 0){
													echo "Sa: $f_sa_count[$f_start_position]<br>";
												}
												if($f_sd_count[$f_start_position] != 0){
													echo "Sd: $f_sd_count[$f_start_position]<br>";
												}
											echo "</div>";
											echo "<p style='color: green;'><strong>$aNickName</strong></p>";
											$query = "SELECT COUNT(*) AS MONSTER_ALIVE FROM monsters WHERE M_Owner='$aNickName' AND C_HP>0 AND Aktiv='1'";
											$result = mysql_query($query) or die("Query failed : " . mysql_error());
											$aRow = mysql_fetch_array($result);
											$monster_alive = $aRow['MONSTER_ALIVE'];
											mysql_free_result($result);
											
											for ($i=0; $i<$slots; $i++){
												if($monster_alive > 0){
													echo "<img class='slot' src='img/slot.png'>";
													$monster_alive--;
												} else {
													echo "<img class='slot' src='img/slot2.png'>";
												}
											}
											echo "<div id='f_mon_atacks' style='margin-top: -3px;'>";
												/************************************Attacks**************************************************************/
												$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$f_m_a1[$f_start_position]'";	
												$result = mysql_query($query) or die("Query failed : " . mysql_error());
												while ($aRow = mysql_fetch_array($result)) {
													$f_m_a1_pp1[] = $aRow["Pp"];
													$f_m_a1_type1[] = $aRow["Type"];
													$f_m_a1_category[] = $aRow["Category"];
												}
												mysql_free_result($result);
												$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$f_m_a2[$f_start_position]'";	
												$result = mysql_query($query) or die("Query failed : " . mysql_error());
												while ($aRow = mysql_fetch_array($result)) {
													$f_m_a2_pp2[] = $aRow["Pp"];
													$f_m_a2_type2[] = $aRow["Type"];
													$f_m_a2_category[] = $aRow["Category"];
												}
												mysql_free_result($result);
												$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$f_m_a3[$f_start_position]'";	
												$result = mysql_query($query) or die("Query failed : " . mysql_error());
												while ($aRow = mysql_fetch_array($result)) {
													$f_m_a3_pp3[] = $aRow["Pp"];
													$f_m_a3_type3[] = $aRow["Type"];
													$f_m_a3_category[] = $aRow["Category"];
												}
												mysql_free_result($result);
												$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$f_m_a4[$f_start_position]'";	
												$result = mysql_query($query) or die("Query failed : " . mysql_error());
												while ($aRow = mysql_fetch_array($result)) {
													$f_m_a4_pp4[] = $aRow["Pp"];
													$f_m_a4_type4[] = $aRow["Type"];
													$f_m_a4_category[] = $aRow["Category"];
												}
												mysql_free_result($result);
												if($f_m_c_hp[$f_start_position] != 0){
													echo "<table id='f_atack_list' style='margin-top: 15px;'>";
														echo "<tr>";
															echo "<td><img class='f_atack_type' src='img_type/$f_m_a1_type1[0].png'></td>";	
															$ar_mon_atack1 = array($f_m_a1[$f_start_position], 'A1', 'A1_Pp');
															$jsvar_mon_atack1 = json_encode($ar_mon_atack1);
															?>
															<td><button class="btn btn-info b_f_atack" onclick='ajax_mon_atack(<?php echo "$jsvar_mon_atack1"; ?>)' <?php if($f_m_a1_pp[$f_start_position] == 0 || $w_m_c_hp[0] <= 0) {echo "disabled";} ?>><div <?php if($f_m_a1_category[0] == 1) echo "style='color: rgb(255 83 83);'"; if($f_m_a1_category[0] == 2) echo"style='color: rgb(91 192 222);'";?> > <?php echo "$f_m_a1[$f_start_position]"; ?></div><?php echo "<span style='color: white;'>$f_m_a1_pp1[0]/$f_m_a1_pp[$f_start_position]</span>";?></button></td>
															<?php
															echo "<td style='padding-left: 15px;'><img class='f_atack_type' src='img_type/$f_m_a2_type2[0].png'></td>";	
															$ar_mon_atack2 = array($f_m_a2[$f_start_position], 'A2', 'A2_Pp');
															$jsvar_mon_atack2 = json_encode($ar_mon_atack2);
															?>
															<td><button class="btn btn-info b_f_atack" onclick='ajax_mon_atack(<?php echo "$jsvar_mon_atack2"; ?>)' <?php if($f_m_a2_pp[$f_start_position] == 0 || $w_m_c_hp[0] <= 0) {echo "disabled"; } ?>><div <?php if($f_m_a2_category[0] == 1) echo "style='color: rgb(255 83 83);'"; if($f_m_a2_category[0] == 2) echo"style='color: rgb(91 192 222);'";?> > <?php echo "$f_m_a2[$f_start_position]"; ?></div><?php echo "<span style='color: white;'>$f_m_a2_pp2[0]/$f_m_a2_pp[$f_start_position]</span>";?></button></td>
															<?php
														echo "</tr>";
														echo "<tr>";
															echo "<td><img class='f_atack_type' src='img_type/$f_m_a3_type3[0].png'></td>";	
															$ar_mon_atack3 = array($f_m_a3[$f_start_position], 'A3', 'A3_Pp');
															$jsvar_mon_atack3 = json_encode($ar_mon_atack3);
															?>
															<td><button class="btn btn-info b_f_atack" onclick='ajax_mon_atack(<?php echo "$jsvar_mon_atack3"; ?>)' <?php if($f_m_a3_pp[$f_start_position] == 0 || $w_m_c_hp[0] <= 0) {echo "disabled"; } ?>><div <?php if($f_m_a3_category[0] == 1) echo "style='color: rgb(255 83 83);'"; if($f_m_a3_category[0] == 2) echo"style='color: rgb(91 192 222);'";?> > <?php echo "$f_m_a3[$f_start_position]"; ?></div><?php echo "<span style='color: white;'>$f_m_a3_pp3[0]/$f_m_a3_pp[$f_start_position]</span>";?></button></td>
															<?php
															echo "<td style='padding-left: 15px;'><img class='f_atack_type' src='img_type/$f_m_a4_type4[0].png'></td>";	
															$ar_mon_atack4 = array($f_m_a4[$f_start_position], 'A4', 'A4_Pp');
															$jsvar_mon_atack4 = json_encode($ar_mon_atack4);
															?>
															<td><button class="btn btn-info b_f_atack" onclick='ajax_mon_atack(<?php echo "$jsvar_mon_atack4"; ?>)' <?php if($f_m_a4_pp[$f_start_position] == 0 || $w_m_c_hp[0] <= 0) {echo "disabled";} ?>><div <?php if($f_m_a4_category[0] == 1) echo "style='color: rgb(255 83 83);'"; if($f_m_a4_category[0] == 2) echo"style='color: rgb(91 192 222);'";?> > <?php echo "$f_m_a4[$f_start_position]"; ?></div><?php echo "<span style='color: white;'>$f_m_a4_pp4[0]/$f_m_a4_pp[$f_start_position]</span>";?></button></td>
															<?php
														echo "</tr>";
													echo "</table>";
												}
											echo "</div>";
											
											//check if you can change monster
											for($a=0; $a<$f_anz_aktiv_monster; $a++){
												if($f_start[$a]!=1 && $f_m_c_hp[$a]>0){
													$f_counter = 1;
													break;
												} else {
													$f_counter = 0;
												}
											}
											if($w_m_c_hp[0] != 0 /*&& $f_counter == 1*/){
												//change monster
												echo "<div id='change_f_monster_forma' style='margin-top: 6px;'>";
													echo "<form method='POST' id='change_f_monster' action='javascript:void(null);' onsubmit='ajax_change_f_monster()'>";
															echo "<input id='f_old_start_id' type='hidden' value='$f_m_id[$f_start_position]'>";	//old start id
														echo "<select class='form_control change_f_m' id='f_monster_choice'>";
																$counter = 0;
																for($a=0; $a<$f_anz_aktiv_monster; $a++){
																	if($f_start[$a]!=1 && $f_m_c_hp[$a]>0){
																		if($counter==0){	//selected
																			echo "<option selected value='$f_m_id[$a]'>$f_m_name[$a]</option>";
																			$counter = 1;
																		} else {
																			echo "<option  value='$f_m_id[$a]'>$f_m_name[$a]</option>";
																		} 
																	}
																}
														echo "</select>";
														if($counter != 0){
															echo "<input class='btn btn-info' style='color: green; height: 31px; border: 1px solid green; margin-top: -3px;' type='submit' value='Change'>";	
														}
													echo "</form>";
												echo "</div>";
											}
									echo "</div>";
								echo "</td>";
							echo "</tr>";	
						echo "</table>";
					echo "</div>";
					/***********************************************************************Protokol********************************************************************/
					echo "<div id='battleProtokol'>";
						$query = "SELECT Round, User, Monster_Name, Monster_Name_Against, Atack_Used, Damage, Status, Effectivity FROM protokol WHERE User='$aNickName' ORDER BY P_ID";	
						$result = mysql_query($query) or die("Query failed : " . mysql_error());
						while ($aRow = mysql_fetch_array($result)) {
							$p_round[] = $aRow["Round"];
							$p_user[] = $aRow["User"];
							$p_monster_name[] = $aRow["Monster_Name"];
							$p_monster_name_against[] = $aRow["Monster_Name_Against"];
							$p_atack_used[] = $aRow["Atack_Used"];
							$p_damage[] = $aRow["Damage"];
							$p_status[] = $aRow["Status"];
							$p_effectivity[] = $aRow["Effectivity"];
						}
						if (mysql_num_rows($result)==0){	//check if result empty
							$p_anz_rounds = 0;
							//echo "<p>CMO</p>";
							echo "<img src='img/logo_full_grey.png'>";
							if($w_m_c_hp[0] == 0){
								echo "<button class='btn btn-info' style='color: green; border: 1px solid green; position: relative; top: -20%; left: 35%; margin-top: -40px;' id='search' onclick='setTimeout(ajax_search_monster, 3000);'>Search</button>";
							}	
						} else {
							$p_anz_rounds = count($p_round);
							for($i=0; $i<$p_anz_rounds; $i++){
								if(($i % 2) == 0){
									echo "<p style='text-align: center; color: rgb(51 51 51); font-weight: bold; font-size: 16px; padding-top: 15px;'>Round $p_round[$i]</p>";
								}
								echo "<p style='color: rgb(51 51 51); font-size: 16px;'>$p_monster_name[$i] used $p_atack_used[$i]: $p_damage[$i] <br> Status: $p_status[$i]. Effectivity: $p_effectivity[$i]</p>";
							}
						}
						mysql_free_result($result);

					echo "</div>";
					echo "<div id='randomMonster' style='text-align: center;'>";
							echo "<table id='fUserMonster1' style='margin: 0 auto; background-color: rgb(56 58 59);'>";
							echo "<tr>";
								echo "<td>";
									echo "<div id='fMonster' style='text-align: center; margin: 0 auto; width: 271px;'>";
										if($w_anz_monster == 0) {
											//no wild, then create one
											$w_m_random_id = rand(1, 4);	//only normal ids
											$query = "SELECT Name, Hp, Atk, Def, Spd, Sp_A, Sp_D FROM monster_list WHERE M_ID_L='$w_m_random_id'";	
											$result = mysql_query($query) or die("Query failed : " . mysql_error());
											while ($aRow = mysql_fetch_array($result)) {
												$w_m_new_name[] = $aRow["Name"];
												$w_ml_hp[] = $aRow["Hp"];
												$w_ml_atk[] = $aRow["Atk"];
												$w_ml_def[] = $aRow["Def"];
												$w_ml_spd[] = $aRow["Spd"];
												$w_ml_sp_a[] = $aRow["Sp_A"];
												$w_ml_sp_d[] = $aRow["Sp_D"];
											}
											mysql_free_result($result);
											$w_m_new_lvl = rand(1, $f_m_lvl[$f_start_position]);	//1 to start lvl from user
											//calculate stats
											$w_m_stat_hp =(int)(($w_ml_hp[0] * 2 + 28 ) * $w_m_new_lvl/100 + 10 + $w_m_new_lvl);
											$w_m_stat_a=(int)(((($w_ml_atk[0] * 2 + 28 ) * $w_m_new_lvl/100 ) + 5));
											$w_m_stat_d=(int)(((($w_ml_def[0] * 2 + 28 ) * $w_m_new_lvl/100 ) + 5));
											$w_m_stat_s=(int)(((($w_ml_spd[0] * 2 + 28 ) * $w_m_new_lvl/100 ) + 5));
											$w_m_stat_sa=(int)(((($w_ml_sp_a[0] * 2 + 28 ) * $w_m_new_lvl/100 ) + 5));
											$w_m_stat_sd=(int)(((($w_ml_sp_d[0] * 2 + 28 ) * $w_m_new_lvl/100 ) + 5));
											$sql_insert = "INSERT INTO wild_monsters (M_Name, For_User, Lvl, Hp, A, D, S, Sa, Sd, C_Hp) VALUES ('$w_m_new_name[0]', '$aNickName', '$w_m_new_lvl', '$w_m_stat_hp', '$w_m_stat_a', '$w_m_stat_d', '$w_m_stat_s', '$w_m_stat_sa', '$w_m_stat_sd', '$w_m_stat_hp');";
											$result_insert = mysql_query($sql_insert) or die(mysql_error());
											//save monster properties
											$query = "SELECT wm.M_ID, wm.M_Name, wm.Lvl, wm.Hp, wm.A, wm.D, wm.S, wm.Sa, wm.Sd, wm.C_Hp, wm.Hp_Count, wm.A_Count, wm.D_Count, wm.S_Count, wm.Sa_Count, wm.Sd_Count, wm.A1, wm.A2, wm.A3, wm.A4, ml.M_ID_L, ml.ML_Image
												  FROM wild_monsters wm INNER JOIN monster_list ml ON ml.Name = wm.M_Name WHERE For_User='$aNickName' ORDER BY M_ID";	
											$result = mysql_query($query) or die("Query failed : " . mysql_error());
											while ($aRow = mysql_fetch_array($result)) {
												$w_m_id[] = $aRow["M_ID"];
												$w_m_name[] = $aRow["M_Name"];
												$w_m_lvl[] = $aRow["Lvl"];
												$w_m_hp_stat[] = $aRow["Hp"];
												$w_m_a_stat[] = $aRow["A"];
												$w_m_d_stat[] = $aRow["D"];
												$w_m_s_stat[] = $aRow["S"];
												$w_m_sa_stat[] = $aRow["Sa"];
												$w_m_sd_stat[] = $aRow["Sd"];
												$w_m_c_hp[] = $aRow["C_Hp"];
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
											}
											mysql_free_result($result);
										}
										/**********************************Gegner*****************************************************/
										echo "<div id='forest_monster'><p style='color: rgb(51 51 51);'>#$w_m_id_l[0] $w_m_name[0] $w_m_lvl[0]-lvl</p></div>";
										echo "<img class='f_image' src='img_monsters/$w_ml_image[0]'>";
										//echo "<p><progress class='f_current_hp' style='width: 150px;' value='$w_m_c_hp[0]' max='$w_m_hp_stat[0]'></progress><br>";	
										$w_progress_hp0 = ($w_m_c_hp[0] * 100) / $w_m_hp_stat[0];
										?>
										<div class="progress">
										  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo "$w_m_c_hp[0]"; ?>"
										  aria-valuemin="0" aria-valuemax="<?php echo "$w_m_hp_stat[0]"; ?>" style="width:<?php echo "$w_progress_hp0";  ?>%">
											<?php echo "$w_m_c_hp[0]"; ?> 
										  </div>
										</div>
										<br>
										<?php
										//stats up
											echo "<div style='color: white; position: absolute; margin: -220px 10px;'>";
												if($w_hp_count[0] != 0){
													echo "HP: $w_hp_count[0] <br>";
												}
												if($w_a_count[0] != 0){
													echo "A: $w_a_count[0] <br>";
												}
												if($w_d_count[0] != 0){
													echo "D: $w_d_count[0] <br>";
												}
												if($w_s_count[0] != 0){
													echo "S: $w_s_count[0] <br>";
												}
												if($w_sa_count[0] != 0){
													echo "Sa: $w_sa_count[0] <br>";
												}
												if($w_sd_count[0] != 0){
													echo "Sd: $w_sd_count[0] <br>";
												}
											echo "</div>";
										echo "<p><strong>Wild Monster</strong></p>";

										if($w_m_c_hp[0] > 0){
											echo "<img class='slot' src='img/slot.png'>";
										} else {
											echo "<img class='slot' src='img/slot2.png'>";
										}
										
									echo "</div>";
								echo "</td>";
							echo "</tr>";	
						echo "</table>";
					echo "</div>";
				}
			?>
		</div>
	</div>
</div>
<script>
	function forest_mode_aktivate(){
		document.getElementById('kyotoCity').style.display='none';
		document.getElementById('forestAktive').style.visibility='hidden';
		document.getElementById('show_forest').style.display='block';
		document.getElementById('reinforcement_div').style.display='none';
		document.getElementById('main').style.background='rgb(56 58 59)';
		$.ajax({
			type: 'POST',
			url: 'forms/refresh_current_stats.php',
			data: '',
			success:function( msg ) {
				//alert( "Stats refreshed!");
			}
		});
		$('#forest_main').load(document.URL +  ' #forest_main');
		$('#doctorATable').load(document.URL +  ' #doctorATable');
	}
	function forest_mode_deaktivate(){
		document.getElementById('kyotoCity').style.display='block';
		document.getElementById('reinforcement_div').style.display='block';
		document.getElementById('forestAktive').style.visibility='visible';
		document.getElementById('show_forest').style.display='none';
		document.getElementById('main').style.background='url(img/city/KyotoCity.png) no-repeat center center fixed';
		document.getElementById('main').style.backgroundSize='cover';
		$.ajax({
			type: 'POST',
			url: 'forms/refresh_current_stats.php',
			data: '',
			success:function( msg ) {
				//alert( "Stats refreshed!");
			}
		});
		$('#forest_main').load(document.URL +  ' #forest_main');
		$('#doctorATable').load(document.URL +  ' #doctorATable');
	}
	function ajax_change_f_monster() {
		var old_start = document.getElementById("f_old_start_id").value;
		var new_start = document.getElementById("f_monster_choice").value;
		$.ajax({
			type: 'POST',
			url: 'forms/monster_changed_res.php',
			data: 'old_start_id='+old_start+'&new_start_id='+new_start,
			success:function( msg ) {
				alert( "Monster Changed!" /*Old_id="+old_start+"New_id:"+new_start*/);
			}
		});
		$('#forest_main').load(document.URL +  ' #forest_main');
		$('#monster_content').load(document.URL +  ' #monster_content');
		$('#tabs').load(document.URL +  ' #tabs');
		$('#forest_main').load(document.URL +  ' #forest_main');
	}
	function ajax_mon_atack(values) {	//values[0] -> atack name from start
		$.ajax({
			type: 'POST',
			url: 'forms/monster_atack_res.php',
			data: 'atack_name_used='+values[0]+'&nr_atack='+values[1]+'&nr_pp='+values[2],
			success:function( msg ) {
				//alert( "Atack ["+values[0]+"] was used!"+values[1]+values[2] );
			}
		});
		$('#forest_main').load(document.URL +  ' #forest_main');
		$('#doctorATable').load(document.URL +  ' #doctorATable');
		$('#monster_content').load(document.URL +  ' #monster_content');
		$('#tabs').load(document.URL +  ' #tabs');
		$('#item_content').load(document.URL +  ' #item_content');
	}
	function ajax_search_monster(){
		$('#forest_main').load(document.URL +  ' #forest_main');
	}
</script>