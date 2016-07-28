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
        header("Location: spisok.php"); exit();
    }
    else
    {
		header("Location: nopass.html"); exit();
    }
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Документ без названия</title>
</head>

<body>
<!--<table border="0" width="100%">
  <tr>
    <td colspan="3" background="images/bdht_01.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="images/bdht_02.jpg" height="100"></td>
    <td width="100%"><p align="center"><img src="images/sps-drow_A4.jpg"></p></td>
    <td><img src="images/bdht_03.jpg" height="100"></td>
  </tr>
</table> -->
<p align="center"><img src="images/sps-drow_A4.jpg"></p>
<br><br>
<form method="POST">
    <table align="center">
        <tr>
          <td rowspan="4"><img src="images/3_p3.jpg" width="67"></td>
            <td rowspan="4">&nbsp;</td>
            <td>Логин:</td>
            <td><input name="login" type="text"></td>
        </tr>
        <tr>
          <td>Пароль:</td>
            <td><input name="password" type="password"></td>
        </tr>
        <tr>
          <td></td>
            <td><input name="submit" type="submit" value="Войти"></td>
        </tr>
    </table>
</form>
</body>
</html>
