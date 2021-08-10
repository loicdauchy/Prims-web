<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class CreateUser
{
    /**
     * @var UserManager
     */
    protected $userRepo;

    /**
     * @var PasswordEncoderInterface
     */
    protected $passwordEncoder;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * CreateUser constructor.
     * @param UserRepository $userRepo
     */
    public function __construct(
                                UserRepository $userRepo,
                                UserPasswordEncoderInterface $passwordEncoder,
                                EntityManagerInterface $em
                               )
    {
        $this->userRepository = $userRepo;
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function __invoke($data)
    {
        $user = $data;
        if ($this->userRepository->findOneBy(['email' => $user->getEmail()])) {
            throw new BadRequestHttpException('Cette adresse email est déjà utilisé.');
        }

        
        $pass = $this->passwordEncoder->encodePassword($user, $user->getPassword());
        $user->setPassword($pass);
        $roles[] = 'ROLE_USER';
        $user->setRoles($roles);
        $user->setAbonnement(0);

        $this->em->persist($user);
        $this->em->flush();

        return [
            'message' => 'Création de compte enregistrée.',
            'user' => $user
        ];
    }
}