<?php
// Страница авторизации

# Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;
}


# Соединямся с БД
$link = mysqli_connect("localhost", "u158376855_sps", "u9550_lupa") or die( mysql_error() );
mysqli_select_db($link, "u158376855_list");

if(isset($_POST['submit']))
{
    # Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    # Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password'])))
    {
        # Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        if(!@$_POST['not_attach_ip'])
        {
            # Если пользователя выбрал привязку к IP
            # Переводим IP в строку
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        }

        # Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        # Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);

        # Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: lists.html"); exit();
    }
    else
    {
		header("Location: nopass.html"); exit();
    }
}
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="ru">
    <meta name="robots" content="index, follow" />
    <title>Вход</title>
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
			<p align="left"><H3><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Вход в базу</H3></p>
		</div>
	</div>
</div>
<hr>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10  col-md-offset-1">
            <form method="POST">
                <table align="center">
                    <tr>
                      <td width="80px" rowspan="2"><img src="images/3_p3.jpg" width="67px"></td>
                        <td width="80px"><label for="basic-url">Логин</label></td>
                        <td>
                    	<input type="text" name="login" class="form-control" placeholder="admin" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                      <td><label for="basic-url">Пароль</label></td>
                      <td>
                      <input type="text" name="password" class="form-control" placeholder="data" aria-describedby="basic-addon1">
                      </td>
                    </tr>
                    <tr>
                      <td width="80px">&nbsp;</td>
                      <td></td>
                        <td>
                        <br>
                    	<p class="text-left"><input class="btn btn-success btn-sm  btn-block" name="submit" type="submit" value="Войти"></p>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<hr>
<div class="well">Develop by <strong><a href="http://sps.esy.es/">SPS</a></strong> for <strong>Ambience Innovations</strong> 
<span class="glyphicon glyphicon-copyright-mark"></span> 2016</div>
</body>
</html>
