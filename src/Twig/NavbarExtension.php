<?php
namespace App\Twig;

use App\Repository\WebsiteConfigRepository;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class NavbarExtension extends AbstractExtension {

    public function __construct(WebsiteConfigRepository $websiteConfigRepository, Environment $twig) {
        $this->websiteConfigRepository = $websiteConfigRepository;
        $this->twig = $twig;
    }
    
    public function getFunctions(): array
    {
        return [
            new TwigFunction('head', [$this, 'getHead'], ['is_safe' => ['html']])
        ];
    }

    public function getHead(): string
    {
        $wbsiteConfig = $this->websiteConfigRepository->find(1);
        return $this->twig->render('partials/head.html.twig', [
            'config' => $wbsiteConfig
        ]);
    }
}