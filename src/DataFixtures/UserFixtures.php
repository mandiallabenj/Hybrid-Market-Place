<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture {

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager) {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setUsername('admin');

        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);
        $user->setEmail('mandeallanbenjamin@gmail.com');
        $user->setRoles(array('ROLE_ADMIN'));

        $manager->persist($user);
        $manager->flush();
    }

}
