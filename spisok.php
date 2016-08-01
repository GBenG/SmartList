<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="ru">
    <meta name="robots" content="index, follow" />
    <title>Общий список компонентов</title>
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
			<p align="left"><H3><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;&nbsp;Общий список компонентов</H3></p>
		</div>
	</div>
</div>
<hr>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<div class="container-fluid">
	<div class="row">
        <div class="col-md-10  col-md-offset-1">
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
                }
                else
                {
                //////////////////////////////////////////////
            
            # Соединямся с БД
            $link = mysqli_connect("localhost", "u158376855_sps", "u9550_lupa") or die( mysql_error() );
            mysqli_select_db($link, "u158376855_list");
            
            $TableName="spisok";
            
            $sql="SELECT * FROM $TableName";
            $query_result=mysqli_query($link,$sql) or die("Display error".mysql_error());
            print("<table class='table table-striped'>\n");
            print("<tr class='success' align=center><td><strong>Названиея</strong></td><td><strong>Цена</strong></td><td><strong>URL</strong></td></tr>");
            while($Row=mysqli_fetch_array($query_result))
            {
            print("<tr align=center> <td align=left>&nbsp; $Row[name]</td> <td width=100>$Row[price] $</td> <td><a href=http://$Row[url]>$Row[url]</a></td> </tr>\n");
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
