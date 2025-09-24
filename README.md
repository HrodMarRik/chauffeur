# Projet Symfony avec Docker

Ce projet Symfony est configuré pour fonctionner avec Docker.

## Prérequis

- Docker
- Docker Compose

## Installation

1. Cloner le repository
2. Construire et démarrer les conteneurs :
```bash
docker-compose up --build
```

## Accès

- Application : http://localhost:8000
- Base de données MySQL : localhost:3306
  - Utilisateur : symfony
  - Mot de passe : symfony
  - Base de données : symfony

## Commandes utiles

```bash
# Démarrer les services
docker-compose up -d

# Arrêter les services
docker-compose down

# Voir les logs
docker-compose logs -f

# Accéder au conteneur web
docker-compose exec web bash

# Exécuter des commandes Symfony
docker-compose exec web php bin/console cache:clear
```

## Structure du projet

- `Dockerfile` : Configuration du conteneur PHP/Apache
- `docker-compose.yml` : Configuration des services
- `docker/apache/000-default.conf` : Configuration Apache
