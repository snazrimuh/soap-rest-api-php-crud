<?php
class MahasiswaRest {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM mahasiswa");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM mahasiswa WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO mahasiswa (nama, nim, jurusan) VALUES (?, ?, ?)");
        $stmt->execute([$data['nama'], $data['nim'], $data['jurusan']]);
        return ['id' => $this->pdo->lastInsertId()];
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE mahasiswa SET nama = ?, nim = ?, jurusan = ? WHERE id = ?");
        $stmt->execute([$data['nama'], $data['nim'], $data['jurusan'], $id]);
        return ['message' => 'Updated successfully'];
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM mahasiswa WHERE id = ?");
        $stmt->execute([$id]);
        return ['message' => 'Deleted successfully'];
    }
}
?>
