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
    <table border="0px">
      <tbody>
        <tr>
          <td for="username"> Nombre
            <input type="text" placeholder="nombre de articulo" required name="nombre">
          </td>
        </tr>
        <tr>
          <td for="username"> Detalle
            <input type="text" placeholder="Detalle del articulo"  name="detalle">
          </td>
        </tr>
        <tr>
          <!-- DIRECCIÓN-->
          <td for="username"> Precio
            <input type="number" minlength="0" step="0.01" placeholder="Ingrese precio" name="precio">
          </td>
        </tr>
        <tr>
          <!-- GRUPO-->
          <td for="username"> Grupo
            <select name="grupo" >
               <option value="0" selected>Seleccione su nivel de acceso</option>
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
  <?php 
       /*BOTONES SUBMIT*/
       if (isset($_POST["registrar"])) 
       {  //registrar es guardar
         $valores[] = $_POST["nombre"];
         $valores[] = $_POST["detalle"];
         $valores[] = $_POST["precio"];
         $valores[] = $_POST["grupo"];
         $campos = array("
           nombre_articulo
         , detalle_articulo
         , precio_articulo
         , grupos
         ");
         $obj->insertarSQL(" articulos_productos ", $campos, $valores);
       }
     elseif (isset($_POST["okeliminar"])) 
       {
         $eliminar = $_POST["eliminar"];
         foreach ($eliminar as $id_articulos_productos) 
           {
             $rs = $obj->eliminarSQL("articulos_productos", " id_articulos_productos = '$id_articulos_productos'");
           }
       }
     elseif(isset($_POST["buscar"])) 
       {
        $nombre = $_POST["nombre"];
        $campos = "*";
        $tabla="articulos_productos";
        $rs = $obj->consultaGeneral("$tabla", "$campos", " nombre_articulo LIKE '%$nombre%'");
         echo "<form method='post'>";
           echo "
           <table class='greenTable'>
           <thead>
           <tr>
           <th>CHECK</th>
           <th>ID PRODUCTO</th>
           <th>NOMBRE</th>
           <th>DETALLE</th>
           <th>PRECIO</th>
           <th>GRUPO</th>
           <th>MODIFICAR</th>
           </tr>
           </thead>
           ";
         while ($fila = $rs->fetch_assoc()) 
           {
             echo "
                 <tbody>
                 <tr>
                 <td><input type=checkbox name=eliminar[] value='$fila[id_articulos_productos]'></td>
                 <td>$fila[id_articulos_productos]</td>
                 <td>$fila[nombre_articulo]</td>
                 <td>$fila[detalle_articulo]</td>
                 <td>$$fila[precio_articulo]</td>
                 <td>$fila[grupos]</td>
                 <td><a href='?pagina=mod_productos.php&id_articulos_productos=$fila[id_articulos_productos]'>Modificar</a></td>
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
         header("location:admin.php?pagina=productos.php");
       }
   /*FIN DE LOS SUBMIT */
  echo "<form method='post'>";
    $campos="
        id_articulos_productos
      ,  nombre_articulo
      ,  detalle_articulo
      ,  precio_articulo
      ,  grupos
";
$tabla="
  articulos_productos
";
  $rs = $obj->consultaGeneral($tabla, $campos);
  echo "
      <table class='greenTable'>
      <thead>
      <tr>
      <th>CHECK</th>
      <th>ID PRODUCTO</th>
      <th>NOMBRE</th>
      <th>DETALLE</th>
      <th>PRECIO</th>
      <th>GRUPO</th>
      <th>MODIFICAR</th>
      </tr>
      </thead>
      ";
  while ($fila = $rs->fetch_assoc()) {
    echo "
        <tbody>
        <tr>
        <td><input type=checkbox name=eliminar[] value='$fila[id_articulos_productos]'></td>
        <td>$fila[id_articulos_productos]</td>
        <td>$fila[nombre_articulo]</td>
        <td>$fila[detalle_articulo]</td>
        <td>$$fila[precio_articulo]</td>
        <td>$fila[grupos]</td>
        <td><a href='mod_productos.php?id_articulos_productos=$fila[id_articulos_productos]'>Modificar</a></td>
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