<?php

namespace Tob\DataTransfer\Writer;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class DoctrineWriter
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Writer
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class DoctrineWriter implements WriterInterface
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
     * @param array  $messages
     *
     * @return void
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     * @throws \Symfony\Component\Serializer\Exception\RuntimeException
     * @throws \Symfony\Component\Serializer\Exception\LogicException
     * @throws \Symfony\Component\Serializer\Exception\InvalidArgumentException
     * @throws \Symfony\Component\Serializer\Exception\ExtraAttributesException
     * @throws \Symfony\Component\Serializer\Exception\BadMethodCallException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     */
    public function write(string $resource, array $messages)
    {
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers);

        foreach ($messages as $message) {
            $entity = $serializer->denormalize($message, $resource);

            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();
    }
}