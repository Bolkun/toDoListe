<html>
	<head>
		<meta charset="utf-8"/>
		<title>Backpack</title>
		<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	</head>
	<script>
		function ajax_send_item() {
			var id = document.getElementById("i_id").value;
			var monster_id = document.getElementById("monster_choice").value;
			$.ajax({
				type: 'POST',
				url: 'forms/item_res.php',
				data: 'item_id='+id+'&mon_id='+monster_id,
				success:function( msg ) {
					alert( "Item used successfuly!" );
				}
			});
			$('#item_content').load(document.URL +  ' #item_content');
			$('#monster_content').load(document.URL +  ' #monster_content');
		}
	</script>
	<body>
		<div id="item_content">
			<?php
				echo "<h4 style='margin-top: -35px;'>Backpack</h4>";
				echo "<hr style='margin-top: -5px;border-top: 1px solid black;'>";
				$aNickName = $_COOKIE['CMO_NICK_NAME'];
				
				//db_connect
				include 'db_connect/db.php';
				
				$query = "SELECT i.IT_ID, i.Item_Amount, il.ItemName, il.ItemImage, il.ItemGoal, il.ItemValue, il.ItemDescription 
						  FROM items i INNER JOIN items_list il ON il.IL_ID=i.IL_ID
						  WHERE Item_Owner='$aNickName' AND Item_Position='0'";
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$it_id[] = $aRow["IT_ID"];
					$it_amount[] = $aRow["Item_Amount"];
					$it_name[] = $aRow["ItemName"];
					$it_image[] = $aRow["ItemImage"];
					$it_goal[] = $aRow["ItemGoal"];
					$it_value[] = $aRow["ItemValue"];
					$it_desc[] = $aRow["ItemDescription"];
				}
				if (mysql_num_rows($result)==0){	//check if result empty
					$it_image_length = 0;
				} else {
					$it_image_length = count($it_image);
				}
				mysql_free_result($result);
			?>
				<!--Selected Item -->
				<style>
					#selected {
						<!--background: rgb(92 184 92);-->
					}
					#name_value {
						text-align: center;
						color:rgb(51 51 51);
						font-size: 16px;
					}
					#img {
						display: block;
						margin-left: auto;
						margin-right: auto;
						margin-top: -22px;
					}
					#amount {
						text-align: center;
						margin-top: -8px;
						color:rgb(51 51 51);
						font-size: 16px;
					}
					#desc {
						text-align: center;
						margin-top: -5px;
						color:rgb(51 51 51);
						font-size: 16px;
					}
					#forma {
						text-align: center;
					}
					.item_use {
						height: 30px;
						line-height: 0.7;
						margin-top: -3px;
					}
					.form_control {
						width: 100px;
						text-align: center;
						display: inline-block;
						color: rgb(255 83 83);
						border-color: rgb(255 83 83);
						background-color: rgb(56 58 59);
						height: 30px;
						line-height: 0.5;
					}
				</style>
				<div id="selected">
					<p id="name_value"></p>
					<img id="img" src="img_items/item.png" style="display:none; width: 85px; height: 85px; padding-top: 15px;">
					<p id="amount"></p>
					<p id="desc"></p>
					<p id="i_id"></p>				
					
					<!-- Forma -->
					<div id="forma" style="display:none">
						<form method='POST' id='item_form' action='javascript:void(null);' onsubmit='ajax_send_item()'>
							<select class="form_control" id='monster_choice'>
								<?php
									$query = "SELECT M_ID, M_Name FROM monsters WHERE M_Owner='$aNickName' AND Aktiv='1' ORDER BY M_ID";
									$result = mysql_query($query) or die("Query failed : " . mysql_error());
									while ($aRow = mysql_fetch_array($result)) {
										$m_id[] = $aRow["M_ID"];
										$a_monster[] = $aRow["M_Name"];
									}
									mysql_free_result($result);
									$a_monster_length = count($a_monster);
									for($a=0; $a<$a_monster_length; $a++){
										if($a==0){	//selected
											echo "<option class='select_item' selected value='$m_id[$a]'>$a_monster[$a]</option>";	
										} else {
											echo "<option class='select_item' value='$m_id[$a]'>$a_monster[$a]</option>";
										}
									}
								?>
							</select>
							<input class="btn btn-info item_use" type='submit' value='Use'>
						</form>
					</div>
				</div>
				<?php
				//Inventar
				if($it_image_length != 0){
					echo "<table border='1'>";
					echo "<tr>";
						for($i=0; $i<$it_image_length; $i++){
							$ar[$i] = array($it_goal[$i], $it_name[$i], $it_amount[$i], $it_desc[$i], $it_image[$i], $it_id[$i]);
							$jsvar = json_encode($ar[$i]);
							$english_format_amount = number_format($it_amount[$i], 0);
							echo "<td style='padding-top: 5px;padding-left: 8px'><img style='width: 85px; height: 85px; cursor: pointer;' src='img_items/$it_image[$i]' onclick='changeContent($jsvar)'><p style='margin-top: -1px;color:rgb(51 51 51);'>$english_format_amount</p></td>"; //$it_goal[$i], $it_name[$i], $it_amount[$i], $it_desc[$i], $it_image[$i]
							if((($i + 1) % 5) == 0) {
								echo "</tr>";
							} 
						} 
					echo "</table>";
				}else {
					echo "Your backpack is empty!";
				}
			?>
		</div>
		<script>
			function changeContent(values) {/*goal, name, amount, desc, image, it_id*/
				if (values[0] == 0) 
				{
					//alert(values[0]);
					//amount format
					var amount = values[2];
					var amountStr = amount.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
					//собирание и крафтинг
					document.getElementById("name_value").innerHTML = values[1]; 	//name 
					document.getElementById("img").style.display="block";
					document.getElementById("img").src = "img_items/" +values[4];	//image
					document.getElementById("amount").innerHTML = "x" +amountStr;	//value
					document.getElementById("desc").innerHTML = values[3];			//desc
					document.getElementById("i_id").value = values[5];				//it_id
					document.getElementById('forma').style.display="none";
				}
				else 
				{
					//использоапниe на монстра
					document.getElementById("name_value").innerHTML = values[1]; 	//name 
					document.getElementById("img").style.display="block";
					document.getElementById("img").src = "img_items/" +values[4];	//image
					document.getElementById("amount").innerHTML = "x" +values[2];	//value
					document.getElementById("desc").innerHTML = values[3];			//desc
					document.getElementById("i_id").value = values[5];				//it_id
					document.getElementById('forma').style.display="block";
				}
			}
			
		</script>
	</body>
</html>
