<?php
require_once './api.php';
require_once './bdd.php';

$apiKey = citywishEnv('CITYWISH_API_KEY', CITYWISH_API_KEY);
$sql = $bdd->prepare('SELECT id,uniqueId FROM members WHERE uniqueId != 0');
$sql->execute();
$members = $sql->fetchAll();
foreach ($members as $key => $value) {
	$occurence = new ApiHabboCity($value['uniqueId'], $apiKey);
	if ($occurence->getErreur() === null) { 
		$figure = $occurence->getFigure();
		$select = $bdd->prepare('SELECT id,figure FROM members_figure WHERE id_user = ?');
		$select->execute([$value['id']]);
		$mf = $select->fetch();
		if($select->rowCount() > 0) {
			if($mf['figure'] !== $figure) {
				$files = glob('/home/citywish/avatarimager/nitro-converted-assets/'.$mf['figure'].'.*');
				foreach ($files as $key => $value) {
					unlink($value);
				}
				$update = $bdd->prepare('UPDATE members_figure SET figure = ? WHERE id_user = ?');
				$update->execute([$figure, $value['id']]);
			}
		} else {
			$set = $bdd->prepare('INSERT INTO members_figure(id_user,figure) VALUES(?,?)');
			$set->execute([$value['id'], $figure]);
		}
	}
}