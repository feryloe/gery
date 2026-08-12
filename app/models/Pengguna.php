<?php
// app/models/Pengguna.php

class Pengguna {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function all() {
        $stmt = $this->pdo->query("
            SELECT p.*, GROUP_CONCAT(h.nama, ', ') AS hobi
            FROM pengguna p
            LEFT JOIN pengguna_hobi ph ON p.id = ph.pengguna_id
            LEFT JOIN hobi h ON ph.hobi_id = h.id
            GROUP BY p.id
            ORDER BY p.id DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM pengguna
            WHERE id = ?
        ");

        $stmt->execute([$id]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        $stmt = $this->pdo->prepare("
            SELECT h.id, h.nama
            FROM hobi h
            INNER JOIN pengguna_hobi ph ON h.id = ph.hobi_id
            WHERE ph.pengguna_id = ?
        ");

        $stmt->execute([$id]);

        $user['hobi_ids'] = array_column(
            $stmt->fetchAll(PDO::FETCH_ASSOC),
            'id'
        );

        return $user;
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO pengguna (nama, umur, jenis_kelamin)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([
            $data['nama'],
            $data['umur'],
            $data['jenis_kelamin']
        ]);

        $penggunaId = $this->pdo->lastInsertId();

        $this->syncHobi($penggunaId, $data['hobi_ids'] ?? []);

        return $penggunaId;
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE pengguna
            SET nama = ?, umur = ?, jenis_kelamin = ?
            WHERE id = ?
        ");

        $stmt->execute([
            $data['nama'],
            $data['umur'],
            $data['jenis_kelamin'],
            $id
        ]);

        $this->syncHobi($id, $data['hobi_ids'] ?? []);

        return true;
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("
            DELETE FROM pengguna
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    private function syncHobi($penggunaId, $hobiIds) {
        $stmt = $this->pdo->prepare("
            DELETE FROM pengguna_hobi
            WHERE pengguna_id = ?
        ");

        $stmt->execute([$penggunaId]);

        if (!empty($hobiIds)) {
            $stmt = $this->pdo->prepare("
                INSERT INTO pengguna_hobi (pengguna_id, hobi_id)
                VALUES (?, ?)
            ");

            foreach ($hobiIds as $hobiId) {
                $stmt->execute([
                    $penggunaId,
                    $hobiId
                ]);
            }
        }
    }

    public function getMatches($id) {
        $user = $this->find($id);

        if (!$user || empty($user['hobi_ids'])) {
            return [];
        }

        $placeholders = implode(
            ',',
            array_fill(0, count($user['hobi_ids']), '?')
        );

        $sql = "
            SELECT
                p.*,
                COUNT(ph.hobi_id) AS jumlah_kecocokan,
                GROUP_CONCAT(h.nama, ', ') AS hobi
            FROM pengguna p
            INNER JOIN pengguna_hobi ph
                ON p.id = ph.pengguna_id
            INNER JOIN hobi h
                ON ph.hobi_id = h.id
            WHERE p.id != ?
              AND ph.hobi_id IN ($placeholders)
            GROUP BY p.id
            ORDER BY jumlah_kecocokan DESC, p.id DESC
        ";

        $params = array_merge(
            [$id],
            $user['hobi_ids']
        );

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
