<?php

  
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
		//mysqli_query($link,"DELETE FROM spisok_ WHERE articul='{$_GET['id']}' LIMIT 1");
		
		mysqli_query($link,"INSERT INTO shippers_ SET shipperID='".$tsid."', company='".$tcom."', location='".$tloc."', barcode='".$tbar."', Dtime='".$tdti."', Dprice='".$tdpr."', URL='".$tsur."', contacts='".$tcon."'");
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
    <title>Редактировать компонент</title>
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
    <?php
            # Скрипт проверки
            # Соединямся с БД
            $link = mysqli_connect("localhost", "u158376855_sps", "u9550_lupa") or die( mysql_error() );
            mysqli_select_db($link, "u158376855_list");
            
            if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
            {   
                $query = mysqli_query($link,"SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
                $userdata = mysqli_fetch_assoc($query);
            
            
                if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
             or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0")))
                {
                    setcookie("id", "", time() - 3600*24*30*12, "/");
                    setcookie("hash", "", time() - 3600*24*30*12, "/");
                    print "Хм, что-то не получилось";
					header("Location: index.php"); exit();
                }
                else
                {
                //////////////////////////////////////////////
            
            # Соединямся с БД
            $link = mysqli_connect("localhost", "u158376855_sps", "u9550_lupa") or die( mysql_error() );
            mysqli_select_db($link, "u158376855_list");
            
            $TableName="spisok_";
            
            //$sql="SELECT * FROM $TableName WHERE ID=1";
            //$query_result=mysqli_query($link,$sql) or die("Display error".mysql_error());
            
			$query = mysqli_query($link,"SELECT * FROM $TableName WHERE articul='{$_GET['id']}' LIMIT 1");
            $Raw = mysqli_fetch_assoc($query);
			
			print("<form method=POST>
				<label for=basic-url>Название</label>
            	<input type=text name=t_name class=form-control placeholder=Name aria-describedby=basic-addon1 value='$Raw[name]'>
				
				<label for=basic-url>Описание</label>
                <input type=text name=t_description class=form-control placeholder=Description aria-describedby=basic-addon1 value='$Raw[description]'>
				
				<label for=basic-url>Цена</label>
				<div class=input-group>
					<input type=text name=t_price class=form-control placeholder=0,00 value='$Raw[price]'>
					<span class=input-group-addon>$</span>
				</div>
				
				<label for=basic-url>Кол-во</label>
				<div class=input-group>
					<input type=text name=t_Qty class=form-control placeholder=0 value='$Raw[Qty]'>
					<span class=input-group-addon>шт.</span>
				</div>
				
				<br>
				<p class=text-left><a href=\"spisok.php\">Назад</a></p>
				</form>\n");

            mysqli_close($link);
                //////////////////////////////////////////////
                }
            }
            else
            {
                print "Включите куки";
				header("Location: index.php"); exit();
            } 
            ?>
	</div>
</div>

<br>
<hr>
<div class="well">Develop by <strong><a href="http://sps.esy.es/">SPS</a></strong> for <strong>Ambience Innovations</strong> 
<span class="glyphicon glyphicon-copyright-mark"></span> 2016</div>
</body>
</html>
