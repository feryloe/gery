<?php
// app/models/Hobi.php
class Hobi {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM hobi ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM hobi WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nama) {
        $stmt = $this->pdo->prepare("INSERT INTO hobi (nama) VALUES (?)");
        return $stmt->execute([$nama]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM hobi WHERE id = ?");
        return $stmt->execute([$id]);
    }
}