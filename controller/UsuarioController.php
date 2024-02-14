<?php

class UsuarioController {

    static function findByUser($userName) {
        $conn = ConnectionManager::getConnectionInstance();
        
        try {
            $stmt = $conn->query("SELECT * FROM usuario WHERE user = '$userName'");
            $usuario = null;
            if ($stmt->num_rows > 0) {
                while ($fila = $stmt->fetch_object()) {
                    $usuario = new Usuario($fila->provincia, $fila->nombre, $fila->telefono, $fila->user, $fila->pass);
                }
            }

            return $usuario;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}

?>