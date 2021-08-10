<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Entity\Card;
use App\Repository\CardRepository;
use App\Repository\UserRepository;
use App\Repository\CommerceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class GetCardsByCommerce
{
    /**
     * @var CardRepository
     */
    protected $cardsRepo;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * @var CommerceRepository
     */
    protected $commerceRepo;

    /**
     * GetCardsByCommerce constructor.
     * @param CardRepository $cardsRepo
     * @param UserRepository $userRepo
     * @param CommerceRepository $commerceRepo
     */
    public function __construct(
                                CardRepository $cardsRepo,
                                UserRepository $userRepo,
                                CommerceRepository $commerceRepo,
                                EntityManagerInterface $em
                               )
    {
        $this->cardsRepo = $cardsRepo;
        $this->userRepo = $userRepo;
        $this->commerceRepo = $commerceRepo;
        $this->em = $em;
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function __invoke($data)
    {
        $commerce = $this->commerceRepo->find($data->getCommerce());

        $cards = $this->cardsRepo->findCardsByCommerceId($commerce);

        return [
            'message' => 'success',
            'card' => $cards
        ];
    }
}