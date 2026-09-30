<?php
require 'system.php';

/*
$user = new UserInfo('Cold');
if ($user->getError() === null) {
    echo $user->getMail();
    echo $user->getName();
    echo $user->getId();
} else {
    echo $user->getError();
}

$user3 = new UserInfo(4);
if ($user3->getError() === null) {
    echo $user3->getMail();
    echo $user3->getName();
    echo $user3->getId();
} else {
    echo $user3->getError();
}

echo '<br/><br/>';

echo '<pre>';
print_r($_SERVER);
echo '</pre>';*/

if(isset($_GET['do'])) {
    echo empty($_POST['aaa']);
}

?>

<form action="?do" method="post">
    
<input name="aa" type="text" id="search" placeholder="Rechercher un article" />
<input name="aaa" type="text">
<input name="aaaa" type="submit">
</form>