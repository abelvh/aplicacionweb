<HTML>
<HEAD>
<TITLE>PIZZERIA ASDFGH</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</HEAD>
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

   if (isset($_REQUEST['actualizar'])) {
   	$idcliente = $_REQUEST['idcliente'];
	$nombre = $_REQUEST['nombre'];
	$telefono = $_REQUEST['telefono'];
	$nif = $_REQUEST['nif'];
	$direccion = $_REQUEST['direccion'];
	$clave = $_REQUEST['clave'];
	$email = $_REQUEST['email'];
	
	//Conexion con la base
	mysql_connect("localhost","root","");

	//selección de la base de datos con la que vamos a trabajar
	mysql_select_db("pizzeria");

	//Ejecucion de la sentencia SQL
	mysql_query("Update clientes Set nombre='$nombre', telefono='$telefono', nif='$nif', direccion='$direccion', clave='$clave', email='$email' Where id_cliente='$idcliente'");
	?>

	<div align="center">
	<h1>Cliente actualizado</h1>
	<a href='actualizacliente.php'>Actualizar otro cliente</a><br>	
	<a href="verclientes.php">Volver</a>
	</div>
<?php } else { ?>

<div align="center">
<h1>Actualización de clientes</h1>

<?php
echo '<form class="borde" method="post" action="actualizacliente.php">';

$con = mysql_connect("localhost","root","") or die("Problema en la conexion al servidor");
mysql_select_db("pizzeria", $con) or die("Problema en la conexion a la BD");
$SQL="Select id_cliente From clientes Where id_cliente!='0' Order By id_cliente";
$result=mysql_query($SQL);
echo '<p><label>IdCliente: </label>';
echo '<select name="idcliente">';

//Mostramos los registros en forma de menú desplegable
while ($row=mysql_fetch_array($result))
{echo '<option>'.utf8_encode($row["id_cliente"]).'</option>';}
mysql_free_result($result)
?>

</select>
<br>
Nombre <br>
<INPUT TYPE="text" NAME="nombre"> <br>
Telefono <br>
<INPUT TYPE="text" NAME="telefono"> <br>
Nif <br>
<INPUT TYPE="text" NAME="nif"> <br>
Direccion <br>
<INPUT TYPE="text" NAME="direccion"> <br>
Clave <br>
<INPUT TYPE="text" NAME="clave"> <br>
Email <br>
<INPUT TYPE="text" NAME="email"> <br>
<input type="submit" name="actualizar" value="Actualizar cliente"><br>
<a href="verclientes.php">Volver</a>
</form>
</div>
<?php } ?>
</BODY>
</HTML> 
