# CityWish

CityWish est une application PHP/MySQL consacrée à la communauté HabboCity :
actualité, profils, votes, dédicaces, concours, flux communautaire et outils
d’administration.

> **État du projet** : cette version est une base historique en cours de
> nettoyage. Les contenus et bibliothèques présents dans l’arborescence n’ont
> pas encore tous été vérifiés pour leur licence ou leur caractère publiable.

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
| `admin/` | Administration originale, terminée et actuellement fonctionnelle, utilisant `admin/inc/data.php` |
| `administration/` | V2 d’administration issue d’un autre dépôt, incomplète à l’origine et adaptée ici en version simplifiée et fonctionnelle temporaire |
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
- un accès à l’API HabboCity si les fonctionnalités d’avatar sont activées ;
- un compte Discord et un webhook si les notifications sont activées.

Le schéma MySQL n’est pas fourni dans cette arborescence. Il faut donc
exporter/importer séparément la base de données de l’instance d’origine, après
avoir supprimé les données personnelles et les contenus non redistribuables.

## Installation locale

1. Servir la racine du projet avec Apache et activer `AllowOverride` pour que
   `.htaccess` soit pris en compte.
2. Créer une base MySQL vide et importer un schéma de développement.
3. Définir les variables d’environnement listées dans `.env.example`.
4. Remplacer les URLs de production dans `.htaccess`, `inc/core.php` et les
   templates si l’application est utilisée sous un autre domaine.
5. Ouvrir `index.php`, puis vérifier les appels AJAX, la connexion et les
   pages d’administration.

La configuration est centralisée dans `inc/config.php`. Elle ne contient plus
de secret par défaut : les valeurs sensibles sont lues depuis l’environnement.
Les variables principales sont `CITYWISH_DB_PASS`, `CITYWISH_API_KEY`,
`CITYWISH_ADMIN_DISCORD_WEBHOOK` et `CITYWISH_GIVEAWAY_DISCORD_WEBHOOK`.

## Audit de publication

La première passe est volontairement un audit : aucun upload, log, asset ou
fichier suspect n’est supprimé automatiquement.

- `admin/uploads/`, `uploads/` et les images sous `assets/` peuvent contenir
  des données personnelles, des contenus soumis au droit d’auteur ou des
  exports historiques ; ils doivent être triés avant publication.
- `administration/log/`, `avatar/log/`, `log/` et les fichiers `Thumbs.db`
  sont des artefacts générés ou potentiellement privés.
- `.idea/` contient des métadonnées locales de l’IDE.
- `admin/` est l’administration originale, terminée et fonctionnelle : elle
  doit être conservée comme référence lors de tout nettoyage.
- `administration/` provient d’un autre dépôt et sa V2 n’était pas terminée ;
  la version présente dans ce projet est une implémentation simplifiée et
  fonctionnelle mise en place temporairement. Elle ne doit pas être supprimée
  ou fusionnée avec `admin/` sans comparaison fonctionnalité par fonctionnalité.
- `avatar/` n’est pas un simple dossier d’assets : c’est un gestionnaire
  applicatif d’images d’avatar qui protège le site contre les indisponibilités
  et erreurs de l’API HabboCity.
- Les bibliothèques embarquées (`jQuery`, `jQuery UI`, TinyMCE, Bootstrap,
  Select2, Font Awesome, etc.) doivent conserver leurs fichiers de licence et
  être vérifiées individuellement.
- Les identifiants précédemment présents dans les fichiers de configuration
  doivent être considérés comme compromis : mots de passe SQL, clés API et
  webhooks Discord doivent être révoqués et régénérés.

## Limites connues

Le projet ne possède pas encore de gestionnaire de dépendances PHP, de suite
de tests ou de pipeline CI. Une partie du code est historique et mélange
présentation, accès aux données et logique métier. Les données, URLs et noms
de domaine de production doivent être remplacés avant une installation
publique.

## Licence et contributions

Le code est destiné à être publié sous GNU GPLv3, conformément au fichier
`LICENSE`. Cette licence ne couvre pas automatiquement les images, textes,
polices, bibliothèques tierces, marques ou données de la communauté. Chaque
élément doit être conservé uniquement si sa licence autorise la redistribution.

Avant toute publication, vérifier l’absence de secrets, logs, exports de base,
comptes utilisateurs et médias non redistribuables. Les contributions doivent
indiquer clairement les changements de configuration et les dépendances
ajoutées.
