<html>
	<head>
		<meta charset="utf-8"/>
        <title>Challange Masters Online</title>
        <link rel="shortcut icon" href="icons/titel_icon_2.png" type="image/png">
		<!--<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/cmo.css">
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>-->
	</head>
	<script type="text/javascript">
		function reloadChat() {
			$('#reload').load('chat.php');
			//$("#reload").html('');
			//$('#reload').reload(true);
		}
		setTimeout("reloadChat()",5000);
	</script>
	<body>
		<?php
			//db_connect
			include 'db_connect/db.php';
			echo "<div id='reload'>";
				$query = "SELECT * FROM chat ORDER BY Ch_ID DESC LIMIT 25";	//LIMIT 25
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				while ($aRow = mysql_fetch_array($result)) {
					$ch_id_chat[] = $aRow["Ch_ID"];
					$datum_chat[] = $aRow["Datum"];
					$zeit_chat[] = $aRow["Zeit"];
					$nick_name_chat[] = $aRow["Nick_Name"];
					$nick_name_to_chat[] = $aRow["Nick_Name_To"];
					$ch_msg_chat[] = $aRow["Ch_Msg"];
				}
				
				if (mysql_num_rows($result)==0){	//check if result empty
					$anz_messages = 0;
				} else {
					$anz_messages = count($ch_id_chat);
				}
				
				mysql_free_result($result);
				
				for($i=0; $i<$anz_messages; $i++){
					if($nick_name_to_chat[$i] != null){
						echo "<p style='color: rgb(51 51 51); font-size:16px;'>[$datum_chat[$i]][$zeit_chat[$i]] <strong>$nick_name_chat[$i] to $nick_name_to_chat[$i]:</strong> $ch_msg_chat[$i]</p>";
					} else {
						echo "<p style='color: rgb(51 51 51); font-size:16px;'>[$datum_chat[$i]][$zeit_chat[$i]] <strong>$nick_name_chat[$i]:</strong> $ch_msg_chat[$i]</p>";
					}
				}
				
			echo "</div>";
		?>
	</body>
</html>
