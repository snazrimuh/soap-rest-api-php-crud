<?php
$client = new SoapClient(null, [
    'location' => 'http://localhost/my-api/public/soap.php',
    'uri' => 'http://localhost/soap'
]);

// Mengambil semua mata kuliah
$response = $client->getMataKuliah();
echo '<pre>';
print_r($response);
echo '</pre>';

// Mengambil mata kuliah berdasarkan ID
$responseById = $client->getMataKuliahById(1); // Ganti dengan ID yang diinginkan
echo '<pre>';
print_r($responseById);
echo '</pre>';

// Menambahkan mata kuliah baru
$responseCreate = $client->createMataKuliah('IF104', 'Jaringan Komputer', 3);
echo '<pre>';
print_r($responseCreate);
echo '</pre>';

// Memperbarui mata kuliah
$responseUpdate = $client->updateMataKuliah(1, 'IF101', 'Pemrograman Web', 3);
echo '<pre>';
print_r($responseUpdate);
echo '</pre>';

// Menghapus mata kuliah
$responseDelete = $client->deleteMataKuliah(1);
echo '<pre>';
print_r($responseDelete);
echo '</pre>';
?>
