<?php
namespace App\Controller;

use App\Repository\ItemsRepository;
use App\Services\Cart\CartService;
use App\Services\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{
    public function __construct(ItemsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }
    
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('home.html.twig', [
            'products' => $this->productsRepository->findVisibleLimit(9)
        ]);
    }
}