<?php
class HistoriaModel {
    private static function connect() {
        return new mysqli("localhost", "root", "", "gestor_historias_db");
    }

    public static function getAll() {
        $conn = self::connect();
        $result = $conn->query("SELECT * FROM historias");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return $data;
    }

    public static function create($data) {
        $conn = self::connect();
        $stmt = $conn->prepare("INSERT INTO historias (titulo, descripcion, responsable, estado, puntos, fecha_creacion, fecha_finalizacion, sprint_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssissi", $data['titulo'], $data['descripcion'], $data['responsable'], $data['estado'], $data['puntos'], $data['fecha_creacion'], $data['fecha_finalizacion'], $data['sprint_id']);
$stmt->execute();
$stmt->close();
        $conn->close();
        return ['success' => true];
    }

    public static function update($data) {
        $conn = self::connect();
        $stmt = $conn->prepare("UPDATE historias SET titulo = ?, descripcion = ?, responsable = ?, estado = ?, puntos = ?, fecha_creacion = ?, fecha_finalizacion = ?, sprint_id = ? WHERE id = ?");
$stmt->bind_param("ssssissii", $data['titulo'], $data['descripcion'], $data['responsable'], $data['estado'], $data['puntos'], $data['fecha_creacion'], $data['fecha_finalizacion'], $data['sprint_id'], $data['id']);
$stmt->execute();
$stmt->close();
        $conn->close();
        return ['success' => true];
    }

    public static function delete($id) {
        $conn = self::connect();
        $stmt = $conn->prepare("DELETE FROM historias WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return ['success' => true];
    }
}
?>
