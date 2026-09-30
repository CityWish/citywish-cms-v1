<!-- Side-Nav-->
      <aside class="main-sidebar hidden-print">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image"><img class="img-circle" src="https://avatar.citywish.fr/?username=<?= $jr->name;?>&headonly=1&direction=2&head_direction=2&size=l" alt="Photo de profil"></div>
            <div class="pull-left info">
              <p><?= $jr->name;?></p>
              <p class="designation"><?= html_entity_decode($jr->fonction);?></p>
            </div>
          </div>
          <!-- Sidebar Menu-->
          <ul class="sidebar-menu">
            <li <?php if ($nav_en_cours == 'Accueil') {echo ' class="active"';} ?> class="nav">
              <a href="index"><i class="fa fa-dashboard"></i><span>Accueil</span></a>
            </li>
            <?php if(isset($_SESSION['username'])){
              $sql = $bdd->prepare('SELECT id FROM members_perms WHERE id_member = ?');
              $sql->execute([$jr->id]);
              if($sql->rowCount() !== 0) {
            ?>
            <li class="nav">
              <a href="https://citywish.fr/administration/"><i class="fa fa-dashboard"></i><span>Nouvelle administration</span></a>
            </li>
            <?php  } } ?>
            <?php if(isset($_SESSION['username'])){ if($jr->rang >= 10 OR $jr->fonction === 'Resp. R&amp;eacute;daction'){ ?>
            <li class="treeview"><a href="#"><i class="fa fa-crown"></i><span>Fondation & Gestion</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./logs.php"><i class="fa fa-circle-o"></i> Logs</a></li>
                <?php if($jr->fonction === 'Resp. R&amp;eacute;daction' OR $jr->rang >= 9) { ?>
                <li><a href="./valid.php"><i class="fa fa-circle-o"></i> Valider un article</a></li>
                <?php } ?>
                <?php if($jr->rang >= 9){?>
                <li><a href="./supp.php"><i class="fa fa-circle-o"></i> Supprimer un article</a></li>
                <li><a href="./members.php"><i class="fa fa-circle-o"></i> Information membre</a></li>
                <?php }?>
              </ul>
            </li>
            <?php } } ?>

            <?php if(isset($_SESSION['username'])){ if($jr->rang >= 8){ ?>
            <li class="treeview"><a href="#"><i class="fa fa-laptop"></i><span>Administration</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./rank.php"><i class="fa fa-circle-o"></i> Rank un joueur</a></li>
                <?php if($jr->rang >= 9){?>
                <li><a href="./bann.php"><i class="fa fa-circle-o"></i>Bannir un joueur</a></li>
                <?php }?>
              </ul>
            </li>
            <?php } } ?>

            <?php if(isset($_SESSION['username'])){ if($jr->rang > 6) { ?>
            <li class="treeview"><a href="#"><i class="fa fa-th-list"></i><span>Rédaction</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./liste.php"><i class="fa fa-circle-o"></i> Tous les articles</a></li>
                <li><a href="./creer.php"><i class="fa fa-circle-o"></i> Créer un article</a></li>
               <!--<li><a href="./modif.php"><i class="fa fa-circle-o"></i> Modifier un article</a></li>-->
              </ul>
            </li>
            <?php } } ?>

            <?php if(isset($_SESSION['username'])){ if($jr->rang >= 9){ ?>
            <li class="treeview"><a href="#"><i class="fa fa-file-text"></i><span>Modération</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./dediliste.php"><i class="fa fa-circle-o"></i>Supprimer dédicace</a></li>
              </ul>
            </li>
            <?php } } ?>

            <?php if(isset($_SESSION['username'])){ if($jr->rang > 6){ ?>
            <li class="treeview"><a href="#"><i class="fa fa-laptop"></i><span>Animation</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./classement.php"><i class="fa fa-circle-o"></i> Classement</a></li>
                <li><a href="./points.php"><i class="fa fa-circle-o"></i> Donner des points</a></li>
              </ul>
            </li>
            <?php } } ?>

            <?php if(isset($_SESSION['username'])){ if($jr->rang > 6){ ?>
            <li class="treeview"><a href="#"><span>Autres</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./select.php"><i class="fa fa-circle-o"></i> Upload</a></li>
                <li><a href="./listimg.php"><i class="fa fa-circle-o"></i> Liste des uploads</a></li>
              </ul>
            </li>
            <?php } } ?>
          </ul>
        </section>
      </aside>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-dashboard"></i> Administration</h1>
            <p>Celle-ci est propulsée par une template</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="../index.php">Aller sur le site</a></li>
            </ul>
          </div>
        </div>
