<?php

namespace App\Util;

use Doctrine\ORM\Mapping as ORM;

trait HistoricalTrait
{
    /**
    * @ORM\Column(type="datetime", nullable=true)
    */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    public function getCreateAt()
    {
        return $this->createdAt;
    }
    public function getUpdateAt()
    {
        return $this->updatedAt;
    }

    public function setCreateAt($createAt)
    {
        $this->createdAt= $createAt;
    }
    public function setUpdateAt($updateAt)
    {
        $this->updatedAt= $updateAt;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt= new \DateTime();
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->updatedAt= new \DateTime();
    }
}
