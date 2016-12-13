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
	$nombre = $_REQUEST['nombre'];
	$precio = $_REQUEST['precio'];
	//Conexion con la base
	mysql_connect("localhost","root","");

	//selección de la base de datos con la que vamos a trabajar
	mysql_select_db("pizzeria");

	//Ejecucion de la sentencia SQL
	mysql_query("Update masas Set precio='$precio' Where descripcion='$nombre'");
	?>

	<div align="center">
	<h1>Masa actualizada</h1>
	<a href='actualizamasa.php'>Actualizar otra masa</a><br>	
	<a href="vermasa.php">Volver</a>
	</div>
<?php } else { ?>

<div align="center">
<h1>Actualización de masas</h1>

<?php
echo '<form class="borde" method="post" action="actualizamasa.php">';

$con = mysql_connect("localhost","root","") or die("Problema en la conexion al servidor");
mysql_select_db("pizzeria", $con) or die("Problema en la conexion a la BD");
$SQL="Select descripcion From masas Order By descripcion";
$result=mysql_query($SQL);
echo '<p><label>Nombre: </label>';
echo '<select name="nombre">';

//Mostramos los registros en forma de menú desplegable
while ($row=mysql_fetch_array($result))
{echo '<option>'.utf8_encode($row["descripcion"]).'</option>';}
mysql_free_result($result)
?>

</select>
<br>
Precio<br>
<INPUT TYPE="TEXT" NAME="precio"><br>
<input type="submit" name="actualizar" value="Actualizar precio masa"><br>
<a href="vermasa.php">Volver</a>
</form>
</div>
<?php } ?>
</BODY>
</HTML> 
