<?php

namespace App\Controller;


use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
class CheckoutController extends AbstractController
{
    #[Route('/checkout/{id}', name: 'app_checkout', requirements: ['id' => '\d+'])]
    public function index(int $id, PanierRepository $panierRepository): Response
    {
        $panier = $panierRepository->findOneBy(['idClient' => 101]);
        $rawProducts = $panier->getProduits();
        $items = [];
        $subtotal = 0;

        foreach ($rawProducts as $product) {
            if (is_array($product) && isset($product['price'])) {
                $items[] = [
                    'id' => $product['id'] ?? null,
                    'name' => $product['name'] ?? 'Unnamed Product',
                    'price' => $product['price'],
                    'quantity' => 1
                ];
                $subtotal += $product['price'];
            }
        }
        $shipping = 15.00;
        $tax = $subtotal * 0.19;
        $total = $subtotal + $shipping + $tax;
        $orderSummary = [
            'items' => $items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'tax' => $tax,
            'total' => $total
        ];

        // Static shipping methods
        $shippingMethods = [
            [
                'id' => 1,
                'name' => 'Standard Shipping',
                'price' => 15.00,
                'estimatedDays' => '3-5'
            ],
            [
                'id' => 2,
                'name' => 'Express Shipping',
                'price' => 25.00,
                'estimatedDays' => '1-2'
            ]
        ];

        // Static payment methods
        $paymentMethods = [
            [
                'id' => 1,
                'name' => 'Credit Card',
                'icon' => 'credit-card'
            ],
            [
                'id' => 2,
                'name' => 'PayPal',
                'icon' => 'paypal'
            ]
        ];

        return $this->render('checkout/index.html.twig', [
            'orderSummary' => $orderSummary,
            'shippingMethods' => $shippingMethods,
            'paymentMethods' => $paymentMethods,
            "someId" => $id
        ]);
    }

    #[Route('/checkout/success/{id}', name: 'app_checkout_success', requirements: ['id' => '\d+'])]
    public function success(int $id, PanierRepository $panierRepository, EntityManagerInterface $entityManager): Response
    {
        $panier = $panierRepository->findOneBy(['idClient' => 101]);

        if ($panier) {
            $entityManager->remove($panier);
            $entityManager->flush();
        }

        return $this->render('checkout/success.html.twig');
    }
}
