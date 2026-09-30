<?php

function get($param)
{
    return array_key_exists($param, $_GET) && !is_null($_GET[$param]) && trim($_GET[$param]) !== '' ? $_GET[$param] : null;
}

$user = get('username');
$user = !is_null($user) && trim($user) !== '' ? $user : 'DraftCity';

$action = strtolower(get('action'));
$action = in_array($action, ['std', 'sit', 'lay', 'wlk', 'wav', 'sit-wav', 'swm']) ? $action : 'std';

$direction = get('direction');
$direction = !is_null($direction) ? $direction % 7 : 3;

$head_direction = get('head_direction');
$head_direction = !is_null($head_direction) ? $head_direction % 7 : 3;

$gesture = strtolower(get('gesture'));
$gesture = in_array($gesture, ['std', 'agr', 'sml', 'sad', 'srp', 'spk', 'eyb']) ? $gesture : 'sml';

$size = strtolower(get('size'));
$size = in_array($size, ['l', 's', 'n']) ? $size : 'n';

$head_only = !!get('headonly');

$url = 'https://api.habbocity.me/avatar_image.php?' . http_build_query([
        'user' => $user,
        'action' => $action,
        'direction' => $direction,
        'head_direction' => $head_direction,
        'gesture' => $gesture,
        'size' => $size,
        'headonly' => $head_only
    ]);

list(, , $type) = getimagesize($url);

$look = imagecreatefrompng(isset($type) && $type === IMAGETYPE_PNG ? $url : str_replace($user, 'DraftCity', $url));

header('Content-Type: image/png');
header('Pragma-directive: no-cache');
header('Cache-directive: no-cache');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
imagesavealpha($look, true);
imagepng($look);
imagedestroy($look);