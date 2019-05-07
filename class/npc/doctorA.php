<style>
	#doctorA {
		text-align: right;
	}
	#pop_doctorA {
		overflow: auto;
		height: 500px;
		width: 580px;
		border:2px solid;
		padding:10px;
		background:rgb(103 204 114);
		border-radius:9px;
		display:none;
		text-align: left;
		z-index: 1;
		position: absolute;
		left: 0;
		right: 0;
		margin: 0 auto;
		margin-top: -30px;
	}
	#close_pop_doctorA {
		right:5px;
		top:5;
		float:right;
	}
	.heal_button img {
		height: 25px;
		width: 25px;
	}
	.heal_button {
		text-align: center;
	}
	.b_location {
		width: 250px;
	}
</style>
<div id='doctorA'>
	<button style='margin-right: 100px;'class="btn btn-info b_location" type="button" onclick="document.getElementById('pop_doctorA').style.display='block';">Doctor A</button>
	<div id='pop_doctorA'>
		<button class="close" aria-label="Close" id='close_pop_doctorA' onclick="document.getElementById('pop_doctorA').style.display='none'"><span aria-hidden="true">&times;</span></button><br>
		<?php
			$query = "SELECT M_ID, M_Name, Lvl, C_Hp, Hp FROM monsters WHERE M_Owner='$aNickName' AND Aktiv='1' ORDER BY M_ID";
			$result = mysql_query($query) or die("Query failed : " . mysql_error());
			while ($aRow = mysql_fetch_array($result)) {
				$m_id_d[] = $aRow["M_ID"];
				$m_name_d[] = $aRow["M_Name"];
				$m_lvl_d[] = $aRow["Lvl"];
				$c_hp_d[] = $aRow["C_Hp"];
				$m_hp_d[] = $aRow["Hp"];
			}
			
			$heal_mon = array();
			
			if (mysql_num_rows($result)==0){	//check if result empty
				$anz_aktiv_monster_d = 0;
			} else {
				$anz_aktiv_monster_d = count($m_hp_d);
			}
			
			mysql_free_result($result);
			
			if($anz_aktiv_monster_d == 0){
				echo "Hi there, I am very glad to see your healthy monsters!";
			} else {
				echo "<table class='table' id='doctorATable' style='background:rgb(103 204 114);'>";
				echo "<tr>";
					echo "<th>Name</th>";
					echo "<th>Level</th>";
					echo "<th>Hp</th>";
					echo "<th>Recover</th>";
				echo "</tr>";
				
				for($i=0; $i<$anz_aktiv_monster_d; $i++){
					echo "<tr>";
						echo "<td>$m_name_d[$i]</td>";
						echo "<td>$m_lvl_d[$i]</td>";
						echo "<td>$c_hp_d[$i] out of $m_hp_d[$i]</td>";
						if(($i == 0) && (($c_hp_d[$i] != $m_hp_d[$i]) || ($m0_a1_pp1[0] != $a1_pp[$i]) || ($m0_a2_pp2[0] != $a2_pp[$i]) || ($m0_a3_pp3[0] != $a3_pp[$i]) || ($m0_a4_pp4[0] != $a4_pp[$i]))){
							$ar_heal_pp[$i] = array($m_id_d[$i], $m_hp_d[$i], $m0_a1_pp1[0], $m0_a2_pp2[0], $m0_a3_pp3[0], $m0_a4_pp4[0]);
							$jsvar_heal_pp0 = json_encode($ar_heal_pp[$i]);
							echo "<td class='heal_button'><img style='cursor: pointer;' src='img/plus.png' onclick='ajax_heal_hp_pp($jsvar_heal_pp0)'></td>";
							$heal_mon[] = $jsvar_heal_pp0;	//collecting data to array
						}
						if(($i == 1) && (($c_hp_d[$i] != $m_hp_d[$i]) || ($m1_a1_pp1[0] != $a1_pp[$i]) || ($m1_a2_pp2[0] != $a2_pp[$i]) || ($m1_a3_pp3[0] != $a3_pp[$i]) || ($m1_a4_pp4[0] != $a4_pp[$i]))){
							$ar_heal_pp[$i] = array($m_id_d[$i], $m_hp_d[$i], $m1_a1_pp1[0], $m1_a2_pp2[0], $m1_a3_pp3[0], $m1_a4_pp4[0]);
							$jsvar_heal_pp1 = json_encode($ar_heal_pp[$i]);
							echo "<td class='heal_button'><img style='cursor: pointer;' src='img/plus.png' onclick='ajax_heal_hp_pp($jsvar_heal_pp1)'></td>";
							$heal_mon[] = $jsvar_heal_pp1;
						}
						if(($i == 2) && (($c_hp_d[$i] != $m_hp_d[$i]) || ($m2_a1_pp1[0] != $a1_pp[$i]) || ($m2_a2_pp2[0] != $a2_pp[$i]) || ($m2_a3_pp3[0] != $a3_pp[$i]) || ($m2_a4_pp4[0] != $a4_pp[$i]))){
							$ar_heal_pp[$i] = array($m_id_d[$i], $m_hp_d[$i], $m2_a1_pp1[0], $m2_a2_pp2[0], $m2_a3_pp3[0], $m2_a4_pp4[0]);
							$jsvar_heal_pp2 = json_encode($ar_heal_pp[$i]);
							echo "<td class='heal_button'><img style='cursor: pointer;' src='img/plus.png' onclick='ajax_heal_hp_pp($jsvar_heal_pp2)'></td>";
							$heal_mon[] = $jsvar_heal_pp2;
						}
						if(($i == 3) && (($c_hp_d[$i] != $m_hp_d[$i]) || ($m3_a1_pp1[0] != $a1_pp[$i]) || ($m3_a2_pp2[0] != $a2_pp[$i]) || ($m3_a3_pp3[0] != $a3_pp[$i]) || ($m3_a4_pp4[0] != $a4_pp[$i]))){
							$ar_heal_pp[$i] = array($m_id_d[$i], $m_hp_d[$i], $m3_a1_pp1[0], $m3_a2_pp2[0], $m3_a3_pp3[0], $m3_a4_pp4[0]);
							$jsvar_heal_pp3 = json_encode($ar_heal_pp[$i]);
							echo "<td class='heal_button'><img style='cursor: pointer;' src='img/plus.png' onclick='ajax_heal_hp_pp($jsvar_heal_pp3)'></td>";
							$heal_mon[] = $jsvar_heal_pp3;
						}
						if(($i == 4) && (($c_hp_d[$i] != $m_hp_d[$i]) || ($m4_a1_pp1[0] != $a1_pp[$i]) || ($m4_a2_pp2[0] != $a2_pp[$i]) || ($m4_a3_pp3[0] != $a3_pp[$i]) || ($m4_a4_pp4[0] != $a4_pp[$i]))){
							$ar_heal_pp[$i] = array($m_id_d[$i], $m_hp_d[$i], $m4_a1_pp1[0], $m4_a2_pp2[0], $m4_a3_pp3[0], $m4_a4_pp4[0]);
							$jsvar_heal_pp4 = json_encode($ar_heal_pp[$i]);
							echo "<td class='heal_button'><img style='cursor: pointer;' src='img/plus.png' onclick='ajax_heal_hp_pp($jsvar_heal_pp4)'></td>";
							$heal_mon[] = $jsvar_heal_pp4;
						}
						if(($i == 5) && (($c_hp_d[$i] != $m_hp_d[$i]) || ($m5_a1_pp1[0] != $a1_pp[$i]) || ($m5_a2_pp2[0] != $a2_pp[$i]) || ($m5_a3_pp3[0] != $a3_pp[$i]) || ($m5_a4_pp4[0] != $a4_pp[$i]))){
							$ar_heal_pp[$i] = array($m_id_d[$i], $m_hp_d[$i], $m5_a1_pp1[0], $m5_a2_pp2[0], $m5_a3_pp3[0], $m5_a4_pp4[0]);
							$jsvar_heal_pp5 = json_encode($ar_heal_pp[$i]);
							echo "<td class='heal_button'><img style='cursor: pointer;' src='img/plus.png' onclick='ajax_heal_hp_pp($jsvar_heal_pp5)'></td>";
							$heal_mon[] = $jsvar_heal_pp5;
						}
					echo "</tr>";
				} 
				echo "<td colspan='3'>HEAL ALL</td>";
				if(empty($heal_mon) != true){
					$anz_heal_mon = count($heal_mon);
					if($anz_heal_mon == 1) echo "<td class='heal_button'><img style='cursor: pointer;' src='img/plus.png' onclick='ajax_heal_hp_pp($heal_mon[0])'></td>";
					if($anz_heal_mon == 2) echo "<td class='heal_button'><img style='cursor: pointer;' src='img/plus.png' onclick='ajax_heal_hp_pp($heal_mon[0]);ajax_heal_hp_pp($heal_mon[1]);'></td>";
					if($anz_heal_mon == 3) echo "<td class='heal_button'><img style='cursor: pointer;' src='img/plus.png' onclick='ajax_heal_hp_pp($heal_mon[0]);ajax_heal_hp_pp($heal_mon[1]);ajax_heal_hp_pp($heal_mon[2]);'></td>";
					if($anz_heal_mon == 4) echo "<td class='heal_button'><img style='cursor: pointer;' src='img/plus.png' onclick='ajax_heal_hp_pp($heal_mon[0]);ajax_heal_hp_pp($heal_mon[1]);ajax_heal_hp_pp($heal_mon[2]);ajax_heal_hp_pp($heal_mon[3]);'></td>";
					if($anz_heal_mon == 5) echo "<td class='heal_button'><img style='cursor: pointer;' src='img/plus.png' onclick='ajax_heal_hp_pp($heal_mon[0]);ajax_heal_hp_pp($heal_mon[1]);ajax_heal_hp_pp($heal_mon[2]);ajax_heal_hp_pp($heal_mon[3]);ajax_heal_hp_pp($heal_mon[4]);'></td>";
					if($anz_heal_mon == 6) echo "<td class='heal_button'><img style='cursor: pointer;' src='img/plus.png' onclick='ajax_heal_hp_pp($heal_mon[0]);ajax_heal_hp_pp($heal_mon[1]);ajax_heal_hp_pp($heal_mon[2]);ajax_heal_hp_pp($heal_mon[3]);ajax_heal_hp_pp($heal_mon[4]);ajax_heal_hp_pp($heal_mon[5]);'></td>";
				}
				echo "</table>";
			}
			echo "<hr style='margin-top: -5px;border-top: 1px solid rgb(103 204 114);'>";
			echo "<img style='height: 150px; width: 150px;' src='img_characters/doctorA.png'>";
			/*Lager*/
			echo "<div id='div_deactivate' style='position: absolute; margin-left: 150px; margin-top: -180px;'>";
				echo "<p style='font-size: 16px; color: rgb(51, 51, 51);'>Deactivate:</p>";
				echo "<ul id='doctorAUnorderedList'>";
					for($i=0; $i<$anz_aktiv_monster_d; $i++){
						$ar_deactivate_mon[$i] = array($m_id_d[$i]);
						$jsvar_deactivate_mon = json_encode($ar_deactivate_mon[$i]);
						echo "<li><button class='btn btn-info' onclick='ajax_deactivate_mon($jsvar_deactivate_mon)'>$m_name_d[$i]</button></li>";
					}
				echo "</ul>";
			echo "</div>";
			$query = "SELECT M_ID, M_Name FROM monsters WHERE M_Owner='$aNickName' AND Aktiv='0' ORDER BY M_ID";
			$result = mysql_query($query) or die("Query failed : " . mysql_error());
			while ($aRow = mysql_fetch_array($result)) {
				$m_id_activate[] = $aRow["M_ID"];
				$m_name_activate[] = $aRow["M_Name"];
			}
			if (mysql_num_rows($result)==0){	//check if result empty
				$anz_deaktiv_monster = 0;
			} else {
				$anz_deaktiv_monster = count($m_id_activate);
			}
			//Dont activate if monsters are 6
			$result=mysql_query("SELECT count(*) as Anz_Aktiv_Mon FROM monsters WHERE M_Owner='$aNickName' AND Aktiv='1'");
			$anz_aktivierte_mon=mysql_fetch_assoc($result);
			//echo $anz_aktivierte_mon['Anz_Aktiv_Mon'];
			echo "<div id='div_activate' style='position: absolute; margin-left: 350px; margin-top: -180px;'>";
				echo "<p style='font-size: 16px; color: rgb(51, 51, 51);'>Activate:</p>";
				if($anz_aktivierte_mon['Anz_Aktiv_Mon'] < 6){
					echo "<ol id='doctorAOrderedList'>";
						for($j=0; $j<$anz_deaktiv_monster; $j++){
							$ar_activate_mon[$j] = array($m_id_activate[$j]);
							$jsvar_activate_mon = json_encode($ar_activate_mon[$j]);
							echo "<li><button class='btn btn-info' style='color: green; border: 1px solid green;' onclick='ajax_activate_mon($jsvar_activate_mon)'>$m_name_activate[$j]</button></li>";
						}
					echo "</ol>";
				} else {
					echo "<ol id='doctorAOrderedList'>";
						for($j=0; $j<$anz_deaktiv_monster; $j++){
							$ar_activate_mon[$j] = array($m_id_activate[$j]);
							$jsvar_activate_mon = json_encode($ar_activate_mon[$j]);
							echo "<li style='font-size: 16px;'>$m_name_activate[$j]</li>";
						}
					echo "</ol>";
				}
			echo "</div>";
		?>
	</div>
