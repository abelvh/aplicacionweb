<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RomAmoR</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="estilo.css">

<style>
body{
    background-image: url("fondo.png") ;
    background-attachment: fixed;

}

.centrar{
	text-align: center;
}
#formatear{
	max-width: 340px;
    -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    -moz-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    border-radius: 6%;
    text-align: center;
}
#login{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
}
.bajar1{
    margin-top: 10px;
}
.bajar2{
    margin-top: 20px;
}
.error{
    text-align: center;
    background-color: red;
    font-size: 30px;
    color: white;
}
#ingredientes{
	background-color: #ec4042;
	color:white;
	width: 150px;
	height: 36px;
	border-radius: 5px;
	text-align: center;
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

mysql_connect("localhost","root","");
mysql_select_db("pizzeria");
$result = mysql_query("SELECT * FROM ingredientes");

if(isset($_POST['confirmar'])) {
	$email = $_SESSION['usuario'];
	$masa = $_REQUEST['masa'];
	$ingre = $_REQUEST['ingre'];
	$ingres = strtolower($ingre);
	$ningres = $_REQUEST['ningre'];
	$tamanio = $_REQUEST['tamanio'];
	$unidades = $_REQUEST['unidades'];
	$entrega = $_REQUEST['entrega'];
	$pago = $_REQUEST['pago'];
	$hora = $_REQUEST['hora'];
	$fecha = $_REQUEST['fecha'];

	//Conexion con la base
	mysql_connect("localhost","root","");

	//selección de la base de datos con la que vamos a trabajar
	mysql_select_db("pizzeria");

	//id masa
	$idmasa=mysql_query("SELECT idMasa FROM masas WHERE descripcion = '$masa'");
	$fila=mysql_fetch_array($idmasa);
	$id_masa = utf8_encode($fila[0]);
	
	//precio masa
	$preciomasa=mysql_query("SELECT precio FROM masas WHERE descripcion = '$masa'");
	$fi=mysql_fetch_array($preciomasa);
	$precio_masa = utf8_encode($fi[0]);
	

	//id cliente
	$idcliente=mysql_query("SELECT id_cliente FROM clientes WHERE email = '$email'");
	$fil=mysql_fetch_array($idcliente);
	$id_cliente = utf8_encode($fil[0]);

	//direccion cliente
	$direccioncliente=mysql_query("SELECT direccion FROM clientes WHERE email = '$email'");
	$f=mysql_fetch_array($direccioncliente);
	$direccion_cliente = utf8_encode($f[0]);

	//nombre cliente
	$nombrecliente=mysql_query("SELECT nombre FROM clientes WHERE email = '$email'");
	$row=mysql_fetch_array($nombrecliente);
	$nombre_cliente = utf8_encode($row[0]);

	//entrega
	if($entrega == "local")
		$ent = "En el local";
	else
		$ent = $direccion_cliente;
	
	$total = $precio_masa*$unidades;
	//Ejecucion de la sentencia SQL
	mysql_query("insert into pedidos (idMasa, numIng, ingredientes, tamano, unidades, entrega, formaPago, fecha, hora, id_cliente, total) values ('$id_masa','$ningres','$ingres','$tamanio','$unidades','$ent','$pago','$fecha','$hora','$id_cliente','$total')");
}

require('fpdf/fpdf.php');

class PDF extends FPDF
{
   //Cabecera de página
   function Header()
   {
       	$this->Image('img/logo.jpeg',10,8,33);
      	$this->SetFont('Arial','B',12);	
	//Movernos a la derecha
	$this->Cell(80);
	

	
   }
   //Pie de página
   function Footer()
   {
      	$this->SetY(-10);
	$this->SetFont('Arial','I',8);
 	$this->Cell(0,10,'Page '.$this->PageNo() ,0,0,'C');
   }
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Ln(40);
$pdf->Cell(80, 10, 'Pizza de '.$masa, 0);
$pdf->Ln(10);
$pdf->Cell(80, 10,  utf8_decode('Número Ingredientes: '.$ningres), 0);
$pdf->Ln(10);
$pdf->Cell(80, 10, 'Ingredientes: '.$ingres, 0);
$pdf->Ln(10);
$pdf->Cell(80, 10,  utf8_decode('Tamaño: '.$tamanio), 0);
$pdf->Ln(10);
$pdf->Cell(80, 10, 'Unidades: '.$unidades, 0);
$pdf->Ln(10);
$pdf->Cell(80, 10, 'Precio unidad: '.$precio_masa .' euros', 0);
$pdf->Ln(10);
$pdf->Cell(80, 10, 'A pagar: '.$total.' euros', 0);
$pdf->Ln(10);
$pdf->Cell(80, 10, 'Forma de pago: '.$pago, 0);
$pdf->Ln(10);
$pdf->Cell(80, 10, 'Fecha entrega: ' .$fecha, 0);
$pdf->Ln(10);
$pdf->Cell(80, 10, 'Hora entrega: ' .$hora, 0);
$pdf->Ln(10);
$pdf->Cell(80, 10, 'Lugar de entrega: ' .$ent, 0);
$pdf->Ln(10);
$pdf->Cell(80, 10, 'Nombre cliente: '.$nombre_cliente, 0);
$pdf->Output("pizza.pdf");
?> 
<div class='container well' id='formatear'><br>
<img src="img/cocinerorpp.gif" alt="clkkklk" width="95%">
<h1><strong>Su pedido se ha realizado con exito¡¡¡</strong></h1>
<p>Que desea hacer ahora?¿</p>
<a href="pizza.pdf" target="_blank">Ver factura</a><br/>
<a href="masa.php">Pedir otra pizza</a><br/>
<a href="login.php">Página principal</a><br/>
<a href="logout.php">Cerrar Sesión</a>
</div>
</BODY>
</HTML> 
