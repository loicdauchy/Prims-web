<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CardRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"read:cards"}},
 *  itemOperations={
 *      "get"={},
 *  },
 *  collectionOperations={
 *       "get"={},
 *       "cardsUp"={
 *          "method"="POST",
 *          "path"="/cards/up",
 *          "controller"=App\Controller\Api\CardsUp::class
 *       },
 *       "getCardsByCommerce"={
 *          "method"="POST",
 *          "path"="/cards/commerces",
 *          "controller"=App\Controller\Api\GetCardsByCommerce::class
 *        }
 *  }
 * )
 */
class Card
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:user", "read:cards"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Commerce::class, inversedBy="cards")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:user"})
     */
    private $commerce;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cards")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:cards"})
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:user", "read:cards"})
     */
    private $points;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommerce(): ?Commerce
    {
        return $this->commerce;
    }

    public function setCommerce(?Commerce $commerce): self
    {
        $this->commerce = $commerce;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }
}
