<?php
require_once __DIR__ . '/../../../inc/config.php';

## CMS
const VERSION = 2;
define('URL', citywishBaseUrl() . 'administration/');
const GLOBAL_PATH = '/var/www/citywish/beta/';
const PATH = '/var/www/citywish/administration/';

## SQL
define('SQL_HOST', CITYWISH_DB_HOST);
define('SQL_USER', CITYWISH_DB_USER);
define('SQL_PASS', CITYWISH_DB_PASS);
define('SQL_BASE', CITYWISH_DB_NAME);

## AVATAR
const AVATAR_IMAGE = 'https://avatar.citywish.fr/?username=';
