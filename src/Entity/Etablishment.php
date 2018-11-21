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
 *         "post"={"access_control"="is_granted('ROLE_USER')"}
 *     },
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class Etablishment
{
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
    private $nameEtablishment;

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
     * @ORM\Column(type="boolean",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $partner;

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
}
