<?php
require_once("conexion/cnn.php");
$obj = new clsConexion();
$sql = "select * from empleado where id_empleado='" . $_GET["id_empleado"] . "'";
$rs = $obj->consultasql($sql);
$fila = $rs->fetch_assoc();
  if (isset($_POST["modificar"]))
    {  //si presionamos el boton para insertar
      $nivel = $_POST["nivel"];
      $dui = $_POST["dui"];
      $nombre = $_POST["nombre"];
      $direccion = $_POST["direccion"];
      $usuario = $_POST["usuario"];
      $clave = $obj->encriptar_desencriptar("encriptar",$_POST["clave"]);
      $sqlinsert = "
      update empleado set 
         id_cargo='$nivel'
        ,dui='$dui'
        ,nombre_completo='$nombre'
        ,direccion_empleado='$direccion'
        ,usuario='$usuario'
        ,clave='$clave'
        ,nivel_acceso='$nivel'
        where id_empleado='" . $_GET["id_empleado"] . "'
      ";
      $rs=$obj->consultasql($sqlinsert);
      //$rs = $conn->query($sqlinsert);
      echo "<script>alert('Dato modificado');window.location='registro.php';	</script>";
    }
  elseif(isset($_POST["cancelar"]))
    {
      echo "<script>alert('Cancelado');window.location='admin.php';	</script>";
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PUPUSERIA LA PERLITA</title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/tabla.css">
  </head>
  <body>

    <div class="login-box">
      <img src="img/pusas.jpg" class="avatar" alt="Avatar Image">
      <h1>Registrate</h1>
      <form method="post">
      <table border="0px" >
         
         <tbody>
           <tr>
                <!-- DUI -->
             <td for="username">Ingrese numero de DUI
             <input type="text" minlength="10" maxlength="10" required pattern="[0-9]{8}[.-][0-9]{1}" title="El formato de DUI comprende 8 digitos, un guión y un digito mas." placeholder="ejem: 08755587-9" name="dui" value="<?php echo $fila["dui"]; ?>"/></td>
                       <!-- nombre de usuario -->
             <td for="username">    Nombre de usuario
               <input type="text" placeholder="Ingrese nombre de usuario" name="usuario" value="<?php echo $fila["usuario"]; ?>"></td>
           </tr>
           <tr>
               <!-- nombre COMPLETO-->
             <td for="username">  Ingrese su nombre completo
               <input type="text" placeholder="Nombre completo" name="nombre" value="<?php echo $fila["nombre_completo"]; ?>"></td>
                 <!-- CONTRASEÑA -->
             <td for="password"> Contraseña
               <input type="text" placeholder="Introduzca su contraseña" name="clave" value="
               <?php
               $a=$obj->encriptar_desencriptar("desencriptar",$fila["clave"]);
                $clave=ltrim($a, " ");
               echo $clave; 
               ?>"></td>
            

           </tr>
           <tr>
              <!-- DIRECCIÓN-->
             <td for="username">   Ingrese su dirección
               <input type="text" placeholder="Dirección" name="direccion" value="<?php echo $fila["direccion_empleado"]; ?>"></td>
             <td><select name="nivel" >
               <option value="1">Seleccione su nivel de acceso</option> 
               <?php
               echo "<form method='post'>";
               $campos = "
               id_cargo,
               cargo
               ";
              $tabla = "cargo";
              $rs = $obj->consultaGeneral($tabla, $campos);
              while ($fila2 = $rs->fetch_assoc()) 
                {
                  if($fila["id_cargo"]==$fila2["id_cargo"])
                    {
                      echo "
                      <option value='$fila2[id_cargo]' selected>$fila2[cargo]</option> 
                      ";
                    }
                  else
                    {
                      echo "
                      <option value='$fila2[id_cargo]'>$fila2[cargo]</option> 
                      ";
                    }

                }
               ?>
           </select></td>
           </tr>
         </tbody>
         </table>
        <input type="submit" value="Guardar Modificación" name="modificar">
        <input type="submit" value="Cancelar" name="cancelar">
      </form>
      </div>
  </body>
</html>