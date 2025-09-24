<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'app_products')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Créer un produit de test
        $product = new Product();
        $product->setName('Produit Test');
        $product->setPrice('29.99');
        $product->setDescription('Ceci est un produit de test pour vérifier la connexion à la base de données.');

        $entityManager->persist($product);
        $entityManager->flush();

        // Récupérer tous les produits
        $products = $entityManager->getRepository(Product::class)->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }
}
