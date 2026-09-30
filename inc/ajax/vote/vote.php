<?php
require_once '../../bdd.php';
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

if (isset($_SESSION['username'])) {
    $statvote = $bdd->prepare('SELECT onoff FROM statutvote WHERE id = ?');
    $statvote->execute([1]);
    if($statvote->fetch(PDO::FETCH_OBJ)->onoff === 1) {
        if ($_POST['pseudo']) {
            $pseudo = str_replace(' ', '', $_POST['pseudo']);

            $user_one = $bdd->prepare('SELECT id FROM members WHERE name = ?');
            $user_one->execute([$pseudo]);
            $fetch_one = $user_one->fetch(PDO::FETCH_OBJ);

            $user_two = $bdd->prepare('SELECT id FROM members WHERE name = ?');
            $user_two->execute([$_SESSION['username']]);
            $fetch_two = $user_two->fetch(PDO::FETCH_OBJ);

            if ($user_two->rowCount() > 0 && $user_one->rowCount() > 0) {
                $verifvote = $bdd->prepare('SELECT id_users,id_whovote FROM vote WHERE id_users = ? AND id_whovote = ?');
                $verifvote->execute([$fetch_one->id, $fetch_two->id]);
                if ($verifvote->rowCount() > 0) {
                    $unvote_vote = $bdd->prepare('DELETE FROM vote WHERE id_users = ? AND id_whovote = ?');
                    $unvote_vote->execute([$fetch_one->id, $fetch_two->id]);

                    $unvote_members = $bdd->prepare('UPDATE members SET vote = vote - 1 WHERE id = ?');
                    $unvote_members->execute([$fetch_one->id]);

                    $nbvotes = $bdd->prepare('SELECT vote FROM members WHERE id = ?');
                    $nbvotes->execute([$fetch_one->id]);

                    echo json_encode(['correct' => true, 'type' => 'success', 'action' => 'unvote', 'title' => 'Succès', 'reason' => 'Ton vote a bien été retiré.']);
                    exit();
                } else {
                    $veriflimit = $bdd->prepare('SELECT id_users,id_whovote FROM vote WHERE id_whovote = ?');
                    $veriflimit->execute([$fetch_two->id]);
                    if ($veriflimit->rowCount() >= 3) {
                        echo json_encode(['correct' => true, 'type' => 'warning', 'title' => 'Avertissement', 'reason' => 'Tu ne peux pas voter plus de 3 fois.']);
                        exit();
                    } else {
                        if ($fetch_one->id === $fetch_two->id) {
                            echo json_encode(['correct' => true, 'type' => 'warning', 'title' => 'Avertissement', 'reason' => 'Tu ne peux pas voter pour toi-même.']);
                            exit();
                        } else {
                            $addvote_members = $bdd->prepare('UPDATE members SET vote = vote + 1 WHERE id = ?');
                            $addvote_members->execute([$fetch_one->id]);

                            $addvote_vote = $bdd->prepare('INSERT INTO vote(id_users,id_whovote) VALUES(?,?)');
                            $addvote_vote->execute([$fetch_one->id, $fetch_two->id]);

                            $nbvotes = $bdd->prepare('SELECT vote FROM members WHERE id = ?');
                            $nbvotes->execute([$fetch_one->id]);

                            echo json_encode(['correct' => true, 'type' => 'success', 'action' => 'vote', 'title' => 'Succès', 'reason' => 'Ton vote a bien été ajouté.']);
                            exit();
                        }
                    }
                }
            }
        }
    } else {
        echo json_encode(['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Le vote est terminé, tu ne peux plus voter.']);
        exit();
    }
    echo json_encode(['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Une erreur s\'est produite durant l\'envoie de ton vote.']);
    exit();
} else {
    echo json_encode(['correct' => true, 'type' => 'error', 'title' => 'Erreur', 'reason' => 'Tu dois être connecté pour pouvoir voter.']);
    exit();
}
