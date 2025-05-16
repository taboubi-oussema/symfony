<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/shop', name: 'app_shop')]
    public function index(Request $request): Response
    {
        // Get boutique parameter from URL
        $boutique = $request->query->get('boutique');

        // Static data for testing
        $allProducts = [
            [
                'id' => 1,
                'name' => 'Zara Summer Dress',
                'description' => 'Elegant summer dress from Zara',
                'price' => 79.99,
                'image' => 'https://via.placeholder.com/300x300',
                'boutique' => 'zara'
            ],
            [
                'id' => 2,
                'name' => 'Zara Denim Jacket',
                'description' => 'Classic denim jacket',
                'price' => 89.99,
                'image' => 'https://via.placeholder.com/300x300',
                'boutique' => 'zara'
            ],
            [
                'id' => 3,
                'name' => 'Zara White Shirt',
                'description' => 'Premium cotton white shirt',
                'price' => 49.99,
                'image' => 'https://via.placeholder.com/300x300',
                'boutique' => 'zara'
            ],
            [
                'id' => 4,
                'name' => 'Peak Running Shoes',
                'description' => 'Professional running shoes',
                'price' => 129.99,
                'image' => 'https://via.placeholder.com/300x300',
                'boutique' => 'peak'
            ],
            [
                'id' => 5,
                'name' => 'Peak Sports T-shirt',
                'description' => 'Comfortable sports t-shirt',
                'price' => 39.99,
                'image' => 'https://via.placeholder.com/300x300',
                'boutique' => 'peak'
            ],
            [
                'id' => 6,
                'name' => 'Peak Track Suit',
                'description' => 'Stylish track suit for athletes',
                'price' => 89.99,
                'image' => 'https://via.placeholder.com/300x300',
                'boutique' => 'peak'
            ],
            [
                'id' => 7,
                'name' => 'Bershka Jeans',
                'description' => 'Stylish slim-fit jeans',
                'price' => 49.99,
                'image' => 'https://via.placeholder.com/300x300',
                'boutique' => 'bershka'
            ],
            [
                'id' => 8,
                'name' => 'Bershka Hoodie',
                'description' => 'Casual hoodie with modern design',
                'price' => 59.99,
                'image' => 'https://via.placeholder.com/300x300',
                'boutique' => 'bershka'
            ],
            [
                'id' => 9,
                'name' => 'Bershka T-shirt',
                'description' => 'Trendy graphic t-shirt',
                'price' => 29.99,
                'image' => 'https://via.placeholder.com/300x300',
                'boutique' => 'bershka'
            ]
        ];

        // Filter products by boutique if specified in URL
        $products = $boutique
            ? array_filter($allProducts, fn($product) => strtolower($product['boutique']) === strtolower($boutique))
            : $allProducts;

        return $this->render('shop/index.html.twig', [
            'products' => $products,
            
        ]);
    }
}
