<?php
class SprintModel {
    private static function connect() {
        return new mysqli("localhost", "root", "", "gestor_historias_db");
    }

    public static function getAll() {
        $conn = self::connect();
        $result = $conn->query("SELECT * FROM sprints");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return $data;
    }

    public static function create($data) {
        $conn = self::connect();
        $stmt = $conn->prepare("INSERT INTO sprints (nombre, fecha_inicio, fecha_fin) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $data['nombre'], $data['fecha_inicio'], $data['fecha_fin']);
$stmt->execute();
$stmt->close();
        $conn->close();
        return ['success' => true];
    }

    public static function update($data) {
        $conn = self::connect();
        $stmt = $conn->prepare("UPDATE sprints SET nombre = ?, fecha_inicio = ?, fecha_fin = ? WHERE id = ?");
$stmt->bind_param("sssi", $data['nombre'], $data['fecha_inicio'], $data['fecha_fin'], $data['id']);
$stmt->execute();
$stmt->close();
        $conn->close();
        return ['success' => true];
    }

    public static function delete($id) {
        $conn = self::connect();
        $stmt = $conn->prepare("DELETE FROM sprints WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return ['success' => true];
    }
}
?>
