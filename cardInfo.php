<html>
	<head>
		<meta charset="utf-8"/>
		<title>CardInfo</title>
		<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	</head>
	<style>
		#ci_id_name{
			color: rgb(51 51 51);
			font-size: 16px;
		}
		#ci_exp_group{
			color: rgb(51 51 51);
			font-size: 16px;
		}
		#ci_types1{
			margin-left: 80px;
			margin-top: -10px;
		}
		#si_stats {
			position: absolute;
			margin-left: 230px;
			margin-top: -235px;
			color: rgb(51 51 51);
			font-size: 16px;
		}
		#ci_header_atacks {
			position: absolute;
			margin-left: 370px;
			margin-top: -235px;
			color: rgb(51 51 51);
			font-size: 16px;
		}
		#ci_atacks{
			margin-left: 370px;
			margin-top: -212px;
			color: rgb(51 51 51);
			font-size: 16px;
		}
		#ci_atacks p {
			animation:blinkingText 5s infinite;
			font-size: 16px;
		}
		@keyframes blinkingText{
			0%{     color: rgb(51, 122, 183);   }
			20%{    color: rgb(51, 122, 183);  }
			30%{    color: rgb(98 98 98); }
			50%{    color: rgb(88 88 88);  }
			61%{   color: rgb(51 51 51);    }
			100%{   color: rgb(51 51 51);    }
		}
	</style>
	<body>
		<?php
			echo "<h4 style='margin-top: -17px;'>Monster Info</h4>";
			echo "<hr style='margin-top: -5px; border-top: 1px solid black;'>";
			$aNickName = $_COOKIE['CMO_NICK_NAME'];
			
			//db_connect
			include 'db_connect/db.php';
					
			$query = "SELECT M_ID_L, ML_Image, Name, Type1, Type2, Exp_Group, Hp, Atk, Def, Spd, Sp_A, Sp_D FROM monster_list ORDER BY M_ID_L";
			$result = mysql_query($query) or die("Query failed : " . mysql_error());
			while ($aRow = mysql_fetch_array($result)) {
				$ci_m_id_l[] = $aRow["M_ID_L"];
				$ci_ml_image[] = $aRow["ML_Image"];
				$ci_name[] = $aRow["Name"];
				$ci_type1[] = $aRow["Type1"];
				$ci_type2[] = $aRow["Type2"];
				$ci_exp_group[] = $aRow["Exp_Group"];
				$ci_hp[] = $aRow["Hp"];
				$ci_atk[] = $aRow["Atk"];
				$ci_def[] = $aRow["Def"];
				$ci_spd[] = $aRow["Spd"];
				$ci_sp_a[] = $aRow["Sp_A"];
				$ci_sp_d[] = $aRow["Sp_D"];
			}
			if (mysql_num_rows($result)==0){	
				$ci_ml_length = 0;
			} else {
				$ci_ml_length = count($ci_m_id_l);
			}
			mysql_free_result($result);
			
			echo "<div id='ci_mon_selected' style='display: none;'>";
					echo "<p id='ci_id_name'></p>";
					echo "<img id='ci_img' src='img_monsters/0.png' style='width: 200px; height: 200px;'><br>";
					echo "<img id='ci_types1' src='img_type/1.png' style='width: 35px; height: 35px;'>";
					//echo "<img id='ci_types2' src='img_type/2.png' style='width: 35px; height: 35px;'>";
					echo "<p id='ci_exp_group'>Expirience Group: </p>";
					echo "<p id='si_stats'>Base Stats: </p>";	
					echo "<p id='ci_header_atacks'>Atacks:</p>";
					echo "<div class='clear_ci_atacks' id='ci_atacks'></div><br><br>";
					
			echo "</div>";
			
			for($i=0; $i<$ci_ml_length; $i++){
				//atacks
				$query = "SELECT a.Lvl, a.A_Name, l.Name, l.Info FROM atack_lern_level a INNER JOIN atack_list l ON l.Name = a.A_Name WHERE M_Name='$ci_name[$i]' ORDER BY Lvl";
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$ci_a_lvl[] = $aRow["Lvl"];
					$ci_a_name[] = $aRow["A_Name"];
					$ci_a_info[] = $aRow["Info"];
				}
				if (mysql_num_rows($result)==0){	
					$ci_atack_lern_lvl_length = 0;
				} else {
					$ci_atack_lern_lvl_length = count($ci_a_lvl);
				}
				mysql_free_result($result);
				//pack all
				$ar_ci[$i] = array($ci_m_id_l[$i], $ci_name[$i], $ci_ml_image[$i], $ci_type1[$i], $ci_type2[$i], $ci_exp_group[$i], $ci_hp[$i], $ci_atk[$i], $ci_def[$i], $ci_spd[$i], $ci_sp_a[$i], $ci_sp_d[$i], $ci_atack_lern_lvl_length, $ci_a_lvl, $ci_a_name, $ci_a_info);
				$jsvar_ci = json_encode($ar_ci[$i]);
				//clear array
				unset($ci_a_lvl);
				unset($ci_a_name);
				unset($ci_a_info);
				//show images
				echo "<img style='height: 100px; width: 100px; cursor: pointer;' src='img_monsters/$ci_ml_image[$i]' onclick='show_monster_list($jsvar_ci)'>";
			}
		?>
		<script>
			function show_monster_list(values) {
				document.getElementById("ci_mon_selected").style.display="block";
				document.getElementById("ci_id_name").innerHTML = "#" +values[0]+" "+values[1];
				document.getElementById("ci_img").src = "img_monsters/" +values[2];
				document.getElementById("ci_types1").src = "img_type/" +values[3]+".png";
				//document.getElementById("ci_types2").src = "img_type/" +values[4]+".png";
				document.getElementById("ci_exp_group").innerHTML = "Expirience Group: "+values[5];
				document.getElementById("si_stats").innerHTML = "Base Stats: <br>HP: "+values[6]+"<br>A: "+values[7]+"<br>D: "+values[8]+"<br>S: "+values[9]+"<br>SA: "+values[10]+"<br>SD: "+values[11]; 
				//remove old atacks
				var div = document.getElementById("ci_atacks");
				while (div.hasChildNodes()) {
					div.removeChild(div.firstChild);
				}
				for(var i=0; i<values[12]; i++){
					//appendChild
					var link = document.createElement("a");
					var p = document.createElement("p");
					var span = document.createElement("span");
					//Attribute
					var a = document.createAttribute("class");
					a.value = "tooltips_ci";	
					link.setAttributeNode(a);
					var node = document.createTextNode(values[13][i]+"-lvl "+values[14][i]);
					var node_span = document.createTextNode(values[15][i]);
					link.appendChild(p);
					link.appendChild(span);
					p.appendChild(node);
					span.appendChild(node_span);
					var element = document.getElementById("ci_atacks");
					element.appendChild(link);
					//document.getElementById("ci_atacks").innerHTML = "<p>" +values[13][i]+"-lvl "+values[14][i]+"</p>";
				}
			}
		</script>
	</body>
</html>
