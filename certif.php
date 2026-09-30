
<?php
require_once 'inc/bdd.php';
require_once 'inc/api.php';

$sql = $bdd->prepare('SELECT name,uniqueId FROM members');
$sql->execute();
while($user = $sql->fetch(PDO::FETCH_OBJ)){
    $apiKey = citywishEnv('CITYWISH_API_KEY', CITYWISH_API_KEY);
    if($user->uniqueId !== 0) {
        $occurence = new ApiHabboCity($user->uniqueId, $apiKey);
        $pseudo = $occurence->getName();
        if($pseudo !== $user->name){
            $updatename = $bdd->prepare('UPDATE members SET name = :pseudo, certif = 1 WHERE uniqueId = :id');
            $updatename->execute(['pseudo' => $pseudo, 'id' => $user->uniqueId]);
        }
    } elseif($user->uniqueId === 0){
        $occurence = new ApiHabboCity($user->name, $apiKey);
        if($occurence->getErreur() === null){
            $uniqueId = $occurence->getId();
            $updateid = $bdd->prepare('UPDATE members SET uniqueId = :id, certif = 1 WHERE name = :pseudo');
            $updateid->execute(['id' => $uniqueId, 'pseudo' => $occurence->getName()]);
        } elseif($occurence->getErreur() !== null) {
            $updatecertif = $bdd->prepare('UPDATE members SET certif = 0 WHERE name = :pseudo');
            $updatecertif->execute(['pseudo' => $user->name]);
        }
    }
}
