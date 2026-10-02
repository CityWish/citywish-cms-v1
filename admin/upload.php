<?php
require_once 'inc/data.php';

function message($message, $location = null)
{
    $javascript = '<script>alert("' . $message . '");';
    if ($location) {
        $javascript .= 'location.href = "' . $location . '";';
    }
    $javascript .= '</script>';
    die($javascript);
}

$image_folder = '../uploads/';
$upload_page = '/admin/select.php';

if (!is_dir($image_folder)) {
    message('Le dossier de destination n\'existe pas. Contacte un administrateur.');
} elseif (!is_writable($image_folder)) {
    message('Le dossier de destination n\'est pas accessible en écriture. Contacte un administrateur.');
}

reset($_FILES);
$image = current($_FILES);

if (!isset($image['error']) || is_array($image['error'])) {
    message('Une erreur s\'est produite, ou alors, vous avez essayé de télécharger plusieurs fichiers en même temps.', $upload_page);
} elseif ($image['error'] === UPLOAD_ERR_NO_FILE && empty($image['tmp_name'])) {
    message('Veuillez sélectionner un fichier.', $upload_page);
} elseif (in_array($image['error'], [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE])) {
    message('Votre fichier est trop lourd.', $upload_page);
} elseif (!is_uploaded_file($image['tmp_name'])) {
    message('Le fichier n\'a pas été téléchargé depuis HTTP POST.', $upload_page);
} elseif ($image['error'] !== UPLOAD_ERR_OK) {
    message('Une erreur s\'est produite.', $upload_page);
}

$mime_type = mime_content_type($image['tmp_name']);
$accepted_types = [
    'image/png' => 'png',
    'image/jpeg' => 'jpg',
    'image/gif' => 'gif'
];

if (!array_key_exists($mime_type, $accepted_types)) {
    message('Le type du fichier n\'est pas pris en charge.', $upload_page);
}

$image_destination = $image_folder . uniqid(time()) . '.' . $accepted_types[$mime_type];
move_uploaded_file($image['tmp_name'], $image_destination);

$logsql = $bdd->prepare('INSERT INTO logs (logs, par, dates) VALUES (:logs, :par, :dates)');
$logsql->execute(['logs' => 'A upload une image', 'par' => $jr->name, 'dates' => date('d-m-Y H:i:s')]);

message('Le fichier ' . basename($image['name']) . ' a bien été envoyé. Vous pouvez le retrouver ici ' . $Configs['Url'] . $image_destination, '/admin/listimg.php');
