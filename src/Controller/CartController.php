<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Repository\PanierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(PanierRepository $panierRepository): Response
    {
        // Get the cart from database
        $panier = $panierRepository->findOneBy(['idClient' => 101]);
        if($panier){
            $rawProducts = $panier->getProduits();
            $cartItems = [];
        }

        // Format each product to match the template's expected structure
        foreach ($rawProducts as $index => $product) {
            $cartItems[] = $product;
        }

        // Calculate totals
        $subtotal = $panier->getTotal();
        $shipping = 15.00;
        $tax = $subtotal * 0.19; 
        $total = $subtotal + $shipping + $tax;

        return $this->render('cart/index.html.twig', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'tax' => $tax,
            'total' => $total,
            "panier"=>$panier
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function add(int $id, PanierRepository $panierRepository, EntityManagerInterface $entityManager): Response
    {
        $panier = $panierRepository->findOneBy(['idClient' => 101]);

        if (!$panier) {
            $panier = new Panier();
            $panier->setIdClient(101);
            $panier->setProduits([]);
            $panier->setTotal(0.0);
        }

        // Static product data (replace with actual logic to fetch product details)
        $staticProducts = [
            1 => ['id' => 1, 'name' => 'Static Product 1', 'price' => 10.00],
            2 => ['id' => 2, 'name' => 'Static Product 2', 'price' => 25.50],
            // Add more static products as needed
        ];

       
        if (!isset($staticProducts[$id])) {
            $this->addFlash('error', 'Product not found');
            return $this->redirectToRoute('app_cart');
        }

        $productToAdd = $staticProducts[$id];

        // Add the product to the cart's products array
        $products = $panier->getProduits();
        $products[] = $productToAdd;
        $panier->setProduits($products);

        // Recalculate total
        $total = 0;
        foreach ($products as $product) {
            if (is_array($product) && isset($product['price'])) {
                $total += $product['price'];
            }
        }
        $panier->setTotal($total);

        // Save the cart to the database
        $entityManager->persist($panier);
        $entityManager->flush();

        $this->addFlash('success', 'Product added to cart');

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove/{id}', name: 'app_cart_remove')]
    public function remove(int $id, PanierRepository $panierRepository, EntityManagerInterface $entityManager): Response
    {
        // Get the current cart
        $panier = $panierRepository->findOneBy(['idClient' => 101]);
    
        if ($panier) {
            // Get current products
            $products = $panier->getProduits();
    
            // Remove the product with the given ID
            foreach ($products as $key => $product) {
                if (isset($product['id']) && $product['id'] == $id) {
                    unset($products[$key]);
                    break;
                }
            }
    
            // Reindex array
            $products = array_values($products);
    
            // Update the cart's product list
            $panier->setProduits($products);
    
            // Recalculate total
            $total = 0;
            foreach ($products as $product) {
                if (is_array($product) && isset($product['price'])) {
                    $total += $product['price'];
                }
            }
            $panier->setTotal($total);
    
            // Save changes
            $entityManager->flush();
        }
    
        return $this->redirectToRoute('app_cart');
    }
    
}
