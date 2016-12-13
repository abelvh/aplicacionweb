<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RomAmoR</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">


<style>
body{
    background-image: url("fondo.png") ;
    background-attachment: fixed;

}
h1{
  font-weight: bold;
}
#formatear{
  max-width: 340px;
    -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    -moz-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    border-radius: 6%;
    text-align: center;

bottom: 10%;
}
#logo{
  border-radius: 50%;
  margin-left: 15px;
}

th{
	background-color: #ec4042;
	color: white;

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
else {
	$email = $_SESSION['usuario']; 
	if ($email != "administrador@pizzeria.com") {
		header('Location: login.php'); 
  		exit();
  	}
}

   if (isset($_REQUEST['borrar'])) {

		$id_pedido = $_REQUEST['idPedido'];
		$conex = mysql_connect("localhost","root","") or die("Problema en la conexion al servidor");
		mysql_select_db("pizzeria", $conex) or die("Problema en la conexion a la BD");
		$sSQL="Delete From pedidos Where idPedido = '$id_pedido'";
		mysql_query($sSQL);
		mysql_close($conex);
?>
     <div class="container well" id="formatear">
       <img src="logo.jpg" alt="Avatar" height="256" width="256" class="img-responsive" id="logo">
<h1>Pedido anulado</h1>
<a href='borrapedido.php'>Anular otro pedido</a><br>	
<a href="pedidos.php">Volver</a>
</div>
<?php
} else {
?>
     <div class="container well" id="formatear">
       <img src="logo.jpg" alt="Avatar" height="256" width="256" class="img-responsive" id="logo">
<h1>Anulación de pedidos</h1>
<?php

echo '<form class="borde" method="post" action="borrapedido.php">';

$con = mysql_connect("localhost","root","") or die("Problema en la conexion al servidor");
mysql_select_db("pizzeria", $con) or die("Problema en la conexion a la BD");
$SQL="Select idPedido From pedidos Order By idPedido";
$result=mysql_query($SQL);
echo '<p><label>Pedido: </label>';
echo '<select name="idPedido">';

//Mostramos los registros en forma de menú desplegable
while ($row=mysql_fetch_array($result))
{echo '<option>'.utf8_encode($row["idPedido"]).'</option>';}
mysql_free_result($result);
?>

</select>
<br>
<input type="submit" name="borrar" value="Anular pedido"><br>
<a href="pedidos.php">Volver</a>
</form>
<?php
	mysql_close($con);
   }
?>
</div>
</body>
</html> 
