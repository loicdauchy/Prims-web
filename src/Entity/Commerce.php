<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommerceRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CommerceRepository::class)
 */
class Commerce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:user"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read:user"})
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read:user"})
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read:user"})
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read:user"})
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commerces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patron;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="commercesAdmin")
     */
    private $admin;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $tel;

    /**
     * @ORM\OneToMany(targetEntity=Card::class, mappedBy="commerce")
     */
    private $cards;

    public function __construct()
    {
        $this->admin = new ArrayCollection();
        $this->cards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPatron(): ?User
    {
        return $this->patron;
    }

    public function setPatron(?User $patron): self
    {
        $this->patron = $patron;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getAdmin(): Collection
    {
        return $this->admin;
    }

    public function addAdmin(User $admin): self
    {
        if (!$this->admin->contains($admin)) {
            $this->admin[] = $admin;
        }

        return $this;
    }

    public function removeAdmin(User $admin): self
    {
        $this->admin->removeElement($admin);

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection|Card[]
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function addCard(Card $card): self
    {
        if (!$this->cards->contains($card)) {
            $this->cards[] = $card;
            $card->setCommerce($this);
        }

        return $this;
    }

    public function removeCard(Card $card): self
    {
        if ($this->cards->removeElement($card)) {
            // set the owning side to null (unless already changed)
            if ($card->getCommerce() === $this) {
                $card->setCommerce(null);
            }
        }

        return $this;
    }

}
