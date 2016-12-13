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

.centrar{
	text-align: center;
}
#formatear{
	max-width: 340px;
    -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    -moz-box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    box-shadow: 0px 0px 18px 0px rgba(48, 50 50, 0.48);
    border-radius: 6%;
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
#avatar{
  border-radius: 50%;
  margin-left: 7%;
}
</style>


  </head>
  <body>
    <div class="container well" id="formatear">
<form action="validar_usuario.php" method="post">
      <div class="row">
        <div class="col-xs-12">
          <img src="logo.jpg" alt="Avatar" height="256" width="256" class="img-responsive" id="avatar">
        </div>
      </div>
      <form>
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Usuario" name="email_usuario" required autofocus>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Contraseña" name="password_usuario" required>
        </div>
        <button class="btn btn-lg btn-danger btn-block" type="submit"><a href="admin1.html">Iniciar sesión</a></button>




        <div class="checkbox">
          <label class="checkbox">
            <input type="checkbox" value="1" name="remember">No cerrar sesión
          </label>
           <a href="registro.html">Registrarse</a>
  
<h5>Puedes consultar nuestros ingredientes como </h5><a href="invitado.php"><h5>invitado</h5></a>
        </div>
      </form>
    </div>
  </body>
</html>




   
