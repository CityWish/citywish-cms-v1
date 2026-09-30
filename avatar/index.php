<?php
/*
header('Pragma-directive: no-cache');
header('Cache-directive: no-cache');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
$imgPng = imageCreateFromPng('./default_avatar_n.png');
if (isset($_GET['size'])) {
    if ($_GET['size'] === 'l') {
        $imgPng = imageCreateFromPng('./default_avatar_l.png');
    }
}

if (isset($_GET['headonly'])) {
    if ($_GET['headonly'] === '1') {
        if ($_GET['size'] === 'n' || $_GET['size'] === 'big') {
            $imgPng = imageCreateFromPng('./default_avatar_n_head.png');
        } elseif ($_GET['size'] === 'l') {
            $imgPng = imageCreateFromPng('./default_avatar_l_head.png');
        }
    }
}

imageAlphaBlending($imgPng, true);
imageSaveAlpha($imgPng, true);
header("Content-type: image/png");
imagepng($imgPng);
imagedestroy($imgPng);
exit;*/

require_once './api.php';
require_once './bdd.php';
$apiKey = citywishEnv('CITYWISH_API_KEY', CITYWISH_API_KEY);
$avatarImage = 'https://avatar.habbocity.me/?figure=';
///$avatarImage = 'https://imager.citywish.fr/?figure=';

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $valide = ['action', 'direction', 'head_direction', 'gesture', 'size', 'headonly'];
    $data = null;
    $error = null;
    $figure = 'hr-115-42.hd-190-1.ch-215-62.lg-285-91.sh-290-62';
    $occurence = new ApiHabboCity($username, $apiKey);
    if ($occurence->getErreur() === null) {
        $figure = $occurence->getFigure();
    } elseif ($occurence->getErreur() !== 'Utilisateur introuvable') {
        $sql = $bdd->prepare('SELECT members_figure.figure as figure,members.id FROM members_figure JOIN members ON members.name = ? WHERE id_user = members.id');
        $sql->execute([$username]);
        if ($sql->rowCount() > 0) {
            $figure = $sql->fetch()['figure'];
        }
        $avatarImage = 'https://imager.citywish.fr/?figure=';
    }
    foreach ($valide as $value) {
        if (isset($_GET[$value])) {
            //std, sit, lay, wlk, wav, sit-wav, swm
            $valideAction = ['std', 'sit', 'lay', 'wlk', 'wav', 'sit-wav', 'swm'];
            if ($value == "action" && !in_array($_GET[$value], $valideAction))
                $error = $error . "L'action est invalide, sa valeur doit être égale à une de celles ci-contre : std, sit, lay, wlk, wav, sit-wav, swm. ";

            // 0-7
            if (($value == "direction" || $value == "head_direction") && ($_GET[$value] < 0 || $_GET[$value] > 7))
                $error = $error . "La direction ou l'head_direction est invalide, sa valeur doit être comprise entre 0-7. ";

            //std, agr, sml, sad, srp, spk, eyb
            $valideGesture = ['std', 'agr', 'sml', 'sad', 'srp', 'spk', 'eyb'];
            if ($value == "gesture" && !in_array($_GET[$value], $valideGesture))
                $error = $error . "L'option gesture est invalide, sa valeur doit être égale à une de celles ci-contre : std, agr, sml, sad, srp, spk, eyb. ";

            //l, s, n, big
            $valideSize = ['l', 's', 'n', 'big'];
            if ($value == "size" && !in_array($_GET[$value], $valideSize))
                $error = $error . "L'option size est invalide, sa valeur doit être égale à une de celles ci-contre : l, s, n, big. ";

            //true/false
            if ($value == "headonly" && ($_GET[$value] != 0 && $_GET[$value] != 1))
                $error = $error . "L'headonly est invalide, sa valeur doit être égale à 1 ou à 0. ";

            $data = $data . "&" . $value . "=" . $_GET[$value];
        }
    }

    if ($error != null) {
        $reponse = ['type' => 'error', 'message' => $error];
    } else {
        header('Pragma-directive: no-cache');
        header('Cache-directive: no-cache');
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        $imgPng = imageCreateFromPng($avatarImage . $figure . $data);
        if ($imgPng === false) {
            $imgPng = imageCreateFromPng('./default_avatar_n.png');
            if (isset($_GET['size'])) {
                if ($_GET['size'] === 'l') {
                    $imgPng = imageCreateFromPng('./default_avatar_l.png');
                }
            }

            if (isset($_GET['headonly'])) {
                if ($_GET['headonly'] === '1') {
                    if ($_GET['size'] === 'n' || $_GET['size'] === 'big') {
                        $imgPng = imageCreateFromPng('./default_avatar_n_head.png');
                    } elseif ($_GET['size'] === 'l') {
                        $imgPng = imageCreateFromPng('./default_avatar_l_head.png');
                    }
                }
            }

            imageAlphaBlending($imgPng, true);
            imageSaveAlpha($imgPng, true);
            header("Content-type: image/png");
            imagepng($imgPng);
            imagedestroy($imgPng);
            exit;
        }
        imageAlphaBlending($imgPng, true);
        imageSaveAlpha($imgPng, true);
        if (isset($_GET['img_format'])) {
            if ($_GET['img_format'] == "gif") {
                header("Content-type: image/gif");
            } else {
                header("Content-type: image/png");
            }
        } else {
            header("Content-type: image/png");
        }
        if (isset($_GET['img_format']) and $_GET['img_format'] == "gif") {
            imagegif($imgPng);
        } else {
            imagepng($imgPng);
        }
        imagedestroy($imgPng);
        return;
    }
} else {
    $reponse = ['type' => 'error', 'message' => 'Ressource invalide'];
}

header('Content-Type: application/json');
echo json_encode($reponse);
