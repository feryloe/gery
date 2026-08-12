
<?php
// public/index.php
ini_set('display_errors',1);
error_reporting(E_ALL);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (php_sapi_name() === 'cli-server') {
    $file = __DIR__ . $path;
    if (is_file($file)) return false;
}


$pdo = require __DIR__ . '/../config/database.php';
// Ensure schema exists (creates tables if missing)
require __DIR__ . '/../config/init_db.php';

// Autoload controllers
require_once __DIR__ . '/../app/controllers/PenggunaController.php';
require_once __DIR__ . '/../app/controllers/HobiController.php';

$pc = new PenggunaController($pdo);
$hc = new HobiController($pdo);


if ($path === '/' || $path === '') {
    $pc->index();
    exit;
}

if ($path === '/create') {
    $pc->create();
    exit;
}

if ($path === '/store') {
    $pc->store();
    exit;
}

if ($path === '/edit') {
    $pc->edit();
    exit;
}

if ($path === '/update') {
    $pc->update();
    exit;
}

if ($path === '/delete') {
    $pc->delete();
    exit;
}

if ($path === '/matches') {
    $pc->matches();
    exit;
}

/* Hobi routes */
if ($path === '/hobi') {
    $hc->index();
    exit;
}
if ($path === '/hobi/store') {
    $hc->store();
    exit;
}
if ($path === '/hobi/delete') {
    $hc->delete();
    exit;
}

http_response_code(404);
echo "404 Not Found";
