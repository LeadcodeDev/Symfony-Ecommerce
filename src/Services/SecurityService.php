<?php
namespace App\Services;

use Symfony\Component\Security\Core\Security;

class SecurityService {

    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function isLogin()
    {
        return $this->security->getUser() ? true : false;
    }
}