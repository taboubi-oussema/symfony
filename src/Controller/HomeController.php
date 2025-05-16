<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // Static data for featured products
        $featured_products = [
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
                'name' => 'Peak Running Shoes',
                'description' => 'Professional running shoes',
                'price' => 129.99,
                'image' => 'https://via.placeholder.com/300x300',
                'boutique' => 'peak'
            ],
            [
                'id' => 3,
                'name' => 'Bershka Hoodie',
                'description' => 'Casual hoodie with modern design',
                'price' => 59.99,
                'image' => 'https://via.placeholder.com/300x300',
                'boutique' => 'bershka'
            ],
            [
                'id' => 4,
                'name' => 'Zara Denim Jacket',
                'description' => 'Classic denim jacket',
                'price' => 89.99,
                'image' => 'https://via.placeholder.com/300x300',
                'boutique' => 'zara'
            ]
        ];

        // Static categories data
        $categories = [
            ['id' => 1, 'name' => 'Electronics', 'image' => 'https://via.placeholder.com/200x200'],
            ['id' => 2, 'name' => 'Fashion', 'image' => 'https://via.placeholder.com/200x200'],
            ['id' => 3, 'name' => 'Home & Living', 'image' => 'https://via.placeholder.com/200x200'],
            ['id' => 4, 'name' => 'Beauty', 'image' => 'https://via.placeholder.com/200x200']
        ];

        return $this->render('home/index.html.twig', [
            'featured_products' => $featured_products,
            'categories' => $categories
        ]);
    }
}
