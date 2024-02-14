<?php

class ItvsController {

    static function findAll() {
        $conn = ConnectionManager::getConnectionInstance();
        try {
            $stmt = $conn->query("SELECT * FROM itvs");

            $itvs = array();
            if ($stmt->num_rows > 0) {
                while ($fila = $stmt->fetch_object()) {
                    $itv = new Itvs($fila->id, $fila->provincia, $fila->localidad, $fila->direccion, $fila->telefono);

                    $itvs[] = $itv;
                }
            }

            return $itvs;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    static function findByProvincia($provincia) {
        $conn = ConnectionManager::getConnectionInstance();
        try {
            $stmt = $conn->query("SELECT * FROM itvs WHERE provincia = '$provincia'");

            $itvs = array();
            if ($stmt->num_rows > 0) {
                while ($fila = $stmt->fetch_object()) {
                    $itv = new Itvs($fila->id, $fila->provincia, $fila->localidad, $fila->direccion, $fila->telefono);

                    $itvs[] = $itv;
                }
            }

            return $itvs;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    static function findById($id) {
        $conn = ConnectionManager::getConnectionInstance();
        try {
            $stmt = $conn->query("SELECT * FROM itvs WHERE id = '$id'");

            $itv = null;
            if ($stmt->num_rows > 0) {
                while ($fila = $stmt->fetch_object()) {
                    $itv = new Itvs($fila->id, $fila->provincia, $fila->localidad, $fila->direccion, $fila->telefono);
                }
            }
            return $itv;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
   
}
