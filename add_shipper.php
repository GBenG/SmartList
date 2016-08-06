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
		$tart = uniqid("ai_");
		$tnem = $_POST['t_name'];
		$tdes = $_POST['t_description'];
		$tprc = $_POST['t_price'];
		$tqty = $_POST['t_Qty'];
		$tave = $_POST['t_availble'];
		$tord = $_POST['t_ordered'];
		$tned = $_POST['t_need'];
		$tdaturl = $_POST['t_datasheet_url'];
		$tap1url = $_POST['t_appnote_url'];
		$tap2url = $_POST['t_appnote_url'];
		$tap3url = $_POST['t_appnote_url'];
		
		mysqli_query($link,"INSERT INTO shippers_ SET articul='".$tart."', name='".$tnem."', description='".$tdes."', price='".$tprc."', Qty='".$tqty."', availble='".$tave."', ordered='".$tord."', need='".$tned."', datasheet='".$tdaturl."', appnote1='".$tap1url."', appnote2='".$tap2url."', appnote3='".$tap3url."'");
		header("Location: add_component.php"); 
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
    <title>Добавление нового компонента в базу</title>
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
			<p align="left"><H3><span class="glyphicon glyphicon-tags" aria-hidden="true"></span>&nbsp;&nbsp;Добавление нового компонента в базу</H3></p>
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
	                  <input type="text" class="form-control" aria-label="..."  id="inputSuccess1" value = '<?=$val;?>'/>
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