<?php

namespace Tob\DataTransfer\Resource;

use RuntimeException;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class CsvResource
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Resource
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class CsvResource implements ResourceInterface
{
    /** @var array */
    protected $data = [];
    /** @var string */
    protected $identifier;

    /**
     * CsvResource constructor.
     *
     * @param string $resource
     * @param string $identifier
     *
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     */
    public function __construct(string $resource, string $identifier)
    {
        $normalizers = [new ObjectNormalizer()];
        $encoders = [new CsvEncoder(';')];
        $serializer = new Serializer($normalizers, $encoders);

        $this->data = $serializer->decode(file_get_contents($resource), 'csv');
        $this->identifier = $identifier;
    }

    /**
     * @param $id
     *
     * @return array
     * @throws RuntimeException
     */
    public function find($id) : array
    {
        if (!is_array($this->data)) {
            throw new RuntimeException('There was an error during reading csv');
        }

        foreach ($this->data as $item) {
            if ($item[$this->identifier] === $id) {
                return $item;
            }
        }
    }

    /**
     * @return array
     */
    public function findAll() : array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws RuntimeException
     */
    public function create(array $data) : array
    {
        throw new RuntimeException('This resource is read only');
    }

    /**
     * @param array $data
     * @param array $identifier
     *
     * @return array
     * @throws RuntimeException
     */
    public function update(array $data, array $identifier) : array
    {
        throw new RuntimeException('This resource is read only');
    }

    /**
     * @param array $identifier
     *
     * @return bool
     * @throws RuntimeException
     */
    public function delete(array $identifier) : bool
    {
        throw new RuntimeException('This resource is read only');
    }
}