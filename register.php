<?php
// �������� ����������� ������ ������������

# ���������� � ��
$link = mysqli_connect("localhost", "u158376855_sps", "u9550_lupa") or die( mysql_error() );
mysqli_select_db($link, "u158376855_list");



if(isset($_POST['submit']))
{
    $err = array();

    # �������� �����
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "����� ����� �������� ������ �� ���� ����������� �������� � ����";
    }
    
    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "����� ������ ���� �� ������ 3-� �������� � �� ������ 30";
    }
    
    # ���������, �� ��������� �� ������������ � ����� ������
    $query = mysqli_query($link, "SELECT COUNT(user_id) FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
    if(mysql_result($query, 0) > 0)
    {
        $err[] = "������������ � ����� ������� ��� ���������� � ���� ������";
    }
    
    # ���� ��� ������, �� ��������� � �� ������ ������������
    if(count($err) == 0)
    {
        
        $login = $_POST['login'];
        
        # ������� ������ ������� � ������ ������� ����������
        $password = md5(md5(trim($_POST['password'])));
        
        mysqli_query($link, "INSERT INTO users SET user_login='".$login."', user_password='".$password."'");
        header("Location: login.php"); exit();
    }
    else
    {
        print "<b>��� ����������� ��������� ��������� ������:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>REGISTR</title>
</head>

<body>


<form method="POST">
����� <input name="login" type="text"><br>
������ <input name="password" type="password"><br>
<input name="submit" type="submit" value="������������������">
</form>

</body>
</html>
