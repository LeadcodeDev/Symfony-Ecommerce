<?php
namespace App\Controller;

use App\Services\Cart\CartService;
use App\Services\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @Route("/mon-compte", name="private_account_index")
     */
    public function privateAccount(SecurityService $securityService, CartService $cartService)
    {
        if (!$securityService->isLogin()) return $this->redirectToRoute(('home'));

        return $this->render('User/privateAccount.html.twig', [
            'cart' => $cartService->getFullCart(),
            'total' => $cartService->getTotalPrice()
        ]);
    }
}