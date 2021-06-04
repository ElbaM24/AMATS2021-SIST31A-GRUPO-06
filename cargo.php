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
          <td for="username"> Cargo
            <input type="text" placeholder="cargo" name="cargo">
          </td>
        </tr>
      </tbody>
    </table>
    <br>
    <input type="submit" value="Guardar" name="guardar">
    <!--QUITAR ESTE BOTON <input type="submit" value="Modificar">-->
    <input type="submit" value="Buscar" name="buscar">
    <input type="reset" value="Limpiar">
  </form>
  <!--AGREGUE TODO ESTE PHP-->
  <?php
    if (isset($_POST["guardar"])) 
      {  //si presionamos el boton para insertar
        $cargo[] = $_POST["cargo"];
        $campos = array("cargo");
        $obj->insertarSQL("cargo", $campos, $cargo);
      }
    elseif (isset($_POST["okeliminar"]))
      {
        $eliminar = $_POST["eliminar"];
        foreach ($eliminar as $id_cargo) 
          {
            $rs = $obj->eliminarSQL("cargo", " id_cargo = '$id_cargo'");
          }
      }
    elseif (isset($_POST["buscar"]))
      {
        echo "<form method='post'>";
        $campos = "id_cargo, cargo";
        $tabla = "cargo";
        $cargo = $_POST["cargo"];
        $rs = $obj->consultaGeneral("$tabla", "$campos", "cargo LIKE'%$cargo%'");
        echo "
            <table class='greenTable'>
            <thead>
            <tr>
            <th>CHECK</th>
            <th>ID</th>
            <th>CARGO</th>
            <th>MODIFICAR</th>
            </tr>
            </thead>
            ";
        while ($fila = $rs->fetch_assoc()) 
          {
            echo "
                  <tbody>
                  <tr>
                  <td><input type=checkbox name=eliminar[] value='$fila[id_cargo]'></td>
                  <td>$fila[id_cargo]</td>
                  <td>$fila[cargo]</td>
                  <td><a href='?pagina=mod_cargo.php&id_cargo=$fila[id_cargo]'>Modificar</a></td>
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
        header("location:admin.php?pagina=cargo.php");
      } 
    else 
      {
      }
  echo "<form method='post'>";
  $campos = "
              id_cargo,
              cargo
              ";
  $tabla = "cargo";
  $rs = $obj->consultaGeneral($tabla, $campos);
  echo "
      <table class='greenTable'>
      <thead>
      <tr>
      <th>CHECK</th>
      <th>ID</th>
      <th>CARGO</th>
      <th>MODIFICAR</th>
      </tr>
      </thead>
      ";
  while ($fila = $rs->fetch_assoc()) {
    echo "
        <tbody>
        <tr>
        <td><input type=checkbox name=eliminar[] value='$fila[id_cargo]'></td>
        <td>$fila[id_cargo]</td>
        <td>$fila[cargo]</td>
        <td><a href='?pagina=mod_cargo.php&id_cargo=$fila[id_cargo]'>Modificar</a></td>
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