<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tambah Pengguna</title>
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="container">
    <h1>Tambah Pengguna</h1>
    <form method="post" action="/store">
        <label>Nama: <input type="text" name="nama" required></label><br><br>
        <label>Umur: <input type="number" name="umur"></label><br><br>
        <label>Jenis Kelamin:
            <select name="jenis_kelamin">
                <option value="">-</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </select>
        </label><br><br>

        <fieldset>
            <legend>Pilih Hobi (boleh lebih dari satu)</legend>
            <?php foreach($hobi as $h): ?>
                <label><input type="checkbox" name="hobi_ids[]" value="<?php echo $h['id']; ?>"> <?php echo htmlspecialchars($h['nama']); ?></label><br>
            <?php endforeach; ?>
        </fieldset>

        <br>
        <button type="submit">Simpan</button>
    </form>
    <p><a href="/">Kembali</a></p>
</div>
</body>
</html>