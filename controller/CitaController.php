<?php

class CitaController {

    static function findAll() {
        $conn = ConnectionManager::getConnectionInstance();
        try {
            $stmt = $conn->query("SELECT * FROM vehiculo");

            $citas = array();
            if ($stmt->num_rows > 0) {
                while ($fila = $stmt->fetch_object()) {
                    $cita = new Cita($fila->matricula, $fila->id_itv, $fila->fecha, $fila->hora, $fila->ficha);

                    $citas[] = $cita;
                }
            }

            return $citas;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    static function findByMatricula($mat) {
        $conn = ConnectionManager::getConnectionInstance();
        try {
            $stmt = $conn->query("SELECT * FROM citas WHERE matricula = '$mat'");

            $cita = null;
            if ($stmt->num_rows > 0) {
                while ($fila = $stmt->fetch_object()) {
                    $cita = new Cita($fila->matricula, $fila->id_itv, $fila->fecha, $fila->hora, $fila->ficha);
                }
            }

            return $cita;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    static function findByItvId($itvId) {
        $conn = ConnectionManager::getConnectionInstance();
        try {
            $stmt = $conn->query("SELECT * FROM citas WHERE id_itv = '$itvId'");

            $citas = array();
            if ($stmt->num_rows > 0) {
                while ($fila = $stmt->fetch_object()) {
                    $cita = new Cita($fila->matricula, $fila->id_itv, $fila->fecha, $fila->hora, $fila->ficha);

                    $citas[] = $cita;
                }
            }

            return $citas;

            return $cita;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    static function insertCita($cita) {
        $conn = ConnectionManager::getConnectionInstance();
        try {
            $stmt = $conn->prepare('INSERT INTO citas VALUES(?, ?, ?, ?, ?)');
            $stmt->bind_param("sssss", $cita->matricula, $cita->id_itv, $cita->fecha, $cita->hora, $cita->ficha);
            $stmt->execute();
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    static function deleteCita($citaMat) {
        $conn = ConnectionManager::getConnectionInstance();
        try {
            $stmt = $conn->prepare("DELETE FROM citas WHERE matricula = ?");
            $stmt->bind_param("s", $citaMat);
            $stmt->execute();
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }
}

?>