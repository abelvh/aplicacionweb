<HTML>
<HEAD>
<TITLE>PIZZERIA ASDFGH</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</HEAD>
<BODY>
<?php
/****************************************
**Si la conexion fallara mandamos un msj 'ha fallado la conexion'**/
mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.mysql_error());

/*Luego hacemos la conexión a la base de datos. 
**De igual manera mandamos un msj si hay algun error*/
mysql_select_db('pizzeria')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
 
/*caturamos nuestros datos que fueron enviados desde el formulario mediante el metodo POST
**y los almacenamos en variables.*/
$email = $_POST["email_usuario"];   
$password = $_POST["password_usuario"];

/*Consulta de mysql con la que indicamos que necesitamos que seleccione
**solo los campos que tenga como email el que el formulario
**le ha enviado*/
$result = mysql_query("SELECT * FROM clientes WHERE email = '$email'");

//Validamos si el email del usuario existe en la base de datos o es correcto
if($row = mysql_fetch_array($result))
{     
//Si el usuario es correcto ahora validamos su contraseña
 if($row["clave"] == $password)
 {
  //Creamos sesión
  session_start();  
  //Almacenamos el nombre de usuario en una variable de sesión usuario
  $_SESSION['usuario'] = $email;  
  //Redireccionamos a la pagina: index.php
  header("Location: index.php");  
 }
 else
 {
  //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
  ?>
    <div align="center">
    <h3>Contraseña Incorrecta</h3>
    <a href= "login.php">Volver a loguear</a>
    </div>
  <?php
            
 }
}
else
{
 //en caso que el nombre de usuario es incorrecto enviamos un msj y redireccionamos a login.php
?>
    <div align="center">
    <h3>Email incorrecto</h3>
    <a href= "login.php">Volver a loguear</a>
    </div>
<?php 
        
}

//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
@mysql_free_result($result);

/*Mysql_close() se usa para cerrar la conexión a la Base de datos y es 
**necesario hacerlo para no sobrecargar al servidor .*/
mysql_close();
?>
</BODY>
</HTML> 
