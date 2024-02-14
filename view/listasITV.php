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
        <a href="menu.php">Volver al menu</a>

        <h1>
            Gestion de citas de las ITV de  <?php echo $_SESSION['userSession']->provincia; ?>
        </h1>

        <?php
        $itvs = ItvsController::findByProvincia($_SESSION['userSession']->provincia);

        if (count($itvs) > 0) {
            ?>
            <table border = 1>
                <tr>
                    <th>Localidad</th>
                    <th>Dirección</th>
                    <th>Citas</th>
                </tr>
                <?php
                foreach ($itvs as $itv) {
                    echo '<tr>';

                    echo '<td>';
                    echo $itv->localidad;
                    echo '</td>';
                    echo '<td>';
                    echo $itv->direccion;
                    echo '</td>';
                    echo '<td>';
                    ?>
                    <form action="misCitas.php?idITV=<?php echo $itv->id; ?>" method="POSt">
                        <input type="submit" name="itsCitas" value = "Mis citas">
                    </form>
                    <?php
                    echo '</td>';

                    echo '</tr>';
                }
                ?>
            </table>

            <?php
        } else {
            echo '<h2>No existen sedes de ITV para esta provincia</h2>';
        }
        ?>


    </body>
</html>
