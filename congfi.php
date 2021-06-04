<?php
    session_start();
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
    <section>
        <h1 align="center">reiniciar contadores y unset de las sessiones</h1>
        <form method="post">
            <table  align="center">
                <tr>
                    <td colspan="2" align="center">
                        <h3>Ten en cuenta que la proxima vez que vicites <br> una pagina esta tentra el contador a 1.</h3>
                    </td>
                </tr>
                <tr>
                    <td>reiniciar contador 1</td>
                    <td>
                        <input type="radio" name="reiniciar" value="1" required>
                    </td>
                </tr>
                <tr>
                    <td>reiniciar contador 2</td>
                    <td><input type="radio" name="reiniciar" value="2" required></td>
                </tr>
                <tr>
                    <td>reiniciar contador 1 y 2</td>
                    <td><input type="radio" name="reiniciar" value="3" required></td>
                </tr>
                <tr>
                    <td>borrar session contactos</td>
                    <td><input type="radio" name="reiniciar" value="4" required></td>
                </tr>
                <tr>
                    <td>borrar session encuesta</td>
                    <td><input type="radio" name="reiniciar" value="5" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="reinicio">
                        <input type="reset" value="Limpiar">
                    </td>
                </tr>
            </table>
        </form>
    </section>
    <section>
        <?php
        if(isset($_POST["reinicio"])){
            $i=$_POST["reiniciar"];
            switch ($i) {
                case 1:
                    unset($_SESSION['contador1']);
                    echo "<script>alert('Accion realizada con exito');</script>";
                    break;
                case 2:
                    unset($_SESSION['contador2']);
                    echo "<script>alert('Accion realizada con exito');</script>";
                    break;
                case 3:
                    unset($_SESSION['contador1']);
                    unset($_SESSION['contador2']);
                    echo "<script>alert('Accion realizada con exito');</script>";
                    break;
                    case 4:
                        unset($_SESSION['contacto']);
                        echo "<script>alert('Accion realizada con exito');</script>";
                        break;
                        case 5:
                            unset($_SESSION['encuesta']);
                            echo "<script>alert('Accion realizada con exito');</script>";
                            break;
            }
        }

            
        ?>
    </section>
</body>
</html>