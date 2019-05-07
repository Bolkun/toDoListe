<script>
	document.getElementById('pop_profile').style.display='block';
</script>
<?php
	if(isset($_POST['r_user'])){
		$aNickName = $_POST['r_user'];
	} else {
		$aNickName = $_COOKIE['CMO_NICK_NAME'];
	}
	echo "$aNickName";
?>