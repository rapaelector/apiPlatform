<?php

// src/Entity/User.php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Util\HistoricalTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
class Drinks
{
    use HistoricalTrait;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $brandName;


    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $description;


    /**
     * @ORM\Column(type="integer",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $price;


    /**
     * @ORM\Column(type="boolean",nullable = true, options={"default" : false})
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $withMixture;

    /**
    * @ORM\ManyToMany(targetEntity="Mixture", mappedBy="drinks", cascade={"PERSIST", "DELET})
    * @Groups({"putUser", "historicPost", "read"})
    */
    private $mixtures;

    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $image;

    /**
    * @ORM\ManyToOne(targetEntity="Etablishment", inversedBy="drinks")
    */
    private $etablishment;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\InqueueCommand", inversedBy="drinkNameList")
     */
    private $inqueueCommand;

    public function __construct()
    {
        $this->mixtures = new ArrayCollection();
        $this->inqueueCommand = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

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

    public function getGlobalPrice(): ?string
    {
        return $this->globalPrice;
    }

    public function setGlobalPrice(?string $globalPrice): self
    {
        $this->globalPrice = $globalPrice;

        return $this;
    }

    public function getAlcohlic(): ?bool
    {
        return $this->alcohlic;
    }

    public function setAlcohlic(?bool $alcohlic): self
    {
        $this->alcohlic = $alcohlic;

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

    public function getBrandName(): ?string
    {
        return $this->brandName;
    }

    public function setBrandName(?string $brandName): self
    {
        $this->brandName = $brandName;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getWithMixture(): ?bool
    {
        return $this->withMixture;
    }

    public function setWithMixture(?bool $withMixture): self
    {
        $this->withMixture = $withMixture;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Mixture[]
     */
    public function getMixtures(): Collection
    {
        return $this->mixtures;
    }

    public function addMixture(Mixture $mixture): self
    {
        if (!$this->mixtures->contains($mixture)) {
            $this->mixtures[] = $mixture;
            $mixture->addDrink($this);
        }

        return $this;
    }

    public function removeMixture(Mixture $mixture): self
    {
        if ($this->mixtures->contains($mixture)) {
            $this->mixtures->removeElement($mixture);
        }

        return $this;
    }

    public function getBuyDrink(): ?BuyDrink
    {
        return $this->buyDrink;
    }

    public function setBuyDrink(?BuyDrink $buyDrink): self
    {
        $this->buyDrink = $buyDrink;

        // set (or unset) the owning side of the relation if necessary
        $newDrink = $buyDrink === null ? null : $this;
        if ($newDrink !== $buyDrink->getDrink()) {
            $buyDrink->setDrink($newDrink);
        }

        return $this;
    }

    public function getInqueueCommand(): ?InqueueCommand
    {
        return $this->inqueueCommand;
    }

    public function setInqueueCommand(?InqueueCommand $inqueueCommand): self
    {
        $this->inqueueCommand = $inqueueCommand;

        return $this;
    }

    public function addInqueueCommand(InqueueCommand $inqueueCommand): self
    {
        if (!$this->inqueueCommand->contains($inqueueCommand)) {
            $this->inqueueCommand[] = $inqueueCommand;
        }

        return $this;
    }

    public function removeInqueueCommand(InqueueCommand $inqueueCommand): self
    {
        if ($this->inqueueCommand->contains($inqueueCommand)) {
            $this->inqueueCommand->removeElement($inqueueCommand);
        }

        return $this;
    }
}
