<?php

namespace Tob\DataTransfer\Reader;

use Doctrine\ORM\EntityManager;
use JsonSerializable;

/**
 * Class DoctrineReader
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Reader
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class DoctrineReader implements ReaderInterface
{
    /** @var EntityManager */
    protected $entityManager;

    /**
     * DoctrineReader constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $resource
     *
     * @return array
     */
    public function read(string $resource) : array
    {
        $repository = $this->entityManager->getRepository($resource);

        if (!$repository) {
            return [];
        }

        $entities = array_map(
            function (JsonSerializable $entity) {
                return $entity->jsonSerialize();
            }, $repository->findAll()
        );

        return $entities;
    }
}