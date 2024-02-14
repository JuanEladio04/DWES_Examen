<?php

class VehiculoController {

    static function findAll() {
        $conn = ConnectionManager::getConnectionInstance();
        try {
            $stmt = $conn->query("SELECT * FROM citas");

            $vehiculos = array();
            if ($stmt->num_rows > 0) {
                while ($fila = $stmt->fetch_object()) {
                    $vehiculo = new Vehiculo($fila->matricula, $fila->marca, $fila->modelo,
                            $fila->color, $fila->plazas, $fila->fecha_ultima_revision);

                    $vehiculos[] = $vehiculo;
                }
            }

            return $vehiculos;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    static function findByMatricula($mat) {
        $conn = ConnectionManager::getConnectionInstance();
        try {
            $stmt = $conn->query("SELECT * FROM vehiculo WHERE matricula = '$mat'");

            $vehiculo = null;
            if ($stmt->num_rows > 0) {
                while ($fila = $stmt->fetch_object()) {
                    $vehiculo = new Vehiculo($fila->matricula, $fila->marca, $fila->modelo,
                            $fila->color, $fila->plazas, $fila->fecha_ultima_revision);
                }
            }

            return $vehiculo;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    static function findByITV($itvId) {
        $conn = ConnectionManager::getConnectionInstance();
        try {
            $stmt = $conn->query("SELECT vehiculo.matricula, vehiculo.marca, vehiculo.modelo, citas.fecha, citas.hora, citas.ficha FROM vehiculo INNER JOIN citas ON citas.matricula = vehiculo.matricula WHERE citas.id_itv = $itvId");

            $vehiculos = array();
            if ($stmt->num_rows > 0) {
                while ($fila = $stmt->fetch_object()) {
                    $vehiculo = $fila;

                    $vehiculos[] = $vehiculo;
                }
            }

            return $vehiculos;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}

?>