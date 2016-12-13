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







   if (isset($_REQUEST['consultar'])) {


    $fechaMin = $_REQUEST['fechaMin'];
    $fechaMax = $_REQUEST['fechaMax'];
    $conex = mysql_connect("localhost","root","") or die("Problema en la conexion al servidor");
    mysql_select_db("pizzeria", $conex) or die("Problema en la conexion a la BD");
    //$result=mysql_query("SELECT * FROM pedidos Where fecha >='$fechaMin'AND fecha<='fechaMax'")or die("Problema en la consulta");
$SQL= "SELECT * FROM pedidos Where fecha BETWEEN '$fechaMin' AND '$fechaMax'";
$result=mysql_query($SQL) or die("Problema en la consulta");

//Mostramos los registros en forma de tabla



?>
<div class="container well" id="formatear">
<img src="logo.jpg" alt="Avatar" height="256" width="256" class="img-responsive" id="logo">
<h1>Consultar pedido</h1>
<p>Pedidos realizados en esas fechas: </p>
<table align="center">
  <table border="1" align="center">
<tr>
<th>Id Pedido</th>
<th>Fecha</th>
<th>Id Cliente</th>
</tr>
<?php
$cont=0;

while ($row=mysql_fetch_array($result))
{
echo '<tr><td>'.utf8_encode($row["idPedido"]).'</td>';
echo '<td>'.$row["id_cliente"].'</td>';
echo '<td>'.$row["fecha"].'</td></tr>';
}
echo '</table>';




?>
</table>
<a href='consultaporfecha.php'>Consultar otro pedido</a><br>  
<a href="pedidos.php">Volver</a>
</div>

<?php
} else {
?>





     <div class="container well" id="formatear">
       <img src="logo.jpg" alt="Avatar" height="256" width="256" class="img-responsive" id="logo">
<h1>Consulta de pedidos</h1>

<form class="borde" method="post" action="consultaporfecha.php">
<label>Fecha Minima: </label>
<input type="text" name="fechaMin" placeholder="dd/mm/aaaa" required="required"><br>
<label>Fecha Máxima: </label>
<input type="text" name="fechaMax" placeholder="dd/mm/aaaa" required="required"><br>
<form class="borde" method="post" action="consultaporfecha.php">




</select>
<br>
<input type="submit" name="consultar" value="Consultar pedido"><br>
<a href="pedidos.php">Volver</a>
</form>
<?php

   }
?>
</div>
</body>
</html> 
