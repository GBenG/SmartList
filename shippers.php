<?php

// Добавление элемента в список

# Соединямся с БД
$link = mysqli_connect("localhost", "u158376855_sps", "u9550_lupa") or die( mysql_error() );
mysqli_select_db($link, "u158376855_list");


if(isset($_POST['submit_q']))
{
    $err = array();
	
    # проверям капчу
    if(!preg_match("/4dqrzm/",$_POST['txt_capch']))
    {
     //   $err[] = "Логин может состоять только из букв английского алфавита и цифр";//
//	 header("Location: reg_error.html"); exit();
    }
    
    # Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {
        $tnm = $_POST['t_name'];
		$tprc = $_POST['t_contacts'];
		$turl = $_POST['t_url'];
        
       
        mysqli_query($link,"INSERT INTO shippers SET shipper='".$tnm."', contacts='".$tprc."', url='".$turl."'");
        header("Location: shippers.php"); exit();
    }
    else
    {
       // print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
        //    print $error."<br>";
		header("Location: reg_error.html"); exit();
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="ru">
    <meta name="robots" content="index, follow" />
    <title>Списог желаний АмбиэнцИнновэйшнз :)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="styles/manual.css" >
	<link rel="shortcut icon" type="img/ico" href="images/favicon.ico" />
    <script src="js/respond.min.js"></script>	
</head>

<body>
<p align="center"><a href="lists.html"><img src="images/sps-drow_A4.jpg"></a></p>
<br>
<hr>

<div class="container-fluid">
  <div class="row">
  <div class="col-md-6 col-md-offset-3">

<form method="POST">
<table width="80%" border="0" cellspacing="6px" cellpadding="5px">
  <tr>
    <td colspan="4" align="center"  style="padding:5px !important"><strong>Добавление нового пункта</strong></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="padding:5px !important">Название</td>
    <td><input name="t_name" type="text" style="width:500px;"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="padding:5px !important">Ссылка</td>
    <td><textarea name="t_url" style="width:500px;"></textarea></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="padding:5px !important">Контакты</td>
    <td><textarea name="t_contacts" style="width:500px;"></textarea></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>    
    <td colspan="2">
    	<p class="text-center"><input class="btn btn-success btn-lg" name="submit_q" type="submit" value="Добавить"></p>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
    </tr>
</table>
</form>
<hr>


<p align="center" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold">СПИСОК</p>

<br>
<?php
// Скрипт проверки

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

$TableName="shippers";

$sql="SELECT * FROM $TableName";
$query_result=mysqli_query($link,$sql) or die("Display error".mysql_error());
print("<table max-width=600px class='table table-striped'>\n");
print("<tr class='success'> <td>Названиея</td> <td>Цена</td> <td>URL</td> </tr>");
while($Row=mysqli_fetch_array($query_result))
{
print("<tr align=center> <td align=left>&nbsp; $Row[shipper]</td> <td>$Row[contacts]</td> <td><a href=$Row[url]>$Row[url]</a></td> </tr>\n");
}
print("</table>");
mysqli_free_result($query_result);
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
</div>

<br>
<hr>
<div class="well">Develop by <strong><a href="http://sps.esy.es/">SPS</a></strong> for <strong>Ambience Innovations</strong> 
<span class="glyphicon glyphicon-copyright-mark"></span> 2016</div>
</body>
</html>
