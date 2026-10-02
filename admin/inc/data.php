<?php
require_once '../inc/core.php';
require_once '../inc/webhook/Client.php';
require_once '../inc/webhook/Embed.php';
use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;

if(empty($_SESSION['username'])){
	header("Location: ../index.php");
	exit();
}
if($jr->rang < 6){
	header("Location: ../index.php");
	exit();
}
/*if($_SESSION['admin'] === false){
	header('Location: ../index.php');
	exit();
}*/

if(isset($_GET['do'])){
	if(happySecu($_GET['do']) == "rank"){
		if(isset($_POST['pseudo'])){
			if(empty($_POST['pseudo'])){
				echo '<script>alert("Veuillez remplir la case pseudo !");</script>';
			} else{
				if($jr->rang > 7){
					$sql = $bdd->query("SELECT * FROM members WHERE name = '".happySecu($_POST['pseudo'])."'");
					if($sql->rowCount() < 1){
						echo '<script>alert("Aucun membre trouvé sous ce pseudo !");</script>';
					} else{
						$staff = $sql->fetch(PDO::FETCH_OBJ);
						$rang = happySecu($_POST['rang']);
	                    $fonction = happySecu($_POST['fonction']);
						$stats = happySecu($_POST['stats']);

                        $ranksql = $bdd->prepare('UPDATE members SET rang = :rang, fonction = :fonction, point_staff = :point_staff, stats_staff = :stats_staff WHERE name = :name');
                        $ranksql->execute(['rang' => $rang, 'fonction' => $fonction, 'point_staff' => 3, 'stats_staff' => 0, 'name' => happySecu($_POST['pseudo'])]);
												$pole = $_POST['pole'];
												$poles = ['Staff',
												'Construction',
												'Création',
												'Animation',
												'Correction',
												'Rédaction',
												'Communication',
												'Événementiel',
												'Administration',
												'Gestion',
												'Fondation'];
												$client = new Client(citywishEnv('CITYWISH_ADMIN_DISCORD_WEBHOOK', CITYWISH_ADMIN_DISCORD_WEBHOOK));
												if ($rang != 1) {
														$client->message('__**Pôle '.$poles[$pole].'**__ - **'.$_POST['pseudo'].'** devient **'.html_entity_decode(html_entity_decode($fonction)).'**. Bravo à lui/elle !');
                            $logsql = $bdd->prepare("INSERT INTO logs(logs,par,dates) values(?,?,?)");
                            $logsql->execute(array("À Rank un membre", $jr->name, date('d-m-Y H:i:s')));
                            echo '<script>alert("Membre rank !");</script>';
                        }
                        else{
													$client->message('__**Pôle '.$poles[$pole].'**__ - **'.$_POST['pseudo'].'** n\'est plus **'.html_entity_decode(html_entity_decode($staff->fonction)).'**. Bonne continuation à lui/elle !');
                            $logsql = $bdd->prepare("INSERT INTO logs(logs,par,dates) values(?,?,?)");
                            $logsql->execute(array("À dérank un membre", $jr->name, date('d-m-Y H:i:s')));
                            echo '<script>alert("Membre rank !");</script>';
						}
					///	$client->send();
					}
				} else {
					echo '<script>alert("Erreur");</script>';
				}
			}
		}
	}
}

if(isset($_GET['do'])){
	if(happySecu($_GET['do']) == "creer"){
		if(isset($_POST['titre']) || isset($_POST['descp']) || isset($_POST['msg']) || isset($_POST['background']) || isset($_POST['categorie'])){
			$titre = happySecu($_POST['titre']);
			$descp = happySecu($_POST['descp']);
			$msg = mb_convert_encoding($_POST['msg'], 'UTF-8', 'UTF-8');
			$background = happySecu($_POST['background']);
			$categorie = happySecu($_POST['categorie']);
			if(empty($titre) || empty($msg) || empty($background) || empty($categorie)){
				echo '<script>alert("Veuillez remplir tout les champs !");</script>';
			} else{
				if(strlen($descp) <= 300) {
				$sql = $bdd->prepare("INSERT INTO news(titre,descp,body,par,dates,background,categorie) VALUES (?,?,?,?,?,?,?)");
				$logsql = $bdd->prepare("INSERT INTO logs(logs,par,dates) values(?,?,?)");
				$logsql->execute(array("À Créé un article",$jr->name,time()));
				$sql->execute(array($titre,$descp,$msg,$jr->id,time(),$background,$categorie));
				echo '<script>alert("Article envoyé en vérification !");</script>';
				} else {
					echo '<script>alert("La description est trop longue.");</script>';
				}
			}
		}
	}
}

