<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Pengguna</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

<div class="container">

    <h1>Edit Pengguna</h1>

    <form method="post" action="/update">

        <input
            type="hidden"
            name="id"
            value="<?php echo htmlspecialchars($user['id']); ?>"
        >

        <label>
            Nama:
            <input
                type="text"
                name="nama"
                value="<?php echo htmlspecialchars($user['nama'] ?? ''); ?>"
                required
            >
        </label>

        <br><br>

        <label>
            Umur:
            <input
                type="number"
                name="umur"
                value="<?php echo htmlspecialchars($user['umur'] ?? ''); ?>"
                min="1"
            >
        </label>

        <br><br>

        <label>
            Jenis Kelamin:

            <select name="jenis_kelamin">

                <option value="">- Pilih -</option>

                <option value="L"
                    <?php echo (($user['jenis_kelamin'] ?? '') === 'L') ? 'selected' : ''; ?>>
                    Laki-Laki
                </option>

                <option value="P"
                    <?php echo (($user['jenis_kelamin'] ?? '') === 'P') ? 'selected' : ''; ?>>
                    Perempuan
                </option>

            </select>
        </label>

        <br><br>

        <fieldset>

            <legend>Pilih Hobi (boleh lebih dari satu)</legend>

            <?php if (empty($hobi)): ?>

                <p>
                    Belum ada data hobi.
                    <a href="/hobi">Kelola Hobi</a>
                </p>

            <?php else: ?>

                <?php foreach ($hobi as $h): ?>

                    <label>
                        <input
                            type="checkbox"
                            name="hobi_ids[]"
                            value="<?php echo htmlspecialchars($h['id']); ?>"
                            <?php
                            if (
                                !empty($user['hobi_ids']) &&
                                in_array($h['id'], $user['hobi_ids'])
                            ) {
                                echo 'checked';
                            }
                            ?>
                        >

                        <?php echo htmlspecialchars($h['nama']); ?>
                    </label>

                    <br>

                <?php endforeach; ?>

            <?php endif; ?>

        </fieldset>

        <br>

        <button type="submit">Update</button>

    </form>

    <p>
        <a href="/">Kembali</a>
    </p>

</div>

</body>
</html>
