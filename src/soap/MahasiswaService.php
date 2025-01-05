<?php
require_once '../config/database.php';

class MahasiswaService {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllMahasiswa() {
        $result = $this->db->query("SELECT * FROM mahasiswa");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getMahasiswaById($id) {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createMahasiswa($nama, $nim, $jurusan) {
        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nama, nim, jurusan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $nim, $jurusan);
        return $stmt->execute();
    }

    public function updateMahasiswa($id, $nama, $nim, $jurusan) {
        $stmt = $this->db->prepare("UPDATE mahasiswa SET nama = ?, nim = ?, jurusan = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nama, $nim, $jurusan, $id);
        return $stmt->execute();
    }

    public function deleteMahasiswa($id) {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
