<?php

function citywishEnv(string $name, string $default = ''): string
{
    $value = getenv($name);
    return $value === false ? $default : $value;
}

function citywishBaseUrl(): string
{
    $configured = citywishEnv('CITYWISH_BASE_URL');
    if ($configured !== '') {
        return rtrim($configured, '/') . '/';
    }

    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    return $scheme . '://' . $host . '/';
}

define('CITYWISH_DB_HOST', citywishEnv('CITYWISH_DB_HOST', '127.0.0.1'));
define('CITYWISH_DB_NAME', citywishEnv('CITYWISH_DB_NAME', 'citywish'));
define('CITYWISH_DB_USER', citywishEnv('CITYWISH_DB_USER', 'citywish'));
define('CITYWISH_DB_PASS', citywishEnv('CITYWISH_DB_PASS'));
define('CITYWISH_API_KEY', citywishEnv('CITYWISH_API_KEY'));
define('CITYWISH_ADMIN_DISCORD_WEBHOOK', citywishEnv('CITYWISH_ADMIN_DISCORD_WEBHOOK'));
define('CITYWISH_GIVEAWAY_DISCORD_WEBHOOK', citywishEnv('CITYWISH_GIVEAWAY_DISCORD_WEBHOOK'));
define('CITYWISH_COOKIE_DOMAIN', citywishEnv('CITYWISH_COOKIE_DOMAIN'));
