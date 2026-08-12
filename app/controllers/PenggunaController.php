
<?php
// app/controllers/PenggunaController.php
require_once __DIR__ . '/../models/Pengguna.php';
require_once __DIR__ . '/../models/Hobi.php';

class PenggunaController {
    private $penggunaModel;
    private $hobiModel;

    public function __construct($pdo) {
        $this->penggunaModel = new Pengguna($pdo);
        $this->hobiModel = new Hobi($pdo);
    }

    public function index() {
        $users = $this->penggunaModel->all();
        include __DIR__ . '/../views/pengguna/index.php';
    }

    public function create() {
        $hobi = $this->hobiModel->all();
        include __DIR__ . '/../views/pengguna/create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nama' => trim($_POST['nama'] ?? ''),
                'umur' => intval($_POST['umur'] ?? 0),
                'jenis_kelamin' => $_POST['jenis_kelamin'] ?? '',
                'hobi_ids' => $_POST['hobi_ids'] ?? []
            ];
            $this->penggunaModel->create($data);
            header('Location: /');
            exit;
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: /'); exit; }
        $user = $this->penggunaModel->find($id);
        $hobi = $this->hobiModel->all();
        include __DIR__ . '/../views/pengguna/edit.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $data = [
                'nama' => trim($_POST['nama'] ?? ''),
                'umur' => intval($_POST['umur'] ?? 0),
                'jenis_kelamin' => $_POST['jenis_kelamin'] ?? '',
                'hobi_ids' => $_POST['hobi_ids'] ?? []
            ];
            $this->penggunaModel->update($id, $data);
            header('Location: /');
            exit;
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) $this->penggunaModel->delete($id);
        header('Location: /');
        exit;
    }

    public function matches() {
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: /'); exit; }

        $currentUser = $this->penggunaModel->find($id);
        $matches = $this->penggunaModel->getMatches($id);

        // Pastikan data sudah mengandung filter dari model
        include __DIR__ . '/../views/pengguna/matches.php';
    }
}
