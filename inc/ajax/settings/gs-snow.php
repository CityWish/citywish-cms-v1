<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

if(isset($_SESSION['SNOW'])){
    if($_SESSION['SNOW'] == 0){
        $_SESSION['SNOW'] = 1;
        echo 'OUI';
        exit();
    }elseif($_SESSION['SNOW'] == 1){
        $_SESSION['SNOW'] = 0;
        echo 'NON';
        exit();
    }
}else{
    $_SESSION['SNOW'] = 0;
}
?>