<?php
if(isset($_POST["create"]) && isset($_COOKIE['user']))
{
	header('Location: create_artic.php');
}elseif (isset($_POST["create"]) && !isset($_COOKIE['user'])) {echo '<script type="text/javascript">alert("Чтобы добавлять статьи, авторизируйтесь!")</script>';}

if(isset($_COOKIE['user']))
{
	$name=$_COOKIE['user'];
	echo '<h2 class="First">Привет, '.$name.'</h2>';
}else { echo '<h2 class="First">Вы не авторизировались</h2>'; }

if(isset($_POST["close"]) && isset($_COOKIE['user']))
{
	$user = $_COOKIE['user'];
	setcookie('user', $user, time()-3600, "/");
	header('Location: index.php');
}elseif (isset($_POST["close"]) && !isset($_COOKIE['user'])) {echo '<script type="text/javascript">alert("Вы не авторизовались")</script>';}

?>
<doctype html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Вход на сайт</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<TABLE class="begin" border="1" cellpadding="10">
	<tr>
	<td>

		<h1 class="First">Регистрация</h1><br>
		<form  action="registration.php" method="post" >
			<input type="text" class="First" name="nick" id="nck" placeholder="Введите ваше имя"><br><br>
			<input type="text" class="First" name="login" id="log" placeholder="Введите логин"><br><br>
			<input type="text" class="First" name="password" id="passw" placeholder="Введите пароль"><br><br>
			<button type="submit" class="Butt" name="but1">Зарегистрироваться</button><br><br>
		</form>

	</td>
	</tr>
	
	<tr>
	<td>

		<h1 class="First">Вход</h1><br>
		<form  action="autorization.php" method="post" >
			<input type="text" class="First" name="login1" id="log1" placeholder="Введите логин"><br><br>
			<input type="text" class="First" name="password1" id="passw1" placeholder="Введите пароль"><br><br>
			<button type="submit" class="Butt" name="but2">Войти</button>
		</form>

	</td>
	</tr>
</TABLE>	



	<h1 class="Header">Учебный портал по курсу Web-технологии</h1><br>


	<div class="page3">
		<form  action="main.php" method="post" ><br><br><br>
			<?php
				require_once 'config.php';
				$mysql = new mysqli($connect,$user,$pw,$bd);
				$res = $mysql->query("SELECT `articles_name`,`short_text` FROM `articles`");
				
				$mass = array();
				$mass1 = array();
				while($arr = mysqli_fetch_assoc($res)){
					$mass[] = $arr['articles_name'];
					$mass1[] = $arr['short_text'];
				}
				
				$i=0;
				foreach($mass as $val)
				{
					$i=$i+1;
					echo '<TABLE border="2" cellpadding="10" width="1000">
					<tr><td>
					<h1 class="Head">'.$val.'</h1>
					<h1 class="little">'.$mass1[$i-1].'</h1>
					<button type="submit" class="Butt" name="'. 'artic'.$i .'" value="'.$i.'">Читать</button><br><br>
					</td></tr>
					</TABLE>';
				}
				
				$mysql->close();
			?>
			
		</form>
	</div>

		<form  action="index.php" method="post" >
			<button type="submit" class="create" name="create">Добавить статью</button>
			<button type="submit" class="exit" name="close">Выйти</button>
		</form>
	
</body>
</html>