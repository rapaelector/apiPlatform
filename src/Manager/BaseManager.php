<?php

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;

class BaseManager
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
