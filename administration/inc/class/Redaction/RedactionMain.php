<?php
session_start();

require_once '../BddInit.php';
require_once '../UserInfo.php';

class RedactionMain
{
    private $user;

    private $pdo;

    private $error = null;

    private $response;

    public function __construct()
    {
        $this->user = new UserInfo($_SESSION['username']);
        $this->pdo = new BddInit('JQkuQrQ4RpgyC3qB');
    }

    private function htmlClean(string $text): string
    {
        return htmlentities($text);
    }

    public function draft()
    {

    }

    public function send()
    {

    }

    public function correct()
    {

    }

    public function edit() 
    {

    }
}