<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RomAmoR</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="estilo.css">

<style>
body{
    background-image: url("fondo.png") ;
    background-attachment: fixed;

}

.centrar{
	text-align: center;
}
#formatear{
	max-width: 400px;
    -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    -moz-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    border-radius: 1%;
    text-align: center;

}
#login{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
}
.bajar1{
    margin-top: 10px;
}
.bajar2{
    margin-top: 20px;
}
.error{
    text-align: center;
    background-color: red;
    font-size: 30px;
    color: white;
}
#ingredientes{
	background-color: #ec4042;
	color:white;
	width: 150px;
	height: 36px;
	border-radius: 5px;
}
h4{
	text-align: left;
	margin-left: 20px;
}
#logo{
	border-radius: 50%;
	margin-left: 15px;
}

h3{
	color:#ec4042;
}
</style>


  </head>
<BODY>
<div class='container well' id='formatear'>
<img src="img/logo.jpeg" alt="RomAmoR" id="logo">
<h1><strong>Déase usted de alta en RomAmoR!!</strong></h1>
<h3><strong>Tipos de masas: </strong></h3>
<?php
mysql_connect("localhost","root","");
mysql_select_db("pizzeria");
$result = mysql_query("SELECT * FROM masas");
while ($row=mysql_fetch_array($result)) {
	echo '<label>'.utf8_encode($row["descripcion"]).' --> '.utf8_encode($row["precio"]).' €<label>';
}
mysql_free_result($result);
?>
<h3><strong>Ingredientes: </strong></h3><br>
<?php
$res = mysql_query("SELECT * FROM ingredientes");
while ($row=mysql_fetch_array($res)) {
	echo '<label>'.utf8_encode($row["nombreIng"]).'<label><br>';
	if ($row["imagen"]!= "")
		echo "<img src='img/".$row["imagen"]."'><br/>";	
}
?>
<br>
<a href="registro.html">Registrese ya!!!</a><br><br>
<a href="index.php">Volver a la página de inicio</a>
</div>
</BODY>
</HTML> 
