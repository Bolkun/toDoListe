<!------------------------------------------ div1 -------------------------------------------------------------->
<div id="div1" style="display:none">
	<style>
	#menu1 {
		float: left;
		margin-top: -175px;
		margin-left: 200px;
	}
	#stats_table1 th, #stats_table1 td{
		padding-left: 0px;
		padding-top: 0px;
	}
	#stats1 {
		float: left;
		margin-top: -145px;
		margin-left: 200px;
	}
	#atack_list1 th, #atack_list1 td {
		padding-left: 10px;
		padding-top: 10px;
	}
	#atacks1 {
		float: left;
		margin-top: -145px;
		margin-left: 190px;
	}
	
	progress.hp_progress1:after { 
		   content: attr(value);
	}	
	progress.a_progress1:after { 
	   content: attr(value);
	}	
	progress.d_progress1:after { 
	   content: attr(value);
	}
	progress.s_progress1:after { 
	   content: attr(value);
	}
	progress.sa_progress1:after { 
	   content: attr(value);
	}
	progress.sd_progress1:after { 
	   content: attr(value);
	}			
	</style>
	<div id="tabs1" <?php if($anz_aktiv_monsters <= 3){ echo "style='margin:-10 -20;'"; }?>>
		<div id="menu1">
			<img style='cursor: pointer;' src='img/info.png' onclick='showInfo(1)'>
			<img style='cursor: pointer;' src='img/stats.png' onclick='showStats(1)'>
			<img style='cursor: pointer;' src='img/atacks.png' onclick='showAtacks(1)'>
		</div>
		<div id="contents1">
			<div id="info1" style="display:none">
				<?php
				if($type2[1]>0){
					echo "<p class='types'>Type: <img src='img_type/$type1[1].png'> <img src='img_type/$type2[1].png'></p>";
				} else {
					echo "<p class='types'>Type: <img src='img_type/$type1[1].png'></p>";
				}
				if($start[1] != 1){
					for($i=0; $i<$anz_aktiv_monsters; $i++){
						if($start[$i] == 1) $m_start=$m_id[$i];
					}
					$m1_start = array($m_id[1], $m_start);	//m_id, m_start
					$jsvar_m1_start = json_encode($m1_start);
					echo "<form method='POST' action='javascript:void(null);' onsubmit='ajax_make_start($jsvar_m1_start)'>";
						echo "<input class='btn btn-info start' type='submit' value='First Pick'>";
					echo "</form>";
				}
				?>
				<p class="gens">Gens: HP<?php echo "$hp_g[1]";?>A<?php echo "$a_g[1]";?>D<?php echo "$d_g[1]";?>S<?php echo "$s_g[1]";?>SA<?php echo "$sa_g[1]";?>SD<?php echo "$sd_g[1]";?></p>
			</div>
			<div id="stats1">
				<table id='stats_table1'>
					<tr>
						<td id="hp_name1">HP: </td>
						<td id="hp1"><div id='change_monsters1_stat_hp'><?php echo "$stat_hp[1]";?></div></td>
						<td><div id='change_hp_progress1'><progress class='hp_progress1' style='width: 126px;' value='<?php echo "$hp_ev[1]"; ?>' max='126'></progress></div></td>
						<td>
						<?php
							$m1_ev_array_hp1 = array($m_id[1], "Hp_Ev", 1);
							$m1_jsvar_hp1 = json_encode($m1_ev_array_hp1);
						?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_hp1";?>)'>
								<?php
								if($ev[1]> 0 && $hp_ev[1] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
						<?php
							$m1_ev_array_hp10 = array($m_id[1], "Hp_Ev", 10);
							$m1_jsvar_hp10 = json_encode($m1_ev_array_hp10);
						?>
						<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_hp10";?>)'>
								<?php
								if($ev[1]>= 10 && $hp_ev[1] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m1_ev_array_hp100 = array($m_id[1], "Hp_Ev", 100);
								$m1_jsvar_hp100 = json_encode($m1_ev_array_hp100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_hp100";?>)'>
								<?php
								if($ev[1]>= 100 && $hp_ev[1] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>		
					</tr>
					<tr>
						<td id="a_name1">A: </td>
						<td id="a1"><div id='change_monsters1_stat_a'><?php echo "$stat_a[1]";?></div></td>
						<td><div id='change_a_progress1'><progress class='a_progress1' style='width: 126px;' value='<?php echo "$a_ev[1]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m1_ev_array_a1 = array($m_id[1], "A_Ev", 1);
								$m1_jsvar_a1 = json_encode($m1_ev_array_a1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_a1";?>)'>
								<?php
								if($ev[1]> 0 && $a_ev[1] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m1_ev_array_a10 = array($m_id[1], "A_Ev", 10);
								$m1_jsvar_a10 = json_encode($m1_ev_array_a10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_a10";?>)'>
								<?php
								if($ev[1]>= 10 && $a_ev[1] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m1_ev_array_a100 = array($m_id[1], "A_Ev", 100);
								$m1_jsvar_a100 = json_encode($m1_ev_array_a100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_a100";?>)'>
								<?php
								if($ev[1]>= 100 && $a_ev[1] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="d_name1">D: </td>
						<td id="d1"><div id='change_monsters1_stat_d'><?php echo "$stat_d[1]";?></div></td>
						<td><div id='change_d_progress1'><progress class='d_progress1' style='width: 126px;' value='<?php echo "$d_ev[1]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m1_ev_array_d1 = array($m_id[1], "D_Ev", 1);
								$m1_jsvar_d1 = json_encode($m1_ev_array_d1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_d1";?>)'>
								<?php
								if($ev[1]> 0 && $d_ev[1] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m1_ev_array_d10 = array($m_id[1], "D_Ev", 10);
								$m1_jsvar_d10 = json_encode($m1_ev_array_d10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_d10";?>)'>
								<?php
								if($ev[1]>= 10 && $d_ev[1] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m1_ev_array_d100 = array($m_id[1], "D_Ev", 100);
								$m1_jsvar_d100 = json_encode($m1_ev_array_d100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_d100";?>)'>
								<?php
								if($ev[1]>= 100 && $d_ev[1] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="s_name1">S: </td>
						<td id="s1"><div id='change_monsters1_stat_s'><?php echo "$stat_s[1]";?></div></td>
						<td><div id='change_s_progress1'><progress class='s_progress1' style='width: 126px;' value='<?php echo "$s_ev[1]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m1_ev_array_s1 = array($m_id[1], "S_Ev", 1);
								$m1_jsvar_s1 = json_encode($m1_ev_array_s1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_s1";?>)'>
								<?php
								if($ev[1]> 0 && $s_ev[1] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m1_ev_array_s10 = array($m_id[1], "S_Ev", 10);
								$m1_jsvar_s10 = json_encode($m1_ev_array_s10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_s10";?>)'>
								<?php
								if($ev[1]>= 10 && $s_ev[1] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m1_ev_array_s100 = array($m_id[1], "S_Ev", 100);
								$m1_jsvar_s100 = json_encode($m1_ev_array_s100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_s100";?>)'>
								<?php
								if($ev[1]>= 100 && $s_ev[1] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="sa_name1">SA: </td>
						<td id="sa1"><div id='change_monsters1_stat_sa'><?php echo "$stat_sa[1]";?></div></td>
						<td><div id='change_sa_progress1'><progress class='sa_progress1' style='width: 126px;' value='<?php echo "$sa_ev[1]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m1_ev_array_sa1 = array($m_id[1], "Sa_Ev", 1);
								$m1_jsvar_sa1 = json_encode($m1_ev_array_sa1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_sa1";?>)'>
								<?php
								if($ev[1]> 0 && $sa_ev[1] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m1_ev_array_sa10 = array($m_id[1], "Sa_Ev", 10);
								$m1_jsvar_sa10 = json_encode($m1_ev_array_sa10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_sa10";?>)'>
								<?php
								if($ev[1]>= 10 && $sa_ev[1] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m1_ev_array_sa100 = array($m_id[1], "Sa_Ev", 100);
								$m1_jsvar_sa100 = json_encode($m1_ev_array_sa100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_sa100";?>)'>
								<?php
								if($ev[1]>= 100 && $sa_ev[1] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="sd_name1">SD: </td>
						<td id="sd1"><div id='change_monsters1_stat_sd'><?php echo "$stat_sd[1]";?></div></td>
						<td><div id='change_sd_progress1'><progress class='sd_progress1' style='width: 126px;' value='<?php echo "$sd_ev[1]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m1_ev_array_sd1 = array($m_id[1], "Sd_Ev", 1);
								$m1_jsvar_sd1 = json_encode($m1_ev_array_sd1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_sd1";?>)'>
								<?php
								if($ev[1]> 0 && $sd_ev[1] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m1_ev_array_sd10 = array($m_id[1], "Sd_Ev", 10);
								$m1_jsvar_sd10 = json_encode($m1_ev_array_sd10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_sd10";?>)'>
								<?php
								if($ev[1]>= 10 && $sd_ev[1] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m1_ev_array_sd100 = array($m_id[1], "Sd_Ev", 100);
								$m1_jsvar_sd100 = json_encode($m1_ev_array_sd100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m1_jsvar_sd100";?>)'>
								<?php
								if($ev[1]>= 100 && $sd_ev[1] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
				</table>
				<h1 class="ev"><strong>EV: <?php echo "$ev[1]";?></strong></h2>
			</div>
			<div id="atacks1" style="display:none">
				<?php
				/************************************Attacks**************************************************************/
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a1[1]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m1_a1_pp1[] = $aRow["Pp"];
					$m1_a1_type1[] = $aRow["Type"];
					$m1_a1_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a2[1]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m1_a2_pp2[] = $aRow["Pp"];
					$m1_a2_type2[] = $aRow["Type"];
					$m1_a2_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a3[1]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m1_a3_pp3[] = $aRow["Pp"];
					$m1_a3_type3[] = $aRow["Type"];
					$m1_a3_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a4[1]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m1_a4_pp4[] = $aRow["Pp"];
					$m1_a4_type4[] = $aRow["Type"];
					$m1_a4_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				echo "<table id='atack_list1'>";
					echo "<tr>";
						echo "<td><img class='atack_type' src='img_type/$m1_a1_type1[0].png'></td>";	
						?>
						<td><div <?php if($m1_a1_category[0] == 1) echo "style='color: red;'"; if($m1_a1_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a1[1]"; ?></div><?php echo "$m1_a1_pp1[0]/$a1_pp[1]";?></td>
						<?php
						echo "<td><img class='atack_type' src='img_type/$m1_a2_type2[0].png'></td>";	
						?>
						<td><div <?php if($m1_a2_category[0] == 1) echo "style='color: red;'"; if($m1_a2_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a2[1]"; ?></div><?php echo "$m1_a2_pp2[0]/$a2_pp[1]";?></td>
						<?php
					echo "</tr>";
					echo "<tr>";
						echo "<td><img class='atack_type' src='img_type/$m1_a3_type3[0].png'></td>";	
						?>
						<td><div <?php if($m1_a3_category[0] == 1) echo "style='color: red;'"; if($m1_a3_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a3[1]"; ?></div><?php echo "$m1_a3_pp3[0]/$a3_pp[1]";?></td>
						<?php
						echo "<td><img class='atack_type' src='img_type/$m1_a4_type4[0].png'></td>";	
						?>
						<td><div <?php if($m1_a4_category[0] == 1) echo "style='color: red;'"; if($m1_a4_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a4[1]"; ?></div><?php echo "$m1_a4_pp4[0]/$a4_pp[1]";?></td>
						<?php
					echo "</tr>";
				echo "</table>";
				?>
			</div>
		</div>
	</div>
</div>
<script>	
//Monster 1
function m2_a1() {
	document.getElementById('pop_m2_a1').style.display="block";
	document.getElementById('pop_m2_a2').style.display="none";
	document.getElementById('pop_m2_a3').style.display="none";
	document.getElementById('pop_m2_a4').style.display="none";
}
function m2_a2() {
	document.getElementById('pop_m2_a1').style.display="none";
	document.getElementById('pop_m2_a2').style.display="block";
	document.getElementById('pop_m2_a3').style.display="none";
	document.getElementById('pop_m2_a4').style.display="none";
}
function m2_a3() {
	document.getElementById('pop_m2_a1').style.display="none";
	document.getElementById('pop_m2_a2').style.display="none";
	document.getElementById('pop_m2_a3').style.display="block";
	document.getElementById('pop_m2_a4').style.display="none";
}
function m2_a4() {
	document.getElementById('pop_m2_a1').style.display="none";
	document.getElementById('pop_m2_a2').style.display="none";
	document.getElementById('pop_m2_a3').style.display="none";
	document.getElementById('pop_m2_a4').style.display="block";
}
function ChangeContent1(values) {
	if(document.getElementById('div1').style.display == "none"){
		document.getElementById('div1').style.display="block";
		document.getElementById('monster_td0').style.display="none";
		document.getElementById('monster_td1').style.marginLeft="-28px";
		document.getElementById('monster_td2').style.display="none";
		document.getElementById('monster_td3').style.display="none";
		document.getElementById('monster_td4').style.display="none";
		document.getElementById('monster_td5').style.display="none";
	} else {
		document.getElementById('div1').style.display="none";
		document.getElementById('monster_td1').style.marginLeft="0px";
		document.getElementById('monster_td0').style.display="block";
		document.getElementById('monster_td2').style.display="block";
		document.getElementById('monster_td3').style.display="block";
		document.getElementById('monster_td4').style.display="block";
		document.getElementById('monster_td5').style.display="block";
	}
	
	if(values[35] == 1.1){	//har a
		document.getElementById('a_name1').style.color="green";
		document.getElementById('a1').style.color="green";
	} else if(values[35] == 0.9){
		document.getElementById('a_name1').style.color="red";
		document.getElementById('a1').style.color="red";
	}
	if(values[36] == 1.1){
		document.getElementById('d_name1').style.color="green";
		document.getElementById('d1').style.color="green";
	} else if(values[36] == 0.9){
		document.getElementById('d_name1').style.color="red";
		document.getElementById('d1').style.color="red";
	}
	if(values[37] == 1.1){
		document.getElementById('s_name1').style.color="green";
		document.getElementById('s1').style.color="green";
	} else if(values[37] == 0.9){
		document.getElementById('s_name1').style.color="red";
		document.getElementById('s1').style.color="red";
	}
	if(values[38] == 1.1){
		document.getElementById('sa_name1').style.color="green";
		document.getElementById('sa1').style.color="green";
	} else if(values[38] == 0.9){
		document.getElementById('sa_name1').style.color="red";
		document.getElementById('sa1').style.color="red";
	}
	if(values[39] == 1.1){
		document.getElementById('sd_name1').style.color="green";
		document.getElementById('sd1').style.color="green";
	} else if(values[39] == 0.9){
		document.getElementById('sd_name1').style.color="red";
		document.getElementById('sd1').style.color="red";
	}
}
</script>