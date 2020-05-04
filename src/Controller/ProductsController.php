<?php
namespace App\Controller;

use App\Entity\Items;
use App\Repository\ItemsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    public function product(Items $product)
    {
        if (!$product->getIsVisible()) return $this->redirectToRoute('home');

        return $this->render('Products/product.html.twig', [
            'product' => $product
        ]);
    }
}