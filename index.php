<?php
      require_once("conexion/cnn.php");
      $obj=new clsConexion();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PUPUSERIA LA PERLITA</title>
    <link rel="stylesheet" href="css/master.css">
  </head>
  <body>

    <div class="login-box">
      <img src="img/pusas.jpg" class="avatar" alt="Avatar Image">
      <h1>Inicia sesión</h1>
      <form method="POST"><!-- AGREGUE method="POST" -->
        <!-- nombre de usuario -->
        <label for="username">Nombre de usuario</label>
        <input type="text" name="usuario" placeholder="Ingrese nombre de usuario"><!--AGREGUE ESTO name="usuario"-->
        <!-- CONTRASEÑA -->
        <label for="password">Contraseña</label>
        <input type="password" name="clave" placeholder="Introduzca contraseña"><!--AGREGUE ESTO name="clave"-->
        <input type="submit" name="entrar" value="Entrar"><!--AGREGUE ESTO name="entrar"-->
        <input type="reset" value="Limpiar">   <!--AGREGUE ESTO-->
      </form>
      <article><!--AGREGUE TODO ESTE ARTICULO-->
      <?php
        if(isset($_POST["entrar"])){
          $usuario=$_POST["usuario"];
          $clave=$obj->encriptar_desencriptar("encriptar",$_POST["clave"]);
          $rs=$obj->consultaGeneral("empleado WHERE usuario='$usuario' AND clave='$clave'","*");
          if($rs->num_rows>0){
             $fila=$rs->fetch_assoc();
             if($fila["nivel_acceso"]==1){
               header("location:admin.php");
               //echo $fila["nivel_acceso"];
             }
             elseif($fila["nivel_acceso"]==2){
              header("location:empleado");
              //echo $fila["nivel_acceso"];
             }else{
               echo "A surgido un error inesperado";
             }
          }else{
            echo "usuario o contraseña incorrectos";
          }
        }
      ?>
    </article><!--HASTA AQUI-->
    </div>
  </body>
</html>