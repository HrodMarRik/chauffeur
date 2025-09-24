<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $systemInfo = [
            'php_version' => PHP_VERSION,
            'symfony_version' => \Symfony\Component\HttpKernel\Kernel::VERSION,
            'server_time' => new \DateTime(),
            'memory_usage' => memory_get_usage(true),
            'memory_peak' => memory_get_peak_usage(true),
            'user_agent' => $request->headers->get('User-Agent'),
            'ip_address' => $request->getClientIp(),
        ];

        $stats = [
            'total_chauffeurs' => 42,
            'active_trajets' => 18,
            'completed_trajets' => 1247,
            'total_revenue' => 45678.90,
        ];

        // Fonctionnalités avec état
        $features = [
            [
                'name' => 'Gestion des Chauffeurs',
                'status' => 'active',
                'description' => 'Gestion complète des chauffeurs et de leurs informations',
                'icon' => 'fas fa-users',
                'color' => 'success'
            ],
            [
                'name' => 'Planification des Trajets',
                'status' => 'active',
                'description' => 'Planification et optimisation des trajets',
                'icon' => 'fas fa-route',
                'color' => 'info'
            ],
            [
                'name' => 'Suivi en Temps Réel',
                'status' => 'maintenance',
                'description' => 'Suivi GPS et notifications en temps réel',
                'icon' => 'fas fa-map-marker-alt',
                'color' => 'warning'
            ],
            [
                'name' => 'Rapports Avancés',
                'status' => 'development',
                'description' => 'Analytics et rapports détaillés',
                'icon' => 'fas fa-chart-bar',
                'color' => 'secondary'
            ]
        ];

        // Messages système
        $messages = [
            [
                'type' => 'success',
                'title' => 'Système opérationnel',
                'content' => 'Tous les services fonctionnent correctement',
                'timestamp' => new \DateTime('-5 minutes')
            ],
            [
                'type' => 'info',
                'title' => 'Mise à jour disponible',
                'content' => 'Version 1.1.0 disponible avec de nouvelles fonctionnalités',
                'timestamp' => new \DateTime('-1 hour')
            ]
        ];

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'system_info' => $systemInfo,
            'stats' => $stats,
            'features' => $features,
            'messages' => $messages,
        ]);
    }

    #[Route('/api/status', name: 'api_status', methods: ['GET'])]
    public function apiStatus(): Response
    {
        $status = [
            'status' => 'ok',
            'timestamp' => (new \DateTime())->format('c'),
            'version' => '1.0.0',
            'environment' => $this->getParameter('kernel.environment'),
            'debug' => $this->getParameter('kernel.debug'),
            'services' => [
                'database' => 'connected',
                'cache' => 'active',
                'queue' => 'running'
            ]
        ];

        return $this->json($status);
    }
}
