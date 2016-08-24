<?php
  session_start(); // Начинаем сессию
  $val = $_GET["loc"];
  
# Добавление элемента в список
# Соединямся с БД
$link = mysqli_connect("localhost", "u158376855_sps", "u9550_lupa") or die( mysql_error() );
mysqli_select_db($link, "u158376855_list");

if(isset($_POST['delete_q']))
{
	$err = array();
	# Если нет ошибок, то добавляем в БД нового пользователя
	if(count($err) == 0)
	{
		//mysql_query("DELETE FROM city WHERE id='{$_GET['id']}' LIMIT 1");
		mysqli_query($link,"DELETE FROM spisok_ WHERE articul='{$_GET['id']}' LIMIT 1");
		
		//mysqli_query($link,"INSERT INTO shippers_ SET shipperID='".$tsid."', company='".$tcom."', location='".$tloc."', barcode='".$tbar."', //Dtime='".$tdti."', Dprice='".$tdpr."', URL='".$tsur."', contacts='".$tcon."'");
		header("Location: spisok.php"); 
		exit();
	}
	else
	{
		print "<div class=jumbotron  align=center><h3>При удалении из базы произошла ошибка (O_x)</h3></div>";
		foreach($err AS $error)
		{
			header("Location: reg_error.html"); exit();
		}
	}
}
if(isset($_POST['cancel_q']))
{		
	header("Location: spisok.php");
	exit();
}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="ru">
    <meta name="robots" content="index, follow" />
    <title>Удалить элемент писка?</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="styles/manual.css" >
	<link rel="shortcut icon" type="img/ico" href="images/favicon.ico" />
    <script src="js/respond.min.js"></script>	
</head>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<body>
<br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3  col-md-offset-1">
			<p align="left"><a href="lists.html"><img src="images/sps-drow_A4.jpg"></a></p>
		</div>
        <div class="col-md-7">
			<p align="left"><H3><span class='glyphicon glyphicon-trash' aria-hidden='true'></span>&nbsp;&nbsp;Удалить элемент писка?</H3></p>
		</div>
	</div>
</div>
<hr>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<div class="container-fluid">
	<div class="row">
    	<form method="POST">
        <div class="col-md-5 col-md-offset-1">
           <p class="text-left"><input class="btn btn-danger btn-lg  btn-block" name="delete_q" type="submit" value="Удалить"></p>
		</div>
        <div class="col-md-5">
           <p class="text-left"><input class="btn btn-success btn-lg  btn-block" name="cancel_q" type="submit" value="Отменить"></p>
		</div>
        </form>
	</div>
</div>

<br>
<hr>
<div class="well">Develop by <strong><a href="http://sps.esy.es/">SPS</a></strong> for <strong>Ambience Innovations</strong> 
<span class="glyphicon glyphicon-copyright-mark"></span> 2016</div>
</body>
</html>
