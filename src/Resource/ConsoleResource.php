<?php

namespace Tob\DataTransfer\Resource;

/**
 * Class ConsoleResource
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Resource
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class ConsoleResource implements ResourceInterface
{
    /**
     * @param $id
     *
     * @return array
     */
    public function find($id) : array
    {
        // TODO: Implement find() method.
    }

    /**
     * @return array
     */
    public function findAll() : array
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data) : array
    {
        var_dump($data);
    }

    /**
     * @param array $data
     * @param array $identifier
     *
     * @return array
     */
    public function update(array $data, array $identifier) : array
    {
        // TODO: Implement update() method.
    }

    /**
     * @param array $identifier
     *
     * @return bool
     */
    public function delete(array $identifier) : bool
    {
        // TODO: Implement delete() method.
    }
}