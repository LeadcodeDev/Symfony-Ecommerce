<?php
namespace App\Controller;

use App\Repository\CartItemsRepository;
use App\Repository\ItemsRepository;
use App\Services\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    public function __construct(CartService $cartService, CartItemsRepository $cartItemsRepository)
    {
        $this->cartService = $cartService;
        $this->cartItemsRepository = $cartItemsRepository;
    }

    /**
     * @Route("/panier/add/{id}", name="cart_add", methods={"GET"})
     */
    public function add(int $id, ItemsRepository $itemsRepository)
    {
        $this->cartService->add($itemsRepository->find($id));
        return $this->redirectToRoute('private_account_index');
    }

    /**
     * @Route("/panier/remove/{id}", name="cart_remove", methods={"GET"})
     */
    public function remove(int $id)
    {
        $cartItem = $this->cartItemsRepository->find($id);
        $this->cartService->remove($cartItem);
        return $this->redirectToRoute('private_account_index');
    }

    /**
     * @Route("/panier/setAmount/{id}/{amount}", name="cart_set_amount", methods={"POST"})
     */
    public function changeAmount(int $id, int $amount)
    {
        $cartItem = $this->cartItemsRepository->find($id);
        $this->cartService->setAmount($cartItem, $amount);
        if ($amount === 0) {
            return $this->redirectToRoute('private_account_index');
        } else {
            return new Response();
        }
    }
}