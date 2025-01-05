<?php
require_once '../config/config.php';
require_once '../src/rest/MahasiswaRest.php';
require_once '../src/rest/MataKuliahRest.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$path = $_GET['path'] ?? '';

switch ($path) {
    case 'mahasiswa':
        $rest = new MahasiswaRest($pdo);
        if ($method === 'GET') {
            if (isset($_GET['id'])) {
                echo json_encode($rest->getById($_GET['id']));
            } else {
                echo json_encode($rest->getAll());
            }
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($rest->create($data));
        } elseif ($method === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($rest->update($_GET['id'], $data));
        } elseif ($method === 'DELETE') {
            echo json_encode($rest->delete($_GET['id']));
        }
        break;

    case 'mata_kuliah': // New case for Mata Kuliah
        $mataKuliahRest = new MataKuliahRest($pdo);
        if ($method === 'GET') {
            if (isset($_GET['id'])) {
                echo json_encode($mataKuliahRest->getById($_GET['id']));
            } else {
                echo json_encode($mataKuliahRest->getAll());
            }
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($mataKuliahRest->create($data));
        } elseif ($method === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($mataKuliahRest->update($_GET['id'], $data));
        } elseif ($method === 'DELETE') {
            echo json_encode($mataKuliahRest->delete($_GET['id']));
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['message' => 'Not Found']);
        break;
}
?>
