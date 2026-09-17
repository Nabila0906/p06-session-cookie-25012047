<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';
$flash = pullFlash();

$cart = $_SESSION['cart'];

$total = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
</head>
<body>

 <?php require __DIR__ . '/components/header.php'; ?>

    <h1>Keranjang Belanja</h1>

    <?php if ($flash): ?>
        <p><?= e($flash) ?></p>
    <?php endif; ?>

    <?php if (empty($cart)): ?>

        <p>Keranjang masih kosong.</p>

    <?php else: ?>

        <?php foreach ($cart as $id => $quantity): ?>

            <?php
            if (!isset($products[$id])) {
                continue;
            }

            $product = $products[$id];
            $subtotal = $product['harga'] * $quantity;
            $total += $subtotal;
            ?>

            <div>
                <h2><?= e($product['nama']) ?></h2>
                <p>Harga: Rp<?= number_format($product['harga'], 0, ',', '.') ?></p>
                <p>Jumlah: <?= $quantity ?></p>
                <p>Subtotal: Rp<?= number_format($subtotal, 0, ',', '.') ?></p>
                <form action="actions.php" method="post">
    <input type="hidden" name="action" value="remove">
    <input type="hidden" name="id" value="<?= $id ?>">
    <button type="submit">Hapus</button>
</form>
            </div>

            <hr>

        <?php endforeach; ?>

        <h2>Total: Rp<?= number_format($total, 0, ',', '.') ?></h2>
        <form action="actions.php" method="post">
    <input type="hidden" name="action" value="clear">
    <button type="submit">Kosongkan Keranjang</button>
</form>

    <?php endif; ?>

    <a href="index.php">Kembali ke Katalog</a>
    <?php require __DIR__ . '/components/footer.php'; ?>


</body>
</html>