<?php
namespace App\Services\Cart;

use App\Entity\Cart;
use App\Entity\CartItems;
use App\Entity\Items;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Gestion du panier de l'utilisateur courant via les sessions de Symfony
 */
class CartService {

    protected $session;

    public function __construct(Security $security, CartRepository $cartRepository, EntityManagerInterface $entityManager)
    {
        $this->security = $security;
        $this->cartRepository = $cartRepository;
        $this->entityManager = $entityManager;
    }
    
    /**
     * Gestion du panier client via les session de symfony
     * Ajout du produit dans le panier de l'utilisateur courant
     * 
     * @param  int $id
     * @return void
     */
    public function add(Items $items)
    {
        if (count($this->cartRepository->getCartFromUser($this->security->getUser()->getId())) === 0) {
            $cart = $this->createCart();
            $this->createCartItem($cart, $items);
        } else {
            $arr = [];
            $cartItems = [];

            $cart = $this->cartRepository->getCartFromUser($this->security->getUser()->getId());
            $cartItems = $cart[0]->getItems();

            foreach($cartItems as $cartItem) {
                array_push($arr, $cartItem->getItem()->getId());
            }

            if (!in_array($items->getId(), $arr)) {
                $this->createCartItem($cart[0], $items);
            }
        }
    }

    /**
     * Gestion du panier client via les session de symfony
     * Suppression du produit dans le panier de l'utilisateur courant
     *
     * @param  int $id
     * @return void
     */
    public function remove(CartItems $cartItem)
    {
        $this->entityManager->remove($cartItem);
        $this->entityManager->flush();
    }

    /**
     * Gestion du panier client via les session de symfony
     * Assigne une quantité à un produit du panier
     *
     * @return void
     */
    public function setAmount(CartItems $cartItem, int $amount) {
        if ($amount === 0) {
            $this->remove($cartItem);
        }
        $cartItem->setAmount($amount);
        $this->entityManager->flush();
    }
    
    /**
     * Gestion du panier client via les session de symfony
     * Récupère tous les articles du panier de l'utilisateur courant
     *
     * @return Object
     */
    public function getFullCart(): Object
    {
       return $this->cartRepository->getCartFromUser($this->security->getUser()->getId())[0];
    }

    /**
     * Gestion du panier client via les session de symfony
     * Récupère le nombre de produits dans le panier
     * 
     * @return int
     */
    public function getTotalAmount(): int
    {
        $items = $this->getFullCart()->getItems();
        $count = 0;
        foreach($items as $item) {
            $count += intval($item->getAmount());
        }
        return $count;
    }

    private function createCart(): Cart
    {
        $cart = new Cart();
        $cart->setUser($this->security->getUser());
        $cart->setIsComplete(false);

        $this->entityManager->persist($cart);
        $this->entityManager->flush();

        return $cart;
    }

    private function createCartItem(Cart $cart, Items $item): CartItems
    {
        $CartItems = new CartItems();
        $CartItems->setCart($cart);
        $CartItems->setAmount(1);
        $CartItems->setItem($item);

        $this->entityManager->persist($CartItems);
        $this->entityManager->flush();

        return $CartItems;
    }
}