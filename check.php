<?php
	$login=$_POST['login'];
	$pass=$_POST['password'];
	$name=$_POST['nick'];
	
	if (strlen($login)<5 || strlen($login)>15)
	{
		echo "Длина логина должна быть больше 5 и меньше 15, вы ввели логин:";
		echo $login;
		exit();
	}
	
	$mysql = new mysqli('localhost','root','','mysite_bd');
	$mysql->query("INSERT INTO `user_list` (`login`, `password`, `nick`) VALUES ('$login','$pass','$name')");
	$mysql->close();
	
	if (strlen($pass)<5)
	{
		echo "Слишком короткий пароль(минимальная длина: 5 символов)";
		exit();
	}
	
	if (strlen($name)==0)
	{
		echo "Вы не ввели имя!";
		exit();
	}
	
	$pass = md5($pass);
	
	$mysql = new mysqli('localhost','root','','mysite_bd');
	$mysql->query("INSERT INTO `user_list` (`login`, `password`, `nick`) VALUES ('$login','$pass','$name')");
	$mysql->close();
	
	header('Location: index.php');
	
	
?>