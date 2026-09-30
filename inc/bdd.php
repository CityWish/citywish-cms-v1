<?php
require_once __DIR__ . '/config.php';

try {
	$bdd = new PDO('mysql:host=' . CITYWISH_DB_HOST . ';dbname=' . CITYWISH_DB_NAME . ';charset=utf8mb4', CITYWISH_DB_USER, citywishEnv('CITYWISH_DB_PASS', CITYWISH_DB_PASS), [
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	]);
} catch (\PDOException $e) {
	print_r($e->getMessage());
	die();
}