<?php

namespace Tob\DataTransfer\Resource;

/**
 * Class ArrayResource
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Resource
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class ArrayResource implements ResourceInterface
{
    /** @var array */
    protected $data = [];
    /** @var string */
    protected $identifier;

    /**
     * ArrayResource constructor.
     *
     * @param array  $data
     * @param string $identifier
     */
    public function __construct(array $data, string $identifier)
    {
        $this->data = $data;
        $this->identifier = $identifier;
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function find($id) : array
    {
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
     */
    public function create(array $data) : array
    {
        return $data;
    }

    /**
     * @param array $data
     * @param array $identifier
     *
     * @return array
     */
    public function update(array $data, array $identifier) : array
    {
        return $data;
    }

    /**
     * @param array $identifier
     *
     * @return bool
     */
    public function delete(array $identifier) : bool
    {
        return true;
    }
}