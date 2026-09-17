<?php
declare(strict_types=1);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function setFlash(string $message): void
{
    $_SESSION['flash'] = $message;
}

function pullFlash(): ?string
{
    $message = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return is_string($message) ? $message : null;
}

function cartCount(array $cart): int
{
    return array_sum(array_map('intval', $cart));
}