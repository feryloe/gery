<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kecocokan</title>

    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

<div class="container">

    <h1>Kecocokan</h1>

    <?php if (!empty($currentUser)): ?>

        <p>
            Menampilkan kecocokan untuk:
            <strong>
                <?php echo htmlspecialchars($currentUser['nama']); ?>
            </strong>
        </p>

        <?php if (empty($matches)): ?>

            <p>
                Tidak ada pengguna lain yang memiliki hobi yang sama.
            </p>

        <?php else: ?>

            <table>

                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Hobi yang Cocok</th>
                        <th>Jumlah Kecocokan</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($matches as $match): ?>

                    <tr>

                        <td>
                            <?php echo htmlspecialchars($match['nama'] ?? '-'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($match['umur'] ?? '-'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($match['jenis_kelamin'] ?? '-'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($match['hobi'] ?? 'Tidak ada hobi'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($match['jumlah_kecocokan'] ?? '0'); ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        <?php endif; ?>

    <?php else: ?>

        <p>
            Data pengguna tidak ditemukan.
        </p>

    <?php endif; ?>

    <p>
        <a href="/">Kembali</a>
    </p>

</div>

</body>

</html>
