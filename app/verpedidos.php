<HTML>
<HEAD>
<TITLE>PIZZERIA ASDFGH</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</HEAD>
<BODY>
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
//Conexion con la base
mysql_connect("localhost","root","");

//selección de la base de datos con la que vamos a trabajar
mysql_select_db("pizzeria");

$email = $_SESSION['usuario'];
//id cliente
$idcliente=mysql_query("SELECT id_cliente FROM clientes WHERE email = '$email'");
$fil=mysql_fetch_array($idcliente);
$id_cliente = utf8_encode($fil[0]);

//Ejecutamos la sentencia SQL
$consulta=mysql_query("select * from pedidos where id_cliente = '$id_cliente'");

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

$result=mysql_query("SELECT * FROM pedidos where id_cliente = '$id_cliente' ORDER BY idPedido ASC LIMIT ".$inicio."," . $tam_pag);
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
<a href="masa.php">Nuevo pedido</a><br>
<a href="borrarpedido.php">Anular un pedido</a><br>
<a href="index.php">Volver</a><br>
</div>

</BODY>
</HTML> 
