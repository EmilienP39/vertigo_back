<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder) {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setNom('admin');
        $user->setPrenom('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $password = $this->encoder->hashPassword($user, 'admin');
        $user->setPassword($password);
        $user->setEmail('admin@admin.com');
        $manager->persist($user);

        $manager->flush();
    }
}
