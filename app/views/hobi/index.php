
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kelola Hobi</title>
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="container">
    <h1>Kelola Hobi</h1>
    <form method="post" action="/hobi/store">
        <input type="text" name="nama" placeholder="Nama hobi" required>
        <button type="submit">Tambah Hobi</button>
    </form>

    <?php if(empty($hobi)): ?>
        <p>Tidak ada data hobi.</p>
    <?php else: ?>
        <ul>
            <?php foreach($hobi as $h): ?>
                <li><?php echo htmlspecialchars($h['nama']); ?> - <a href="/hobi/delete?id=<?php echo $h['id']; ?>" onclick="return confirm('Hapus?')">Hapus</a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <p><a href="/">Kembali</a></p>
</div>
</body>
</html>
