<?php
require_once("conexion/cnn.php");
$obj = new clsConexion();
$sql = "select * from cliente where id_cliente='" . $_GET["id_cliente"] . "'";
$rs = $obj->consultasql($sql);
$fila = $rs->fetch_assoc();
if (isset($_POST["modificar"]))
    {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellidos"];
        $direccion = $_POST["direccion"];
        $empleado = $_POST["empleado"];
        $sqlinsert = "
        update cliente set 
           nombre_cliente='$nombre'
          ,apellido_cliente='$apellido'
          ,direccion_cliente='$direccion'
          ,id_empleado='$empleado'
          where id_cliente='" . $_GET["id_cliente"] . "'
        ";
        $rs=$obj->consultasql($sqlinsert);
        //$rs = $conn->query($sqlinsert);
        echo "<script>alert('Dato modificado');window.location='?pagina=cliente.php';	</script>";
    }
elseif(isset($_POST["cancelar"]))
    {
      echo "<script>alert('Cancelado');window.location='admin.php';	</script>";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST">
        <table border="0px" class="tabla1">
            <tbody>
                <tr>
                    <!-- DUI -->
                    <td for="username"> Nombres del cliente
                        <input type="text" placeholder="nombre" name="nombre" value="<?php echo $fila["nombre_cliente"]; ?>">
                    </td>
                </tr>
                <tr>
                    <td for="username"> Apellidos del cliente
                        <input type="text" placeholder="Apellidos" name="apellidos" value="<?php echo $fila["apellido_cliente"]; ?>">
                    </td>
                </tr>
                <tr>
                    <!-- DIRECCIÓN-->
                    <td for="username"> Dirección del cliente
                        <input type="text" placeholder="Dirección" name="direccion" value="<?php echo $fila["direccion_cliente"]; ?>">
                    </td>
                </tr>
                <tr>
                <td for="username">Nombre de Empleado que registra
                        <select name="empleado">
                            <option value="1">Seleccione un empleado</option>
                            <?php
                            $campos = "
                            *
                            ";
                            $tabla = "empleado";
                            $rs = $obj->consultaGeneral($tabla, $campos);
                            while ($fila2 = $rs->fetch_assoc()) 
                                {
                                    if($fila["id_empleado"]==$fila2["id_empleado"])
                                        {
                                            echo "
                                            <option value='$fila2[id_empleado]' selected>$fila2[nombre_completo]</option> 
                                            ";
                                        }
                                    else
                                        {
                                            echo "
                                            <option value='$fila2[id_empleado]'>$fila2[nombre_completo]</option> 
                                            ";
                                        }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <td>
                <input type="submit" value="Guardar Modificación" name="modificar">
                <input type="submit" value="Cancelar" name="cancelar">
                </td>
            </tbody>
        </table>
    </form>
</body>
</html>