if(isset($_GET['do'])){
	if($_GET['do'] === 'ban'){
		if(empty($_POST['pseudo']) || empty($_POST['why'])){
			echo '<script>alert("Oups, il faut remplir tous les champs.");</script>';
			header('Location: bann.php');
			exit();
		}else{
			$ban_members = $bdd->prepare('SELECT * FROM members WHERE name = :pseudo');
			$ban_members->execute(['pseudo' => $_POST['pseudo']]);
			if($ban_members->rowCount() < 1){
				echo '<script>alert("Oups, le membre n\'existe pas.");</script>';
				header('Location: bann.php');
				exit();	
			}else{
				$ban_members_info = $ban_members->fetch(PDO::FETCH_OBJ);
				if($jr->rang === 9){
					if($ban_members_info->rang > 8){
						echo '<script>alert("Oups, tu ne peux pas bannir un haut gradé.");</script>';
						header('Location: bann.php');
						exit();
					}
				}
				if($jr->rang >= 10){
					if($ban_members_info->rang > 10){
						echo '<script>alert("Oups, tu ne peux pas bannir un fondateur.");</script>';
						header('Location: bann.php');
						exit();
					}
				}
				if(isset($_POST['banip'])){
					$ban_ip = $bdd->prepare('INSERT INTO banip(id,pseudo,why,ip) VALUES(?,?,?,?)');
					$ban_ip->execute([$ban_members_info->id, $_POST['pseudo'], $_POST['why'], $ban_members_info->ip_adresse]);
					$logsql = $bdd->prepare('INSERT INTO logs(logs,par,dates) VALUES (?,?,?)');
					$logs = 'À banip le joueur : '.$_POST['pseudo'].' qui est sous l\'adresse ip : '.$ban_members_info->ip_adresse;
					$logsql->execute([$logs, $jr->name, date('d-m-Y H:i:s')]);
					header('Location: bann');
					exit();
				}elseif(empty($_POST['banip'])){
					$ban = $bdd->prepare('INSERT INTO banip(id,pseudo,why,ip) VALUES(?,?,?,?)');
					$ban->execute([$ban_members_info->id, $_POST['pseudo'], $_POST['why'], '']);
					$logsql = $bdd->prepare('INSER INTO logs(logs,par,dates) VALUES (?,?,?)');
					$logs = 'À ban le joueur :'.$_POST['pseudo'];
					$logsql->execute([$logs, $jr->name, date('d-m-Y H:i:s')]);
					header('Location: bann');
					exit();
				}
			}
		}
	}
}

if(isset($_GET['sup'])){
	$id = happySecu($_GET['sup']);
	$sql = $bdd->prepare("SELECT * FROM news where id = ?");
	$sql->execute(array($id));
	if($sql->rowCount() < 1){
				echo '<script>alert("Erreur");</script>';
	} else{
		$sql = $bdd->query("UPDATE news SET supprimer = 1 where id = '".$id."'");
		$logsql = $bdd->prepare("INSERT INTO logs(logs,par,dates) values(?,?,?)");
		$logsql->execute(array("À supprimé un article",$jr->name,date('d-m-Y H:i:s')));
				echo '<script>alert("Ok");</script>';
	}
}

if(isset($_GET['dedi'])){
	$dedi = happySecu($_GET['dedi']);
	$sql = $bdd->prepare("SELECT * FROM dedi where id = ? and verif = 0");
	$sql->execute(array($dedi));
	if($sql->rowCount() < 1){
				echo '<script>alert("Erreur");</script>';
	} else{
		$sql = $bdd->query("UPDATE dedi SET verif = 1 where id = '".$dedi."'");
		$logsql = $bdd->prepare("INSERT INTO logs(logs,par,dates) values(?,?,?)");
		$logsql->execute(array("À confirmé une dédicace",$jr->name,date('d-m-Y H:i:s')));
				echo '<script>alert("Ok");</script>';
	}
}

if(isset($_GET['do'])){
	if(happySecu($_GET['do']) == "add"){
		if(isset($_POST['pseudoadd']) || isset($_POST['mdpadd'])){
			$pseudo = happySecu($_POST['pseudoadd']);
			$mdp = HashPassword($_POST['mdpadd']);
			if(empty($pseudo) || empty($mdp)){
				echo '<script>alert("Erreur");</script>';
			} else{
				$sql = $bdd->prepare("SELECT * FROM members where name = ?");
				$sql->execute(array($pseudo));
				if($sql->rowCount() > 0){
				echo '<script>alert("Erreur");</script>';
 				} else{
					$sql = $bdd->prepare("INSERT INTO members(name,password,rang) values (?,?,?)");
					$logsql = $bdd->prepare("INSERT INTO logs(logs,par,dates) values(?,?,?)");
					$logsql->execute(array("À ajouté un membre",$jr->name,date('d-m-Y H:i:s')));
					$sql->execute(array($pseudo,$mdp,1));
				echo '<script>alert("Ok");</script>';
				}
			}
		}
	}
}

