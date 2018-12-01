<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource(
 *     forceEager=false,
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=false},
 *     denormalizationContext={"groups"={"historicPost"}},
 *     collectionOperations={
 *         "get",
 *         "post"={"access_control"="is_granted('ROLE_USER')"}
 *     },
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class BuyDrink
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $billNumber;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Drinks", cascade={"persist", "remove"})
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $drink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $totalPricePerDrink;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $totalPrice;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Etablishment", cascade={"persist", "remove"})
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $etablishment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBillNumber(): ?string
    {
        return $this->billNumber;
    }

    public function setBillNumber(?string $billNumber): self
    {
        $this->billNumber = $billNumber;

        return $this;
    }

    public function getDrink(): ?Drinks
    {
        return $this->drink;
    }

    public function setDrink(?Drinks $drink): self
    {
        $this->drink = $drink;

        return $this;
    }

    public function getTotalPricePerDrink(): ?string
    {
        return $this->totalPricePerDrink;
    }

    public function setTotalPricePerDrink(?string $totalPricePerDrink): self
    {
        $this->totalPricePerDrink = $totalPricePerDrink;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(string $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getYes(): ?string
    {
        return $this->yes;
    }

    public function setYes(string $yes): self
    {
        $this->yes = $yes;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

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
