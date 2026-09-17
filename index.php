<?php
require_once _DIR_ . '/bootstrap.php';
require_once _DIR_ . '/functions.php';
$allowedThemes = ['light', 'dark'];

$theme = $_COOKIE['theme'] ?? 'light';

if (!in_array($theme, $allowedThemes, true)) {
    $theme = 'light';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'])) {
    $candidate = $_POST['theme'];

    if (in_array($candidate, $allowedThemes, true)) {
        setcookie('theme', $candidate, [
            'expires' => time() + 60 * 60 * 24 * 30,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        header('Location: index.php');
        exit;
    }
}

$products = require _DIR_ . '/data/products.php';
$flash = pullFlash();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk</title>
</head>
<body>

    <h1>Katalog Produk</h1>
    <form method="post">
    <label for="theme">Tema:</label>

    <select name="theme" id="theme">
        <option value="light" <?= $theme === 'light' ? 'selected' : '' ?>>Light</option>
        <option value="dark" <?= $theme === 'dark' ? 'selected' : '' ?>>Dark</option>
    </select>

    <button type="submit">Simpan Tema</button>
</form>

    <?php if ($flash): ?>
        <p><?= e($flash) ?></p>
    <?php endif; ?>

    <p>Isi keranjang: <?= cartCount($_SESSION['cart']) ?></p>

    <?php foreach ($products as $id => $product): ?>
        <div>
            <h2><?= e($product['nama']) ?></h2>
            <p>Harga: Rp<?= number_format($product['harga'], 0, ',', '.') ?></p>

            <form action="actions.php" method="post">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit">Tambah ke Keranjang</button>
            </form>
        </div>
        <hr>
    <?php endforeach; ?>

    <a href="cart.php">Lihat Keranjang</a>

</body>
</html>