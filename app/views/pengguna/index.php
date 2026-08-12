<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Pengguna</title>

    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

<div class="container">

    <h1>Daftar Pengguna Biro Jodoh Berbasis Hobi</h1>

    <p>
        <a href="/create">Tambah Pengguna</a>
        |
        <a href="/hobi">Kelola Hobi</a>
    </p>

    <?php if (empty($users)): ?>

        <p>Tidak ada pengguna yang ditemukan.</p>

        <p>
            <a href="/create">+ Tambah Pengguna</a>
        </p>

    <?php else: ?>

        <table>

            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Hobi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($users as $u): ?>

                <tr>

                    <td>
                        <?php echo htmlspecialchars($u['nama'] ?? ''); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($u['umur'] ?? ''); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($u['jenis_kelamin'] ?? ''); ?>
                    </td>

                    <td>
                        <?php
                        echo htmlspecialchars(
                            $u['hobi'] ?? 'Tidak ada hobi'
                        );
                        ?>
                    </td>

                    <td>

                        <a href="/edit?id=<?php echo $u['id']; ?>">
                            Edit
                        </a>

                        |

                        <a
                            href="/delete?id=<?php echo $u['id']; ?>"
                            onclick="return confirm('Yakin ingin menghapus pengguna ini?')"
                        >
                            Hapus
                        </a>

                        |

                        <a href="/matches?id=<?php echo $u['id']; ?>">
                            Lihat Kecocokan
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>

</body>
</html>
