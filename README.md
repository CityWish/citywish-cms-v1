# CityWish - CMS v1

CityWish est un ancien site de fan de HabboCity développé en PHP : actualité, profils, votes, dédicaces, concours, flux communautaire et
administration.

> **À savoir** : il s’agit d’une base de code historique, assez lourde,
> conservée comme un panier à codes. Le site fonctionne, mais ce dépôt n’est
> pas destiné à être utilisé tel quel. Vous pouvez vous en servir comme source
> d’idées, d’exemples ou de briques réutilisables.
>
> Plusieurs fonctionnalités dépendent d’un accès à l’API de HabboCity.
> 
> Certaines fonctionnalités dépendent ou sont liées à un bot Discord, qui n’est pas inclus dans ce dépôt.
> 
> La base de code historique a été a de nombreuses reprises mélangée avec des fonctionnalités développées pour de futures versions de ce projet.

Le projet a été développé par **Neal/Minao** puis remanié au fil des années par **Cold-FR**.

## Architecture

| Chemin | Rôle |
| --- | --- |
| `index.php`, `news.php`, `profil.php`, `vote.php`, etc. | Pages publiques et contrôleurs PHP sans framework |
| `inc/core.php` | Initialisation des sessions, configuration générale, utilisateur courant et fonctions partagées |
| `inc/bdd.php` | Connexion PDO à MySQL |
| `inc/api.php` | Client de l’API HabboCity |
| `inc/ajax/` | Endpoints AJAX pour les sessions, réglages, votes, flux, concours et outils |
| `inc/webhook/` | Client PHP pour les notifications Discord |
| `assets/templates/` | Fragments HTML communs du site public |
| `assets/style/`, `assets/js/`, `assets/imgs/` | CSS, JavaScript, polices et images du site public |
| `admin/` | Administration originale utilisant `admin/inc/data.php` |
| `administration/` | V2 d’administration issue d’un autre dépôt, adaptée ici en version simplifiée |
| `avatar/` | Gestionnaire du service d’images d’avatar, avec des garde-fous lorsque l’API HabboCity renvoie une erreur ou devient indisponible |
| `tools/` | Outils isolés, notamment la sauvegarde de looks |
| `.htaccess` | Réécriture des URLs, erreurs HTTP, cache et restrictions d’accès |

### Flux principaux

1. Une page publique charge `inc/core.php`, qui démarre la session, ouvre la
   connexion PDO et charge l’utilisateur courant.
2. Les pages et le JavaScript appellent les scripts de `inc/ajax/`.
3. Les contenus éditoriaux sont stockés dans MySQL puis rendus par les pages
   publiques et l’administration.
4. Le service `avatar/` interroge l’API HabboCity, génère les images demandées
   et applique des comportements de repli lorsque l’API ne répond pas
   correctement.
5. Les opérations d’administration de référence passent par `admin/`.
   `administration/` contient une V2 simplifiée conservée comme solution
   temporaire pour les fonctionnalités déjà adaptées.

## Prérequis

- PHP avec PDO MySQL et les extensions utilisées par l’installation cible ;
- MySQL ou MariaDB ;
- Apache avec `mod_rewrite`, `mod_headers`, `mod_expires` et `mod_deflate` ;
- un accès à l’API HabboCity (certaines fonctionnalités dépendent de cette API) ;

Le schéma MySQL est fourni dans [`database_schema.sql`](database_schema.sql).
Il s’agit d’un dump de structure sans données applicatives (`INSERT INTO`).

## Installation locale

1. Servir la racine du projet avec Apache et activer `AllowOverride` pour que
   `.htaccess` soit pris en compte.
2. Créer une base nommée `citywish` et importer le schéma :
   `mysql -u citywish -p citywish < database_schema.sql`.
3. Définir les variables d’environnement listées dans `.env.example`.
4. Remplacer les URLs de production dans `.htaccess`, `inc/core.php` et les
   templates si l’application est utilisée sous un autre domaine.
5. Ouvrir `index.php`, puis vérifier les appels AJAX, la connexion et les
   pages d’administration.

La configuration est centralisée dans `inc/config.php`. Les variables principales sont `CITYWISH_BASE_URL`, `CITYWISH_DB_HOST`, `CITYWISH_DB_NAME`,
`CITYWISH_DB_USER`, `CITYWISH_DB_PASS`, `CITYWISH_API_KEY`,
`CITYWISH_ADMIN_DISCORD_WEBHOOK` et `CITYWISH_GIVEAWAY_DISCORD_WEBHOOK`.
`CITYWISH_BASE_URL` permet d’adapter les URLs générées par l’application ; le
setup Docker le définit à `http://localhost:8080` afin que les assets locaux
ne soient pas chargés depuis le domaine de production.
`CITYWISH_COOKIE_DOMAIN` est optionnelle et permet de partager la session entre
plusieurs sous-domaines en production ; elle doit rester vide en local.

### Test rapide avec Docker

Docker Compose fournit une instance locale prête à démarrer avec PHP 8.3,
Apache et MySQL 8.4. Le fichier `database_schema.sql` est importé
automatiquement dans une base vide et les identifiants utilisés sont
volontairement locaux au conteneur.

```bash
docker compose up --build -d
curl -I http://localhost:8080/
docker compose logs web
```

Le site est ensuite disponible à l’adresse
[`http://localhost:8080/`](http://localhost:8080/). Pour arrêter et supprimer
les conteneurs :

```bash
docker compose down
```

Pour réinitialiser aussi la base de données et rejouer le dump SQL :

```bash
docker compose down -v
docker compose up --build -d
```

Cette configuration permet de vérifier le démarrage, le routage Apache, la connexion PDO
et le chargement des pages sans données métier. Les erreurs liées à l’absence
de comptes, d’articles, de clé API HabboCity ou de bot Discord sont
attendues dans ce mode de test.

### Correspondance du schéma

Le dump couvre les deux générations de l’administration et le site public :

- le site et `admin/` utilisent principalement `members`, `news`, `dedi`,
  `commentaires`, `flux`, `flux_webhook`, `partners`, `vote`, `view_article`,
  `banip`, `maintenance` et `logs` ;
- `administration/` utilise notamment `articles`, `articles_correct`,
  `articles_edit`, `members_perms`, `permissions`, `giveaways`,
  `giveaways_participants`, `members_figure`, `team_poles` et `team_staffs` ;
- `auth2factor`, `ranking_discord` et `statutvote` sont également présents pour
  les fonctionnalités spécialisées du code.

Le dump a été produit avec MySQL 8.4 et utilise notamment la collation
`utf8mb4_0900_ai_ci` sur certaines tables de la V2. MariaDB ou une version
plus ancienne de MySQL peut nécessiter le remplacement de cette collation par
une collation compatible avant import.

## Limites connues

Le projet n’a pas de gestionnaire de dépendances PHP, de suite de tests ni de
pipeline CI. Le code mélange parfois présentation, accès aux données et
logique métier. Remplacez les données, URLs et noms de domaine de production
avant toute installation publique.

## Licence et contributions

Le code est destiné à être publié sous GNU GPLv3, conformément au fichier
`LICENSE`. Cette licence ne couvre pas automatiquement les images, textes,
polices, bibliothèques tierces, marques ou données de la communauté. Chaque
élément doit être conservé uniquement si sa licence autorise la redistribution.