if(isset($_GET['supmember'])){
	if(happySecu($_GET['supmember']) == "ok"){
		if($jr->rang > 3){
			if(isset($_POST['membersup'])){
				$name = happySecu($_POST['membersup']);
				if(empty($_POST['membersup'])){
				echo '<script>alert("Erreur");</script>';
				} else{
					$sql = $bdd->prepare("SELECT * FROM members WHERE name = ?");
					$sql->execute(array($name));
					if($sql->rowCount() < 1){
				echo '<script>alert("Erreur");</script>';
					} else{
						$logsql = $bdd->prepare("INSERT INTO logs(logs,par,dates) values(?,?,?)");
						$logsql->execute(array("À supprimé un membre",$jr->name,1));
						$sql = $bdd->prepare("DELETE FROM members where name = ?");
						$sql->execute(array($name));
				echo '<script>alert("Ok");</script>';
					}
				}
			}
		} else{
				echo '<script>alert("Erreur");</script>';
		}
	}
}

if(isset($_GET['do'])){
	if(happySecu($_GET['do']) == "namemodif"){
		if(isset($_POST['namemodif'])){
			if(empty($_POST['namemodif'])){
				echo '<script>alert("Erreur");</script>';
			} else{
				$logsql = $bdd->prepare("INSERT INTO logs(logs,par,dates) values(?,?,?)");
				$logsql->execute(array("À changé le pseudo de ".$_POST['name']."",$jr->name,date('d-m-Y H:i:s')));
				$sql = $bdd->prepare("UPDATE members set name = ? where name = ?");
				$sql->execute(array(happySecu($_POST['namemodif']), happySecu($_POST['name'])));
				echo '<script>alert("Ok");</script>';
			}
		}
	}
}

if(isset($_GET['do'])){
	if(happySecu($_GET['do']) == "certifmodif"){
		if(isset($_POST['certifmodif'])){
				$logsql = $bdd->prepare("INSERT INTO logs(logs,par,dates) values(?,?,?)");
				$logsql->execute(array("À changé la certification de ".$_POST['name'].", il passe à la certification ".$_POST['certifmodif']."",$jr->name,date('d-m-Y H:i:s')));
				$sql = $bdd->prepare("UPDATE members set certif = ? where name = ?");
				$sql->execute(array(happySecu($_POST['certifmodif']), happySecu($_POST['name'])));
				echo '<script>alert("Certification changé !");</script>';

		}
	}
}

if(isset($_GET['do'])){
	if(happySecu($_GET['do']) == "addpoints"){
		if(isset($_POST['pseudo']) AND isset($_POST['points'])){
			if($_POST['pseudo'] == $_SESSION['username'] AND $jr->rang <= 7){
				$erreur = "<script type='text/javascript'>sweetAlert('Oops...', 'Tu ne peux pas donner de points à toi-même.', 'error')</script>";
			}else{
			  $sqlpoints = $bdd->prepare("UPDATE members SET activ_p_s = activ_p_s + :numbers WHERE name = :pseudo");
			  $sqlpoints->execute(["numbers" => $_POST['points'], "pseudo" => $_POST['pseudo']]);
			  header("Location: points.php");
			  exit();
		  }
		}
	}
}

if(isset($_GET['do'])){
  if(happySecu($_GET['do']) == "partners-add"){
    if(isset($_POST['orga-name']) && isset($_POST['orga-descp']) && isset($_POST['orga-plateform']) && isset($_POST['orga-banner']) && isset($_POST['orga-little']) && isset($_POST['orga-color']) && isset($_POST['orga-valid'])){
	  if(strlen($_POST['orga-color']) <= 6){
		$sqlpartners = $bdd->prepare("INSERT INTO partners(name,link,img,img_little,color,descp,valid) VALUES(?,?,?,?,?,?,?)");
		$sqlpartners->execute([happySecu($_POST['orga-name']), happySecu($_POST['orga-plateform']), happySecu($_POST['orga-banner']), happySecu($_POST['orga-little']), happySecu($_POST['orga-color']), happySecu($_POST['orga-descp']), happySecu($_POST['orga-valid'])]);
		if($_POST['orga-valid'] == 1){
			header('Location: ' . citywishBaseUrl() . 'partners');
			exit();
		}else{
			header("Location: partners");
			exit();
		}
	  }else{
		  echo "<script type='text/javascript'>alert('Le code couleur est trop grand. Le code doit contenir au maximum 6 caractères.');</script>";
	  }
	}else{
		echo "<script type='text/javascript'>alert('Tout les champs doivent être remplis.');</script>";
	} 
  }
}
?>
