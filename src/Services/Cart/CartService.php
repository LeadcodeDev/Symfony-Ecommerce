<?php
namespace App\Services\Cart;

use App\Repository\ItemsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


/**
 * Gestion du panier de l'utilisateur courant via les sessions de Symfony
 */
class CartService {

    protected $session;

    public function __construct(SessionInterface $session, ItemsRepository $itemsRepository)
    {
        $this->session = $session;
        $this->itemsRepository = $itemsRepository;
    }
    
    /**
     * Gestion du panier client via les session de symfony
     * Ajout du produit dans le panier de l'utilisateur courant
     * 
     * @param  int $id
     * @return void
     */
    public function add(int $id)
    {
        $cart = $this->session->get('cart', []);
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $this->session->set('cart', $cart);
    }

    /**
     * Gestion du panier client via les session de symfony
     * Suppression du produit dans le panier de l'utilisateur courant
     *
     * @param  int $id
     * @return void
     */
    public function remove(int $id)
    {
        $cart = $this->session->get('cart', []);
        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }

        $this->session->set('cart', $cart);
    }
    
    /**
     * Gestion du panier client via les session de symfony
     * Récupère tous les articles du panier de l'utilisateur courant
     *
     * @return array
     */
    public function getFullCart(): array
    {
        $cart = $this->session->get('cart', []);
        $cartWithDatas = [];

        foreach ($cart as $id => $amount) {
            $cartWithDatas[] = [
                'product' => $this->itemsRepository->find($id),
                'amount' => $amount
            ];
        }

        return $cartWithDatas;
    }

        
    /**
     * Gestion du panier client via les session de symfony
     * Récupère tous le prix final du panier de l'utilisateur courant
     * 
     * @return float
     */
    public function getTotalPrice(): float
    {
        $total = 0;
        foreach ($this->getFullCart() as $item) {
            $total += $item['product']->getPrice() * $item['amount'];
        }

        return $total;
    }
}