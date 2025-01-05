<?php
class MataKuliahRest {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM mata_kuliah");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM mata_kuliah WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO mata_kuliah (kode, nama_mata_kuliah, sks) VALUES (?, ?, ?)");
        $stmt->execute([$data['kode'], $data['nama_mata_kuliah'], $data['sks']]);
        return ['id' => $this->pdo->lastInsertId()];
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE mata_kuliah SET kode = ?, nama_mata_kuliah = ?, sks = ? WHERE id = ?");
        $stmt->execute([$data['kode'], $data['nama_mata_kuliah'], $data['sks'], $id]);
        return ['message' => 'Updated successfully'];
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM mata_kuliah WHERE id = ?");
        $stmt->execute([$id]);
        return ['message' => 'Deleted successfully'];
    }
}
?>
