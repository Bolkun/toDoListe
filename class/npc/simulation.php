<html>
	<head>
		<meta charset="utf-8"/>
		<title>Challange Masters Online</title>
		<link rel="shortcut icon" href="icons/titel_icon_2.png" type="image/png">
	</head>
	<style>
		#pop_simulation {
			overflow: auto;
			height: 220px;
			width: 300px;
			border:2px solid;
			padding:10px;
			background:rgb(103 204 114);
			border-radius:9px;
			display:none;
			text-align: left;
			z-index: 1;
			position: absolute;
			top: 100px;
			left: 0;
			right: 0;
			margin: 0 auto;
			font-size: 16px;
			color: rgb(51 51 51);
		}
		#close_pop_simulation {
			right:5px;
			top:5;
			float:right;
		}
		.sim {
			color: rgb(51 51 51) !important;
		}
	</style>
	<body>
		<?php
			$query = "SELECT Value FROM selected_simulation";	
			$result = mysql_query($query) or die("Query failed : " . mysql_error());
			while ($aRow = mysql_fetch_array($result)) {
				$ss_value[] = $aRow["Value"];
			}
			if(mysql_num_rows($result)==0){	//check if result empty
				echo "<div id='simulation'>";
					echo "<div style='text-align: right;'>";
						echo "<button style='margin-right: 100px; margin-top: 5px;' class='btn btn-info b_location' id='simulationButton' type='button' onclick='pop_simulation()'>Simulation</button>";
					echo "</div>";
					echo "<div id='pop_simulation' style='display:none'>";
						echo "<div id='simulation_window'>";
						?>
							<button class="close" aria-label="Close" id='close_pop_simulation' onclick="document.getElementById('pop_simulation').style.display='none'"><span aria-hidden="true">&times;</span></button><br>
						<?php
							//Show options
							echo "<h4 id='change_name' style='margin-top: -15;'>Choose:</h4>";	//$online_nick_name[$count]
							echo "<form method='POST' id='simulation_form' action='javascript:void(null);' onsubmit='ajax_select_simulation()'>";
								echo "<div><label class='checkbox-inline radiobox_inline sim'>";
									echo "<input type='radio' id='rf_choice1' name='choice_simulation' value='1'>Random vs Random";
									echo "<span class='checkmark_radio'></span>";
								echo "</label></div>";
								echo "<div><label class='checkbox-inline radiobox_inline sim'>";
									echo "<input type='radio' id='rf_choice2' name='choice_simulation' value='2' checked>Reinforcement vs Random";
									echo "<span class='checkmark_radio'></span>";
								echo "</label></div>";
								/*echo "<div><label class='checkbox-inline radiobox_inline sim'>";
									echo "<input type='radio' id='rf_choice3' name='choice_simulation' value='3' disabled>Player vs Reinforcement";
									echo "<span class='checkmark_radio'></span>";
								echo "</label></div>";*/
								echo "<br><div style='text-align: center; margin-top: -15px;'><input class='btn btn-info' type='submit' value='Start'></div>";	
							echo "</form>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			} else if($ss_value[0] == 1){
				//Random vs Random
				include 'simulation/random_vs_random.php';
			} else if($ss_value[0] == 2){
				//Reinforcement vs Random
				include 'simulation/reinforcement_vs_random.php';
			}
		?>
	</body>
</html>
<script>
	function pop_simulation() {
		document.getElementById('pop_simulation').style.display="block";
	}
	function ajax_select_simulation() {
		if (document.getElementById('rf_choice1').checked) {
			var choice = document.getElementById('rf_choice1').value;
		}
		if (document.getElementById('rf_choice2').checked) {
			var choice = document.getElementById('rf_choice2').value;
		}
		/*if (document.getElementById('rf_choice3').checked) {
			var choice = document.getElementById('rf_choice3').value;
		}*/
		$.ajax({
			type: "POST",
			url: "forms/selected_simulation.php",
			data: 'player_choice='+choice,
			success:function( msg ) {
				//alert("choice="+choice);
			}
		});
		$('#reinforcement_div').load(document.URL +  ' #reinforcement_div');
		
		document.getElementById('kyotoCity').style.display='none';
		document.getElementById('kyotoCity_forest').style.display='none';
	}
	function rf_training_deaktivate(){
		//document.getElementById('rf_training').style.display='none';
		$("#rf_training").html('');
		$.ajax({
			type: 'POST',
			url: 'forms/selected_simulation_out.php',
			data: '',
			success:function( msg ) {
				
			}
		});
		$('#reinforcement_div').load(document.URL +  ' #reinforcement_div');
		
		document.getElementById('kyotoCity').style.display='block';
		document.getElementById('kyotoCity_forest').style.display='block';
		//location.reload(true);
	}
</script>