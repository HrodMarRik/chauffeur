#!/bin/bash

echo "🧪 Test de l'image Docker Symfony..."

# Créer un réseau Docker pour les tests
docker network create test-network 2>/dev/null || true

# Démarrer MySQL dans un conteneur séparé
echo "📦 Démarrage de MySQL..."
docker run -d --name test-mysql --network test-network \
  -e MYSQL_ROOT_PASSWORD=root \
  -e MYSQL_DATABASE=symfony \
  -e MYSQL_USER=symfony \
  -e MYSQL_PASSWORD=symfony \
  mysql:8.0

# Attendre que MySQL soit prêt
echo "⏳ Attente de MySQL..."
sleep 30

# Démarrer l'application Symfony
echo "🚀 Démarrage de Symfony..."
docker run -d --name symfony-test --network test-network \
  -e DATABASE_URL="mysql://symfony:symfony@test-mysql:3306/symfony?serverVersion=8.0.32&charset=utf8mb4" \
  -e APP_ENV=prod \
  -e APP_DEBUG=0 \
  -p 8000:80 \
  symfony-app

# Attendre que l'application soit prête
echo "⏳ Attente de Symfony..."
sleep 15

# Tester l'application
echo "🔍 Test de l'application..."
if curl -f http://localhost:8000; then
  echo "✅ Test réussi !"
else
  echo "❌ Test échoué !"
fi

# Nettoyer
echo "🧹 Nettoyage..."
docker stop symfony-test test-mysql
docker rm symfony-test test-mysql
docker network rm test-network

echo "✨ Terminé !"
