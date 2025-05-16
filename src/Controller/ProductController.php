<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'app_product_show')]
    public function show(int $id): Response
    {
        // Static product data
        $product = [
            'id' => $id,
            'name' => 'Designer Watch',
            'price' => 299.99,
            'images' => [
                'https://via.placeholder.com/600x600',
                'https://via.placeholder.com/600x600',
                'https://via.placeholder.com/600x600'
            ],
            'description' => 'Luxury designer watch with premium features. This elegant timepiece combines style and functionality with its premium materials and precise movement.',
            'specifications' => [
                'Brand' => 'Luxury Brand',
                'Model' => 'Chronograph X',
                'Movement' => 'Automatic',
                'Case Material' => 'Stainless Steel',
                'Water Resistance' => '100m'
            ],
            'reviews' => [
                [
                    'user' => 'John D.',
                    'rating' => 5,
                    'comment' => 'Excellent quality and beautiful design!'
                ],
                [
                    'user' => 'Sarah M.',
                    'rating' => 4,
                    'comment' => 'Great watch, but a bit pricey.'
                ]
            ],
            'relatedProducts' => [
                [
                    'id' => 2,
                    'name' => 'Smart Watch',
                    'price' => 199.99,
                    'image' => 'https://via.placeholder.com/300x300'
                ],
                [
                    'id' => 3,
                    'name' => 'Classic Watch',
                    'price' => 249.99,
                    'image' => 'https://via.placeholder.com/300x300'
                ]
            ]
        ];

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}
