<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $messageSent = false;
        $formData = [];

        // Simulation du traitement du formulaire
        if ($request->isMethod('POST')) {
            $formData = [
                'nom' => $request->request->get('nom', ''),
                'email' => $request->request->get('email', ''),
                'telephone' => $request->request->get('telephone', ''),
                'sujet' => $request->request->get('sujet', ''),
                'message' => $request->request->get('message', '')
            ];

            // Simulation de l'envoi du message
            $messageSent = true;
        }

        // Informations de contact
        $contactInfo = [
            'adresse' => '123 Avenue des Champs-Élysées, 75008 Paris',
            'telephone' => '+33 1 23 45 67 89',
            'email' => 'contact@chauffeur.com',
            'horaires' => [
                'lundi' => '8h00 - 18h00',
                'mardi' => '8h00 - 18h00',
                'mercredi' => '8h00 - 18h00',
                'jeudi' => '8h00 - 18h00',
                'vendredi' => '8h00 - 18h00',
                'samedi' => '9h00 - 17h00',
                'dimanche' => 'Fermé'
            ],
            'services' => [
                'Transport VIP',
                'Transport Aéroport',
                'Transport Entreprise',
                'Transport Événementiel',
                'Transport Mariage'
            ]
        ];

        return $this->render('contact/index.html.twig', [
            'contact_info' => $contactInfo,
            'form_data' => $formData,
            'message_sent' => $messageSent,
            'page_title' => 'Contactez-nous',
            'page_subtitle' => 'Nous sommes là pour répondre à vos questions'
        ]);
    }
}
