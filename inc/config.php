<?php

function citywishEnv(string $name, string $default = ''): string
{
    $value = getenv($name);
    return $value === false ? $default : $value;
}

const CITYWISH_DB_HOST = '127.0.0.1';
const CITYWISH_DB_NAME = 'citywish';
const CITYWISH_DB_USER = 'citywish';
const CITYWISH_DB_PASS = '';
const CITYWISH_API_KEY = '';
const CITYWISH_ADMIN_DISCORD_WEBHOOK = '';
const CITYWISH_GIVEAWAY_DISCORD_WEBHOOK = '';
