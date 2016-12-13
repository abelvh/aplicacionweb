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

   if (isset($_REQUEST['enviar'])) {
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
	mysql_query("insert into ingredientes (nombreIng, descripcion, imagen) values ('$nombre','$descripcion','$nombreFichero')");
	?>
	     <div class="container well" id="formatear">
       <img src="logo.jpg" alt="Avatar" height="256" width="256" class="img-responsive" id="logo">
	<h1><div align="center">Ingrediente registrado</div></h1>
	<div align="center">
	<a href='engadeingre.php'>Añadir otro ingrediente</a><br>	
	<a href="veringre.php">Volver</a>
	</div>
	</div><?php } else { 
?>
     <div class="container well" id="formatear">
       <img src="logo.jpg" alt="Avatar" height="256" width="256" class="img-responsive" id="logo">
<h1>Alta de ingredientes</h1>
<br>
<FORM METHOD="POST" ACTION="engadeingre.php" ENCTYPE="multipart/form-data">
Nombre del ingrediente<br>
<INPUT TYPE="TEXT" NAME="nombre" required="required"><br><br>
Descripcion (Opcional)<br>
<INPUT TYPE="text" NAME="descripcion"> <br><br>
Imagen (Opcional)<br>
<INPUT TYPE="FILE" size="44" name="imagen"><br>
<INPUT TYPE="SUBMIT" name="enviar" value="Dar de Alta" id="ingredientes"><br><br>
<a href="veringre.php">Volver</a>
</FORM>
</div>
<?php } ?>
</BODY>
</HTML> 
