<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php
  session_start(); // Начинаем сессию
  if ($_GET["loc"] == "ukr") {
    $val = "Украина";
  }
  elseif ($_GET["loc"] == "chi") {
    $val = "Китай";
  }
  elseif ($_GET["loc"] == "usa") {
    $val = "США";
  }
  elseif ($_GET["loc"] == "oth") {
    $val = "Другое";
  }else{
  $val = "Другое";
  }
  
# Добавление элемента в список
# Соединямся с БД
$link = mysqli_connect("localhost", "u158376855_sps", "u9550_lupa") or die( mysql_error() );
mysqli_select_db($link, "u158376855_list");

if(isset($_POST['submit_q']))
{
	$err = array();
	# Если нет ошибок, то добавляем в БД нового пользователя
	if(count($err) == 0)
	{
		$tloc = $_POST['t_location'];
		$tcom = $_POST['t_company'];
		$tdti = $_POST['t_Dtime'];
		$tdpr = $_POST['t_Dprice'];
		$tsur = $_POST['t_ship_url'];
		$tcon = $_POST['t_contacts'];
		$tsid = uniqid("sid_");
		$tbar = uniqid("bar_");
		
		mysqli_query($link,"INSERT INTO shippers_ SET  shipperID='".$tsid."', company='".$tcom."', location='".$tloc."', barcode='".$tbar."', Dtime='".$tdti."', Dprice='".$tdpr."', URL='".$tsur."', contacts='".$tcon."'");
		header("Location: add_shipper.php"); 
		exit();
	}
	else
	{
		print "<div class=jumbotron  align=center><h3>При добавлении в базу произошла ошибка (O_x)</h3></div>";
		foreach($err AS $error)
		{
			header("Location: reg_error.html"); exit();
		}
	}
}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="ru">
    <meta name="robots" content="index, follow" />
    <title>Добавление нового поставщика</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="styles/manual.css" >
	<link rel="shortcut icon" type="img/ico" href="images/favicon.ico" />
    <script src="https://code.jquery.com/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/respond.min.js"></script>	
    <script src="js/bootstrap.js"></script>	
    <script src="js/bootstrap-dropdown.js"></script>	
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
			<p align="left"><H3><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>&nbsp;&nbsp;Добавление нового поставщика</H3></p>
		</div>
	</div>
</div>
<hr>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10  col-md-offset-1">
            <form method="POST">
            <table width="100%" border="0">
              <tr>
                <td colspan="4" align="center"  style="padding:5px !important"></td>
               </tr>
               <tr>
                <td>
                    <label for="basic-url">Расположение</label>
                  <div class="input-group has-success">
	                  <input name="t_location"  type="text" class="form-control" aria-label="..."  id="inputSuccess1" value = '<?=$val;?>'/>
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-success dropdown-toggle" style="border-color:#3c763d"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">				 Выбрать <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="add_shipper.php?loc=ukr">Украина</a></li>
                            <li><a href="add_shipper.php?loc=chi">Китай</a></li>
                            <li><a href="add_shipper.php?loc=usa">США</a></li>
                            <li><a href="add_shipper.php?loc=oth">Другое</a></li>
                        </ul>
                      </div><!-- /btn-group -->
                    </div><!-- /input-group -->
                    <h6 style="color:rgba(138,138,138,1.00)">*выбор расположения необходимо сделать до ввода данных в остальные поля</h6>
                    <hr>
                </td>
              </tr>
              <tr>
                <td>
                    <label for="basic-url">Компания</label>
                    <input type="text" name="t_company" class="form-control" placeholder="Name" aria-describedby="basic-addon1">
                </td>
               </tr>
              <tr>
                <td>
                    <label for="basic-url">Время доставки</label>
                    <div class="input-group">
                        <input type="text" name="t_Dtime" class="form-control" placeholder="0" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-addon">дней</span>
                    </div>
                </td>
              </tr>
                            <tr>
                <td>
                    <label for="basic-url">Стоимость доставки</label>
                    <div class="input-group">
                        <input type="text" name="t_Dprice" class="form-control" placeholder="0.00" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-addon">$</span>
                    </div>
                </td>
              </tr>
              <tr>
                <td>
                    <label for="basic-url">Ссылка на поставщика</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon3">http://</span>
                      <input type="text" name="t_ship_url" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                </td>
              </tr>
              <tr>
                <td>
                    <label for="basic-url">Контакты поставщика</label>
                    <input type="text" name="t_contacts" class="form-control" aria-describedby="basic-addon1">
                </td>
              </tr>
              <tr>
                <td>
                	<br>
                    <p class="text-left"><input class="btn btn-success btn-lg" name="submit_q" type="submit" value="Добавить"></p>
                </td>
              </tr>
            </table>
            </form>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
            <hr>
            <p align="center" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold">СПИСОК ПОСТАВЩИКОВ</p>
            
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
            
            $TableName="shippers_";
			
            
            $sql="SELECT * FROM $TableName";
            $query_result=mysqli_query($link,$sql) or die("Display error".mysql_error());
            print("<table class='table table-striped'>\n");
            print("<tr class='success' align=center>
			<td>Компания</td>
			<td>Расположение</td>
			<td>Время доставки</td>
			<td>Стоимость доставки</td>
			<td>Ссылка</td> 
			<td>Контакты</td>
			<td><span class='glyphicon glyphicon-trash' aria-hidden='true'></td>
			</tr>");
            while($Row=mysqli_fetch_array($query_result))
            {
            print("<tr align=center> 
			<td align=left>$Row[company]</td> 
			<td>$Row[location]</td> 
			<td>$Row[Dtime]</td> 
			<td>$Row[Dprice]</td> 
			<td><a href=http://$Row[URL] target=_blank>$Row[URL]</a></td>
			<td>$Row[contacts]</td> 
			<td><a href=\"delete.php?id=".$Row[shipperID]."\"><span class='glyphicon glyphicon-remove' aria-hidden='true'></a></td>
			</tr>\n");
            }
            print("</table>");
            mysqli_free_result($query_result);
            mysqli_close($link);
                ////////////////////////////////////////////// &nbsp; 
                }
            }
            else
            {
                print "Включите куки";
                header("Location: index.php"); exit();
            } 
            ?>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
		</div>
	</div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<br>
<hr>
	<div class="well">Develop by <strong><a href="http://sps.esy.es/">SPS</a></strong> for <strong>Ambience Innovations</strong> 
	<span class="glyphicon glyphicon-copyright-mark"></span> 2016</div>
</body>
</html>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->