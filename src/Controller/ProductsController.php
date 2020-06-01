<?php
namespace App\Controller;

use App\Entity\Items;
use App\Repository\ItemsRepository;
use App\Services\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ProductsController extends AbstractController
{

    public function __construct(ItemsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * @Route("/products", name="products_index")
     */
    public function list()
    {
        return $this->render('Products/products.html.twig', [
            'products' => $this->productsRepository->findAllVisible()
        ]);
    }
        
    /**
     * @Route("/produits/{slugCategory}/{slugProduct}/{id}", name="product_detail")
     */
    public function product(Items $item, Security $security, CartService $cartService)
    {
        if (!$item->getIsVisible()) return $this->redirectToRoute('home');
        $isInCart = false;

        if ($security->getUser()) {
            $cart = $cartService->getFullCart();

            foreach ($cart->getItems() as $product) {
                $isInCart = $product->getItem()->getId() === $item->getId();
                if ($product->getItem()->getId() === $item->getId()) {
                    $isInCart = true;
                }
            }
        }

        return $this->render('Products/product.html.twig', [
            'product' => $item,
            'inCart' => $isInCart
        ]);
    }
}