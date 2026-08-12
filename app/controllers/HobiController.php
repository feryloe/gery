
<?php
// app/controllers/HobiController.php
require_once __DIR__ . '/../models/Hobi.php';

class HobiController {
    private $hobiModel;
    public function __construct($pdo) {
        $this->hobiModel = new Hobi($pdo);
    }

    public function index() {
        $hobi = $this->hobiModel->all();
        include __DIR__ . '/../views/hobi/index.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = trim($_POST['nama'] ?? '');
            if ($nama !== '') {
                $this->hobiModel->create($nama);
            }
            header('Location: /hobi');
            exit;
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->hobiModel->delete($id);
        }
        header('Location: /hobi');
        exit;
    }
}
