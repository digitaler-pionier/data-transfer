<?php

namespace Tob\DataTransfer\Writer;

/**
 * Interface WriterInterface
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Writer
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
interface WriterInterface
{
    /**
     * @param string $resource
     * @param array  $messages
     *
     * @return void
     */
    public function write(string $resource, array $messages);
}