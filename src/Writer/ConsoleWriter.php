<?php

namespace Tob\DataTransfer\Writer;

/**
 * Class ConsoleWriter
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Writer
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class ConsoleWriter implements WriterInterface
{
    /**
     * @param string $resource
     * @param array  $messages
     *
     * @return void
     */
    public function write(string $resource, array $messages)
    {
        var_dump($messages);
    }
}