<?php
namespace App\Controller;

use App\Services\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
    public function add(int $id, CartService $cartService)
    {
        $cartService->add($id);
        return $this->redirectToRoute('private_account_index');
    }

    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove(int $id, CartService $cartService)
    {
        $cartService->remove($id);
        return $this->redirectToRoute('private_account_index');
    }
}