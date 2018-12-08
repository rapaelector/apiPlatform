<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
 *         "post"
 *     },
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class Mixture
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
    private $brandName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $image;

    /**
    * @ORM\ManyToMany(targetEntity="Drinks", inversedBy="mixtures")
    */
    private $drinks;

    public function __construct()
    {
        $this->drinks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

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

    public function getDrinks(): ?Drinks
    {
        return $this->drinks;
    }

    public function addDrink(Drinks $drink): self
    {
        if (!$this->drinks->contains($drink)) {
            $this->drinks[] = $drink;
        }

        return $this;
    }

    public function removeDrink(Drinks $drink): self
    {
        if ($this->drinks->contains($drink)) {
            $this->drinks->removeElement($drink);
        }

        return $this;
    }
}
