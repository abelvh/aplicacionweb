<HTML>
<HEAD>
<TITLE>PIZZERIA ASDFGH</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</HEAD>
<BODY>
<?
$nombre = $_REQUEST['nombre'];
$telefono = $_REQUEST['telefono'];
$nif = $_REQUEST['nif'];
$direccion = $_REQUEST['direccion'];
$email = $_REQUEST['email'];
$clave = $_REQUEST['contraseña'];
//Conexion con la base
mysql_connect("localhost","root","");

//selección de la base de datos con la que vamos a trabajar
mysql_select_db("pizzeria");

//Ejecucion de la sentencia SQL
mysql_query("insert into clientes (telefono, nombre, nif, direccion, clave, email) values ('$telefono','$nombre','$nif','$direccion','$clave','$email')");
?>
<h1><div align="center">Usuario dado de alta</div></h1>
<div align="center">
<?php session_start();  
 $_SESSION['usuario'] = $email;  
  //Redireccionamos a la pagina: index.php
  header("Location: index.php"); 
?>
</div>
</BODY>
</HTML> 
