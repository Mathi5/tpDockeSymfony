<?php

namespace App\DataFixtures;

use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@test.fr');
        $user->setFirstName('Mathis');
        $user->setLastName('Villard');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->hasher->hashPassword(
            $user,
            'admin'
        ));
        $user->setFlag("testdeflagpourleforumensymfony");
        $manager->persist($user);

        $comment = new Message();
        $comment->setText('Bonjour, je suis un commentaire')
            ->setIpAddress('0.0.0.0');
        $manager->persist($comment);
        $comment2 = new Message();
        $comment2->setText('Il faut mettre un 20/20 à ce projet')
            ->setIpAddress('0.0.0.0');
        $manager->persist($comment2);
        $comment3 = new Message();
        $comment3->setText('Je suis d\'accord')
            ->setIpAddress('0.0.0.0');
        $manager->persist($comment3);


        $manager->flush();
    }
}
