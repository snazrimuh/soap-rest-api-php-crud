<?php
require_once '../config/database.php';
require_once '../src/soap/MahasiswaService.php';
require_once '../src/soap/MataKuliahService.php'; 

$db = getDatabaseConnection();
$serviceType = $_GET['service'] ?? 'mahasiswa';

if ($serviceType === 'mahasiswa') {
    $service = new MahasiswaService($db);
} else {
    $service = new MataKuliahService($db);
}

$options = ['uri' => 'http://localhost/soap'];
$server = new SoapServer(null, $options);
$server->setObject($service);
$server->handle();
?>
