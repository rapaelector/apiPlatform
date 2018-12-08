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
 *     collectionOperations={
 *         "get",
 *         "post"
 *     },
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class DrinkOfEtablishment
{
    use HistoricalTrait;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\OneToOne(targetEntity="Drinks", cascade={"PERSIST"})
    */
    private $drinks;

    /**
    * @ORM\OneToOne(targetEntity="Etablishment", cascade={"PERSIST"})
    */
    private $etablishment;

    /**
     * @ORM\Column(type="integer", length=255, nullable = true)
     * @Groups({"read"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read"})
     */
    private $botlePrice;


    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read"})
     */
    private $singleDrinkPrice;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBotlePrice(): ?string
    {
        return $this->botlePrice;
    }

    public function setBotlePrice(?string $botlePrice): self
    {
        $this->botlePrice = $botlePrice;

        return $this;
    }

    public function getSingleDrinkPrice(): ?string
    {
        return $this->singleDrinkPrice;
    }

    public function setSingleDrinkPrice(?string $singleDrinkPrice): self
    {
        $this->singleDrinkPrice = $singleDrinkPrice;

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
}
