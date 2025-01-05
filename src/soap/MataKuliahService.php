<?php
require_once '../config/database.php';

class MataKuliahService {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllMataKuliah() {
        $result = $this->db->query("SELECT * FROM mata_kuliah");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getMataKuliahById($id) {
        $stmt = $this->db->prepare("SELECT * FROM mata_kuliah WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createMataKuliah($kode, $nama, $sks) {
        $stmt = $this->db->prepare("INSERT INTO mata_kuliah (kode, nama_mata_kuliah, sks) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $kode, $nama, $sks);
        return $stmt->execute();
    }

    public function updateMataKuliah($id, $kode, $nama, $sks) {
        $stmt = $this->db->prepare("UPDATE mata_kuliah SET kode = ?, nama_mata_kuliah = ?, sks = ? WHERE id = ?");
        $stmt->bind_param("ssii", $kode, $nama, $sks, $id);
        return $stmt->execute();
    }

    public function deleteMataKuliah($id) {
        $stmt = $this->db->prepare("DELETE FROM mata_kuliah WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
