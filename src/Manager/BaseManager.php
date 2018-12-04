<?php

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BaseManager
{
    protected $em;
    protected $validator;
    protected $passwordEncoder;

    public function __construct(EntityManagerInterface $em, ValidatorInterface $validator, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->em = $em;
        $this->validator = $validator;
        $this->passwordEncoder = $passwordEncoder;
    }
}
