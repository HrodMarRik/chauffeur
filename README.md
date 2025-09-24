# 🚗 Projet Chauffeur

Application Symfony pour la gestion de chauffeurs avec Docker.

## 🚀 Démarrage rapide

### Développement avec hot-reload

```bash
# Démarrer l'environnement de développement
./dev.sh start

# Accéder à l'application
open http://localhost:8000
```

### Commandes disponibles

```bash
./dev.sh start    # Démarrer l'environnement
./dev.sh stop     # Arrêter l'environnement  
./dev.sh restart  # Redémarrer l'environnement
./dev.sh logs     # Voir les logs
./dev.sh shell    # Accéder au shell du conteneur
./dev.sh status   # Voir le statut des conteneurs
```

## 🛠️ Technologies

- **Symfony 6.4** - Framework PHP
- **Docker** - Containerisation
- **MySQL 8.0** - Base de données
- **Twig** - Moteur de templates

## 📁 Structure

```
├── src/Controller/     # Contrôleurs Symfony
├── templates/          # Templates Twig
├── docker/            # Configuration Docker
├── config/            # Configuration Symfony
├── public/            # Fichiers publics
└── dev.sh            # Script de développement
```

## 🔧 Développement

L'environnement de développement utilise des volumes Docker pour synchroniser vos modifications de code en temps réel. Aucun rebuild nécessaire !

## 🚀 Production

```bash
# Construire l'image de production
docker build -t chauffeur-prod .

# Lancer avec docker-compose
docker-compose -f docker-compose.prod.yml up -d
```
