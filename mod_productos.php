<?php
require_once("conexion/cnn.php");
$obj = new clsConexion();
$sql = "select * from articulos_productos where id_articulos_productos='" . $_GET["id_articulos_productos"] . "'";
$rs = $obj->consultasql($sql);
$fila = $rs->fetch_assoc();
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
    <table border="0px">
      <tbody>
        <tr>
          <td for="username"> Nombre
            <input type="text" placeholder="nombre de articulo" required name="nombre" value="<?php echo $fila["nombre_articulo"]; ?>">
          </td>
        </tr>
        <tr>
          <td for="username"> Detalle
            <input type="text" placeholder="Detalle del articulo"  name="detalle" value="<?php echo $fila["detalle_articulo"]; ?>">
          </td>
        </tr>
        <tr>
          <!-- DIRECCIÓN-->
          <td for="username"> Precio
            <input type="number" minlength="0" step="0.01" placeholder="Ingrese precio" name="precio" value="<?php echo $fila["precio_articulo"]; ?>">
          </td>
        </tr>
        <tr>
          <!-- GRUPO-->
          <td for="username"> Grupo
            <select name="grupo" >
               <option value="<?php echo $fila["grupos"]; ?>" selected><?php echo $fila["grupos"]; ?></option>
               <option value="pupusas">Pupusas</option> 
               <option value="desayunos">Desayunos</option>
               <option value="bebidas">Bebidas</option>
               <option value="postres">postres</option> 
            </select>
          </td>
        </tr>
        <td>
          <input type="submit" value="Registrar Producto" name="registrar">
          <input type="submit" value="Buscar" name="buscar">
          <input type="reset" value="Limpiar">
        </td>
      </tbody>
    </table>
  </form>
</body>
</html>