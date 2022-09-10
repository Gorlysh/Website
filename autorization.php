<?php
	$login=$_POST['login1'];
	$pass=$_POST['password1'];
	
	$pass = md5($pass);
	
	require_once 'config.php';
	$mysql = new mysqli($connect,$user,$pw,$bd);
	$res = $mysql->query("SELECT * FROM `user_list` where `login`='$login' and `password`='$pass'");
	$user= $res->fetch_assoc();
	
	if(empty($user)) {
		echo '<script type="text/javascript">alert("Неверный логин или пароль")</script>
		<meta http-equiv="refresh" content="0;http://127.0.0.1/kurs/index.php">';
		exit();
	}
	
	setcookie('user', $user['nick'], time()+3600, "/");
	
	$mysql->close();
	
	header('Location: index.php');	
?>