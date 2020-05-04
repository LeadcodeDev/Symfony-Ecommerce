<?php
namespace App\Services;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserSecurityService
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function setupUser(User $user): void
    {
        $password = $this->passwordEncoder->encodePassword($user, $user->getPassword());

        $user->setPassword($password);
    }
}