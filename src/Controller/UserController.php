<?php
namespace App\Controller;

use App\Repository\CartRepository;
use App\Repository\UserRepository;
use App\Services\Cart\CartService;
use App\Services\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\Cache\ItemInterface;

class UserController extends AbstractController
{

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;   
    }

    /**
     * @Route("/mon-compte", name="private_account_index")
     */
    public function privateAccount(SecurityService $securityService, Security $security, CartRepository $cartRepository)
    {
        if (!$securityService->isLogin()) return $this->redirectToRoute(('home'));

        return $this->render('User/privateAccount.html.twig', [
            'cart' => $cartRepository->getCartFromUser($security->getUser()->getId())[0]
        ]);
    }
}