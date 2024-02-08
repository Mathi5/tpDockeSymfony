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

    
## Déploiement avec Docker Swarm

1. Cree un image pour docker swarm :

    ```bash
    docker build -t swarmweb .  
   ```

2. **Initialisez Docker Swarm** : Vous devez initialiser Docker Swarm sur la machine qui agira en tant que nœud de gestion. Vous pouvez le faire en utilisant la commande suivante :

    ```bash
    docker swarm init
    ```

3. **Déployez la pile** : Après avoir initialisé Docker Swarm, vous pouvez déployer votre application en utilisant la commande suivante :

    ```bash
    docker stack deploy --compose-file docker-compose-swarm.yml TpFinalDocker
    ```

   `TpFinalDocker` est le nom de la pile. Vous pouvez le remplacer par n'importe quel nom que vous préférez.

4. **Vérifiez le déploiement** : Vous pouvez vérifier l'état de votre déploiement en utilisant la commande suivante :

    ```bash
    docker stack services TpFinalDocker
    ```

   Cette commande affiche une liste de tous les services dans votre pile avec leur état actuel.

5. **Accédez à votre application** : Une fois que tous les services sont en état de marche, vous pouvez accéder à votre application en utilisant l'adresse IP de votre nœud de gestion Docker Swarm et le port que vous avez spécifié dans votre fichier Docker Compose. Par exemple, si vous avez spécifié le port 8080 pour le service de votre application web, vous pouvez accéder à votre application en naviguant vers `http://<ip-du-noeud-de-gestion>:8080` dans votre navigateur web.

