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
  max-width: 840px;
    -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    -moz-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    border-radius: 1%;
    text-align: center;

bottom: 10%;
}
#logo{
  border-radius: 50%;
  margin-left: 35%;
}

th{
	background-color: #ec4042;
	color: white;

}

</style>


  </head>
<BODY>
     <div class="container well" id="formatear">
       <img src="logo.jpg" alt="Avatar" height="256" width="256" class="img-responsive" id="logo">
<h1><div align="center">PEDIDOS</div></h1>
<br>
<br>
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

//Conexion con la base
mysql_connect("localhost","root","");

//selección de la base de datos con la que vamos a trabajar
mysql_select_db("pizzeria");

//Ejecutamos la sentencia SQL
$consulta=mysql_query("select * from pedidos");

//Contamos numero de registros
$num_total_registros = mysql_num_rows($consulta);

//Limito la busqueda
$tam_pag = 15;

//examino la página a mostrar y el inicio del registro a mostrar
if(!isset($_GET["pagina"]))
	$pagina="";
else
	$pagina = $_GET["pagina"];

if (!$pagina) {
	$inicio = 0;
	$pagina = 1;
}
else {
	$inicio = ($pagina - 1) * $tam_pag;
}

//calculo el total de páginas
$total_paginas = ceil($num_total_registros / $tam_pag);
?>

<table border="1" align="center">
<tr>
<th>IDPedido</th>
<th>Masa</th>
<th>Nº Ingredientes</th>
<th>Tamaño</th>
<th>Unidades</th>
<th>Entrega</th>
<th>Forma de pago</th>
<th>Fecha Entrega</th>
<th>Hora Entrega</th>
<th>Cliente</th>
<th>Total €</th>
</tr>
<?php

$result=mysql_query("SELECT * FROM pedidos ORDER BY idPedido ASC LIMIT ".$inicio."," . $tam_pag);
//Mostramos los registros
while ($row=mysql_fetch_array($result)) {
	echo '<tr><td>'.utf8_encode($row["idPedido"]).'</td>';
	$masa=mysql_query("select descripcion from masas WHERE idMasa = ".$row["idMasa"]);
	while ($fila=mysql_fetch_array($masa)) {
		echo '<td>'.utf8_encode($fila["descripcion"]).'</td>';
	}
	echo '<td>'.$row["numIng"].'</td>';
	echo '<td>'.$row["tamano"].'</td>';
	echo '<td>'.$row["unidades"].'</td>';
	echo '<td>'.$row["entrega"].'</td>';
	echo '<td>'.$row["formaPago"].'</td>';
	echo '<td>'.$row["fecha"].'</td>';
	echo '<td>'.$row["hora"].'</td>';
	$cliente=mysql_query("select nombre from clientes WHERE id_cliente = ".$row["id_cliente"]);
	while ($fil=mysql_fetch_array($cliente)) {
		echo '<td>'.utf8_encode($fil["nombre"]).'</td>';
	}
	echo '<td>'.$row["total"].'</td></tr>';
}

echo '</table>';
echo '<div style="margin-bottom:20px; margin-left:890px;" align="center">';

if ($total_paginas > 1) {
   	if ($pagina != 1)
      		echo '<p style="float:left;"><a href="?pagina='.($pagina-1).'"><img src="img/izq.gif" border="0"></a></p>';
      		for ($i=1;$i<=$total_paginas;$i++) {
         		if ($pagina == $i)
            			//si muestro el índice de la página actual, no coloco enlace
           			echo '<p style="float:left; border:1px coral solid; width:10px;">'.$pagina.'</p>';
         		else
				//si el índice no corresponde con la página mostrada actualmente,
				//coloco el enlace para ir a esa página
				echo '<p style="float:left; border: 1px coral solid; width:10px;"><a href="?pagina='.$i.'">'.$i.'</a></p>';
		}
		if ($pagina != $total_paginas)
			echo '<p style="float:left;"><a href="?pagina='.($pagina+1).'"><img src="img/der.gif" border="0"></a></p>';
}
else {
	if ($total_paginas == 1) 
		echo '<p style="margin-left:15px; float:left; border:1px coral solid; width:10px;">1</p>';
}
?>

</div>
<div style="margin-top:60px" align="center">
<a href="consultaporfecha.php">Consulte los pedidos por fecha</a><br>
<a href="borrapedido.php">Anular un pedido</a><br>
<a href="index.php">Volver</a><br>
</div>
</div>
</BODY>
</HTML> 
