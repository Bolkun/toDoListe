<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8"/>
	<style>
		#clock{
			font-family: Tahoma, sans-serif;
			font-size: 24px;
			font-weight: bold;
			color: rgb(255, 83, 83);	
			margin-top: -50px;
			margin-right: 50px;
			float: right;
		}	
		#panel{
			text-align: left;
			padding-top: 20px;
		}
		#messageText {
			width: 55%;
		}
	</style>
	<script>
		window.onload = function(){
		    window.setInterval(
			function(){
				var d = new Date();
				document.getElementById("clock").innerHTML = d.toLocaleTimeString();
			}
		  , 1000);
		}
	</script>
	<script>
		function ajax_send_message(values) {
			var toUser = document.getElementById("toUser").value;
			var messageText = document.getElementById("messageText").value;
			$.ajax({
				type: 'POST',
				url: 'forms/message_res.php',
				data: 'User='+values[0]+'&toUser='+toUser+'&messageText='+messageText,
				success:function( msg ) {
					//alert( "Message Send! User="+values[0]+'&toUser='+toUser+'&messageText='+messageText );
				}
			});
			document.getElementById("messageText").value = '';
		}
	</script>
  </head>	
  <body>
	<div id="panel">
		<?php
			$ar_user_footer = array($aNickName);
			$jsvar_user_footer = json_encode($ar_user_footer);
		?>
		<form method='POST' id='message_form' action='javascript:void(null);' onsubmit='ajax_send_message(<?php echo "$jsvar_user_footer"; ?>)'>
			<span style='color: white; font-size:16px;'>to: </span><input type="text" id='toUser' name="toUser" maxlength="25" size="10">
			<input class='btn btn-info' type="reset" value="Reset">
			<input type="text" id="messageText" name="message" maxlength="250">
			<input class='btn btn-info' type='submit' name='send' value='OK'>
			<!--<input type="button" value="Smilies">-->
			<!--<input type="button" value="Clear Chat">-->
		</form>
	</div>
	<div id='clock'>00:00:00</div> <!-- hh:mm:ss -->
</body>
</html>