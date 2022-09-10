<?php
	require_once 'config.php';
	$mysql = new mysqli($connect,$user,$pw,$bd);
	$res = $mysql->query("SELECT count(*) FROM `articles`");
	$arr = mysqli_fetch_array($res);
	$n=$arr[0];
	
	$j=1;
	while ($j<=$n){
		$artic_name="artic".$j;
		if(isset($_POST[$artic_name]))
		{
			$name=$_POST[$artic_name];
			$mysql = new mysqli('localhost','root','','mysite_bd');
			$res = $mysql->query("SELECT `id`,`article_text`,`articles_name` FROM `articles`");
			$mass = array();
			$massid = array();
			$massart = array();
			while($arr = mysqli_fetch_assoc($res))
			{
				$massid[] = $arr['id'];
				$mass[] = $arr['article_text'];
				$massart[] = $arr['articles_name'];	
			}
			setcookie('a_id', $massid[$j-1], time()+3600, "/");
			echo '<TABLE class="create" border="2" cellpadding="10" width="1000">
					<tr><td>
					<h1 class="Head1">'.$massart[$j-1].'</h1>
					<p>'.$mass[$j-1].'</p>
					</td></tr>
					</TABLE>';
					

		$mysql->close();
		}
		
		$j=$j+1;
	}	

if (isset($_POST["back"]))
{
	header('Location: index.php');
}

if (isset($_POST["delete"]) && isset($_COOKIE['user']))
{
	$id = $_COOKIE['a_id'];
	require_once 'config.php';
	$mysql = new mysqli($connect,$user,$pw,$bd);
	$mysql->query("DELETE FROM `articles` where `id`=$id");
	$mysql->close();
	header('Location: index.php');
} elseif (isset($_POST["delete"]) && !isset($_COOKIE['user'])) {echo '<script type="text/javascript">alert("Авторизируйтесь, чтобы удалять записи")</script><meta http-equiv="refresh" content="0;http://127.0.0.1/kurs/index.php">';}

if(isset($_POST["edit"]))
{
	$id = $_COOKIE['a_id'];
	require_once 'config.php';
	$mysql = new mysqli($connect,$user,$pw,$bd);
	$res = $mysql->query("SELECT `article_text`, `articles_name` FROM `articles` where `id`=$id ");
	$arr = mysqli_fetch_assoc($res);
	echo '<TABLE class="create" border="2" cellpadding="10" width="1000">

				<tr><td>
				<h1 class="Head1">'.$arr['articles_name'].'</h1>
				<p>'.$arr['article_text'].'</p>
					</td></tr>
					</TABLE>';
	$mysql->close();
}

if(isset($_POST["do_edit"]) && isset($_COOKIE['user']))
{
	$id = $_COOKIE['a_id'];
	require_once 'config.php';
	$mysql = new mysqli($connect,$user,$pw,$bd);
	if(!empty($_POST["editor1"]))
	{	
		$text=$_POST["editor1"];
		$res = $mysql->query("UPDATE `articles` SET `article_text` = '$text' WHERE `id` = '$id'");
	}
	$res = $mysql->query("SELECT `article_text`, `articles_name` FROM `articles` where `id`=$id ");
	$arr = mysqli_fetch_assoc($res);
	echo '<TABLE class="create" border="2" cellpadding="10" width="1000">
					<tr><td>
					<h1 class="Head1">'.$arr['articles_name'].'</h1>
					<p>'.$arr['article_text'].'</p>
					</td></tr>
					</TABLE>';
	$mysql->close();
} elseif (isset($_POST["do_edit"]) && !isset($_COOKIE['user'])) {echo '<script type="text/javascript">alert("Авторизируйтесь, чтобы редактировать")</script><meta http-equiv="refresh" content="0;http://127.0.0.1/kurs/index.php">';}

?>
<doctype html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Просмотр статьи</title>
	<link rel="stylesheet" href="style.css">
	<script src="ckeditor/ckeditor.js"></script>
</head>

<body>
<div class="div_first">
			<form  action="main.php" method="post" >
				<button type=submit class="Butt" name="back">Назад</button>
				<button type=submit class="Butt" name="edit">Редактировать</button>
				<button type=submit class="Butt" name="delete">Удалить статью</button><br><br>
				<textarea name="editor1" id="editor1" rows="10" cols="80"><?php if(isset($_POST["edit"]))
																				{
																					$id = $_COOKIE['a_id'];
																					require_once 'config.php';
																					$mysql = new mysqli($connect,$user,$pw,$bd);
																					$res = $mysql->query("SELECT `article_text` FROM `articles` where `id`=$id ");
																					$arr = mysqli_fetch_assoc($res);
																					echo $arr['article_text'];
																					$mysql->close();
																				}?>
				</textarea>
				<script>
					CKEDITOR.replace('editor1');
				</script><br><br>
				<button type=submit class="Butt" name="do_edit">Применить изменения</button>
			</form>
		</div class="div_second"><br><br>';

<div>

</div>	
</body>
</html>
