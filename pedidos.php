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
<!-- inicio encabezado -->
  <table border="0px" class="tabla1">
    <tbody>
      <tr>
        <!-- DUI -->
        <td for="username">fecha
          <input type="date">
        </td>
        <!-- nombre de usuario -->
        <td for="username" align="right">
          Numero de pedido
          <input type="number" readonly placeholder="# pedido">
        </td>
      </tr>
      <tr>
        <!-- nombre COMPLETO-->
        <td for="username">
          Numero de mesa
          <input type="number" placeholder="# Mesa">
        </td>
        <!-- CONTRASEÑA -->
        <td for="password" align="right">
          dirección
          <input type="text" placeholder="Introduzca dirección">
        </td>
      </tr>
      <tr>
        <!-- DIRECCIÓN-->
        <td for="username">
          Cliente
          <input type="text" placeholder="Nombre del cliente">
        </td>
        <td>
          <select name="Nivel" align="right">
            <option value="1">Seleccione el estado</option>
            <option value="2">En preparación</option>
            <option value="3">Entregado</option>
          </select>
        </td>
      </tr>
    </tbody>
  </table>
<!-- fin encabezado -->
<!-- inicio cuerpo -->
<form method='post'>
<table class='greenTable'>
            <thead>
            <tr>
            <th>CHECK</th>
            <th>NOMBRE</th>
            <th>DETALLE</th>
            <th>PRECIO</th>
            <th>CANTIDAD</th>
            <th>TOTAL LINEA</th>
            </tr>
            </thead>
            <tbody>
                  <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  </tr>
            </tbody>
            </table>
          </form>
  <!-- fin cuerpo -->
  <!-- inicio pie encabezado -->
  <table class="tabla1">
    <tbody>
      <tr>
        <!-- DUI -->
        <td for="username">
          <select name="Nivel" align="right">
            <option value="1">Selecione estado de pago</option>
            <option value="2">Cancelado</option>
            <option value="3">Pendiente</option>
          </select>
        </td>
        <!-- nombre de usuario -->
        <td for="username" align="right">
          Total
          <input type="number" placeholder="total">
        </td>
      </tr>
    </tbody>
  </table>
  <!-- fin pie encabezado -->
</body>

</html>