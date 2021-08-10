<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
        private $passwordEncoder;

        public function __construct(UserPasswordEncoderInterface $passwordEncoder)
        {
                $this->passwordEncoder = $passwordEncoder;
        }
    
          public function load(ObjectManager $manager)
          {
            for($i = 0; $i < 5; $i++){
                $user = new User();
             
                $user->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    '123456789'
                ));
    
                $user->setEmail('user'.$i.'@email.com');
                $user->setRoles(["ROLE_USER"]);

                $manager->persist($user);
                $manager->flush();
            }
          }
}