</div>
<script>
	function ajax_heal_hp_pp(values){ /*m_id_d, max_hp, max_pp1, max_pp2, max_pp3, max_pp4*/
		$.ajax({
			type: 'POST',
			url: 'forms/doctorA_res.php',
			data: 'm_id_d='+values[0]+'&max_hp='+values[1]+'&max_pp1='+values[2]+'&max_pp2='+values[3]+'&max_pp3='+values[4]+'&max_pp4='+values[5],
			success: function( msg ) {
				//alert( "Monster heald!"+values[0]+" "+values[1]+" "+values[2]+" "+values[3]+" "+values[4]+" "+values[5]);
			}
		});
		$('#profile_content').load(document.URL +  ' #profile_content');
		$('#doctorATable').load(document.URL +  ' #doctorATable');
		$('#monster_content').load(document.URL +  ' #monster_content');
		$('#tabs').load(document.URL +  ' #tabs');
		$('#forest_main').load(document.URL +  ' #forest_main');
	}
	function ajax_deactivate_mon(values){
		$.ajax({
			type: 'POST',
			url: 'forms/doctorA_deaktivate_mon.php',
			data: 'm_id_deaktivate='+values[0],
			success: function( msg ) {
				//alert( "Monster id="+values[0]+" deaktiviert");
			}
		});
		$('#profile_content').load(document.URL +  ' #profile_content');
		$('#doctorATable').load(document.URL +  ' #doctorATable');
		$('#doctorAUnorderedList').load(document.URL +  ' #doctorAUnorderedList');
		$('#doctorAOrderedList').load(document.URL +  ' #doctorAOrderedList');
		$('#campTable').load(document.URL +  ' #campTable');
		$('#monster_content').load(document.URL +  ' #monster_content');
		$('#tabs').load(document.URL +  ' #tabs');
		$('#forest_main').load(document.URL +  ' #forest_main');
		//$('#kyotoCity').load(document.URL +  ' #kyotoCity');
	}
	function ajax_activate_mon(values){
		$.ajax({
			type: 'POST',
			url: 'forms/doctorA_aktivate_mon.php',
			data: 'm_id_aktivate='+values[0],
			success: function( msg ) {
				//alert( "Monster id="+values[0]+" aktiviert");
			}
		});
		$('#profile_content').load(document.URL +  ' #profile_content');
		$('#doctorATable').load(document.URL +  ' #doctorATable');
		$('#doctorAUnorderedList').load(document.URL +  ' #doctorAUnorderedList');
		$('#doctorAOrderedList').load(document.URL +  ' #doctorAOrderedList');
		$('#campTable').load(document.URL +  ' #campTable');
		$('#monster_content').load(document.URL +  ' #monster_content');
		$('#tabs').load(document.URL +  ' #tabs');
		$('#forest_main').load(document.URL +  ' #forest_main');
		//$('#kyotoCity').load(document.URL +  ' #kyotoCity');
	}
</script>