<?php
include_once '../controller/SessionController.php';
error_reporting(E_ALL & ~E_NOTICE);

if (!isset($_SESSION['userSession'])) {
    header('Location: index.php');
}

if (isset($_GET['clSession']) && $_GET['clSession'] == true) {
    session_unset();
    session_destroy();
}


if (isset($_POST['itsRegister'])) {
    if (is_uploaded_file($_FILES['itfFicha']['tmp_name'])) {
        $fich = time() . "-" . $_POST['ithMat'] . "-" . $_FILES['itfFicha']['name'];
        $path = '../fichas/' . $fich;
        $rPath = 'fichas/' . $fich;
        move_uploaded_file($_FILES['itfFicha']['tmp_name'], $path);
    } else {
        echo 'ERROR AL SUBIR ARCHIVO';
    }

    $cita = new Cita($_POST['ithMat'], $_POST['sItv'], $_POST['itdDate'], $_POST['ittiHour'], $rPath);
    CitaController::insertCita($cita);
}

if (isset($_POST['itsDeleteCita'])) {
    CitaController::deleteCita($_POST['ithMat']);
    unlink("../" . $_POST['ithFile']);
    echo 'CITA ANULADA';
}
?>
<html>
    <head>
        <title>Nueva Cita</title>
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

        <form action="" method="POST">
            Matricula: <input type="text" name="ittMat">
            <input type="submit" name="itsBuscar">
        </form>

        <?php
        if (isset($_POST['itsBuscar'])) {
            $vehiculo = VehiculoController::findByMatricula($_POST['ittMat']);
            $cita = CitaController::findByMatricula($_POST['ittMat']);
            if(isset($cita->id_itv)) $itv = ItvsController::findById($cita->id_itv);
            if (isset($vehiculo)) {
                if ($cita != null) {
                    echo "Ya tiene una cita el dia $cita->fecha a las $cita->hora  en la itv de $itv->localidad en la provincia de $itv->provincia";
                    ?>
                    <form action="" method="POST">
                        <input type="submit" name="itsDeleteCita" value="Anular">
                        <input type="hidden" name="ithMat" value="<?php echo $cita->matricula; ?>">
                        <input type="hidden" name="ithFile" value="<?php echo $cita->ficha; ?>">
                    </form>
                    <?php
                } else if ($cita == null) {
                    $itvs = ItvsController::findAll();
                    ?>
                    <h3>Datos del vehiculo</h3>

                    <form action="" method="POST" enctype="multipart/form-data">
                        Matricula: <input type="text" name="ittSMat" value="<?php echo $vehiculo->matricula ?>" disabled="">
                        Marca: <input type="text" name="ittMarc" value="<?php echo $vehiculo->marca ?>" disabled="">
                        <br>
                        Modelo: <input type="text" name="ittMod" value="<?php echo $vehiculo->modelo ?>" disabled="">
                        Color: <input type="text" name="ittColr" value="<?php echo $vehiculo->color ?>" disabled="">
                        <br>
                        Plazas: <input type="text" name="ittPlz" value="<?php echo $vehiculo->plazas ?>" disabled="">
                        Fecha de la ultima revisión: <input type="text" name="ittFUR" value="<?php echo $vehiculo->fecha_ultima_revision ?>" disabled="">
                        <br>

                        <h3>Elegir ITV</h3>

                        Elegir ITV:
                        <select name="sItv">
                            <?php
                            foreach ($itvs as $itv) {
                                echo "<option value='$itv->id'>$itv->localidad - $itv->direccion</option>";
                            }
                            ?>
                        </select>

                        Fecha: <input type="date" name="itdDate" required>
                        Hora: <input type="time" name="ittiHour" required>
                        Ficha del vehiculo: <input type="file" name="itfFicha" required>
                        <input type="submit" name="itsRegister" value="registrar cita">
                        <input type="hidden" name="ithMat" value="<?php echo $vehiculo->matricula ?>">

                    </form>
                    <?php
                }
            } else {
                echo 'No existe ningun vehiculo con esa matrícula';
            }
        }
        ?>

    </body>
</html>
