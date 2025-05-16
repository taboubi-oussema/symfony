<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('user/login.html.twig');
    }

    #[Route('/register', name: 'app_register')]
    public function register(): Response
    {
        return $this->render('user/register.html.twig');
    }

    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        // Static user data
        $user = [
            'id' => 1,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '+216 12345678',
            'address' => [
                'street' => '123 Main St',
                'city' => 'Tunis',
                'country' => 'Tunisia',
                'postalCode' => '1000'
            ]
        ];

        // Static order history
        $orderHistory = [
            [
                'id' => 'ORD-123456',
                'date' => '2024-03-15',
                'total' => 1442.97,
                'status' => 'Delivered',
                'items' => [
                    ['name' => 'Designer Watch', 'quantity' => 1],
                    ['name' => 'Smartphone X', 'quantity' => 1]
                ]
            ],
            [
                'id' => 'ORD-123457',
                'date' => '2024-03-10',
                'total' => 299.99,
                'status' => 'Processing',
                'items' => [
                    ['name' => 'Designer Bag', 'quantity' => 1]
                ]
            ]
        ];

        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'orderHistory' => $orderHistory
        ]);
    }

    #[Route('/profile/edit', name: 'app_profile_edit')]
    public function editProfile(): Response
    {
        // Static user data (same as profile)
        $user = [
            'id' => 1,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '+216 12345678',
            'address' => [
                'street' => '123 Main St',
                'city' => 'Tunis',
                'country' => 'Tunisia',
                'postalCode' => '1000'
            ]
        ];

        return $this->render('user/edit_profile.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/profile/orders', name: 'app_profile_orders')]
    public function orders(): Response
    {
        // Static order history (same as in profile)
        $orders = [
            [
                'id' => 'ORD-123456',
                'date' => '2024-03-15',
                'total' => 1442.97,
                'status' => 'Delivered',
                'items' => [
                    ['name' => 'Designer Watch', 'quantity' => 1],
                    ['name' => 'Smartphone X', 'quantity' => 1]
                ]
            ],
            [
                'id' => 'ORD-123457',
                'date' => '2024-03-10',
                'total' => 299.99,
                'status' => 'Processing',
                'items' => [
                    ['name' => 'Designer Bag', 'quantity' => 1]
                ]
            ]
        ];

        return $this->render('user/orders.html.twig', [
            'orders' => $orders
        ]);
    }
}
