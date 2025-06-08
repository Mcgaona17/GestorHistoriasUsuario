<?php
require_once __DIR__ . '/../src/ReporteController.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        echo json_encode(ReporteController::getAll());
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(ReporteController::create($data));
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(ReporteController::update($data));
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(ReporteController::delete($data['id']));
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?>
