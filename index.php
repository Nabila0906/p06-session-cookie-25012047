<?php
require_once _DIR_ . '/bootstrap.php';
require_once _DIR_ . '/functions.php';

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