#!/bin/bash

echo "🚀 Mode Développement Chauffeur (Direct)"
echo "========================================"

case "$1" in
    "start")
        echo "▶️ Démarrage de l'environnement de développement..."
        
        # Démarrer MySQL
        echo "🗄️ Démarrage de MySQL..."
        docker run -d --name mysql-dev \
          -e MYSQL_ROOT_PASSWORD=root \
          -e MYSQL_DATABASE=symfony \
          -e MYSQL_USER=symfony \
          -e MYSQL_PASSWORD=symfony \
          -p 3307:3306 \
          mysql:8.0
        
        # Attendre que MySQL soit prêt
        echo "⏳ Attente de MySQL..."
        sleep 15
        
        # Construire l'image de développement
        echo "🔨 Construction de l'image de développement..."
        docker build -f Dockerfile -t chauffeur-dev .
        
        # Démarrer Symfony avec volumes pour le développement
        echo "🚀 Démarrage de Symfony avec hot-reload..."
        docker run -d --name chauffeur-dev \
          --link mysql-dev:db \
          -v "$(pwd):/var/www/html" \
          -v /var/www/html/vendor \
          -e APP_ENV=dev \
          -e APP_DEBUG=1 \
          -e DATABASE_URL="mysql://symfony:symfony@db:3306/symfony?serverVersion=8.0.32&charset=utf8mb4" \
          -p 8000:80 \
          chauffeur-dev
        
        echo "✅ Environnement démarré !"
        echo "🌐 Application: http://localhost:8000"
        echo "🗄️ MySQL: localhost:3307"
        echo ""
        echo "💡 Vos modifications de code sont maintenant synchronisées en temps réel !"
        ;;
    "stop")
        echo "⏹️ Arrêt de l'environnement de développement..."
        docker stop chauffeur-dev mysql-dev 2>/dev/null || true
        docker rm chauffeur-dev mysql-dev 2>/dev/null || true
        echo "✅ Environnement arrêté !"
        ;;
    "restart")
        echo "🔄 Redémarrage de l'environnement de développement..."
        $0 stop
        sleep 2
        $0 start
        ;;
    "logs")
        echo "📋 Logs de l'application..."
        docker logs -f chauffeur-dev
        ;;
    "shell")
        echo "🐚 Accès au shell du conteneur..."
        docker exec -it chauffeur-dev bash
        ;;
    "status")
        echo "📊 Statut des conteneurs..."
        docker ps --filter "name=chauffeur-dev\|mysql-dev"
        ;;
    *)
        echo "Usage: $0 {start|stop|restart|logs|shell|status}"
        echo ""
        echo "Commandes disponibles:"
        echo "  start   - Démarrer l'environnement de développement"
        echo "  stop    - Arrêter l'environnement de développement"
        echo "  restart - Redémarrer l'environnement de développement"
        echo "  logs    - Voir les logs en temps réel"
        echo "  shell   - Accéder au shell du conteneur"
        echo "  status  - Voir le statut des conteneurs"
        echo ""
        echo "�� Avec cette configuration, vos modifications de code sont"
        echo "   automatiquement synchronisées avec le conteneur !"
        ;;
esac
