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
     * @ORM\Column(type="string", length=255, nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $name;

    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $brand;


    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $description;

    /**
     * @ORM\Column(type="string",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $globalPrice;

    /**
     * @ORM\Column(type="boolean",nullable = true)
     * @Groups({"read", "historicPost", "putUser"})
     */
    private $alcohlic;

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
}
