<?php
	/*echo "<pre>"; //struktur von text bleibt erhalten
		print_r($_POST);
	echo "</pre>"; */
	
	//db_connect
	include '../db_connect/db.php';
			
	$i = 0;
	if(($_POST['find_master']) != ''){
		$find_master = $_POST['find_master'];
		//Находим мастера
		$query = "SELECT Nick_Name, Rang, Gruppe FROM users WHERE Nick_Name = '$find_master'";
		$result = mysql_query($query) or die("Query failed : " . mysql_error());
		if (mysql_num_rows($result)==0) { 
			echo "<strong>$find_master</strong> doesn't exist!";
		} else {
			print "<table class='table table-condensed'>";
			print "<tr>";
				print "<th>Name</th>";
				print "<th>Rang</th>";
				print "<th>Kategorie</th>";
			print "</tr>";
			while ($aRow = mysql_fetch_array($result)) {
				$master_name = $aRow['Nick_Name'];
				$rang = $aRow['Rang'];
				$kategorie = $aRow['Gruppe'];

				echo "<tr>";
					echo "<td>$master_name</td>";
					echo "<td>$rang</td>";
					echo "<td>$kategorie</td>";
				echo "</tr>";
			}
			print "</table>";
		}
		mysql_free_result($result);
	}
?>