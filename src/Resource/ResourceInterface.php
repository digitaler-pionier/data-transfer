<?php

namespace Tob\DataTransfer\Resource;

/**
 * Interface ResourceInterface
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Resource
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
interface ResourceInterface
{
    /**
     * @param $id
     *
     * @return array
     */
    public function find($id) : array;

    /**
     * @return array
     */
    public function findAll() : array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data) : array;

    /**
     * @param array $data
     * @param array $identifier
     *
     * @return array
     */
    public function update(array $data, array $identifier) : array;

    /**
     * @param array $identifier
     *
     * @return bool
     */
    public function delete(array $identifier) : bool;
}