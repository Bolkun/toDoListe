<!--<html>
	<head>
		<meta charset="utf-8"/>
		<title>Clans</title>
	</head>
	<body>-->
	    <?php
		/*$aNickName = $_COOKIE['CMO_NICK_NAME'];
		
		echo "<h4 style='margin-top: -17px;'>Clans</h4>";
		echo "<hr style='margin-top: -10px;'>";
		
		$mysql_host = 'localhost';
		$mysql_user = 'root';
		$mysql_password = '';
		$my_database = 'cmo';

		$link = mysql_connect($mysql_host, $mysql_user, $mysql_password)
				or die("Could not connect : " . mysql_error());
				mysql_select_db($my_database) or die("Could not select database");
			
		    $query = "SELECT * FROM clans";
		    $result = mysql_query($query) or die("Query failed : " . mysql_error());
		    $aRow = mysql_fetch_array($result);
			
			$nomer = $aRow['Nomer'];
			$logo = $aRow['Logo'];
			$name = $aRow['Name'];
			$rating = $aRow['Rating'];

			mysql_free_result($result);
	    ?>
		<table>
			<tr>
				<th colspan="3">Name of Clan</th>
				<th>Rating</th>
			<tr>
	
			<?php
			// Отобразим содержимое кланов
			$query = "SELECT * FROM clans ORDER BY Rating DESC";
			$result = mysql_query($query) or die("Query failed : " . mysql_error());
			$i = 0;
			while ($aRow = mysql_fetch_array($result)) {
				$i++;
				$logo = $aRow['Logo'];
				$name = $aRow['Name'];
				$rating = $aRow['Rating'];

				echo "<tr>";
					echo "<td>$i</td>";
					echo "<td><img src='img_clans/$logo'></td>";
					echo "<td>$name</td>";
					echo "<td>$rating</td>";
				echo "</tr>";
			}
			mysql_free_result($result);
			?>
		</table>
	</body>
</html>*/
