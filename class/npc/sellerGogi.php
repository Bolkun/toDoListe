<style>
	#sellerGogi {
		text-align: right;
	}
	#pop_sellerGogi {
		overflow: auto;
		height: 500px;
		width: 600px;
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
		margin-top: -100px;
	}
	#close_pop_sellerGogi {
		right:5px;
		top:5;
		float:right;
	}
</style>
<div id='sellerGogi'>
	<button style='margin-right: 100px; margin-top: 5px;' class="btn btn-info b_location" type="button" onclick="document.getElementById('pop_sellerGogi').style.display='block';">Seller Gogi</button>
	<div id='pop_sellerGogi'>
		<button class="close" aria-label="Close" id='close_pop_sellerGogi' onclick="document.getElementById('pop_sellerGogi').style.display='none'"><span aria-hidden="true">&times;</span></button><br>
		<div style="float: left;width: 200px;height:auto;">
			<img style='height: 150px; width: 150px;' src='img_characters/gogi.png'>
		</div>
		<!-- Display the countdown timer in an element -->
		<div style="float: left;width: 150px;height:auto;">
			<h3 style='color: rgb(51 51 51);'>Time left:</h3>
			<div id="timer">
			  <p style='color: rgb(255 83 83); font-size: 64px;'></p>
			</div>
		</div>
		<table class='table' id="sellerGogiTable" style='background:rgb(103 204 114);'>
			<?php
				$aNickName = $_COOKIE['CMO_NICK_NAME'];
				//check the date
				$sg_current_date = date('Y-m-d');
				$query = "SELECT M_Date FROM monsters WHERE M_Owner='Gogi' AND M_Date=CURDATE()";	//
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$m_date[] = $aRow["M_Date"];
				}
				if (mysql_num_rows($result)==0){	//check if result empty
					$m_date_length = 0;
				} else {
					$m_date_length = count($m_date);
				}
				mysql_free_result($result);
				if($m_date_length == 0){	//load new monsters if not current date
					//take 6 random id monsters from a monster_list
					$monsers_random_id = array();		//ids
					//$monsters_random_name = array();	//names
					$query = "SELECT COUNT(*) AS TOTAL_COLLECTION FROM monster_list";
					$result = mysql_query($query) or die("Query failed : " . mysql_error());
					$aRow = mysql_fetch_array($result);
					$total_collection = $aRow['TOTAL_COLLECTION'];
					mysql_free_result($result);
					$sg_mon_amount = 6;
					for($i=0; $i<$sg_mon_amount;$i++){
						$monsters_random_id[$i] = rand(1, $total_collection);
						$monsters_random_image[$i] = "$monsters_random_id[$i].png";
						//find there names
						$query = "SELECT Name FROM monster_list WHERE M_ID_L='$monsters_random_id[$i]'";	
						$result = mysql_query($query) or die("Query failed : " . mysql_error());
						while ($aRow = mysql_fetch_array($result)) {
							$monsters_random_name[$i] = $aRow["Name"];
						}
						mysql_free_result($result);
						$randomHp_G[$i] = rand(0, 36);
						$randomA_G[$i] = rand(0, 36);
						$randomD_G[$i] = rand(0, 36);
						$randomS_G[$i] = rand(0, 36);
						$randomSa_G[$i] = rand(0, 36);
						$randomSd_G[$i] = rand(0, 36);
						$randomHar[$i] = rand(1, 24);
						$randomlvl[$i] = 1;
						$query = "SELECT Hatk, Hdef, Hspeed, Hsatk, Hsdef FROM har WHERE Har_ID='$randomHar[$i]'";	
						$result = mysql_query($query) or die("Query failed : " . mysql_error());
						while ($aRow = mysql_fetch_array($result)) {
							$sg_hatk[$i] = $aRow["Hatk"];
							$sg_hdef[$i] = $aRow["Hdef"];
							$sg_hspeed[$i] = $aRow["Hspeed"];
							$sg_hsatk[$i] = $aRow["Hsatk"];
							$sg_hsdef[$i] = $aRow["Hsdef"];
						}
						mysql_free_result($result);
						$sql_insert = "INSERT INTO monsters (M_Name, M_Owner, M_Date, M_Image, Lvl, Hp_G, A_G, D_G, S_G, Sa_G, Sd_G, Har) VALUES ('$monsters_random_name[$i]', 'Gogi', '$sg_current_date', '$monsters_random_image[$i]', $randomlvl[$i], '$randomHp_G[$i]', '$randomA_G[$i]', '$randomD_G[$i]', '$randomS_G[$i]', '$randomSa_G[$i]', '$randomSd_G[$i]', '$randomHar[$i]');";
						$result_insert = mysql_query($sql_insert) or die(mysql_error());
					}
				} else {
					// mysql_query("DELETE FROM monsters WHERE M_Owner = 'Gogi'");
					//delete monsters who two days old
					for($i=0; $i<$m_date_length; $i++){
						//mysql_query("DELETE FROM monsters WHERE M_Owner = 'Gogi' AND $m_date[$i]<=CURDATE()-1");
					}
					//Just show monsters for current date
					$query = "SELECT M_Name, M_Owner, M_Image, Lvl, Hp_G, A_G, D_G, S_G, Sa_G, Sd_G, Har FROM monsters WHERE M_Owner='Gogi' AND M_Date=CURDATE() ORDER BY M_ID";	
					$result = mysql_query($query) or die("Query failed : " . mysql_error());
					while ($aRow = mysql_fetch_array($result)) {
						$monsters_random_name[] = $aRow["M_Name"];
						$monsters_random_image[] = $aRow["M_Image"];
						$randomlvl[] = $aRow["Lvl"];
						$randomHp_G[] = $aRow["Hp_G"];
						$randomA_G[] = $aRow["A_G"];
						$randomD_G[] = $aRow["D_G"];
						$randomS_G[] = $aRow["S_G"];
						$randomSa_G[] = $aRow["Sa_G"];
						$randomSd_G[] = $aRow["Sd_G"];
						$randomHar[] = $aRow["Har"];
					}
					if (mysql_num_rows($result)==0){	//check if result empty
						$sg_mon_amount = 0;
					} else {
						$sg_mon_amount = count($monsters_random_name);
					}
					
					mysql_free_result($result);
					
					for($j=0; $j<$sg_mon_amount;$j++){
						$query = "SELECT Hatk, Hdef, Hspeed, Hsatk, Hsdef FROM har WHERE Har_ID='$randomHar[$j]'";	
						$result = mysql_query($query) or die("Query failed : " . mysql_error());
						while ($aRow = mysql_fetch_array($result)) {
							$sg_hatk[$j] = $aRow["Hatk"];
							$sg_hdef[$j] = $aRow["Hdef"];
							$sg_hspeed[$j] = $aRow["Hspeed"];
							$sg_hsatk[$j] = $aRow["Hsatk"];
							$sg_hsdef[$j] = $aRow["Hsdef"];
						}
						mysql_free_result($result);
					}
				}
			?>
			<!--<tr>
				<th>Name</th>
				<th>Image</th>
				<th>Gens</th>
				<th>Buy</th>
			</tr>-->
			<?php
			$query = "SELECT M_ID FROM monsters WHERE M_Owner='Gogi' AND M_Date=CURDATE() ORDER BY M_ID";	
			$result = mysql_query($query) or die("Query failed : " . mysql_error());
			while ($aRow = mysql_fetch_array($result)) {
				$buy_mon_mid[] = $aRow["M_ID"];
			}
			mysql_free_result($result);
			//check money
			$query = "SELECT Item_Amount FROM items WHERE Item_Owner='$aNickName' AND IL_ID='1'";	
			$result = mysql_query($query) or die("Query failed : " . mysql_error());
			while ($aRow = mysql_fetch_array($result)) {
				$money_amount[] = $aRow["Item_Amount"];
			}
			mysql_free_result($result);
			for($i=0; $i<$sg_mon_amount;$i++){
				echo "<tr>";
					echo "<td><br><br>$monsters_random_name[$i] $randomlvl[$i]-lvl</td>";
					echo "<td><img id='ci_img' src='img_monsters/$monsters_random_image[$i]' style='width: 100px; height: 100px;'></td>";
					echo "<td><br><br>";
							echo "HP:<span>$randomHp_G[$i]</span>";
							if($sg_hatk[$i] == 1.1){
								echo "A:<span style='color: green;'>$randomA_G[$i]</span>";
							} else if($sg_hatk[$i] == 0.9) {
								echo "A:<span style='color: red'>$randomA_G[$i]</span>";
							}else {
								echo "A:<span>$randomA_G[$i]</span>";
							}
							if($sg_hdef[$i] == 1.1){
								echo "D:<span style='color: green;'>$randomD_G[$i]</span>";
							} else if($sg_hdef[$i] == 0.9) {
								echo "D:<span style='color: red;'>$randomD_G[$i]</span>";
							} else {
								echo "D:<span>$randomD_G[$i]</span>";
							}
							if($sg_hspeed[$i] == 1.1){
								echo "S:<span style='color: green;'>$randomS_G[$i]</span>";
							} else if($sg_hspeed[$i] == 0.9) {
								echo "S:<span style='color: red;'>$randomS_G[$i]</span>";
							} else {
								echo "S:<span>$randomS_G[$i]</span>";
							}   
							if($sg_hsatk[$i] == 1.1){
								echo "SA:<span style='color: green;'>$randomSa_G[$i]</span>";
							} else if($sg_hsatk[$i] == 0.9) {
								echo "SA:<span style='color: red;'>$randomSa_G[$i]</span>";
							} else {
								echo "SA:<span>$randomSa_G[$i]</span>";
							} 
							if($sg_hsdef[$i] == 1.1){
								echo "SD:<span style='color: green;'>$randomSd_G[$i]</span>";
							} else if($sg_hsdef[$i] == 0.9) {
								echo "SD:<span style='color: red;'>$randomSd_G[$i]</span>";
							} else {
								echo "SD:<span>$randomSd_G[$i]</span>";
							} 
					echo "</td>";
					if($money_amount[0] >= 1000){
						$ar_buy_mon[$i] = array($buy_mon_mid[$i]);
						$jsvar_buy_mon = json_encode($ar_buy_mon[$i]);
						echo "<td style='padding-top: 45px;'><button class='btn btn-info' style='color: green; border: 1px solid green;' onclick='ajax_buy_mon($jsvar_buy_mon)'>1000$</button></td>";
					} else {
						echo "<td style='padding-top: 45px;'><button class='btn btn-info' disabled>1000$</button></td>";
					}
				echo "</tr>";
			}
			//Delete all monsters whose date 1 days old
			mysql_query("DELETE FROM monsters WHERE M_Owner='Gogi' AND M_Date < NOW() - INTERVAL 1 DAY");
			?>
		</table>
	</div>
	<script>
		setInterval(function time(){
		  var d = new Date();
		  var hours = 24 - d.getHours();
		  var min = 60 - d.getMinutes();
		  var sec = 60 - d.getSeconds();
		  if((min + '').length == 1){
			min = '0' + min;
		  }
		  if((sec + '').length == 1){
				sec = '0' + sec;
		  }
		  if((hours == 0) && (min == 0) && (sec == 1)){
			//alert("Auction is over!");
			
		  }
		  jQuery('#timer p').html(hours+':'+min+':'+sec)
		}, 1000);
		function ajax_buy_mon(values){
			$.ajax({
				type: 'POST',
				url: 'forms/sellerGogi_res.php',
				data: 'm_id_buy='+values[0],
				success: function( msg ) {
					alert( "Monster bought successfuly");	// "Monster with id="+values[0]+" bought successfuly"
				}
			});
			$('#profile_content').load(document.URL +  ' #profile_content');
			$('#doctorATable').load(document.URL +  ' #doctorATable');
			$('#item_content').load(document.URL +  ' #item_content');
			$('#doctorAUnorderedList').load(document.URL +  ' #doctorAUnorderedList');
			$('#doctorAOrderedList').load(document.URL +  ' #doctorAOrderedList');
			$('#sellerGogiTable').load(document.URL +  ' #sellerGogiTable');
		}
	</script>
</div>