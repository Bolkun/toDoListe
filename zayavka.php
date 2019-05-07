<html lang="en">
    <head>
        <meta charset="utf-8"/>
    </head>
	<style>

	</style>
    <body>
		<?php
			if(isset($_POST['send'])){
				$choice = $_POST['choice_player_menu'];
				$player = $_POST['player'];
				if($choice == 1){	//Вызов
					echo "Challenge $player sent";
				}
				if($choice == 2){	//Нападение
					echo "Attack on $player";
				}
				if($choice == 3){	//Доминация
					echo "Domination";
				}
			} 
		?>
    </body>
</html>