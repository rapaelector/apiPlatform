<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InqueueCommandRepository")
 */
class InqueueCommand
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\BuyDrink", cascade={"persist", "remove"})
     */
    private $bill;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Etablishment", cascade={"persist", "remove"})
     */
    private $etablishment;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $orderDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Drinks", mappedBy="inqueueCommand")
     */
    private $drinkNameList;

    public function __construct()
    {
        $this->drinkNameList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEtablishment(): ?Etablishment
    {
        return $this->etablishment;
    }

    public function setEtablishment(?Etablishment $etablishment): self
    {
        $this->etablishment = $etablishment;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(?\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * @return Collection|Drinks[]
     */
    public function getDrinkNameList(): Collection
    {
        return $this->drinkNameList;
    }

    public function addDrinkNameList(Drinks $drinkNameList): self
    {
        if (!$this->drinkNameList->contains($drinkNameList)) {
            $this->drinkNameList[] = $drinkNameList;
            $drinkNameList->setInqueueCommand($this);
        }

        return $this;
    }

    public function removeDrinkNameList(Drinks $drinkNameList): self
    {
        if ($this->drinkNameList->contains($drinkNameList)) {
            $this->drinkNameList->removeElement($drinkNameList);
            // set the owning side to null (unless already changed)
            if ($drinkNameList->getInqueueCommand() === $this) {
                $drinkNameList->setInqueueCommand(null);
            }
        }

        return $this;
    }
}
