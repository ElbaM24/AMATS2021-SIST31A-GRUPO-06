<?php
require_once("conexion/cnn.php");
$obj = new clsConexion();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tabla.css">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <table border="0px" class="tabla1">
            <tbody>
                <tr>
                    <!-- DUI -->
                    <td for="username"> Nombres del cliente
                        <input type="text" placeholder="nombre" name="nombre">
                    </td>
                </tr>
                <tr>
                    <td for="username"> Apellidos del cliente
                        <input type="text" placeholder="Apellidos" name="apellidos">
                    </td>
                </tr>
                <tr>
                    <!-- DIRECCIÓN-->
                    <td for="username"> Dirección del cliente
                        <input type="text" placeholder="Dirección" name="direccion">
                    </td>
                </tr>
                <tr>
                    <td for="username">Nombre de Empleado que registra
                        <select name="empleado">
                            <option value="1" selected>Seleccione un empleado</option>
                            <?php
                            $campos = "
                            *
                            ";
                            $tabla = "empleado";
                            $rs = $obj->consultaGeneral($tabla, $campos);
                            while ($fila = $rs->fetch_assoc()) {
                                echo "
                            <option value='$fila[id_empleado]'>$fila[nombre_completo]</option> 
                            ";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <td>
                    <input type="submit" value="Registrar" name="registrar">
                    <input type="submit" value="Buscar" name="buscar">
                    <input type="reset" value="Limpiar">
                </td>
            </tbody>
        </table>
    </form>
    <?php
        /*BOTONES SUBMIT*/
    if (isset($_POST["registrar"])) 
        {  //registrar es guardar
          $valores[] = $_POST["nombre"];
          $valores[] = $_POST["apellidos"];
          $valores[] = $_POST["direccion"];
          $valores[] = $_POST["empleado"];
          $campos = array("
            nombre_cliente
          , apellido_cliente
          , direccion_cliente
          , id_empleado
          ");
          $obj->insertarSQL(" cliente ", $campos, $valores);
        }
    elseif (isset($_POST["okeliminar"])) 
        {
          $eliminar = $_POST["eliminar"];
          foreach ($eliminar as $id_cliente) 
            {
              $rs = $obj->eliminarSQL("cliente", " id_cliente = '$id_cliente'");
            }
        }
    elseif(isset($_POST["buscar"])) 
        {
            $nombre = $_POST["nombre"];
            $campos = "
                   id_cliente
                ,  empleado.nombre_completo
                ,  nombre_cliente
                ,  apellido_cliente
                ,  direccion_cliente
            ";
            $tabla = "
            cliente INNER JOIN empleado 
            ON (cliente.id_empleado = empleado.id_empleado)
            ";
            $rs = $obj->consultaGeneral("$tabla", "$campos", " nombre_cliente LIKE '%$nombre%'");
            echo "<form method='post'>";
        
            echo "
                <table class='greenTable'>
                <thead>
                <tr>
                <th>CHECK</th>
                <th>ID CLIENTE</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>DIRECIÓN</th>
                <th>EMPLEADO</th>
                <th>MODIFICAR</th>
                </tr>
                </thead>
            ";
            while ($fila = $rs->fetch_assoc()) 
                {
                    echo "
                    <tbody>
                    <tr>
                    <td><input type=checkbox name=eliminar[] value='$fila[id_cliente]'></td>
                    <td>$fila[id_cliente]</td>
                    <td>$fila[nombre_cliente]</td>
                    <td>$fila[apellido_cliente]</td>
                    <td>$fila[direccion_cliente]</td>
                    <td>$fila[nombre_completo]</td>
                    <td><a href='?pagina=mod_cliente.php&id_cliente=$fila[id_cliente]'>Modificar</a></td>
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
          header("location:admin.php?pagina=cliente.php");
        }
        /*FIN DE LOS SUBMIT */
    echo "<form method='post'>";
    $campos = "
          id_cliente
       ,  empleado.nombre_completo
       ,  nombre_cliente
       ,  apellido_cliente
       ,  direccion_cliente
 ";
    $tabla = "
   cliente INNER JOIN empleado 
   ON (cliente.id_empleado = empleado.id_empleado)
 ";
    $rs = $obj->consultaGeneral($tabla, $campos);
    echo "
       <table class='greenTable'>
       <thead>
       <tr>
       <th>CHECK</th>
       <th>ID CLIENTE</th>
       <th>NOMBRE</th>
       <th>APELLIDO</th>
       <th>DIRECIÓN</th>
       <th>EMPLEADO</th>
       <th>MODIFICAR</th>
       </tr>
       </thead>
       ";
    while ($fila = $rs->fetch_assoc()) {
        echo "
         <tbody>
         <tr>
         <td><input type=checkbox name=eliminar[] value='$fila[id_cliente]'></td>
         <td>$fila[id_cliente]</td>
         <td>$fila[nombre_cliente]</td>
         <td>$fila[apellido_cliente]</td>
         <td>$fila[direccion_cliente]</td>
         <td>$fila[nombre_completo]</td>
         <td><a href='?pagina=mod_cliente.php&id_cliente=$fila[id_cliente]'>Modificar</a></td>
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
</body>

</html>