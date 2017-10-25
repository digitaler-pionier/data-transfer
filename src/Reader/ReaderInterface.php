<?php

namespace Tob\DataTransfer\Reader;

/**
 * Interface ReaderInterface
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Reader
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
interface ReaderInterface
{
    /**
     * @param string $resource
     *
     * @return array
     */
    public function read(string $resource) : array;
}