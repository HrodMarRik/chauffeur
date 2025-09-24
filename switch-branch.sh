#!/bin/bash

echo "🔄 Gestionnaire de branches Chauffeur"
echo "======================================"

# Vérifier l'état actuel
CURRENT_BRANCH=$(git branch --show-current)
echo "📍 Branche actuelle: $CURRENT_BRANCH"

echo ""
echo "Choisissez une action:"
echo "1) Basculer vers main"
echo "2) Basculer vers dev"
echo "3) Créer une nouvelle branche"
echo "4) Voir le statut"
echo "5) Quitter"

read -p "Votre choix (1-5): " choice

case $choice in
    1)
        echo "🔄 Basculement vers main..."
        git checkout main
        echo "✅ Maintenant sur la branche main"
        ;;
    2)
        echo "🔄 Basculement vers dev..."
        git checkout dev
        echo "✅ Maintenant sur la branche dev"
        ;;
    3)
        read -p "Nom de la nouvelle branche: " branch_name
        echo "🆕 Création de la branche $branch_name..."
        git checkout -b "$branch_name"
        echo "✅ Nouvelle branche $branch_name créée"
        ;;
    4)
        echo "📊 Statut actuel:"
        git status
        ;;
    5)
        echo "👋 Au revoir!"
        exit 0
        ;;
    *)
        echo "❌ Choix invalide"
        exit 1
        ;;
esac
