<?php
// �������� �����������

# ������� ��� ��������� ��������� ������
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;
}



# ���������� � ��
$link = mysqli_connect("localhost", "u158376855_sps", "u9550_lupa") or die( mysql_error() );
mysqli_select_db($link, "u158376855_list");

if(isset($_POST['submit']))
{
    # ����������� �� �� ������, � ������� ����� ���������� ����������
    $query = mysqli_query("SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    
    # ���������� ������
    if($data['user_password'] === md5(md5($_POST['password'])))
    {

	   # ���������� ��������� ����� � ������� ���
        $hash = md5(generateCode(10));
            
        if(!@$_POST['not_attach_ip'])
        {
            # ���� ������������ ������ �������� � IP
            # ��������� IP � ������
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        }
        
        # ���������� � �� ����� ��� ����������� � IP
        mysql_query("UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");
        
        # ������ ����
        setcookie("id", $data['user_id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);
        
        # ���������������� ������� �� �������� �������� ������ �������
        header("Location: check.php"); exit(); 	
    }
    else
    {
        print "�� ����� ������������ �����/������";
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>LOGIN</title>
</head>

<body>

<form method="POST">
����� <input name="login" type="text"><br>
������ <input name="password" type="password"><br>
�� ����������� � IP(�� ���������) <input type="checkbox" name="not_attach_ip"><br>
<input name="submit" type="submit" value="�����">
</form>

</body>
</html>
