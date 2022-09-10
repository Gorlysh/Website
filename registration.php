<?php
	$login=$_POST['login'];
	$pass=$_POST['password'];
	$name=$_POST['nick'];
	
	if (strlen($login)<5 || strlen($login)>15)
	{
		echo '<script type="text/javascript">alert("Длина логина должна быть больше 5 и меньше 15")</script>
		 <meta http-equiv="refresh" content="0;http://127.0.0.1/kurs/index.php">';
		exit();

	}
	
	require_once 'config.php';
	$mysql = new mysqli($connect,$user,$pw,$bd);
	$res = $mysql->query("SELECT * FROM `user_list` where `login`='$login'");
	$user= $res->fetch_assoc();
	
	if(empty($user)) {
		$mysql->close();
	
		if (strlen($pass)<5)
		{
			echo '<script type="text/javascript">alert("Слишком короткий пароль(минимальная длина: 5 символов)")</script>
			<meta http-equiv="refresh" content="0;http://127.0.0.1/kurs/index.php">';
			exit();
		}
	
		if (strlen($name)==0)
		{
			echo '<script type="text/javascript">alert("Вы не ввели имя!")</script>
			<meta http-equiv="refresh" content="0;http://127.0.0.1/kurs/index.php">';
			exit();
		}
	
		$pass = md5($pass);
	
		require_once 'config.php';
		$mysql = new mysqli($connect,$user,$pw,$bd);
		$mysql->query("INSERT INTO `user_list` (`login`, `password`, `nick`) VALUES ('$login','$pass','$name')");
		$mysql->close();
	
		header('Location: index.php');
	}
	else {
		echo '<script type="text/javascript">alert("Пользователь с таким логином уже существует!")</script>
		<meta http-equiv="refresh" content="0;http://127.0.0.1/kurs/index.php">';
		exit();
	}
	
	
?>