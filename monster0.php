<!------------------------------------------ div0 -------------------------------------------------------------->
<div id="div0" style="display:none">
	<style>
		#menu0 {
			float: left;
			margin-top: -175px;
			margin-left: 200px;
		}
		.types {
			float: left;
			margin-top: -140px;
			margin-left: 200px;
			color:rgb(51, 51, 51);
			font-size:16px;
		}
		.start {
			float: left;
			margin-top: -45px;
			margin-left: 200px;
		}
		.gens {
			float: left;
			margin-top: -100px;
			margin-left: 200px;
			color:rgb(51, 51, 51);
			font-size:16px;
		}
		#stats_table0 th, #stats_table0 td{
			padding-left: 0px;
			padding-top: 0px;
		}
		#stats0 {
			float: left;
			margin-top: -145px;
			margin-left: 200px;
		}
		.ev {
			float: left;
			margin-top: 10px;
		}
		#atack_list0 th, #atack_list0 td {
			padding-left: 10px;
			padding-top: 10px;
		}
		#atacks0 {
			float: left;
			margin-top: -145px;
			margin-left: 190px;
		}
		.atack_link {
			text-decoration: none;
		}
		
		progress.hp_progress:after { 
		   content: attr(value);
		}	
		progress.a_progress:after { 
		   content: attr(value);
		}	
		progress.d_progress:after { 
		   content: attr(value);
		}
		progress.s_progress:after { 
		   content: attr(value);
		}
		progress.sa_progress:after { 
		   content: attr(value);
		}
		progress.sd_progress:after { 
		   content: attr(value);
		}	
		.types img {
			height: 35px; 
			width: 35px;
		}
		.atack_type{
			height: 35px; 
			width: 35px;
		}
		#tabs0, #tabs1, #tabs2 {
			margin-top: -40px;
		}
		#tabs3, #tabs4, #tabs5 {
			margin-top: -10px;
		}
		#stats0, #stats1, #stats2, #stats3, #stats4, #stats5 {
			padding-top: 10px;
		}
		#info0, #info1, #info2, #info3, #info4, #info5 {
			padding-top: 10px;
		}
		#atacks0, #atacks1, #atacks2, #atacks3, #atacks4, #atacks5 {
			padding-top: 5px;
		}
		progress {
			height: 20px;
		}
		.pluses_stats {
			height: 20px;
			margin-top: 15px;
			margin-left: 5px;
			line-height: 0.5 !important;
		}
		td {
			height: 31px;
		}
	</style>
	<div id="tabs0" <?php // if($anz_aktiv_monsters <= 3){ echo "style='margin:-10px -20px;'"; }?>>
		<div id="menu0">
			<img style='cursor: pointer;' src='img/info.png' onclick='showInfo(0)'>
			<img style='cursor: pointer;' src='img/stats.png' onclick='showStats(0)'>
			<img style='cursor: pointer;' src='img/atacks.png' onclick='showAtacks(0)'>
		</div>
		<div id="contents0">
			<div id="info0" style="display:none">
				<?php
				if($type2[0]>0){
					echo "<p class='types'>Type: <img src='img_type/$type1[0].png'> <img src='img_type/$type2[0].png'></p>";
				} else {
					echo "<p class='types'>Type: <img src='img_type/$type1[0].png'></p>";
				}
				if($start[0] != 1){
					for($i=0; $i<$anz_aktiv_monsters; $i++){
						if($start[$i] == 1) $m_start=$m_id[$i];	//else go through all monsters
					}
					$m0_start = array($m_id[0], $m_start);	//m_id, m_start
					$jsvar_m0_start = json_encode($m0_start);
					echo "<form method='POST' action='javascript:void(null);' onsubmit='ajax_make_start($jsvar_m0_start)'>";
						echo "<input class='btn btn-info start' type='submit' value='First Pick'>";
					echo "</form>";
				}
				?>
				<p class="gens">Gens: HP<?php echo "$hp_g[0]";?>A<?php echo "$a_g[0]";?>D<?php echo "$d_g[0]";?>S<?php echo "$s_g[0]";?>SA<?php echo "$sa_g[0]";?>SD<?php echo "$sd_g[0]";?></p>
				<!--<a href="javascript:start0();">Make first started</a>-->
			</div>
			<div id="stats0">
				<table id='stats_table0'>
					<tr>
						<td id="hp_name">HP: </td>
						<td id="hp"><div id='change_monsters0_stat_hp'><?php echo "$stat_hp[0]";?></div></td>
						<td><div id='change_hp_progress'><progress class='hp_progress' style='width: 126px;' value='<?php echo "$hp_ev[0]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m0_ev_array_hp1 = array($m_id[0], "Hp_Ev", 1);
								$m0_jsvar_hp1 = json_encode($m0_ev_array_hp1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_hp1";?>)'>
								<?php
								if($ev[0]> 0 && $hp_ev[0] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m0_ev_array_hp10 = array($m_id[0], "Hp_Ev", 10);
								$m0_jsvar_hp10 = json_encode($m0_ev_array_hp10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_hp10";?>)'>
								<?php
								if($ev[0]>= 10 && $hp_ev[0] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m0_ev_array_hp100 = array($m_id[0], "Hp_Ev", 100);
								$m0_jsvar_hp100 = json_encode($m0_ev_array_hp100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_hp100";?>)'>
								<?php
								if($ev[0]>= 100 && $hp_ev[0] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="a_name">A: </td>
						<td id="a"><div id='change_monsters0_stat_a'><?php echo "$stat_a[0]";?></div></td>
						<td><div id='change_a_progress'><progress class='a_progress' style='width: 126px;' value='<?php echo "$a_ev[0]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m0_ev_array_a1 = array($m_id[0], "A_Ev", 1);
								$m0_jsvar_a1 = json_encode($m0_ev_array_a1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_a1";?>)'>
								<?php
								if($ev[0]> 0 && $a_ev[0] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m0_ev_array_a10 = array($m_id[0], "A_Ev", 10);
								$m0_jsvar_a10 = json_encode($m0_ev_array_a10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_a10";?>)'>
								<?php
								if($ev[0]>= 10 && $a_ev[0] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m0_ev_array_a100 = array($m_id[0], "A_Ev", 100);
								$m0_jsvar_a100 = json_encode($m0_ev_array_a100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_a100";?>)'>
								<?php
								if($ev[0]>= 100 && $a_ev[0] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="d_name">D: </td>
						<td id="d"><div id='change_monsters0_stat_d'><?php echo "$stat_d[0]";?></div></td>
						<td><div id='change_d_progress'><progress class='d_progress' style='width: 126px;' value='<?php echo "$d_ev[0]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m0_ev_array_d1 = array($m_id[0], "D_Ev", 1);
								$m0_jsvar_d1 = json_encode($m0_ev_array_d1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_d1";?>)'>
								<?php
								if($ev[0]> 0 && $d_ev[0] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m0_ev_array_d10 = array($m_id[0], "D_Ev", 10);
								$m0_jsvar_d10 = json_encode($m0_ev_array_d10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_d10";?>)'>
								<?php
								if($ev[0]>= 10 && $d_ev[0] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m0_ev_array_d100 = array($m_id[0], "D_Ev", 100);
								$m0_jsvar_d100 = json_encode($m0_ev_array_d100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_d100";?>)'>
								<?php
								if($ev[0]>= 100 && $d_ev[0] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="s_name">S: </td>
						<td id="s"><div id='change_monsters0_stat_s'><?php echo "$stat_s[0]";?></div></td>
						<td><div id='change_s_progress'><progress class='s_progress' style='width: 126px;' value='<?php echo "$s_ev[0]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m0_ev_array_s1 = array($m_id[0], "S_Ev", 1);
								$m0_jsvar_s1 = json_encode($m0_ev_array_s1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_s1";?>)'>
								<?php
								if($ev[0]> 0 && $s_ev[0] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m0_ev_array_s10 = array($m_id[0], "S_Ev", 10);
								$m0_jsvar_s10 = json_encode($m0_ev_array_s10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_s10";?>)'>
								<?php
								if($ev[0]>= 10 && $s_ev[0] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m0_ev_array_s100 = array($m_id[0], "S_Ev", 100);
								$m0_jsvar_s100 = json_encode($m0_ev_array_s100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_s100";?>)'>
								<?php
								if($ev[0]>= 100 && $s_ev[0] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="sa_name">SA: </td>
						<td id="sa"><div id='change_monsters0_stat_sa'><?php echo "$stat_sa[0]";?></div></td>
						<td><div id='change_sa_progress'><progress class='sa_progress' style='width: 126px;' value='<?php echo "$sa_ev[0]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m0_ev_array_sa1 = array($m_id[0], "Sa_Ev", 1);
								$m0_jsvar_sa1 = json_encode($m0_ev_array_sa1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_sa1";?>)'>
								<?php
								if($ev[0]> 0 && $sa_ev[0] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m0_ev_array_sa10 = array($m_id[0], "Sa_Ev", 10);
								$m0_jsvar_sa10 = json_encode($m0_ev_array_sa10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_sa10";?>)'>
								<?php
								if($ev[0]>= 10 && $sa_ev[0] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m0_ev_array_sa100 = array($m_id[0], "Sa_Ev", 100);
								$m0_jsvar_sa100 = json_encode($m0_ev_array_sa100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_sa100";?>)'>
								<?php
								if($ev[0]>= 100 && $sa_ev[0] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td id="sd_name">SD: </td>
						<td id="sd"><div id='change_monsters0_stat_sd'><?php echo "$stat_sd[0]";?></div></td>
						<td><div id='change_sd_progress'><progress class='sd_progress' style='width: 126px;' value='<?php echo "$sd_ev[0]"; ?>' max='126'></progress></div></td>
						<td>
							<?php
								$m0_ev_array_sd1 = array($m_id[0], "Sd_Ev", 1);
								$m0_jsvar_sd1 = json_encode($m0_ev_array_sd1);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_sd1";?>)'>
								<?php
								if($ev[0]> 0 && $sd_ev[0] < 126){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+1'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m0_ev_array_sd10 = array($m_id[0], "Sd_Ev", 10);
								$m0_jsvar_sd10 = json_encode($m0_ev_array_sd10);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_sd10";?>)'>
								<?php
								if($ev[0]>= 10 && $sd_ev[0] <= 116){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+10'/>
								<?php
								}
								?>
							</form>
						</td>
						<td>
							<?php
								$m0_ev_array_sd100 = array($m_id[0], "Sd_Ev", 100);
								$m0_jsvar_sd100 = json_encode($m0_ev_array_sd100);
							?>
							<form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo "$m0_jsvar_sd100";?>)'>
								<?php
								if($ev[0]>= 100 && $sd_ev[0] <= 26){
								?>
									<input class="btn btn-info pluses_stats" type='submit' value='+100'/>
								<?php
								}
								?>
							</form>
						</td>
					</tr>
				</table>
				<h1 class="ev"><strong><div id='result_ev'>EV: <?php echo "$ev[0]";?></div></strong></h2>
			</div>
			<div id="atacks0" style="display:none">
				<?php
				/************************************Attacks**************************************************************/
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a1[0]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m0_a1_pp1[] = $aRow["Pp"];
					$m0_a1_type1[] = $aRow["Type"];
					$m0_a1_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a2[0]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m0_a2_pp2[] = $aRow["Pp"];
					$m0_a2_type2[] = $aRow["Type"];
					$m0_a2_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a3[0]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m0_a3_pp3[] = $aRow["Pp"];
					$m0_a3_type3[] = $aRow["Type"];
					$m0_a3_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				$query = "SELECT Pp, Type, Category FROM atack_list WHERE Name='$a4[0]'";	
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m0_a4_pp4[] = $aRow["Pp"];
					$m0_a4_type4[] = $aRow["Type"];
					$m0_a4_category[] = $aRow["Category"];
				}
				mysql_free_result($result);
				echo "<table id='atack_list0'>";
					echo "<tr>";
						echo "<td><img class='atack_type' src='img_type/$m0_a1_type1[0].png'></td>";	
						?>
						<td><div <?php if($m0_a1_category[0] == 1) echo "style='color: red;'"; if($m0_a1_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a1[0]"; ?></div><?php echo "$m0_a1_pp1[0]/$a1_pp[0]";?></td>
						<?php
						echo "<td><img class='atack_type' src='img_type/$m0_a2_type2[0].png'></td>";	
						?>
						<td><div <?php if($m0_a2_category[0] == 1) echo "style='color: red;'"; if($m0_a2_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a2[0]"; ?></div><?php echo "$m0_a2_pp2[0]/$a2_pp[0]";?></td>
						<?php
					echo "</tr>";
					echo "<tr>";
						echo "<td><img class='atack_type' src='img_type/$m0_a3_type3[0].png'></td>";	
						?>
						<td><div <?php if($m0_a3_category[0] == 1) echo "style='color: red;'"; if($m0_a3_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a3[0]"; ?></div><?php echo "$m0_a3_pp3[0]/$a3_pp[0]";?></td>
						<?php
						echo "<td><img class='atack_type' src='img_type/$m0_a4_type4[0].png'></td>";	
						?>
						<td><div <?php if($m0_a4_category[0] == 1) echo "style='color: red;'"; if($m0_a4_category[0] == 2) echo"style='color: blue;'";?> > <?php echo "$a4[0]"; ?></div><?php echo "$m0_a4_pp4[0]/$a4_pp[0]";?></td>
						<?php
					echo "</tr>";
				echo "</table>";
				?>
			</div>
		</div>
	</div>
</div>
<script>
	//Monster 0
	function m1_a1() {
		document.getElementById('pop_m1_a1').style.display="block";
		document.getElementById('pop_m1_a2').style.display="none";
		document.getElementById('pop_m1_a3').style.display="none";
		document.getElementById('pop_m1_a4').style.display="none";
	}
	function m1_a2() {
		document.getElementById('pop_m1_a1').style.display="none";
		document.getElementById('pop_m1_a2').style.display="block";
		document.getElementById('pop_m1_a3').style.display="none";
		document.getElementById('pop_m1_a4').style.display="none";
	}
	function m1_a3() {
		document.getElementById('pop_m1_a1').style.display="none";
		document.getElementById('pop_m1_a2').style.display="none";
		document.getElementById('pop_m1_a3').style.display="block";
		document.getElementById('pop_m1_a4').style.display="none";
	}
	function m1_a4() {
		document.getElementById('pop_m1_a1').style.display="none";
		document.getElementById('pop_m1_a2').style.display="none";
		document.getElementById('pop_m1_a3').style.display="none";
		document.getElementById('pop_m1_a4').style.display="block";
	}
	function ChangeContent0(values) {	//values[40] == anz aktive monsters
		if(document.getElementById('div0').style.display == "none"){
			document.getElementById('div0').style.display="block";
			if(values[40] >= 2) document.getElementById('monster_td1').style.display="none";
			if(values[40] >= 3) document.getElementById('monster_td2').style.display="none";
			if(values[40] >= 4) document.getElementById('monster_td3').style.display="none";
			if(values[40] >= 5) document.getElementById('monster_td4').style.display="none";
			if(values[40] >= 6) document.getElementById('monster_td5').style.display="none";
		} else {
			document.getElementById('div0').style.display="none";
			if(values[40] >= 2) document.getElementById('monster_td1').style.display="block";
			if(values[40] >= 3) document.getElementById('monster_td2').style.display="block";
			if(values[40] >= 4) document.getElementById('monster_td3').style.display="block";
			if(values[40] >= 5) document.getElementById('monster_td4').style.display="block";
			if(values[40] >= 6) document.getElementById('monster_td5').style.display="block";
		}
		
		if(values[35] == 1.1){	//har a
			document.getElementById('a_name').style.color="green";
			document.getElementById('a').style.color="green";
		} else if(values[35] == 0.9){
			document.getElementById('a_name').style.color="red";
			document.getElementById('a').style.color="red";
		}
		if(values[36] == 1.1){
			document.getElementById('d_name').style.color="green";
			document.getElementById('d').style.color="green";
		} else if(values[36] == 0.9){
			document.getElementById('d_name').style.color="red";
			document.getElementById('d').style.color="red";
		}
		if(values[37] == 1.1){
			document.getElementById('s_name').style.color="green";
			document.getElementById('s').style.color="green";
		} else if(values[37] == 0.9){
			document.getElementById('s_name').style.color="red";
			document.getElementById('s').style.color="red";
		}
		if(values[38] == 1.1){
			document.getElementById('sa_name').style.color="green";
			document.getElementById('sa').style.color="green";
		} else if(values[38] == 0.9){
			document.getElementById('sa_name').style.color="red";
			document.getElementById('sa').style.color="red";
		}
		if(values[39] == 1.1){
			document.getElementById('sd_name').style.color="green";
			document.getElementById('sd').style.color="green";
		} else if(values[39] == 0.9){
			document.getElementById('sd_name').style.color="red";
			document.getElementById('sd').style.color="red";
		}
	}
</script>