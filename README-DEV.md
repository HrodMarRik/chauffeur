# Chauffeur - Branche de Développement

## 🚀 Branche Dev

Cette branche contient les fonctionnalités en cours de développement et les améliorations pour l'application Chauffeur.

## 📋 Fonctionnalités Actuelles

- ✅ Configuration Docker complète
- ✅ API Symfony fonctionnelle
- ✅ Tests automatisés CI/CD
- ✅ Base de données MySQL configurée
- ✅ Contrôleur d'accueil avec endpoint API

## 🛠️ Commandes de Développement

### Lancer l'application localement
```bash
# Avec Docker Compose (si disponible)
docker-compose up -d

# Ou avec Docker directement
docker run -d --name mysql-chauffeur -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=symfony -e MYSQL_USER=symfony -e MYSQL_PASSWORD=symfony -p 3307:3306 mysql:8.0
docker build -t chauffeur-web .
docker run -d --name chauffeur-app -p 8000:80 -e APP_ENV=dev -e APP_DEBUG=1 -e DATABASE_URL="mysql://symfony:symfony@host.docker.internal:3307/symfony?serverVersion=8.0.32&charset=utf8mb4" chauffeur-web
```

### Tester l'application
```bash
# Test automatisé
./test-docker.sh

# Test manuel
curl http://localhost:8000/
```

### Accéder au conteneur
```bash
docker exec -it chauffeur-app bash
```

## 🔄 Workflow CI/CD

- **Push sur `dev`** : Déclenche les tests de développement
- **Push sur `main`** : Déclenche les tests de production
- **Pull Request** : Tests complets avant merge

## 📝 Prochaines Fonctionnalités

- [ ] Authentification utilisateur
- [ ] Gestion des chauffeurs
- [ ] Système de réservation
- [ ] API REST complète
- [ ] Interface web

## 🐛 Signaler un Bug

Utilisez les Issues GitHub pour signaler les problèmes rencontrés.

## 📞 Support

Pour toute question sur le développement, contactez l'équipe de développement.
