<!------------------------------------------ div4 -------------------------------------------------------------->
<div id="div4" style="display:none">
	<style>
	#menu4 {
		float: left;
		margin-top: -175px;
		margin-left: 200px;
	}
	#stats_table4 th, #stats_table4 td{
		padding-left: 0px;
		padding-top: 0px;
	}
	#stats4 {
		float: left;
		margin-top: -145px;
		margin-left: 200px;
	}
	#atack_list4 th, #atack_list4 td {
		padding-left: 10px;
		padding-top: 10px;
	}
	#atacks4 {
		float: left;
		margin-top: -145px;
		margin-left: 190px;
	}
	
	progress.hp_progress4:after { 
	   content: attr(value);
	}	
	progress.a_progress4:after { 
	   content: attr(value);
	}	
	progress.d_progress4:after { 
	   content: attr(value);
	}
	progress.s_progress4:after { 
	   content: attr(value);
	}
	progress.sa_progress4:after { 
	   content: attr(value);
	}
	progress.sd_progress4:after { 
	   content: attr(value);
	}			
	</style>
	<div id="tabs4">
		<div id="menu4">
			<img style='cursor: pointer;' src='img/info.png' onclick='showInfo(4)'>
			<img style='cursor: pointer;' src='img/stats.png' onclick='showStats(4)'>
			<img style='cursor: pointer;' src='img/atacks.png' onclick='showAtacks(4)'>
		</div>
		<div id="contents4">
			<div id="info4" style="display:none">
				<?php
				if($type2[4]>0){
					echo "<p class='types'>Type: <img src='img_type/$type1[4].png'> <img src='img_type/$type2[4].png'></p>";
				} else {
					echo "<p class='types'>Type: <img src='img_type/$type1[4].png'></p>";
				}
				if($start[4] != 1){
					for($i=0; $i<$anz_aktiv_monsters; $i++){
						if($start[$i] == 1) $m_start=$m_id[$i];
					}
					$m4_start = array($m_id[4], $m_start);	//m_id, m_start
					$jsvar_m4_start = json_encode($m4_start);
					echo "<form method='POST' action='javascript:void(null);' onsubmit='ajax_make_start($jsvar_m4_start)'>";
						echo "<input class='btn btn-info start' type='submit' value='First Pick'>";
					echo "</form>";
				}
				?>
				<p class="gens">Gens: HP<?php echo "$hp_g[4]";?>A<?php echo "$a_g[4]";?>D<?php echo "$d_g[4]";?>S<?php echo "$s_g[4]";?>SA<?php echo "$sa_g[4]";?>SD<?php echo "$sd_g[4]";?></p>
			</div>
			<div id="stats4">
				<table id='stats_table4'>
					<tr>
						<td id="hp_name4">HP: </td>
						<td id="hp4"><div id='change_monsters4_stat_hp'><?php echo "$stat_hp[4]";?></div></td>
						<td><div id='change_hp_progress4'><progress class='hp_progress4' style='width: 126px;' value='<?php echo "$hp_ev[4]"; ?>' max='126'></progress></div></td>
						<td>
						<?php
							$m4_ev_array_hp1 = array($m_id[4], "Hp_Ev", 1);
							$m4_jsvar_hp1 = json_encode($m4_ev_array_hp1);
						?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_hp1";?>)'>
								<?php
								if($ev[4]> 0 && $hp_ev[4] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
						<?php
							$m4_ev_array_hp10 = array($m_id[4], "Hp_Ev", 10);
							$m4_jsvar_hp10 = json_encode($m4_ev_array_hp10);
						?>
						<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_hp10";?>)'>
								<?php
								if($ev[4]>= 10 && $hp_ev[4] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m4_ev_array_hp100 = array($m_id[4], "Hp_Ev", 100);
								$m4_jsvar_hp100 = json_encode($m4_ev_array_hp100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_hp100";?>)'>
								<?php
								if($ev[4]>= 100 && $hp_ev[4] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>		
					</tr>
					<tr>
						<td id="a_name4">A: </td>
						<td id="a4"><div id='change_monsters4_stat_a'><?php echo "$stat_a[4]";?></div></td>
						<td><div id='change_a_progress4'><progress class='a_progress4' style='width: 126px;' value='<?php echo "$a_ev[4]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m4_ev_array_a1 = array($m_id[4], "A_Ev", 1);
								$m4_jsvar_a1 = json_encode($m4_ev_array_a1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_a1";?>)'>
								<?php
								if($ev[4]> 0 && $a_ev[4] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m4_ev_array_a10 = array($m_id[4], "A_Ev", 10);
								$m4_jsvar_a10 = json_encode($m4_ev_array_a10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_a10";?>)'>
								<?php
								if($ev[4]>= 10 && $a_ev[4] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m4_ev_array_a100 = array($m_id[4], "A_Ev", 100);
								$m4_jsvar_a100 = json_encode($m4_ev_array_a100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_a100";?>)'>
								<?php
								if($ev[4]>= 100 && $a_ev[4] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="d_name4">D: </td>
						<td id="d4"><div id='change_monsters4_stat_d'><?php echo "$stat_d[4]";?></div></td>
						<td><div id='change_d_progress4'><progress class='d_progress4' style='width: 126px;' value='<?php echo "$d_ev[4]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m4_ev_array_d1 = array($m_id[4], "D_Ev", 1);
								$m4_jsvar_d1 = json_encode($m4_ev_array_d1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_d1";?>)'>
								<?php
								if($ev[4]> 0 && $d_ev[4] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m4_ev_array_d10 = array($m_id[4], "D_Ev", 10);
								$m4_jsvar_d10 = json_encode($m4_ev_array_d10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_d10";?>)'>
								<?php
								if($ev[4]>= 10 && $d_ev[4] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m4_ev_array_d100 = array($m_id[4], "D_Ev", 100);
								$m4_jsvar_d100 = json_encode($m4_ev_array_d100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_d100";?>)'>
								<?php
								if($ev[4]>= 100 && $d_ev[4] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="s_name4">S: </td>
						<td id="s4"><div id='change_monsters4_stat_s'><?php echo "$stat_s[4]";?></div></td>
						<td><div id='change_s_progress4'><progress class='s_progress4' style='width: 126px;' value='<?php echo "$s_ev[4]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m4_ev_array_s1 = array($m_id[4], "S_Ev", 1);
								$m4_jsvar_s1 = json_encode($m4_ev_array_s1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_s1";?>)'>
								<?php
								if($ev[4]> 0 && $s_ev[4] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m4_ev_array_s10 = array($m_id[4], "S_Ev", 10);
								$m4_jsvar_s10 = json_encode($m4_ev_array_s10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_s10";?>)'>
								<?php
								if($ev[4]>= 10 && $s_ev[4] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m4_ev_array_s100 = array($m_id[4], "S_Ev", 100);
								$m4_jsvar_s100 = json_encode($m4_ev_array_s100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_s100";?>)'>
								<?php
								if($ev[4]>= 100 && $s_ev[4] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="sa_name4">SA: </td>
						<td id="sa4"><div id='change_monsters4_stat_sa'><?php echo "$stat_sa[4]";?></div></td>
						<td><div id='change_sa_progress4'><progress class='sa_progress4' style='width: 126px;' value='<?php echo "$sa_ev[4]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m4_ev_array_sa1 = array($m_id[4], "Sa_Ev", 1);
								$m4_jsvar_sa1 = json_encode($m4_ev_array_sa1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_sa1";?>)'>
								<?php
								if($ev[4]> 0 && $sa_ev[4] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m4_ev_array_sa10 = array($m_id[4], "Sa_Ev", 10);
								$m4_jsvar_sa10 = json_encode($m4_ev_array_sa10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_sa10";?>)'>
								<?php
								if($ev[4]>= 10 && $sa_ev[4] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m4_ev_array_sa100 = array($m_id[4], "Sa_Ev", 100);
								$m4_jsvar_sa100 = json_encode($m4_ev_array_sa100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_sa100";?>)'>
								<?php
								if($ev[4]>= 100 && $sa_ev[4] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="sd_name4">SD: </td>
						<td id="sd4"><div id='change_monsters4_stat_sd'><?php echo "$stat_sd[4]";?></div></td>
						<td><div id='change_sd_progress4'><progress class='sd_progress4' style='width: 126px;' value='<?php echo "$sd_ev[4]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m4_ev_array_sd1 = array($m_id[4], "Sd_Ev", 1);
								$m4_jsvar_sd1 = json_encode($m4_ev_array_sd1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_sd1";?>)'>
								<?php
								if($ev[4]> 0 && $sd_ev[4] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m4_ev_array_sd10 = array($m_id[4], "Sd_Ev", 10);
								$m4_jsvar_sd10 = json_encode($m4_ev_array_sd10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_sd10";?>)'>
								<?php
								if($ev[4]>= 10 && $sd_ev[4] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m4_ev_array_sd100 = array($m_id[4], "Sd_Ev", 100);
								$m4_jsvar_sd100 = json_encode($m4_ev_array_sd100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m4_jsvar_sd100";?>)'>
								<?php
								if($ev[4]>= 100 && $sd_ev[4] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
				</table>
				<h1 class="ev"><strong>EV: <?php echo "$ev[4]";?></strong></h2>
			</div>
			<div id="atacks4" style="display:none">
				<?php
				/************************************Attacks**************************************************************/
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a1[4]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m4_a1_pp1[] = $aRow["Pp"];
					$m4_a1_type1[] = $aRow["Type"];
					$m4_a1_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a2[4]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m4_a2_pp2[] = $aRow["Pp"];
					$m4_a2_type2[] = $aRow["Type"];
					$m4_a2_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a3[4]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m4_a3_pp3[] = $aRow["Pp"];
					$m4_a3_type3[] = $aRow["Type"];
					$m4_a3_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a4[4]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m4_a4_pp4[] = $aRow["Pp"];
					$m4_a4_type4[] = $aRow["Type"];
					$m4_a4_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				echo "<table id='atack_list4'>";
					echo "<tr>";
						echo "<td><img class='atack_type' src='img_type/$m4_a1_type1[0].png'></td>";	
						?>
						<td><div <?php if($m4_a1_category[0] == 1) echo "style='color: red;'"; if($m4_a1_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a1[4]"; ?></div><?php echo "$m4_a1_pp1[0]/$a1_pp[4]";?></td>
						<?php
						echo "<td><img class='atack_type' src='img_type/$m4_a2_type2[0].png'></td>";	
						?>
						<td><div <?php if($m4_a2_category[0] == 1) echo "style='color: red;'"; if($m4_a2_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a2[4]"; ?></div><?php echo "$m4_a2_pp2[0]/$a2_pp[4]";?></td>
						<?php
					echo "</tr>";
					echo "<tr>";
						echo "<td><img class='atack_type' src='img_type/$m4_a3_type3[0].png'></td>";	
						?>
						<td><div <?php if($m4_a3_category[0] == 1) echo "style='color: red;'"; if($m4_a3_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a3[4]"; ?></div><?php echo "$m4_a3_pp3[0]/$a3_pp[4]";?></td>
						<?php
						echo "<td><img class='atack_type' src='img_type/$m4_a4_type4[0].png'></td>";	
						?>
						<td><div <?php if($m4_a4_category[0] == 1) echo "style='color: red;'"; if($m4_a4_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a4[4]"; ?></div><?php echo "$m4_a4_pp4[0]/$a4_pp[4]";?></td>
						<?php
					echo "</tr>";
				echo "</table>";
				?>
			</div>
		</div>
	</div>
</div>
<script>
//Monster 4
function m5_a1() {
	document.getElementById('pop_m5_a1').style.display="block";
	document.getElementById('pop_m5_a2').style.display="none";
	document.getElementById('pop_m5_a3').style.display="none";
	document.getElementById('pop_m5_a4').style.display="none";
}
function m5_a2() {
	document.getElementById('pop_m5_a1').style.display="none";
	document.getElementById('pop_m5_a2').style.display="block";
	document.getElementById('pop_m5_a3').style.display="none";
	document.getElementById('pop_m5_a4').style.display="none";
}
function m5_a3() {
	document.getElementById('pop_m5_a1').style.display="none";
	document.getElementById('pop_m5_a2').style.display="none";
	document.getElementById('pop_m5_a3').style.display="block";
	document.getElementById('pop_m5_a4').style.display="none";
}
function m5_a4() {
	document.getElementById('pop_m5_a1').style.display="none";
	document.getElementById('pop_m5_a2').style.display="none";
	document.getElementById('pop_m5_a3').style.display="none";
	document.getElementById('pop_m5_a4').style.display="block";
}	
function ChangeContent4(values) {
	if(document.getElementById('div4').style.display == "none"){
		document.getElementById('div4').style.display="block";
		document.getElementById('monster_td0').style.display="none";
		document.getElementById('monster_td1').style.display="none";
		document.getElementById('monster_td2').style.display="none";
		document.getElementById('monster_td3').style.display="none";
		document.getElementById('monster_td4').style.marginTop="-24px";
		document.getElementById('monster_td4').style.marginLeft="-28px";
		document.getElementById('monster_td5').style.display="none";
	} else {
		document.getElementById('div4').style.display="none";
		document.getElementById('monster_td0').style.display="block";
		document.getElementById('monster_td1').style.display="block";
		document.getElementById('monster_td2').style.display="block";
		document.getElementById('monster_td3').style.display="block";
		document.getElementById('monster_td4').style.marginTop="0px";
		document.getElementById('monster_td4').style.marginLeft="0px";
		document.getElementById('monster_td5').style.display="block";
	}
	
	if(values[35] == 1.1){	//har a
		document.getElementById('a_name4').style.color="green";
		document.getElementById('a4').style.color="green";
	} else if(values[35] == 0.9){
		document.getElementById('a_name4').style.color="red";
		document.getElementById('a4').style.color="red";
	}
	if(values[36] == 1.1){
		document.getElementById('d_name4').style.color="green";
		document.getElementById('d4').style.color="green";
	} else if(values[36] == 0.9){
		document.getElementById('d_name4').style.color="red";
		document.getElementById('d4').style.color="red";
	}
	if(values[37] == 1.1){
		document.getElementById('s_name4').style.color="green";
		document.getElementById('s4').style.color="green";
	} else if(values[37] == 0.9){
		document.getElementById('s_name4').style.color="red";
		document.getElementById('s4').style.color="red";
	}
	if(values[38] == 1.1){
		document.getElementById('sa_name4').style.color="green";
		document.getElementById('sa4').style.color="green";
	} else if(values[38] == 0.9){
		document.getElementById('sa_name4').style.color="red";
		document.getElementById('sa4').style.color="red";
	}
	if(values[39] == 1.1){
		document.getElementById('sd_name4').style.color="green";
		document.getElementById('sd4').style.color="green";
	} else if(values[39] == 0.9){
		document.getElementById('sd_name4').style.color="red";
		document.getElementById('sd4').style.color="red";
	}
}
</script>