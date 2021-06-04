<?php
require_once("conexion/cnn.php");
$obj = new clsConexion();
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
             <input type="text" minlength="10" maxlength="10" required pattern="[0-9]{8}[.-][0-9]{1}" title="El formato de DUI comprende 8 digitos, un guión y un digito mas." placeholder="ejem: 08755587-9" name="dui" /></td>
                       <!-- nombre de usuario -->
             <td for="username">    Nombre de usuario
               <input type="text" placeholder="Ingrese nombre de usuario" name="usuario"></td>
          
            
           </tr>
           <tr>
               <!-- nombre COMPLETO-->
             <td for="username">  Ingrese su nombre completo
               <input type="text" placeholder="Nombre completo" name="nombre"></td>
                 <!-- CONTRASEÑA -->
             <td for="password"> Contraseña
               <input type="password" placeholder="Introduzca su contraseña" name="clave"></td>
            

           </tr>
           <tr>
              <!-- DIRECCIÓN-->
             <td for="username">   Ingrese su dirección
               <input type="text" placeholder="Dirección" name="direccion"></td>
             <td><select name="nivel" >
               <option value="1" selected>Seleccione su nivel de acceso</option> 
               <?php
               $campos = "
               id_cargo,
               cargo
               ";
              $tabla = "cargo";
              $rs = $obj->consultaGeneral($tabla, $campos);
              while ($fila = $rs->fetch_assoc()) {
                echo "
                    <option value='$fila[id_cargo]'>$fila[cargo]</option> 
                    ";
              }
               ?>
           </select></td>
           </tr>
        
        
         </tbody>
         </table>
        <input type="submit" value="Registrar" name="registrar">
        <input type="submit" value="Buscar" name="buscar">
        
      </form>
      <?php
      /*BOTONES SUBMIT*/
        if (isset($_POST["registrar"])) 
          {  //registrar es guardar
            $valores[] = $_POST["nivel"];
            $valores[] = $_POST["dui"];
            $valores[] = $_POST["nombre"];
            $valores[] = $_POST["direccion"];
            $valores[] = $_POST["usuario"];
            $valores[] = $obj->encriptar_desencriptar("encriptar",$_POST["clave"]);
            $valores[] = $_POST["nivel"];
            $campos = array("
              id_cargo
            , dui
            , nombre_completo
            , direccion_empleado
            , usuario
            , clave
            , nivel_acceso");
            $obj->insertarSQL("empleado", $campos, $valores);
          }
        elseif (isset($_POST["okeliminar"])) 
          {
            $eliminar = $_POST["eliminar"];
            foreach ($eliminar as $id_empleado) 
              {
                $rs = $obj->eliminarSQL("empleado", " id_empleado = '$id_empleado'");
              }
          }
        elseif (isset($_POST["buscar"])) 
          {
            echo "<form method='post'>";
            $campos="
                id_empleado
              ,  cargo.id_cargo
              ,  dui
              , nombre_completo
              , direccion_empleado
              , usuario
              , clave
              , nivel_acceso
              ";
            $tabla="
              empleado
                  INNER JOIN cargo 
                      ON (empleado.id_cargo = cargo.id_cargo)
            ";
            $dui = $_POST["dui"];
            $rs = $obj->consultaGeneral("$tabla", "$campos", "dui LIKE'%$dui%'");
              echo "
              <table class='greenTable'>
              <thead>
              <tr>
              <th>CHECK</th>
              <th>ID EMPLEADO</th>
              <th>ID CARGO</th>
              <th>DUI</th>
              <th>NOMBRE</th>
              <th>DIRECCIÓN</th>
              <th>USUARIO</th>
              <th>CLAVE</th>
              <th>NIVEL ACCESO</th>
              <th>MODIFICAR</th>
              </tr>
              </thead>
              ";
            while ($fila = $rs->fetch_assoc()) 
              {
                echo "
                    <tbody>
                    <tr>
                    <td><input type=checkbox name=eliminar[] value='$fila[id_empleado]'></td>
                    <td>$fila[id_empleado]</td>
                    <td>$fila[id_cargo]</td>
                    <td>$fila[dui]</td>
                    <td>$fila[nombre_completo]</td>
                    <td>$fila[direccion_empleado]</td>
                    <td>$fila[usuario]</td>
                    <td>$fila[clave]</td>
                    <td>$fila[nivel_acceso]</td>
                    <td><a href='?pagina=mod_cargo.php&id_empleado=$fila[id_empleado]'>Modificar</a></td>
                    </tr>
                    ";
              }
            echo "  <tr>
              <td colspan='10' align='center'>
              <input type='submit' name='okeliminar' value='Eliminar' />
              <input type='submit' name='cerrarB' value='Cerrar busqueda' />
              </td>
              </tr>
              </tbody>
              </table>
            </form>
            ";
          }
        elseif(isset($_POST["cerrarB"]))
          {
            header("location:admin.php");
          }
      /*FIN DE LOS SUBMIT */
    echo "<form method='post'>";
    $campos="
        id_empleado
      ,  cargo.id_cargo
      ,  dui
      , nombre_completo
      , direccion_empleado
      , usuario
      , clave
      , nivel_acceso
";
$tabla="
  empleado
      INNER JOIN cargo 
          ON (empleado.id_cargo = cargo.id_cargo)
";
  $rs = $obj->consultaGeneral($tabla, $campos);
  echo "
      <table class='greenTable'>
      <thead>
      <tr>
      <th>CHECK</th>
      <th>ID EMPLEADO</th>
      <th>ID CARGO</th>
      <th>DUI</th>
      <th>NOMBRE</th>
      <th>DIRECCIÓN</th>
      <th>USUARIO</th>
      <th>CLAVE</th>
      <th>NIVEL ACCESO</th>
      <th>MODIFICAR</th>
      </tr>
      </thead>
      ";
  while ($fila = $rs->fetch_assoc()) {
    echo "
        <tbody>
        <tr>
        <td><input type=checkbox name=eliminar[] value='$fila[id_empleado]'></td>
        <td>$fila[id_empleado]</td>
        <td>$fila[id_cargo]</td>
        <td>$fila[dui]</td>
        <td>$fila[nombre_completo]</td>
        <td>$fila[direccion_empleado]</td>
        <td>$fila[usuario]</td>
        <td>$fila[clave]</td>
        <td>$fila[nivel_acceso]</td>
        <td><a href='mod_registro.php?id_empleado=$fila[id_empleado]'>Modificar</a></td>
        </tr>
        ";
  }
  echo "  <tr>
      <td colspan='10' align='center'>
      <input type='submit' name='okeliminar' value='Eliminar' />
      </td>
      </tr>
      </tbody>
      </table>
    </form>
    
    ";
  ?>
    </div>
    
  </body>
</html>