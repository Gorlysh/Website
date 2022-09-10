<?php
if (isset($_POST["create"]) && !empty($_POST["editor1"]) && !empty($_POST["editor2"]))
{
	require_once 'config.php';
	$mysql = new mysqli($connect,$user,$pw,$bd);
	$name=$_POST["editor1"];
	$text=$_POST["editor2"];
	$short_text=$_POST["editor3"];
	$mysql->query("INSERT INTO `articles` (`articles_name`, `article_text`, `short_text`) VALUES ('$name','$text','$short_text')");
	$mysql->close();
	header('Location: index.php');
}

if (isset($_POST["back"]))
{
	header('Location: index.php');
}
?>
<doctype html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Создание статьи</title>
	<link rel="stylesheet" href="style.css">
	<script src="ckeditor/ckeditor.js"></script>
</head>

<body>
<form  action="create_artic.php" method="post" >
	<div><H1 class="Header">Создание новой статьи</H1>
	<TABLE class="create">
	<tr><td>	
		<H1>Введите название статьи</H1>
		<textarea name="editor1" id="editor1" rows="1" cols="10"></textarea>
				<script>
					CKEDITOR.replace('editor1');
				</script>
	</td></tr>
	<tr><td>		
		<H1>Краткое содержание</H1>
		<textarea name="editor3" id="editor3" rows="1" cols="10"></textarea>
				<script>
					CKEDITOR.replace('editor3');
				</script>
	</td></tr>
	<tr><td>	
		<H1>Текст статьи</H1>
		<textarea name="editor2" id="editor2" rows="1" cols="10"></textarea>
				<script>
					CKEDITOR.replace('editor2');
				</script>
		<button type=submit class="Butt" name="create">Добавить статью</button>	
		<button type=submit class="Butt" name="back">Назад</button>
	<tr><td>
	</TABLE>
	</div>
</form>
</body>
</html>