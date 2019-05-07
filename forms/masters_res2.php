<?php
	/*echo "<pre>"; //struktur von text bleibt erhalten
		print_r($_POST);
	echo "</pre>"; */
	
	//db_connect
	include '../db_connect/db.php';
			
	$i = 0;
	print "<table class='table table-condensed'>";
	print "<tr>";
		print "<th>Top</th>";
		print "<th>Name</th>";
		print "<th>Rang</th>";
		print "<th>Kategorie</th>";
	print "</tr>";

	//Выдаем 100 лутших мастеров по рангу
	$query = "SELECT Nick_Name, Rang, Gruppe FROM users ORDER BY Rang DESC LIMIT 100";
	$result = mysql_query($query) or die("Query failed : " . mysql_error());
	while ($aRow = mysql_fetch_array($result)) {
		$i=$i+1;
		$master_name = $aRow['Nick_Name'];
		$rang = $aRow['Rang'];
		$kategorie = $aRow['Gruppe'];

		echo "<tr>";
			echo "<td>#$i</td>";
			echo "<td>$master_name</td>";
			echo "<td>$rang</td>";
			echo "<td>$kategorie</td>";
		echo "</tr>";
	}
	print "</table>";
	mysql_free_result($result);
?>