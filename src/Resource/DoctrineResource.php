<?php

namespace Tob\DataTransfer\Resource;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use JsonSerializable;
use RuntimeException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class DoctrineResource
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Resource
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class DoctrineResource implements ResourceInterface
{
    /** @var EntityManager */
    protected $entityManager;
    /** @var string */
    protected $entityName;

    /**
     * DoctrineResource constructor.
     *
     * @param EntityManager $entityManager
     * @param string        $entityName
     */
    public function __construct(EntityManager $entityManager, string $entityName)
    {
        $this->entityManager = $entityManager;
        $this->entityName = $entityName;
    }

    /**
     * @param $id
     *
     * @return array
     * @throws \RuntimeException
     */
    public function find($id) : array
    {
        /** @var JsonSerializable $entity */
        $entity = $this->getRepository()->find($id);

        if (!$entity) {
            throw new RuntimeException(sprintf('Entity with id %s not found', $id));
        }

        return $this->toArray($entity);
    }

    /**
     * @return array
     *
     * @throws \RuntimeException
     */
    public function findAll() : array
    {
        return array_map([$this, 'toArray'], $this->getRepository()->findAll());
    }

    /**
     * @param array $data
     *
     * @return array
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     * @throws \Symfony\Component\Serializer\Exception\RuntimeException
     * @throws \Symfony\Component\Serializer\Exception\LogicException
     * @throws \Symfony\Component\Serializer\Exception\InvalidArgumentException
     * @throws \Symfony\Component\Serializer\Exception\ExtraAttributesException
     * @throws \Symfony\Component\Serializer\Exception\BadMethodCallException
     */
    public function create(array $data) : array
    {
        $entity = $this->createEntity($data);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $data;
    }

    /**
     * @param array $data
     * @param array $identifier
     *
     * @return array
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     * @throws \Symfony\Component\Serializer\Exception\RuntimeException
     * @throws \Symfony\Component\Serializer\Exception\LogicException
     * @throws \Symfony\Component\Serializer\Exception\InvalidArgumentException
     * @throws \Symfony\Component\Serializer\Exception\ExtraAttributesException
     * @throws \Symfony\Component\Serializer\Exception\BadMethodCallException
     */
    public function update(array $data, array $identifier) : array
    {
        $entity = $this->createEntity($data);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $data;
    }

    /**
     * @param array $identifier
     *
     * @return bool
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(array $identifier) : bool
    {
        $entity = $this->entityManager->find($this->entityName, $identifier);

        if ($entity) {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
        }
    }

    /**
     * @return EntityRepository
     * @throws RuntimeException
     */
    protected function getRepository() : EntityRepository
    {
        $repository = $this->entityManager->getRepository($this->entityName);

        if (!$repository) {
            throw new RuntimeException(sprintf('Repository for entity %s not found', $this->entityName));
        }

        return $repository;
    }

    /**
     * @param mixed $entity
     *
     * @return array
     */
    protected function toArray($entity) : array
    {
        if ($entity instanceof JsonSerializable) {

            return $entity->jsonSerialize();
        }

        return get_object_vars($entity);
    }

    /**
     * @param array $data
     *
     * @return JsonSerializable
     *
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     * @throws \Symfony\Component\Serializer\Exception\RuntimeException
     * @throws \Symfony\Component\Serializer\Exception\LogicException
     * @throws \Symfony\Component\Serializer\Exception\InvalidArgumentException
     * @throws \Symfony\Component\Serializer\Exception\ExtraAttributesException
     * @throws \Symfony\Component\Serializer\Exception\BadMethodCallException
     */
    protected function createEntity(array $data) : JsonSerializable
    {
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers);

        return $serializer->denormalize($data, $this->entityName);
    }
}