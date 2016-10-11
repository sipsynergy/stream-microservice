<?php

namespace App;

use Doctrine\ORM\EntityManager;

/**
 * Class ResourceAbstract.
 */
abstract class ResourceAbstract
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager = null;


    /**
     * Construct.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}