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

   if (isset($_REQUEST['borrar'])) {

		$id_pedido = $_REQUEST['idPedido'];
		$conex = mysql_connect("localhost","root","") or die("Problema en la conexion al servidor");
		mysql_select_db("pizzeria", $conex) or die("Problema en la conexion a la BD");
		$sSQL="Delete From pedidos Where idPedido = '$id_pedido'";
		mysql_query($sSQL);
		mysql_close($conex);
?>
<div align="center">
<h1>Pedido anulado</h1>
<a href='borrarpedido.php'>Anular otro pedido</a><br>	
<a href="verpedidos.php">Volver</a>
</div>
<?php
} else {
?>
<div align="center">
<h1>Anulación de pedidos</h1>
<?php

echo '<form class="borde" method="post" action="borrarpedido.php">';

$con = mysql_connect("localhost","root","") or die("Problema en la conexion al servidor");
mysql_select_db("pizzeria", $con) or die("Problema en la conexion a la BD");
$SQL="Select idPedido From pedidos WHERE id_cliente = '$id_cliente' Order By idPedido";
$result=mysql_query($SQL);
echo '<p><label>Pedido: </label>';
echo '<select name="idPedido">';

//Mostramos los registros en forma de menú desplegable
while ($row=mysql_fetch_array($result))
{echo '<option>'.utf8_encode($row["idPedido"]).'</option>';}
mysql_free_result($result)
?>

</select>
<br>
<input type="submit" name="borrar" value="Anular pedido"><br>
<a href="verpedidos.php">Volver</a>
</form>
<?php
	mysql_close($con);
   }
?>
</div>
</body>
</html> 
