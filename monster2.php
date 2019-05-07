<!------------------------------------------ div2 -------------------------------------------------------------->
<div id="div2" style="display:none">
	<style>
	#menu2 {
		float: left;
		margin-top: -175px;
		margin-left: 200px;
	}
	#stats_table2 th, #stats_table2 td{
		padding-left: 0px;
		padding-top: 0px;
	}
	#stats2 {
		float: left;
		margin-top: -145px;
		margin-left: 200px;
	}
	#atack_list2 th, #atack_list2 td {
		padding-left: 10px;
		padding-top: 10px;
	}
	#atacks2 {
		float: left;
		margin-top: -145px;
		margin-left: 190px;
	}
	
	progress.hp_progress2:after { 
	   content: attr(value);
	}	
	progress.a_progress2:after { 
	   content: attr(value);
	}	
	progress.d_progress2:after { 
	   content: attr(value);
	}
	progress.s_progress2:after { 
	   content: attr(value);
	}
	progress.sa_progress2:after { 
	   content: attr(value);
	}
	progress.sd_progress2:after { 
	   content: attr(value);
	}			
	</style>
	<div id="tabs2" <?php if($anz_aktiv_monsters <= 3){ echo "style='margin:-10 -20;'"; }?>>
		<div id="menu2">
			<img style='cursor: pointer;' src='img/info.png' onclick='showInfo(2)'>
			<img style='cursor: pointer;' src='img/stats.png' onclick='showStats(2)'>
			<img style='cursor: pointer;' src='img/atacks.png' onclick='showAtacks(2)'>
		</div>
		<div id="contents2">
			<div id="info2" style="display:none">
				<?php
				if($type2[2]>0){
					echo "<p class='types'>Type: <img src='img_type/$type1[2].png'> <img src='img_type/$type2[2].png'></p>";
				} else {
					echo "<p class='types'>Type: <img src='img_type/$type1[2].png'></p>";
				}
				if($start[2] != 1){
					for($i=0; $i<$anz_aktiv_monsters; $i++){
						if($start[$i] == 1) $m_start=$m_id[$i];
					}
					$m2_start = array($m_id[2], $m_start);	//m_id, m_start
					$jsvar_m2_start = json_encode($m2_start);
					echo "<form method='POST' action='javascript:void(null);' onsubmit='ajax_make_start($jsvar_m2_start)'>";
						echo "<input class='btn btn-info start' type='submit' value='First Pick'>";
					echo "</form>";
				}
				?>
				<p class="gens">Gens: HP<?php echo "$hp_g[2]";?>A<?php echo "$a_g[2]";?>D<?php echo "$d_g[2]";?>S<?php echo "$s_g[2]";?>SA<?php echo "$sa_g[2]";?>SD<?php echo "$sd_g[2]";?></p>
			</div>
			<div id="stats2">
				<table id='stats_table2'>
					<tr>
						<td id="hp_name2">HP: </td>
						<td id="hp2"><div id='change_monsters2_stat_hp'><?php echo "$stat_hp[2]";?></div></td>
						<td><div id='change_hp_progress2'><progress class='hp_progress2' style='width: 126px;' value='<?php echo "$hp_ev[2]"; ?>' max='126'></progress></div></td>
						<td>
						<?php
							$m2_ev_array_hp1 = array($m_id[2], "Hp_Ev", 1);
							$m2_jsvar_hp1 = json_encode($m2_ev_array_hp1);
						?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_hp1";?>)'>
								<?php
								if($ev[2]> 0 && $hp_ev[2] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
						<?php
							$m2_ev_array_hp10 = array($m_id[2], "Hp_Ev", 10);
							$m2_jsvar_hp10 = json_encode($m2_ev_array_hp10);
						?>
						<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_hp10";?>)'>
								<?php
								if($ev[2]>= 10 && $hp_ev[2] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m2_ev_array_hp100 = array($m_id[2], "Hp_Ev", 100);
								$m2_jsvar_hp100 = json_encode($m2_ev_array_hp100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_hp100";?>)'>
								<?php
								if($ev[2]>= 100 && $hp_ev[2] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>		
					</tr>
					<tr>
						<td id="a_name2">A: </td>
						<td id="a2"><div id='change_monsters2_stat_a'><?php echo "$stat_a[2]";?></div></td>
						<td><div id='change_a_progress2'><progress class='a_progress2' style='width: 126px;' value='<?php echo "$a_ev[2]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m2_ev_array_a1 = array($m_id[2], "A_Ev", 1);
								$m2_jsvar_a1 = json_encode($m2_ev_array_a1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_a1";?>)'>
								<?php
								if($ev[2]> 0 && $a_ev[2] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m2_ev_array_a10 = array($m_id[2], "A_Ev", 10);
								$m2_jsvar_a10 = json_encode($m2_ev_array_a10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_a10";?>)'>
								<?php
								if($ev[2]>= 10 && $a_ev[2] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m2_ev_array_a100 = array($m_id[2], "A_Ev", 100);
								$m2_jsvar_a100 = json_encode($m2_ev_array_a100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_a100";?>)'>
								<?php
								if($ev[2]>= 100 && $a_ev[2] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="d_name2">D: </td>
						<td id="d2"><div id='change_monsters2_stat_d'><?php echo "$stat_d[2]";?></div></td>
						<td><div id='change_d_progress2'><progress class='d_progress2' style='width: 126px;' value='<?php echo "$d_ev[2]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m2_ev_array_d1 = array($m_id[2], "D_Ev", 1);
								$m2_jsvar_d1 = json_encode($m2_ev_array_d1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_d1";?>)'>
								<?php
								if($ev[2]> 0 && $d_ev[2] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m2_ev_array_d10 = array($m_id[2], "D_Ev", 10);
								$m2_jsvar_d10 = json_encode($m2_ev_array_d10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_d10";?>)'>
								<?php
								if($ev[2]>= 10 && $d_ev[2] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m2_ev_array_d100 = array($m_id[2], "D_Ev", 100);
								$m2_jsvar_d100 = json_encode($m2_ev_array_d100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_d100";?>)'>
								<?php
								if($ev[2]>= 100 && $d_ev[2] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="s_name2">S: </td>
						<td id="s2"><div id='change_monsters2_stat_s'><?php echo "$stat_s[2]";?></div></td>
						<td><div id='change_s_progress2'><progress class='s_progress2' style='width: 126px;' value='<?php echo "$s_ev[2]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m2_ev_array_s1 = array($m_id[2], "S_Ev", 1);
								$m2_jsvar_s1 = json_encode($m2_ev_array_s1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_s1";?>)'>
								<?php
								if($ev[2]> 0 && $s_ev[2] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m2_ev_array_s10 = array($m_id[2], "S_Ev", 10);
								$m2_jsvar_s10 = json_encode($m2_ev_array_s10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_s10";?>)'>
								<?php
								if($ev[2]>= 10 && $s_ev[2] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m2_ev_array_s100 = array($m_id[2], "S_Ev", 100);
								$m2_jsvar_s100 = json_encode($m2_ev_array_s100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_s100";?>)'>
								<?php
								if($ev[2]>= 100 && $s_ev[2] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="sa_name2">SA: </td>
						<td id="sa2"><div id='change_monsters2_stat_sa'><?php echo "$stat_sa[2]";?></div></td>
						<td><div id='change_sa_progress2'><progress class='sa_progress2' style='width: 126px;' value='<?php echo "$sa_ev[2]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m2_ev_array_sa1 = array($m_id[2], "Sa_Ev", 1);
								$m2_jsvar_sa1 = json_encode($m2_ev_array_sa1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_sa1";?>)'>
								<?php
								if($ev[2]> 0 && $sa_ev[2] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m2_ev_array_sa10 = array($m_id[2], "Sa_Ev", 10);
								$m2_jsvar_sa10 = json_encode($m2_ev_array_sa10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_sa10";?>)'>
								<?php
								if($ev[2]>= 10 && $sa_ev[2] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m2_ev_array_sa100 = array($m_id[2], "Sa_Ev", 100);
								$m2_jsvar_sa100 = json_encode($m2_ev_array_sa100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_sa100";?>)'>
								<?php
								if($ev[2]>= 100 && $sa_ev[2] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="sd_name2">SD: </td>
						<td id="sd2"><div id='change_monsters2_stat_sd'><?php echo "$stat_sd[2]";?></div></td>
						<td><div id='change_sd_progress2'><progress class='sd_progress2' style='width: 126px;' value='<?php echo "$sd_ev[2]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m2_ev_array_sd1 = array($m_id[2], "Sd_Ev", 1);
								$m2_jsvar_sd1 = json_encode($m2_ev_array_sd1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_sd1";?>)'>
								<?php
								if($ev[2]> 0 && $sd_ev[2] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m2_ev_array_sd10 = array($m_id[2], "Sd_Ev", 10);
								$m2_jsvar_sd10 = json_encode($m2_ev_array_sd10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_sd10";?>)'>
								<?php
								if($ev[2]>= 10 && $sd_ev[2] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m2_ev_array_sd100 = array($m_id[2], "Sd_Ev", 100);
								$m2_jsvar_sd100 = json_encode($m2_ev_array_sd100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m2_jsvar_sd100";?>)'>
								<?php
								if($ev[2]>= 100 && $sd_ev[2] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
				</table>
				<h1 class="ev"><strong>EV: <?php echo "$ev[2]";?></strong></h2>
			</div>
			<div id="atacks2" style="display:none">
				<?php
				/************************************Attacks**************************************************************/
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a1[2]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m2_a1_pp1[] = $aRow["Pp"];
					$m2_a1_type1[] = $aRow["Type"];
					$m2_a1_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a2[2]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m2_a2_pp2[] = $aRow["Pp"];
					$m2_a2_type2[] = $aRow["Type"];
					$m2_a2_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a3[2]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m2_a3_pp3[] = $aRow["Pp"];
					$m2_a3_type3[] = $aRow["Type"];
					$m2_a3_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a4[2]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m2_a4_pp4[] = $aRow["Pp"];
					$m2_a4_type4[] = $aRow["Type"];
					$m2_a4_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				echo "<table id='atack_list2'>";
					echo "<tr>";
						echo "<td><img class='atack_type' src='img_type/$m2_a1_type1[0].png'></td>";	
						?>
						<td><div <?php if($m2_a1_category[0] == 1) echo "style='color: red;'"; if($m2_a1_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a1[2]"; ?></div><?php echo "$m2_a1_pp1[0]/$a1_pp[2]";?></td>
						<?php
						echo "<td><img class='atack_type' src='img_type/$m2_a2_type2[0].png'></td>";	
						?>
						<td><div <?php if($m2_a2_category[0] == 1) echo "style='color: red;'"; if($m2_a2_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a2[2]"; ?></div><?php echo "$m2_a2_pp2[0]/$a2_pp[2]";?></td>
						<?php
					echo "</tr>";
					echo "<tr>";
						echo "<td><img class='atack_type' src='img_type/$m2_a3_type3[0].png'></td>";	
						?>
						<td><div <?php if($m2_a3_category[0] == 1) echo "style='color: red;'"; if($m2_a3_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a3[2]"; ?></div><?php echo "$m2_a3_pp3[0]/$a3_pp[2]";?></td>
						<?php
						echo "<td><img class='atack_type' src='img_type/$m2_a4_type4[0].png'></td>";	
						?>
						<td><div <?php if($m2_a4_category[0] == 1) echo "style='color: red;'"; if($m2_a4_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a4[2]"; ?></div><?php echo "$m2_a4_pp4[0]/$a4_pp[2]";?></td>
						<?php
					echo "</tr>";
				echo "</table>";
				?>
			</div>
		</div>
	</div>
</div>
<script>	
//Monster 2
function m3_a1() {
	document.getElementById('pop_m3_a1').style.display="block";
	document.getElementById('pop_m3_a2').style.display="none";
	document.getElementById('pop_m3_a3').style.display="none";
	document.getElementById('pop_m3_a4').style.display="none";
}
function m3_a2() {
	document.getElementById('pop_m3_a1').style.display="none";
	document.getElementById('pop_m3_a2').style.display="block";
	document.getElementById('pop_m3_a3').style.display="none";
	document.getElementById('pop_m3_a4').style.display="none";
}
function m3_a3() {
	document.getElementById('pop_m3_a1').style.display="none";
	document.getElementById('pop_m3_a2').style.display="none";
	document.getElementById('pop_m3_a3').style.display="block";
	document.getElementById('pop_m3_a4').style.display="none";
}
function m3_a4() {
	document.getElementById('pop_m3_a1').style.display="none";
	document.getElementById('pop_m3_a2').style.display="none";
	document.getElementById('pop_m3_a3').style.display="none";
	document.getElementById('pop_m3_a4').style.display="block";
}

function ChangeContent2(values) {
	if(document.getElementById('div2').style.display == "none"){
		document.getElementById('div2').style.display="block";
		document.getElementById('monster_td0').style.display="none";
		document.getElementById('monster_td1').style.display="none";
		document.getElementById('monster_td2').style.marginLeft="-56px";
		document.getElementById('monster_td3').style.display="none";
		document.getElementById('monster_td4').style.display="none";
		document.getElementById('monster_td5').style.display="none";
	} else {
		document.getElementById('div2').style.display="none";
		document.getElementById('monster_td0').style.display="block";
		document.getElementById('monster_td1').style.display="block";
		document.getElementById('monster_td2').style.marginLeft="0px";
		document.getElementById('monster_td3').style.display="block";
		document.getElementById('monster_td4').style.display="block";
		document.getElementById('monster_td5').style.display="block";
	}
	
	if(values[35] == 1.1){	//har a
		document.getElementById('a_name2').style.color="green";
		document.getElementById('a2').style.color="green";
	} else if(values[35] == 0.9){
		document.getElementById('a_name2').style.color="red";
		document.getElementById('a2').style.color="red";
	}
	if(values[36] == 1.1){
		document.getElementById('d_name2').style.color="green";
		document.getElementById('d2').style.color="green";
	} else if(values[36] == 0.9){
		document.getElementById('d_name2').style.color="red";
		document.getElementById('d2').style.color="red";
	}
	if(values[37] == 1.1){
		document.getElementById('s_name2').style.color="green";
		document.getElementById('s2').style.color="green";
	} else if(values[37] == 0.9){
		document.getElementById('s_name2').style.color="red";
		document.getElementById('s2').style.color="red";
	}
	if(values[38] == 1.1){
		document.getElementById('sa_name2').style.color="green";
		document.getElementById('sa2').style.color="green";
	} else if(values[38] == 0.9){
		document.getElementById('sa_name2').style.color="red";
		document.getElementById('sa2').style.color="red";
	}
	if(values[39] == 1.1){
		document.getElementById('sd_name2').style.color="green";
		document.getElementById('sd2').style.color="green";
	} else if(values[39] == 0.9){
		document.getElementById('sd_name2').style.color="red";
		document.getElementById('sd2').style.color="red";
	}
}
</script>