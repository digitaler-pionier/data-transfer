<?php

namespace Tob\DataTransfer\Service;

use Tob\DataTransfer\Reader\ReaderInterface;
use Tob\DataTransfer\Writer\WriterInterface;

/**
 * Class DataTransferService
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Service
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class DataTransferService
{
    /** @var ReaderInterface */
    protected $reader;
    /** @var WriterInterface */
    protected $writer;

    /**
     * DataTransferService constructor.
     *
     * @param ReaderInterface $reader
     * @param WriterInterface $writer
     */
    public function __construct(ReaderInterface $reader, WriterInterface $writer)
    {
        $this->reader = $reader;
        $this->writer = $writer;
    }

    /**
     * @param string $sourceResource
     * @param string $targetResource
     *
     * @return void
     */
    public function transfer(string $sourceResource, string $targetResource)
    {
        $messages = $this->reader->read($sourceResource);

        $this->writer->write($targetResource, $messages);
    }
}