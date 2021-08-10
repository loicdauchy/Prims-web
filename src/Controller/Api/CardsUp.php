<?php

namespace App\Controller\Api;

use App\Entity\Card;
use App\Entity\User;
use App\Repository\CardRepository;
use App\Repository\UserRepository;
use App\Repository\CommerceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class CardsUp
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
     * CardsUp constructor.
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
        $user = $this->userRepo->find($data->getUser());
        $commerce = $this->commerceRepo->find($data->getCommerce());

        $card = $this->cardsRepo->findCardByUserAndCommerceId($user, $commerce);

        if(!$card){
            $card = new Card();
            $card->setUser($user);
            $card->setCommerce($commerce);
            $card->setPoints($data->getPoints());       
        }
        else{
            $card = $card[0];
            $card->setPoints($data->getPoints());
        }

        $this->em->persist($card);
        $this->em->flush();

        
        

        return [
            'message' => 'success',
            'card' => $card
        ];
    }
}