<?php
header("Content-Type: application/json");

class ReporteController {
    public static function resumen() {
        $conn = new mysqli("localhost", "root", "", "gestor_historias_db");
        $result = $conn->query("SELECT estado, COUNT(*) as total FROM historias GROUP BY estado");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return $data;
    }
}

echo json_encode(ReporteController::resumen());
