
<?php
// config/init_db.php

if (!isset($pdo) || !$pdo) return;

$schema = [
"CREATE TABLE IF NOT EXISTS hobi (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nama TEXT NOT NULL
);",
"CREATE TABLE IF NOT EXISTS pengguna (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nama TEXT NOT NULL,
    umur INTEGER,
    jenis_kelamin TEXT
);",
"CREATE TABLE IF NOT EXISTS pengguna_hobi (
    pengguna_id INTEGER NOT NULL,
    hobi_id INTEGER NOT NULL,
    PRIMARY KEY (pengguna_id, hobi_id),
    FOREIGN KEY (pengguna_id) REFERENCES pengguna(id) ON DELETE CASCADE,
    FOREIGN KEY (hobi_id) REFERENCES hobi(id) ON DELETE CASCADE
);"
];

foreach ($schema as $sql) {
    $pdo->exec($sql);
}
