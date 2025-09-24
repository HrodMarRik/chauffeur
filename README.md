# Projet Chauffeur avec Symfony et Docker

Ce projet Symfony est configuré pour fonctionner avec Docker et est connecté à GitHub avec l'intégration continue.

## 🚀 Fonctionnalités

- **Symfony 6.4.25** avec PHP 8.1
- **Docker** et **Docker Compose** pour le développement et la production
- **MySQL 8.0** comme base de données
- **GitHub Actions** pour l'intégration continue
- **Apache** comme serveur web
- **Doctrine ORM** pour la gestion de la base de données

## 📋 Prérequis

- Docker
- Docker Compose
- Git

## 🛠️ Installation

### Développement

1. Cloner le repository :
```bash
git clone https://github.com/HrodMarRik/chauffeur.git
cd chauffeur
```

2. Construire et démarrer les conteneurs :
```bash
docker-compose up --build
```

### Production

```bash
docker-compose -f docker-compose.prod.yml up --build -d
```

## 🌐 Accès

- **Application** : http://localhost:8000
- **Page de test BD** : http://localhost:8000/products
- **Base de données MySQL** : localhost:3307
  - Utilisateur : `symfony`
  - Mot de passe : `symfony`
  - Base de données : `symfony`

## 📝 Commandes utiles

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
docker-compose exec web php bin/console doctrine:migrations:migrate

# Créer une nouvelle entité
docker-compose exec web php bin/console make:entity NomEntite

# Créer une migration
docker-compose exec web php bin/console make:migration
```

## 🏗️ Structure du projet

```
chauffeur/
├── .github/workflows/     # GitHub Actions CI/CD
├── docker/               # Configuration Docker
│   └── apache/
├── src/                  # Code source Symfony
│   ├── Controller/       # Contrôleurs
│   ├── Entity/          # Entités Doctrine
│   └── Repository/      # Repositories
├── templates/            # Templates Twig
├── migrations/           # Migrations Doctrine
├── public/               # Point d'entrée web
├── config/               # Configuration Symfony
├── Dockerfile            # Image Docker
├── docker-compose.yml    # Services de développement
├── docker-compose.prod.yml # Services de production
└── README.md
```

## 🔧 Configuration

### Variables d'environnement

Le fichier `.env` contient la configuration de base de données :

```env
DATABASE_URL="mysql://symfony:symfony@127.0.0.1:3307/symfony?serverVersion=8.0.32&charset=utf8mb4"
APP_ENV=dev
APP_DEBUG=1
```

### Base de données

Pour créer la base de données et exécuter les migrations :

```bash
docker-compose exec web php bin/console doctrine:database:create
docker-compose exec web php bin/console doctrine:migrations:migrate
```

## 🚀 Déploiement

Le projet est configuré avec GitHub Actions pour l'intégration continue. Chaque push sur la branche `main` déclenche :

1. Tests PHP
2. Construction de l'image Docker
3. Tests de l'image Docker

## 📚 Documentation

- [Documentation Symfony](https://symfony.com/doc/6.4/index.html)
- [Documentation Docker](https://docs.docker.com/)
- [Documentation GitHub Actions](https://docs.github.com/en/actions)
- [Documentation Doctrine](https://www.doctrine-project.org/projects/doctrine-orm/en/current/index.html)

## 🤝 Contribution

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👨‍💻 Auteur

**HrodMarRik** - [GitHub](https://github.com/HrodMarRik)
