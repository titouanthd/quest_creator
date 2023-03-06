### Quest Creator

Le projet Quest Creator est une application web / un outil en ligne qui permet a ses utilisateurs de créer des quêtes personnalisées pour les jeux de rôles. Cette application fourni des fonctionnalités pour créer des scénarios, des objectifs, des récompenses, des ennemis, des personnages non-joueurs et des environnements de jeu pour les joueurs. Les utilisateurs peuvent également partager leurs quêtes créées avec d'autres joueurs, ou même les intégrer à leurs propres jeux de rôle. En somme, Quest Creator aide les joueurs à personnaliser et à enrichir leur expérience de jeu en leur permettant de créer des quêtes uniques et adaptées à leur propre monde de jeu.

## Stack
- PHP >= 8.1.0
- Symfony >= 6.1
- PostgreSQL en prod (SQL lite en dev)

## Ideas
1. Chat GPT pour la génération des bio des PNJ & des quetes

## Life cycle
1. Création d'un univers
  -> il nous faut un nom, un slug, user_id, created_at, updated_at, areas, seed
2. Création des areas 
  -> il nous faut un nom, un slug, user_id, biome, created_at, updated_at, universe_id, maps
3. Création des maps
  -> name, slug, x, y, user_id, area_id, created_at, updated_at

## Installation

<!-- todo -->

## Contribution
- le codageur moralement et bonne ambiance ( en contribution )
- Lothereus pour avoir trouver l'idée
- @Twidi pour le financement
- @ZarTek-Creole pour sa patience.
- ANDREWDIGITAL pour la DA
- root9131 le stagiaire toujours la pour le café <3