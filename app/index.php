<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMOR</title>
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
  <body>
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

mysql_connect('localhost','root','');
mysql_select_db('pizzeria');
$email = $_SESSION['usuario'];  
$result = mysql_query("SELECT nombre FROM clientes WHERE email = '$email'");
$row=mysql_fetch_array($result);
if ($email != "administrador@pizzeria.com") {
 ?>
     <div class="container well" id="formatear">
       <img src="logo.jpg" alt="Avatar" height="256" width="256" class="img-responsive" id="logo">
      <div class="row">
        <div class="col-xs-12">

  <h1>Bienvenido Abel Vilca <? echo utf8_encode($row[0]); ?>!!!</h1>
  
  
  <a href="masa.php" class="btn btn-danger" role="button">Pedir una pizza</a><br><br>

  <a href="logout.php">Cerrar Sesión</a>
  </div>
 <?php
} else { ?>
     <div class="container well" id="formatear">
       <img src="logo.jpg" alt="Avatar" height="256" width="256" class="img-responsive" id="logo">

  <h3>Bienvenido <? echo $row[0]; ?></h3>
  <h4>Que deseas hacer??¿¿</h4>
  <a href="vermasa.php">Ver masas</a><br>
  <a href="veringre.php">Ver ingredientes</a><br>
  <a href="verclientes.php">Ver clientes</a><br>
  <a href="pedidos.php">Ver pedidos</a><br>
  <a href="logout.php">Cerrar Sesión</a>
  </div>
 </div>
        </div>
<?php
}
?>
</BODY>
</HTML> 

