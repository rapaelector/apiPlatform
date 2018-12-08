<?php

// src/Entity/User.php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Util\HistoricalTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource(
 *     forceEager=false,
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=false},
 *     denormalizationContext={"groups"={"historicPost"}},
 *     collectionOperations={
 *         "get",
 *         "post"
 *     },
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class Historic
{
    use HistoricalTrait;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\ManyToOne(targetEntity="User", inversedBy="historic")
    */
    private $user;

    /**
    * @ORM\OneToOne(targetEntity="Drinks", cascade={"PERSIST"})
    * @Groups({"read","historicPost", "putUser"})
    */
    private $drinks;

    /**
    * @ORM\OneToOne(targetEntity="Etablishment", cascade={"PERSIST"})
    * @Groups({"read","historicPost", "putUser"})
    */
    private $etablishment;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $orderType;

    /**
     * @ORM\Column(type="integer",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $orderDate;
    /**
     * @ORM\OneToOne(targetEntity="BuyDrink", cascade={"PERSIST"})
     */
    private $bill;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderType(): ?string
    {
        return $this->orderType;
    }

    public function setOrderType(?string $orderType): self
    {
        $this->orderType = $orderType;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

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

    public function getDrinks(): ?Drinks
    {
        return $this->drinks;
    }

    public function setDrinks(?Drinks $drinks): self
    {
        $this->drinks = $drinks;

        return $this;
    }

    public function getEtablishment(): ?Etablishment
    {
        return $this->etablishment;
    }

    public function setEtablishment(?Etablishment $etablishment): self
    {
        $this->etablishment = $etablishment;

        return $this;
    }

    public function getBill(): ?BuyDrink
    {
        return $this->bill;
    }

    public function setBill(?BuyDrink $bill): self
    {
        $this->bill = $bill;

        return $this;
    }

}
