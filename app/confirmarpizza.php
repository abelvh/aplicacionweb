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
	max-width: 340px;
    -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    -moz-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    border-radius: 6%;
    text-align: center;
}
#formatear1{
    max-width: 300px;
    -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    -moz-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    border-radius: 6%;
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
#logo{
  border-radius: 50%;
  margin-left: 15px;
}
</style>


  </head>
<BODY>
<?php

//creamos la sesion
session_start();

//validamos si se ha hecho o no el inicio de sesion correctamente

//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['usuario'])) 
{
  header('Location: login.php'); 
  exit();
}

mysql_connect("localhost","root","");
mysql_select_db("pizzeria");
$result = mysql_query("SELECT * FROM ingredientes");
$total = mysql_num_rows($result);
$ingredientes = array();

if(isset($_POST['masa'])) {
	$masa = $_REQUEST['masa'];
}



if(isset($_POST['dingre'])) {
	while ($row=mysql_fetch_array($result)) {
		if(isset($_REQUEST[utf8_encode($row["nombreIng"])])) {
			$ingre = $_REQUEST[utf8_encode($row["nombreIng"])];
			array_push($ingredientes, $ingre);
		}		
	}
}

?>
<div class='container well' id='formatear'>
<img src='img/logo.jpeg' alt='Avatar' height='256' width='256' class='img-responsive' id='logo'>
<h1><strong>La pizza que usted ha pedido es: </strong></h1>
<div class='container well' id='formatear1'>
Masa -> <?php echo $masa."<br/>"; ?>
Ingredientes -> <?php 
$ningre = count($ingredientes);
for($i=0;$i<$ningre;$i++)
	echo $ingredientes[$i]."<br/>"; 

//convertir array a string
$ingres = implode(",", $ingredientes);
?>
<form action='confirmarpedido.php' method="post">
<?php echo "<input type='hidden' name='masa' value='".$masa."'>";
echo "<input type='hidden' name='ingre' value='".$ingres."'>";
echo "<input type='hidden' name='ningre' value='".$ningre."'>"; ?></div>
<input type='SUBMIT' name="confirmar" value='Confirmar pizza' id="ingredientes">
</form>
<form action='masa.php'>
<input type='SUBMIT' name="cambiar" value='Cambiar' id="ingredientes">
</form>
<br>
<a href="index.php">Página principal</a><br>
<a href="logout.php">Cerrar Sesión</a>
</div>
</BODY>
</HTML> 
