<?php
require_once '../../bdd.php';

require_once '../../api.php';
$apiKey = citywishEnv('CITYWISH_API_KEY', CITYWISH_API_KEY);

$search = str_replace(' ', '', $_POST['value-search']);
$typeflux = intval($_POST['typeflux']);
$pole = intval(($_POST['pole']));
if (intval($_POST['dates']) === 0 && strpos($_POST['dates'], '/') === false) {
    $month = 0;
    $year = 0;
} else {
    $dates = explode('/', $_POST['dates']);
    $month = intval($dates[0]);
    $year = intval($dates[1]);
}

if($search !== ''){
    if ($typeflux === 0) {
        if ($pole === 0) {
            if ($month === 0) {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux']]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'year' => $year]);
                }
            } else {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND month = :month ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'month' => $month]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND month = :month AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'month' => $month, 'year' => $year]);
                }
            }
        } else {
            if ($month === 0) {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND pole = :pole ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'pole' => $pole]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND pole = :pole AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'pole' => $pole, 'year' => $year]);
                }
            } else {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND pole = :pole AND month = :month ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'pole' => $pole, 'month' => $month]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND pole = :pole AND month = :month AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'pole' => $pole, 'month' => $month, 'year' => $year]);
                }
            } 
        }
    } else {
        if ($pole === 0) {
            if ($month === 0) {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND in_out = :inout ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'inout' => $typeflux]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND in_out = :inout AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'inout' => $typeflux, 'year' => $year]);
                }
            } else {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND in_out = :inout AND month = :month ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'inout' => $typeflux, 'month' => $month]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND in_out = :inout AND month = :month AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'inout' => $typeflux, 'month' => $month, 'year' => $year]);
                }
            }
        } else {
            if ($month === 0) {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND in_out = :inout AND pole = :pole ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'inout' => $typeflux, 'pole' => $pole]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND in_out = :inout AND pole = :pole AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'inout' => $typeflux, 'pole' => $pole, 'year' => $year]);
                }
            } else {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND in_out = :inout AND pole = :pole AND month = :month ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'inout' => $typeflux, 'pole' => $pole, 'month' => $month]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE pseudo LIKE :search AND cw_hc = :hccw AND in_out = :inout AND pole = :pole AND month = :month AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['search' => $search.'%', 'hccw' => $_GET['flux'], 'inout' => $typeflux, 'pole' => $pole, 'month' => $month, 'year' => $year]);
                }
            }
        }
    }
} else {
    if ($typeflux === 0) {
        if ($pole === 0) {
            if ($month === 0) {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux']]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'year' => $year]);
                }
            } else {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND month = :month ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'month' => $month]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND month = :month AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'month' => $month, 'year' => $year]);
                }
            }
        } else {
            if ($month === 0) {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND pole = :pole ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'pole' => $pole]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND pole = :pole AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'pole' => $pole, 'year' => $year]);
                }
            } else {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND pole = :pole AND month = :month ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'pole' => $pole, 'month' => $month]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND pole = :pole AND month = :month AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'pole' => $pole, 'month' => $month, 'year' => $year]);
                }
            }
        }
    } else {
        if ($pole === 0){
            if ($month === 0) {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND in_out = :inout ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'inout' => $typeflux]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND in_out = :inout AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'inout' => $typeflux, 'year' => $year]);
                }
            } else {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND in_out = :inout AND month = :month ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'inout' => $typeflux, 'month' => $month]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND in_out = :inout AND month = :month AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'inout' => $typeflux, 'month' => $month, 'year' => $year]);
                }
            }
        } else {
            if ($month === 0) {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND in_out = :inout AND pole = :pole ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'inout' => $typeflux, 'pole' => $pole]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND in_out = :inout AND pole = :pole AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'inout' => $typeflux, 'pole' => $pole, 'year' => $year]);
                }
            } else {
                if ($year === 0) {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND in_out = :inout AND pole = :pole AND month = :month ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'inout' => $typeflux, 'pole' => $pole, 'month' => $month]);
                } else {
                    $likesql = $bdd->prepare('SELECT id,pseudo,cw_hc,poste,newposte,in_out,month,year FROM flux WHERE cw_hc = :hccw AND in_out = :inout AND pole = :pole AND month = :month AND year = :year ORDER BY year DESC, month DESC, id DESC LIMIT 32');
                    $likesql->execute(['hccw' => $_GET['flux'], 'inout' => $typeflux, 'pole' => $pole, 'month' => $month, 'year' => $year]);
                }
            }
        }
    }
}

if($likesql->rowCount() > 0) {
    /*if ($likesql->fetch(PDO::FETCH_OBJ)->uniqueId != '') {
        $occurence = new ApiHabboCity($likesql->fetch(PDO::FETCH_OBJ)->pseudo, $apiKey);
        if ($occurence->getErreur() == null || $occurence->getErreur() === 'Utilisateur introuvable') {
            $occurence = new ApiHabboCity($likesql->fetch(PDO::FETCH_OBJ)->uniqueId, $apiKey);
            $pseudo = $occurence->getName();
        } else {
            $pseudo = $likesql->fetch(PDO::FETCH_OBJ)->pseudo;
        }
    } else {
        $pseudo = $likesql->fetch(PDO::FETCH_OBJ)->pseudo;
    }*/
    echo json_encode(['correct' => true, 'response' => $likesql->fetchAll(PDO::FETCH_OBJ)]);
    exit();
} else {
    echo json_encode(['correct' => false, 'response' => 'Aucun staff trouvé.']);
    exit();
}
?>