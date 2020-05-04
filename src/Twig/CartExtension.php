<?php
namespace App\Twig;

use App\Repository\WebsiteConfigRepository;
use App\Services\Cart\CartService;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CartExtension extends AbstractExtension {

    public function __construct(WebsiteConfigRepository $websiteConfigRepository, Environment $twig, CartService $cartService) {
        $this->websiteConfigRepository = $websiteConfigRepository;
        $this->twig = $twig;
        $this->cartService = $cartService;
    }
    
    public function getFunctions(): array
    {
        return [
            new TwigFunction('cart', [$this, 'getCart'], ['is_safe' => ['html']])
        ];
    }

    public function getCart(): string
    {
        return $this->cartService->getFullCart() ? count($this->cartService->getFullCart()) : "";
    }
}