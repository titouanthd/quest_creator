- [Quest Creator](#quest-creator)
  - [Histoire](#histoire)
  - [Stack](#stack)
  - [Idées du projet](#idées-du-projet)
    - [Chat GPT](#chat-gpt)
    - [MidJourney](#midjourney)
  - [Installation](#installation)
  - [Des questions ?](#des-questions-)
  - [Documentation](#documentation)
  - [Contribution](#contribution)
  - [Aidez le projet](#aidez-le-projet)
    - [Donation](#donation)
    - [Une idée ? Une question ? Un bug ? Un suggestion ?](#une-idée--une-question--un-bug--un-suggestion-)
  - [Merci](#merci)
    - [Introduction](#introduction)
    - [Contributeurs](#contributeurs)
  - [Licence](#licence)

# Quest Creator

Le projet Quest Creator est une application web / un outil en ligne qui permet à ses utilisateurs de créer des quêtes personnalisées pour les jeux de rôle. Cette application fournit des fonctionnalités pour créer des scénarios, des objectifs, des récompenses, des ennemis, des personnages non-joueurs et des environnements de jeu pour les joueurs. Les utilisateurs peuvent également partager leurs quêtes créées avec d'autres joueurs ou les intégrer à leurs propres jeux de rôle. En somme, Quest Creator aide les joueurs à personnaliser et à enrichir leur expérience de jeu en leur permettant de créer des quêtes uniques et adaptées à leur propre monde de jeu.

## Histoire

Bonjour, je suis Titouan, un développeur web full-stack passionné et autodidacte. Je diffuse en direct sur Twitch et je suis actuellement en train de développer un projet qui vise à créer un outil en ligne pour créer des quêtes pour les jeux de rôles. L'idée a été trouvée par Lothereus et ma communauté que j'ai sur Twitch. Je suis actuellement en train de développer le projet en live sur Twitch. Si vous voulez voir le projet en action, vous pouvez me suivre sur Twitch et me poser des questions sur le projet.

## Stack

- [PHP](https://www.php.net) >= 8.1.0
- [Symfony](https://symfony.com) >= 5.4
- [PostgreSQL](https://www.postgresql.org) >= 13.4
- [Tailwindcss](https://tailwindcss.com) >= 2.2.19
- [Chat GPT](https://openai.com/blog/chatgpt)
- [MidJourney](https://www.midjourney.com/)
- ...

## Idées du projet

### Chat GPT

  1. Génération de quete
  2. Génération de PNJ
  3. Génération de monstre
  4. Génération de donjon
  5. Génération de carte
  6. Génération de monde
  7. Génération de quête

### MidJourney

  1. Pour générer des avatars pour les personnages (Player/NPC)
  2. Pour générer les images des items/batiments...

- Mettre en place un service de génération procédurale de carte
  1. Prend en comtpe des biomes
  2. Des points d'înterets (ville, village, donjon...)
  3. Prend en compte des ressources (chasse, récolte)
A completer ...

## Installation

1. Cloner le repo avec `git clone https://github.com/titouanthd/quest_creator.git`
2. Installer les dépendances avec `composer install`
3. Créer un fichier `.env.local` à la racine du projet et y ajouter les variables d'environnement.
4. Créer la base de données avec `php bin/console doctrine:database:create`
5. Créer les tables avec `php bin/console doctrine:migrations:migrate`
6. Lancer le serveur avec `symfony serve`

## Des questions ?

- [Discord](https://discord.gg/wE6Ggh4N)
- [Twitch](https://www.twitch.tv/titouanthd)
- [github](https://github.com/titouanthd/quest_creator/issues)

## Documentation

- [Symfony](https://symfony.com/doc/current/index.html)
- [Doctrine](https://www.doctrine-project.org/projects/doctrine-orm/en/2.9/index.html)
- [Twig](https://twig.symfony.com/doc/3.x/)
- [tailwindcss](https://tailwindcss.com/docs)
- [PostgreSQL](https://www.postgresql.org/docs/13/index.html)

## Contribution

Si vous êtes intéressé pour contribuer au projet Quest Creator, voici quelques étapes pour commencer :

1. Forker le repo sur votre compte GitHub.
2. Clonez votre [fork](https://github.com/titouanthd/quest_creator/fork) sur votre machine locale.
3. Installez les dépendances avec `composer install`.
4. Créez une branche pour votre modification avec `git checkout -b  feature/ma-fonctionnalite`.
5. Faites vos modifications et testez-les localement.
6. Commitez vos modifications avec un message clair et explicite.
7. Poussez vos modifications sur votre fork avec `git push origin feature/ma-fonctionnalite`.
8. Créez une pull request vers le repo original.
9. Attendez que votre [pull request](https://github.com/titouanthd/quest_creator/pulls?q=is%3Apr) soit examinée et acceptée.
10. [Merci](#merci) !

## Aidez le projet

Nous sommes toujours à la recherche de personnes pour nous aider à améliorer le projet Quest Creator. Voici quelques façons dont vous pouvez aider :

* **Contribuer du code** : nous sommes toujours à la recherche de personnes pour [contribuer](#contribution) du code au projet.
* **Signaler des bugs** : si vous trouvez un bug dans le projet, veuillez nous en informer en créant une issue sur [github](https://github.com/titouanthd/quest_creator/issues).
* **Proposer des idées** : si vous avez des idées pour améliorer le projet, veuillez les partager avec nous sur [github](https://github.com/titouanthd/quest_creator/issues).
* **Participer à la documentation** : si vous êtes bon en rédaction technique, vous pouvez nous aider à améliorer la documentation du projet.
* **Faire des dons** : si vous voulez nous aider financièrement, vous pouvez faire un don (prochainement disponible).

### Donation

Ce projet utilise Inteligence artificiel du CHAT GPT pour générer des quêtes, des PNJ, des monstres, des donjons, des cartes, des mondes, des quêtes. Cette utilisation est payante et vous pouvez aider le projet en faisant un don. Pour que ce projet soit gratuit pour tout le monde, je vous demande de faire un don pour aider le projet à payer les frais de l'IA du CHAT GPT, hebergement, etc...
Tout donation sera integralement reversé au projet.

### Une idée ? Une question ? Un bug ? Un suggestion ?

Si vous avez une idée, une question, un bug ou une suggestion, n'hésitez pas à nous contacter sur notre [Discord](https://discord.gg/wE6Ggh4N) ou à [créer une issue](https://github.com/titouanthd/quest_creator/issues) sur GitHub.

Vous pouvez introduire une issue sur [github](https://github.com/titouanthd/quest_creator/issues)

## Merci

### Introduction

Nous tenons à remercier [tous ceux qui ont contribué](#contributeurs) au projet Quest Creator, que ce soit en contribuant du code, en signalant des bugs, en proposant des idées ou en faisant des dons. Votre soutien est très apprécié et nous permet de continuer à améliorer le projet pour offrir une meilleure expérience de jeu aux joueurs de jeux de rôles.

### Contributeurs

Pseydonyme |  Merci pour :
---------|----------
 Le codageur | Le soutien moralement et bonne ambiance
 @[Lothereus](https://github.com/lothereus) | Avoir trouver l'idée du projet et pour son soutien
 @[Twidi](https://github.com/Twidi) | Le financement
 @[ZarTek-Creole](https://github.com/ZarTek-Creole) | Les conseils, sa patience et son soutien general.
 ANDREWDIGITAL | La DA et le logo du projet
 root9131 | Être le stagiaire toujours la pour le café et le soutien
 @[raynhcoding](https://www.twitch.tv/raynhcoding) | Le travail Front-End (tailwind)
 @[synnv](https://www.twitch.tv/synnv) | Pour son experience et ses conseils
 

## Licence

Quest Creator est un projet open source sous licence [Apache 2.0](https://www.apache.org/licenses/LICENSE-2.0).
