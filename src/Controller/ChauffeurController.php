<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChauffeurController extends AbstractController
{
    #[Route('/chauffeurs', name: 'app_chauffeurs')]
    public function index(): Response
    {
        $chauffeurs = [
            [
                'id' => 1,
                'nom' => 'Jean Dupont',
                'email' => 'jean.dupont@chauffeur.com',
                'telephone' => '06 12 34 56 78',
                'statut' => 'actif',
                'experience' => '5 ans',
                'note' => 4.8,
                'trajets_completes' => 156,
                'specialite' => 'Transport VIP',
                'vehicule' => 'Mercedes Classe E',
                'disponible' => true
            ],
            [
                'id' => 2,
                'nom' => 'Marie Martin',
                'email' => 'marie.martin@chauffeur.com',
                'telephone' => '06 23 45 67 89',
                'statut' => 'actif',
                'experience' => '3 ans',
                'note' => 4.6,
                'trajets_completes' => 89,
                'specialite' => 'Transport Aéroport',
                'vehicule' => 'BMW Série 5',
                'disponible' => true
            ],
            [
                'id' => 3,
                'nom' => 'Pierre Durand',
                'email' => 'pierre.durand@chauffeur.com',
                'telephone' => '06 34 56 78 90',
                'statut' => 'en_conges',
                'experience' => '8 ans',
                'note' => 4.9,
                'trajets_completes' => 234,
                'specialite' => 'Transport Entreprise',
                'vehicule' => 'Audi A6',
                'disponible' => false
            ],
            [
                'id' => 4,
                'nom' => 'Sophie Leroy',
                'email' => 'sophie.leroy@chauffeur.com',
                'telephone' => '06 45 67 89 01',
                'statut' => 'actif',
                'experience' => '2 ans',
                'note' => 4.5,
                'trajets_completes' => 67,
                'specialite' => 'Transport Événementiel',
                'vehicule' => 'Volkswagen Passat',
                'disponible' => true
            ]
        ];

        $stats = [
            'total_chauffeurs' => count($chauffeurs),
            'chauffeurs_actifs' => count(array_filter($chauffeurs, fn($c) => $c['statut'] === 'actif')),
            'chauffeurs_disponibles' => count(array_filter($chauffeurs, fn($c) => $c['disponible'])),
            'note_moyenne' => round(array_sum(array_column($chauffeurs, 'note')) / count($chauffeurs), 1)
        ];

        return $this->render('chauffeur/index.html.twig', [
            'chauffeurs' => $chauffeurs,
            'stats' => $stats,
            'page_title' => 'Nos Chauffeurs',
            'page_subtitle' => 'Découvrez notre équipe de chauffeurs professionnels'
        ]);
    }

    #[Route('/chauffeurs/{id}', name: 'app_chauffeur_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id): Response
    {
        $chauffeur = [
            'id' => $id,
            'nom' => 'Jean Dupont',
            'email' => 'jean.dupont@chauffeur.com',
            'telephone' => '06 12 34 56 78',
            'statut' => 'actif',
            'experience' => '5 ans',
            'note' => 4.8,
            'trajets_completes' => 156,
            'specialite' => 'Transport VIP',
            'vehicule' => 'Mercedes Classe E',
            'disponible' => true,
            'description' => 'Chauffeur expérimenté spécialisé dans le transport VIP. Excellent service client et ponctualité exemplaire.',
            'langues' => ['Français', 'Anglais', 'Espagnol'],
            'certifications' => ['Permis B', 'Formation Sécurité', 'Service Client'],
            'disponibilite' => [
                'lundi' => '8h-18h',
                'mardi' => '8h-18h',
                'mercredi' => '8h-18h',
                'jeudi' => '8h-18h',
                'vendredi' => '8h-18h',
                'samedi' => '10h-16h',
                'dimanche' => 'Sur demande'
            ]
        ];

        return $this->render('chauffeur/detail.html.twig', [
            'chauffeur' => $chauffeur,
            'page_title' => 'Profil de ' . $chauffeur['nom'],
            'page_subtitle' => 'Informations détaillées du chauffeur'
        ]);
    }
}
