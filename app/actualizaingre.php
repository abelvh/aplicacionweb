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
	$descripcion = $_REQUEST['descripcion'];
	$nombreFichero = "";

	$copiarFichero = false;

      if (is_uploaded_file ($_FILES['imagen']['tmp_name'])) {
         $nombreDirectorio = "img/";
         $nombreFichero = $_FILES['imagen']['name'];
         $copiarFichero = true;

         $nombreCompleto = $nombreDirectorio . $nombreFichero;
      } 
	if ($nombreFichero != "")
		move_uploaded_file ($_FILES['imagen']['tmp_name'],
            $nombreDirectorio . $nombreFichero);
	//Conexion con la base
	mysql_connect("localhost","root","");

	//selección de la base de datos con la que vamos a trabajar
	mysql_select_db("pizzeria");

	//Ejecucion de la sentencia SQL
	mysql_query("Update ingredientes Set descripcion='$descripcion', imagen='$nombreFichero' Where nombreIng='$nombre'");
	?>

	<div align="center">
	<h1>Ingrediente actualizado</h1>
	<a href='actualizaingre.php'>Actualizar otra ingrediente</a><br>	
	<a href="veringre.php">Volver</a>
	</div>
<?php } else { ?>

<div align="center">
<h1>Actualización de ingredientes</h1>

<?php
echo '<form class="borde" method="post" action="actualizaingre.php" enctype="multipart/form-data">';

$con = mysql_connect("localhost","root","") or die("Problema en la conexion al servidor");
mysql_select_db("pizzeria", $con) or die("Problema en la conexion a la BD");
$SQL="Select nombreIng From ingredientes Order By nombreIng";
$result=mysql_query($SQL);
echo '<p><label>Nombre: </label>';
echo '<select name="nombre">';

//Mostramos los registros en forma de menú desplegable
while ($row=mysql_fetch_array($result))
{echo '<option>'.utf8_encode($row["nombreIng"]).'</option>';}
mysql_free_result($result)
?>

</select>
<br>
Descripcion <br>
<INPUT TYPE="text" NAME="descripcion"> <br>
Imagen <br>
<INPUT TYPE="FILE" size="44" name="imagen"><br>
<input type="submit" name="actualizar" value="Actualizar ingrediente"><br>
<a href="veringre.php">Volver</a>
</form>
</div>
<?php } ?>
</BODY>
</HTML> 
