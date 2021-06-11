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
  <title>Document</title>
  <link rel="stylesheet" href="css/cuerpo.css">
  <link rel="stylesheet" href="css/tabla.css">
</head>
<body>
  <form method="post">
    <!-- borre el acction y puse el metodo post -->
    <table border="0px" class="tabla1">
      <tbody>
        <tr>
          <td for="username"> Mesa
            <input type="text" placeholder="Mesa" name="mesa">
          </td>
        </tr>
      </tbody>
    </table>
    <br>
    <input type="submit" value="Guardar" name="guardar">
    <input type="submit" value="Buscar" name="buscar">
    <input type="reset" value="Limpiar">
  </form>
  <!--AGREGUE TODO ESTE PHP-->
  <?php
    if (isset($_POST["guardar"])) 
      {  //si presionamos el boton para insertar
        $mesa[] = $_POST["mesa"];
        $campos = array("detalle_mesa");
        $obj->insertarSQL("mesa", $campos, $mesa);
      }
    elseif (isset($_POST["okeliminar"]))
      {
        $eliminar = $_POST["eliminar"];
        foreach ($eliminar as $id_mesa) 
          {
            $rs = $obj->eliminarSQL("mesa", " id_mesa = '$id_mesa'");
          }
      }
    elseif (isset($_POST["buscar"]))
      {
        echo "<form method='post'>";
        $campos = "id_mesa, detalle_mesa";
        $tabla = "mesa";
        $mesa = $_POST["mesa"];
        $rs = $obj->consultaGeneral("$tabla", "$campos", "detalle_mesa LIKE'%$mesa%'");
        echo "
            <table class='greenTable'>
            <thead>
            <tr>
            <th>CHECK</th>
            <th>ID</th>
            <th>MESA</th>
            <th>MODIFICAR</th>
            </tr>
            </thead>
            ";
        while ($fila = $rs->fetch_assoc()) 
          {
            echo "
                  <tbody>
                  <tr>
                  <td><input type=checkbox name=eliminar[] value='$fila[id_mesa]'></td>
                  <td>$fila[id_mesa]</td>
                  <td>$fila[detalle_mesa]</td>
                  <td><a href='?pagina=mod_mesa.php&id_mesa=$fila[id_mesa]'>Modificar</a></td>
                  </tr>
                  ";
          }
        echo "  <tr>
            <td colspan='4' align='center'>
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
        header("location:admin.php?pagina=mesa.php");
      } 
    else 
      {
      }
  echo "<form method='post'>";
  $campos = "
              id_mesa,
              detalle_mesa
              ";
  $tabla = "mesa";
  $rs = $obj->consultaGeneral($tabla, $campos);
  echo "
      <table class='greenTable'>
      <thead>
      <tr>
      <th>CHECK</th>
      <th>ID</th>
      <th>MESA</th>
      <th>MODIFICAR</th>
      </tr>
      </thead>
      ";
  while ($fila = $rs->fetch_assoc()) {
    echo "
        <tbody>
        <tr>
        <td><input type=checkbox name=eliminar[] value='$fila[id_mesa]'></td>
        <td>$fila[id_mesa]</td>
        <td>$fila[detalle_mesa]</td>
        <td><a href='?pagina=mod_mesa.php&id_mesa=$fila[id_mesa]'>Modificar</a></td>
        </tr>
        ";
  }
  echo "  <tr>
      <td colspan='4' align='center'>
      <input type='submit' name='okeliminar' value='Eliminar' />
      </td>
      </tr>
      </tbody>
      </table>
    </form>
    
    ";
  ?>
  <!--HASTA AQUI-->
</body>

</html>