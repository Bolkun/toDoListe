<html lang="en">
    <head>
        <meta charset="utf-8"/>
		<title>Challange Masters Online</title>
        <link rel="shortcut icon" href="icons/titel_icon_2.png" type="image/png"
		<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/cmo.css">
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
    </head>
	<script>
	
	</script>
	<style>
		#pop_player_menu {
			overflow: auto;
			height:150px;
			width: 150px;
			position:fixed;
			<!--top: 33%;
			left: 75%;-->
			border:2px solid;
			padding:10px;
			background:#fff;
			border-radius:9px;
			display:none;
			text-align: left;
		}
		#close_pop_player_menu {
			right:5px;
			top:5;
			float:right;
		}
		.room_header {
			color: rgb(51 51 51);
			font-size: 16px;
		}
	</style>
		<script type="text/javascript">
		function reloadRoom() {
			//$("#room").html('');
			$('#room').load('room.php');
			//$('#reloadRoom').reload(true);
		}
		setTimeout("reloadRoom()",5000);
	</script>
    <body>
		<iframe name="footer_if" src="footer.php" style="display: none;"></iframe>
		<div id='reloadRoom'>
			<?php 
			//db_connect
			include 'db_connect/db.php';
			if (!empty($_COOKIE['CMO_NICK_NAME'])){
			/* ф-я подсчитывает пользователей на линии; возвращает кол-во пользователей в
			отформатированном виде, т.е. для вывода результата нужно лишь прописать в
			нужном месте типа: echo on_line(); */
			
				$aNickName = $_COOKIE['CMO_NICK_NAME'];
				$wine = 900; // точность он-лайн (300 секунды); время, в течении которого
							  // пользователя, зашедшего на страничку, мы считаем находящимся
							  // на сайте (5 min)
				//делаем доступной глобальную переменную ИП-адреса
				//global $REMOTE_ADDR;
				$user_ip = $_SERVER['REMOTE_ADDR'];
				//удаляем всех, кто уже пробыл $wine секунд 
				$sql_update = "DELETE FROM online WHERE Timestamp+$wine < ".time();
				$result_update = mysql_query($sql_update) or die(mysql_error());

				// вставляем свою запись
				$sql_insert = "INSERT INTO online VALUES ('', '$aNickName', '$user_ip','".time()."') ON DUPLICATE KEY UPDATE Ip='$user_ip', Timestamp='".time()."'";
				$result_insert = mysql_query($sql_insert) or die(mysql_error());
				
				//mysql_query("UPDATE online SET Timestamp = '".time()."' WHERE Nick_Name = '$aNickName'");
				

				 // считаем играков онлайн
				$sql_sel = "SELECT ID FROM online";
				$result_sel = mysql_query($sql_sel) or die(mysql_error());

				$online_people = mysql_num_rows($result_sel); // кол-во Online пользователей
			
				// возвращаем результат
				if ($online_people == 1){
					echo "<p class='room_header'>Online <strong>".$online_people."</strong> person</p>";	//<p>IP: $user_ip</p>
				} else {
					echo "<p class='room_header'>Online <strong>".$online_people."</strong> people</p>";
				}
				//Находим мастера
				$query = "SELECT Nick_Name FROM online";
				$result = mysql_query($query) or die("Query failed : " . mysql_error());
				$count = 0;
				echo "<table>";
				while ($aRow = mysql_fetch_array($result)) {
					$online_nick_name[] = $aRow['Nick_Name'];
					echo "<tr>";
					$jsvar = json_encode($online_nick_name[$count]);
			?>
						<!--<td><img style='height: 25px; width: 25px;' onclick='player_menu(<?php //echo "$jsvar"; ?>)' src='img/challenge.png'></td>-->
						<!--<td><img style='height: 25px; width: 25px;' onclick='ajax_show_profile(<?php //echo "$jsvar"; ?>)' src='img/inf.png'></td> -->
						<td><button onclick='UserInput(<?php echo "$jsvar"; ?>)' style="background:none;border:none;"><?php echo "$online_nick_name[$count]"; ?></button></td>
						<div id='pop_player_menu' style="display:none">
							<button id='close_pop_player_menu' onclick="document.getElementById('pop_player_menu').style.display='none'">X</button><br>
							<?php
								echo "<h4 id='change_name' style='margin-top: -15;'> ? </h4>";	//$online_nick_name[$count]
								echo "<form action='zayavka.php' method='post'>";
								echo "<input id='input_player' type='hidden' name='player' value='' readonly>";
									echo "<input type='radio' name='choice_player_menu' value='1' checked>Challenge<br>";
									echo "<input type='radio' name='choice_player_menu' value='2'>Attack<br>";
									echo "<input type='radio' name='choice_player_menu' value='3'>Domination<br>";
									echo "<br><input type='submit' name='send' value='OK'>";	
								echo "</form>";
							?>
						</div>
			<?php
					$count= $count + 1;
					echo "</tr>";
				}
				echo "</table>";
		echo "</div>";
		}
		?>
		<script>
			//send player name to input value
			function UserInput(values){
				var myDocument = window.footer_if.document;
				document.getElementById('toUser').value = values;
				
			}
			
			//Player Menu
			function player_menu(values) {
				document.getElementById('pop_player_menu').style.display="block";
				document.getElementById('change_name').innerHTML=values;
				document.getElementById('input_player').value = values;
			}
			function ajax_show_profile(values) {
				document.getElementById('pop_profile').style.display='block';
				$.ajax({
					type: 'POST',
					url: 'profile.php',
					data: 'r_user='+values,
					success:function( msg ) {
						//alert(values);
					},
					error:  function(xhr, str){
						alert('Error response: ' + xhr.responseCode);
					}
				});
				$('#profile_content').load(document.URL +  ' #profile_content');
			}
			
		</script>
    </body>
</html>