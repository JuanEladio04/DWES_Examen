<?php
include_once '../controller/SessionController.php';

if (!isset($_SESSION['userSession'])) {
    header('Location: index.php');
}

if (isset($_GET['clSession']) && $_GET['clSession'] == true) {
    session_unset();
    session_destroy();
}
?>
<html>
    <head>
        <title>Listas ITV</title>
    </head>
    <body>

        <h1>
            Hola Administrador de <?php echo $_SESSION['userSession']->provincia; ?>
        </h1>
        <p>Teléfono: <?php echo $_SESSION['userSession']->telefono; ?></p>
        <a href="index.php?clSession=true">Cerrar sesión</a>
        <br>
        <a href="listasITV.php">Volver</a>

        <h1>
            Vehiculos con la cita en la ITV de  <?php echo $_SESSION['userSession']->provincia; ?>
        </h1>

        <?php
        $vehiculos = VehiculoController::findByITV($_GET['idITV']);

        if (count($vehiculos) > 0) {
            ?>
            <table border = 1>
                <tr>
                    <th>Matrícula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Ficha tecnica</th>
                </tr>
                <?php
                foreach ($vehiculos as $vehiculo) {
                    echo '<tr>';

                    echo '<td>';
                    echo $vehiculo->matricula;
                    echo '</td>';
                    echo '<td>';
                    echo $vehiculo->marca;
                    echo '</td>';
                    echo '<td>';
                    echo $vehiculo->modelo;
                    echo '</td>';
                    echo '<td>';
                    echo $vehiculo->fecha;
                    echo '</td>';
                    echo '<td>';
                    echo $vehiculo->hora;
                    echo '</td>';
                    echo '<td>';
                    echo "<a href='ficha.php?fPath=../$vehiculo->ficha' target='blank'>Ver ficha</a>";
                    echo '</td>';

                    echo '</tr>';
                }
                ?>
            </table>

            <?php
        }
        else{
            echo '<h2>No existen citas en esta sede</h2>';
        }
        ?>

    </body>
</html>
