<html>
	<head>
		<meta charset="utf-8"/>
		<title>Masters</title>
		<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	</head>
	<script type="text/javascript" language="javascript">
		function ajax_send_masters() {
		  var msg = $('#masters_form').serialize();
			$.ajax({
			  type: 'POST',
			  url: 'forms/masters_res.php',
			  data: msg,
			  success: function(data) {
				$('#results_masters').html(data);
			  },
			  error:  function(xhr, str){
			alert('Возникла ошибка: ' + xhr.responseCode);
			  }
			});
		}
		function ajax_send_masters2() {
		  var msg = $('#masters_form2').serialize();
			$.ajax({
			  type: 'POST',
			  url: 'forms/masters_res2.php',
			  data: msg,
			  success: function(data) {
				$('#results_masters').html(data);
			  },
			  error:  function(xhr, str){
			alert('Возникла ошибка: ' + xhr.responseCode);
			  }
			});
		}
	</script>
	<style>
		#search {
			margin-top: -20px;
			margin-left: 65px;
		}
		#masters_form2 {
			position: absolute;
			margin-left: 263px;
			margin-top: -51px;
		}
	</style>
	<body>
	    <?php
		
		echo "<h4 style='margin-top: -17px;'>Master ";
		echo "<div id='search'>";
		?>
			<form method='POST' id='masters_form' action='javascript:void(null);' onsubmit='ajax_send_masters()'>
				<input type='text' name='find_master' size='15' placeholder='Nickname'  style='height: 30px; background-color: transparent; border-bottom: 1px solid black;border-top:none;border-left:none;border-right:none;'> 
				<input class='btn btn-info' type='submit' value='Search'> 
				
			</form>
			<form method='POST' id='masters_form2' action='javascript:void(null);' onsubmit='ajax_send_masters2()'>
				<input style='margin-top: 4px;' class='btn btn-info' type='submit' value='Refresh'>
			</form>
		<?php
		echo "</div>";
		echo "</h4>";
		//echo "<hr style='margin-top: -5px;border-top: 1px solid black;'>";
		echo "<div id='results_masters'>";
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
		echo "</div>";
		mysql_close($link);
		?>
	</body>
</html>