<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'strict');
session_start();

require_once '../../../bdd.php';
require_once '../../../webhook/Client.php';
require_once '../../../webhook/Embed.php';

use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;

if (isset($bdd)) {
    if (!empty($_SESSION['username']) || isset($_GET['key'])) {
        $userverif = $bdd->prepare('SELECT rang FROM members WHERE name = :username');
        $userverif->execute(['username' => $_SESSION['username']]);
        if ($userverif->rowCount() > 0 || $_GET['key'] === 'key11022022FluxDiscord') {
            $jr = $userverif->fetch(PDO::FETCH_OBJ);
            if ($jr->rang >= 9 || $_GET['key'] === 'key11022022FluxDiscord') {
                $webhooks = $bdd->prepare('SELECT id,id_user,link,name,avatar,role FROM flux_webhook WHERE onoff = :on');
                $webhooks->execute(['on' => 1]);
                if ($webhooks->rowCount() > 0) {
                    $sendFlux = $bdd->prepare('SELECT id,pseudo,poste,newposte,pole,in_out,month,year FROM flux WHERE cw_hc = :hc AND webhook = :discord ORDER BY id ASC');
                    $sendFlux->execute(['hc' => 'hc', 'discord' => 0]);
                    if ($sendFlux->rowCount() > 0) {
                        $webhookContent = [];
                        while ($flux = $sendFlux->fetch(PDO::FETCH_OBJ)) {
													$poles_badges = [
														0 => 'STAFFHC',
														1 => 'GESTION',
														5 => 'COM',
														2 => 'ORGA',
														11 => 'SECURITE',
														12 => 'AIDE',
														13 => 'SFORUM',
														14 => 'SDISCORD',
														6 => 'CASINO',
														8 => 'ANIM',
														9 => 'WIRED',
														7 => 'EVENT',
														10 => 'ARCHI',
														4 => 'ARTISTE',
														3 => 'DEV_SCRIPT',
													];
                            $poles = [
                                'Staff',
                                'Direction',
                                'Organisation',
                                'Développement',
                                'Créations visuelles',
                                'Communication',
                                'Casino',
                                'Événementiel',
                                'Animation',
                                'Wired',
                                'Architecture',
                                'Sécurité',
                                'Assistance',
                                'Forum',
                                'Assistance Discord'
                            ];
                            $months = [
                                '',
                                'Janvier',
                                'Février',
                                'Mars',
                                'Avril',
                                'Mai',
                                'Juin',
                                'Juillet',
                                'Août',
                                'Septembre',
                                'Octobre',
                                'Novembre',
                                'Décembre'
                            ];

                            $color = '';
                            $sentenceType = '';
                            if ($flux->in_out === 1) {
                                $color = '#2FD27B';
                                $sentenceType = ' devient ';
                            } elseif ($flux->in_out === 2) {
                                $sentenceType = ' n\'est plus ';
                                $color = '#E74D3D';
                            } elseif ($flux->in_out === 3) {
                                $color = '#FFC107';
                                $sentenceType = ' change de poste et n\'est plus **' . $flux->poste . '**, mais devient ';
                            }

                            if ($flux->in_out === 1 || $flux->in_out === 2) {
                                $webhookContent[] = $poles[$flux->pole] . '(&)' . $flux->pseudo . '(&)' . $sentenceType . '(&)' . $flux->poste . '(&)' . $months[$flux->month] . '(&)' . $flux->year . '(&)' . $color . '(&)' . $poles_badges[$flux->pole];
                            } elseif ($flux->in_out === 3) {
                                $webhookContent[] = $poles[$flux->pole] . '(&)' . $flux->pseudo . '(&)' . $sentenceType . '(&)' . $flux->newposte . '(&)' . $months[$flux->month] . '(&)' . $flux->year . '(&)' . $color . '(&)' . $poles_badges[$flux->pole];
                            }

                            $updateWebhook = $bdd->prepare('UPDATE flux SET webhook = :discord WHERE id = :id');
                            $updateWebhook->execute(['discord' => 1, 'id' => $flux->id]);
                        }

                        $webhookClients = [];
                        while ($webhook = $webhooks->fetch(PDO::FETCH_OBJ)) {
                            $webhookClients[] = $webhook;
                        }

                        if (count($webhookContent) > 0 && count($webhookClients) > 0) {
                            function sendFluxs($clients, $embedData, $notif, $bdd)
                            {
                                if (count($embedData) > 0) {
                                    foreach ($clients as $webhook) {
                                        $client = new Client($webhook->link);

                                        if (str_replace(' ', '', $webhook->name) === '') {
                                            $client->username('Flux HabboCity - Par CityWish');
                                        } else {
                                            $client->username($webhook->name);
                                        }

                                        if (str_replace(' ', '', $webhook->avatar) === '') {
                                            $client->avatar('https://citywish.fr/assets/imgs/meta.png');
                                        } else {
                                            $client->avatar($webhook->avatar);
                                        }

                                        foreach ($embedData as $value) {
                                            $sentence = '[**' . $value['pseudo'] . '**](https://habbocity.me/profil/' . $value['pseudo'] . ') ' . $value['sentence'] . ' **' . $value['poste'] . '**. *(' . $value['month'] . ' ' . $value['year'] . ')*';
                                            $gesture = 'sml';
                                            if ($value['type'] === '#E74D3D') {
                                                $gesture = 'sad';
                                            }
                                            $img = 'https://avatar.citywish.fr/?username=' . $value['pseudo'] . '&headonly=0&direction=2&head_direction=3&action=wav&gesture=' . $gesture;
                                            $url = 'https://citywish.fr/flux';

                                            $embed = new Embed();
                                            $embed->url($url);
                                            $embed->color($value['type']);
                                            $embed->author('Flux HabboCity - Par CityWish', $url, 'https://citywish.fr/assets/imgs/meta.png');
                                            $embed->title('**__Pôle ' . $value['pole'] . '__**');
                                            $embed->description($sentence);
                                            $embed->image($img);
                                            $embed->thumbnail('https://swf.habbocity.me/c_images/album1584/'.$value['badge'].'.gif');
                                            $embed->footer('Flux basé sur la page : ' . $url);
                                            $embed->timestamp(date('c'));

                                            $client->embed($embed);
                                        }

                                        if ($client->verify() === 'false') {
                                            $invalidWebhook = $bdd->prepare('UPDATE flux_webhook SET link = :link, onoff = :off WHERE id = :id');
                                            $invalidWebhook->execute(['link' => 'LIEN INVALIDE', 'off' => 0, 'id' => $webhook->id]);
                                        } else if ($notif === 0 && $webhook->role !== '') {
                                            $client->message('<@&' . $webhook->role . '>')->send();
                                        } else {
                                            $client->send();
                                        }
                                    }
                                }
                            }

                            $fluxKeys = array_keys($webhookContent);
                            $lastFlux = end($fluxKeys);
                            $sendCount = 0;
                            $roleNotif = 0;
                            $embeds = [];
                            foreach ($webhookContent as $key => $msg) {
                                $msgExplode = explode('(&)', $msg);
                                [$pole, $pseudo, $sentence, $poste, $month, $year, $type, $badge] = $msgExplode;

                                $embeds[] = array(
                                    'pole' => $pole,
                                    'pseudo' => $pseudo,
                                    'sentence' => $sentence,
                                    'poste' => $poste,
                                    'month' => $month,
                                    'year' => $year,
                                    'type' => $type,
																		'badge' => $badge
                                );

                                if (count($embeds) >= 10) {
                                    if ($sendCount >= 5) {
                                        sleep(19);
                                        $sendCount = 0;
                                    }
                                    sleep(1);
                                    sendFluxs($webhookClients, $embeds, $roleNotif, $bdd);
                                    $roleNotif = 1;
                                    $sendCount++;
                                    $embeds = [];
                                    sleep(2);
                                }

                                if ($key === $lastFlux) {
                                    if ($sendCount >= 5) {
                                        sleep(19);
                                        $sendCount = 0;
                                    }
                                    sleep(1);
                                    sendFluxs($webhookClients, $embeds, $roleNotif, $bdd);
                                    $sendCount++;
                                    exit();
                                }
                            }
                        }
                    } else {
                        echo 'aucun flux';
                        exit();
                    }
                } else {
                    echo 'aucun webhook';
                    exit();

                }
            } else {
                echo 'pas le rang';
                exit();
            }
        } else {
            echo 'compte introuvable';
            exit();
        }
    } else {
        echo 'pas connecté';
        exit();
    }
} else {
    echo 'problème bdd';
    exit();
}