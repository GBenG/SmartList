<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php
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
		$tnm = $_POST['t_name'];
		$tdes = $_POST['t_descript'];
		$tprc = $_POST['t_price'];
		$turl = $_POST['t_url'];
		
		mysqli_query($link,"INSERT INTO spisok SET name='".$tnm."', description='".$tdes."', price='".$tprc."', url='".$turl."'");
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
            <table width="100%" border="0" cellspacing="6px" cellpadding="5px">
              <tr>
                <td colspan="4" align="center"  style="padding:5px !important"></td>
                </tr>
              <tr>
                <td>
                    <label for="basic-url">Название</label>
                    <input type="text" name="t_name" class="form-control" placeholder="Name" aria-describedby="basic-addon1">
                </td>
              </tr>
                            <tr>
                <td>
                    <label for="basic-url">Описание</label>
                    <input type="text" name="t_descript" class="form-control" placeholder="Description" aria-describedby="basic-addon1">
                </td>
              </tr>
              <tr>
                <td>
                    <label for="basic-url">Цена</label>
                    <div class="input-group">
                        <input type="text" name="t_price" class="form-control" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-addon">$</span>
                    </div>
                </td>
              </tr>
              <tr>
                <td>
                    <label for="basic-url">Ссылка на документацию</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon3">http://</span>
                      <input type="text" name="t_url" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                    </div>
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