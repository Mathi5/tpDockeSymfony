# Projet Symfony avec Docker

Ce projet utilise Docker et Docker Compose pour orchestrer le déploiement d'une application Symfony avec une base de données MySQL.

## Composants

Le projet comprend deux services principaux :

- `tp-db`: Un service de base de données MySQL configuré avec un utilisateur personnalisé, un mot de passe et une base de données spécifique.
- `tp-symfony`: Le service d'application Symfony qui s'exécute sur un serveur web Apache avec PHP 8.2, avec des dépendances comme Composer et Node.js installées.

## Prérequis

Avant de démarrer, assurez-vous d'avoir Docker et Docker Compose installés sur votre machine.

## Démarrage rapide

1. **Cloner le projet**

   Clonez ce dépôt sur votre machine locale.

   2. **Construire et démarrer les services**

      Dans le répertoire racine du projet, exécutez la commande suivante pour construire et démarrer les services en arrière-plan (Peut prendre un certain temps pour la première exécution) :

      ```sh
      docker-compose up -d
       ```

3. **Accéder à l'application**

    Une fois que les services sont démarrés, vous pouvez accéder à l'application Symfony via http://localhost:8080 dans votre navigateur.

    Configuration

    - Les détails de la base de données MySQL sont définis dans le service tp-db du fichier docker-compose.yml. 
   
    - L'application Symfony est configurée pour se connecter à cette base de données via la variable d'environnement DATABASE_URL définie dans le service tp-symfony.