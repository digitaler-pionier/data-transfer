<?php

namespace Tob\DataTransfer\Service;

use Tob\DataTransfer\Resource\ResourceInterface;

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
    /** @var ResourceInterface */
    protected $reader;
    /** @var ResourceInterface */
    protected $writer;

    /**
     * DataTransferService constructor.
     *
     * @param ResourceInterface $reader
     * @param ResourceInterface $writer
     */
    public function __construct(ResourceInterface $reader, ResourceInterface $writer)
    {
        $this->reader = $reader;
        $this->writer = $writer;
    }

    /**
     * @return void
     */
    public function transfer()
    {
        $items = $this->reader->findAll();

        foreach ($items as $item) {
            $this->writer->create($item);
        }
    }
}