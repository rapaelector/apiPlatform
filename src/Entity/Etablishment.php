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
 *         "post"={"access_control"="is_granted('ROLE_USER')"}
 *     },
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class Etablishment
{

    public function __construct()
    {
        $this->listImage = array();
        $this->drinks = new ArrayCollection();
    }
    use HistoricalTrait;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $name;

    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $address;


    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $phone;

    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $description;

    /**
     * @ORM\Column(type="boolean",nullable = true, options={"default" : false})
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $type;

    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $longitude;

    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $logo;

    /**
     * @ORM\Column(type="array",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $listImage;

    /**
     * @ORM\Column(type="time",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $openingHour;

    /**
     * @ORM\Column(type="time",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $closingHour;

    /**
    * @ORM\OneToMany(targetEntity="Drinks", mappedBy="etablishment", cascade={"PERSIST"})
    * @Groups({"putUser", "historicPost", "read"})
    */
    private $drinks;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameEtablishment(): ?string
    {
        return $this->nameEtablishment;
    }

    public function setNameEtablishment(?string $nameEtablishment): self
    {
        $this->nameEtablishment = $nameEtablishment;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

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

    public function getPartner(): ?bool
    {
        return $this->partner;
    }

    public function setPartner(?bool $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getListImage(): ?array
    {
        return $this->listImage;
    }

    public function setListImage(?array $listImage): self
    {
        $this->listImage = $listImage;

        return $this;
    }

    public function getOpeningHour(): ?\DateTimeInterface
    {
        return $this->openingHour;
    }

    public function setOpeningHour(?\DateTimeInterface $openingHour): self
    {
        $this->openingHour = $openingHour;

        return $this;
    }

    public function getClosingHour(): ?\DateTimeInterface
    {
        return $this->closingHour;
    }

    public function setClosingHour(?\DateTimeInterface $closingHour): self
    {
        $this->closingHour = $closingHour;

        return $this;
    }

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(?bool $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Drinks[]
     */
    public function getDrinks(): Collection
    {
        return $this->drinks;
    }

    public function addDrink(Drinks $drink): self
    {
        if (!$this->drinks->contains($drink)) {
            $this->drinks[] = $drink;
            $drink->setEtablishment($this);
        }

        return $this;
    }

    public function removeDrink(Drinks $drink): self
    {
        if ($this->drinks->contains($drink)) {
            $this->drinks->removeElement($drink);
            // set the owning side to null (unless already changed)
            if ($drink->getEtablishment() === $this) {
                $drink->setEtablishment(null);
            }
        }

        return $this;
    }
}
