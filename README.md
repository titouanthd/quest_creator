# Quest Creator

Le projet Quest Creator est une application web / un outil en ligne qui permet a ses utilisateurs de créer des quêtes personnalisées pour les jeux de rôles. Cette application fourni des fonctionnalités pour créer des scénarios, des objectifs, des récompenses, des ennemis, des personnages non-joueurs et des environnements de jeu pour les joueurs. Les utilisateurs peuvent également partager leurs quêtes créées avec d'autres joueurs, ou même les intégrer à leurs propres jeux de rôle. En somme, Quest Creator aide les joueurs à personnaliser et à enrichir leur expérience de jeu en leur permettant de créer des quêtes uniques et adaptées à leur propre monde de jeu.

## Auteurs

- [Titouan](https://www.twitch.tv/titouanthd)

## Histoire

Bonjour je suis Titouan et je suis un développeur web full-stack passionné et autodidacte.
Je stream sur Twitch et je suis actuellement en train de développer un projet qui à pour but de créer un outil en ligne pour créer des quêtes pour les jeux de rôles.
L'idée à été trouvé par Lothereus et ma communauté que j'ai sur Twitch, je suis actuellement en train de développer le projet en live sur Twitch, si vous voulez voir le projet en action, vous pouvez me suivre sur Twitch et me poser des questions sur le projet.

## Stack

- [PHP](https://www.php.net) >= 8.1.0
- [Symfony](https://symfony.com) >= 5.4
- [PostgreSQL](https://www.postgresql.org) >= 13.4

## Idées

- Utiliser Chat GPT pour:
  1. Génération de quete
  2. Génération de PNJ
  3. Génération de monstre
  4. Génération de donjon
  5. Génération de carte
  6. Génération de monde
  7. Génération de quête

## Life cycle

1. Création d'un univers
   -> il nous faut un nom, un slug, user_id, created_at, updated_at, areas, seed
2. Création des areas
   -> il nous faut un nom, un slug, user_id, biome, created_at, updated_at, universe_id, maps
3. Création des maps
   -> name, slug, x, y, user_id, area_id, created_at, updated_at

## Installation

1. Cloner le repo avec `git clone https://github.com/titouanthd/quest_creator.git`
2. Installer les dépendances avec `composer install`
3. Créer un fichier `.env.local` à la racine du projet et y ajouter les variables d'environnement.
4. Créer la base de données avec `php bin/console doctrine:database:create`
5. Créer les tables avec `php bin/console doctrine:migrations:migrate`
6. Lancer le serveur avec `symfony serve`

# Des questions ?

- [Discord](https://discord.gg/wE6Ggh4N)
- [Twitch](https://www.twitch.tv/titouanthd)
- [github](https://github.com/titouanthd/quest_creator/issues)

# Une idée ? Une question ? Un bug ? Un suggestion ?

Vous pouvez introduire une issue sur [github](https://github.com/titouanthd/quest_creator/issues)

## Documentation

- [Symfony](https://symfony.com/doc/current/index.html)
- [Doctrine](https://www.doctrine-project.org/projects/doctrine-orm/en/2.9/index.html)
- [Twig](https://twig.symfony.com/doc/3.x/)
- [Bootstrap](https://getbootstrap.com/docs/5.1/getting-started/introduction/)
- [PostgreSQL](https://www.postgresql.org/docs/13/index.html)

## Contribution

- Le codageur moralement et bonne ambiance <3
- @[Lothereus](https://github.com/lothereus) pour avoir trouver l'idée du projet et pour son soutien <3
- @[Twidi](https://github.com/Twidi) pour le financement <3
- @[ZarTek-Creole](https://github.com/ZarTek-Creole) pour sa patience et son soutien <3
- ANDREWDIGITAL pour la DA et le logo <3
- root9131 le stagiaire toujours la pour le café et le soutien <3

## Aidez le projet

Vous pouvez aider le [projet Quest Creator](https://github.com/titouanthd/quest_creator.git) en contribuant au code, en proposant des idées, en signalant des bugs.

## Merci

Merci à tous ceux qui ont contribué au projet, et à tous ceux qui l'utiliseront.
A tout mes followers sur Twitch, merci pour votre soutien, votre patience, vos encouragements, vos commentaires, vos idées, vos suggestions, vos questions, vos bugs, vos contributions, vos dons, vos partages, vos likes, vos messages sur Discord, vos messages sur Twitch, vos messages sur LinkedIn, vos messages sur Reddit, vos messages sur GitHub; et surtout, merci pour votre présence et votre bonne humeur.
A bientôt sur Twitch pour voir le projet en action.