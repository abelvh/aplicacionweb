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

if(isset($_POST['confirmar'])) {
	$masa = $_REQUEST['masa'];
	$ingres = $_REQUEST['ingre'];
	$ningres =  $_REQUEST['ningre'];
}

//precio masa
$preciomasa=mysql_query("SELECT precio FROM masas WHERE descripcion = '$masa'");
$fi=mysql_fetch_array($preciomasa);
$precio_masa = utf8_encode($fi[0]);

?>
?>
<div class='container well' id='formatear'>
<img src='img/logo.jpeg' alt='Avatar' height='256' width='256' class='img-responsive' id='logo'>

<h1><strong>Datos para la entrega del pedido</strong></h1>

<form action='pedido.php' method="post">
<label>Unidades</label>
<input type="number" name="unidades" required="required">
<label>Tamaño</label>
<select name="tamanio">
<option value="0.50">0.50</option>
<option value="0.75">0.75</option>
<option value="1.00">1.00</option>
</select><br/>
<label>Fecha entrega</label>
<input type="text" name="fecha" placeholder="dd/mm/aaaa" required="required"><br>
<label>Hora entrega</label>
<input type="text" name="hora" placeholder="00:00:00" required="required"><br>
<label>Entrega</label>
<select name="entrega">
<option value="local">En el local</option>
<option value="direccion">En su direccion</option>
</select><br/>
<label>Forma de pago</label>
<select name="pago">
<option value="efectivo">Efectivo</option>
<option value="tarjeta">Tarjeta</option>
</select><br/>

<label> Precio unidad: <?php echo $precio_masa;?></label><br>
<?php echo "<input type='hidden' name='masa' value='".$masa."'>";
echo "<input type='hidden' name='ingre' value='".$ingres."'>"; 
echo "<input type='hidden' name='ningre' value='".$ningres."'>"; ?>
<input type='SUBMIT' name="confirmar" value='Confirmar pedido'>
</form>
<br>
<a href="index.php">Página principal</a><br>
<a href="logout.php">Cerrar Sesión</a>
</div>
</BODY>
</HTML> 
