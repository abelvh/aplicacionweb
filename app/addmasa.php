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


#ingredientes{
	background-color: #ec4042;
	color:white;
	width: 150px;
	height: 36px;
	border-radius: 5px;
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


   if (isset($_REQUEST['enviar'])) {

	$descripcion = $_REQUEST['descripcion'];
	$precio = $_REQUEST['precio'];
	//Conexion con la base
	$con =mysql_connect("localhost","root","")or die ("fallo en la conexion con el servidor");

	//selección de la base de datos con la que vamos a trabajar
	mysql_select_db("pizzeria", $con)or die ("Fallo en la conexion con la BD");

	//Ejecucion de la sentencia SQL
	mysql_query("INSERT INTO masas (descripcion, precio) VALUES ('$descripcion','$precio')")or die("fallo en la consulta");
mysql_close($con) or die ("en la consulta2");
?>
	   <div class="container well" id="formatear">
       <img src="logo.jpg" alt="Avatar" height="256" width="256" class="img-responsive" id="logo">
	<h1>Masa registrada</h1>
	<a href='addmasa.php'>Añadir otra masa</a><br>	
	<a href="vermasa.php">Volver</a>
	</div>
<?php } else { ?>
   <div class="container well" id="formatear">
       <img src="logo.jpg" alt="Avatar" height="256" width="256" class="img-responsive" id="logo">
<h1>Alta de masas</h1>
<br>
<FORM METHOD="POST" ACTION="addmasa.php">
Nombre de la masa<br>
<INPUT TYPE="TEXT" NAME="descripcion" required="required"><br>
Precio<br>
<INPUT TYPE="text" NAME="precio" required="required"><br><br>
<INPUT TYPE="SUBMIT" name="enviar" value="Dar de Alta" id="ingredientes"><br><br>
<a href="vermasa.php">Volver</a>
</FORM>
</div>
<?php } ?>
</BODY>
</HTML> 
