<?php
require_once PATH.'system/objects/utils/Statistics.php';

class UtilsManager
{
    public function getIpAdress(): string
    {
        return $_SERVER['HTTP_CLIENT_IP'] ?? ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']);
    }

    public function getStats(): Statistics
    {
        return new Statistics();
    }
}