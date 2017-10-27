<?php

namespace Tob\DataTransfer\Service;

use Tob\DataTransfer\Resource\ResourceInterface;

/**
 * Class DataDifferenceService
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Service
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class DataSynchronizeService
{
    /** @var ResourceInterface */
    protected $primaryResource;
    /** @var ResourceInterface */
    protected $secondaryResource;
    /** @var mixed */
    protected $primaryKey;

    /**
     * DataSynchronizeService constructor.
     *
     * @param ResourceInterface $primaryResource
     * @param ResourceInterface $secondaryResource
     * @param mixed             $primaryKey
     */
    public function __construct(ResourceInterface $primaryResource, ResourceInterface $secondaryResource, $primaryKey)
    {
        $this->primaryResource = $primaryResource;
        $this->secondaryResource = $secondaryResource;
        $this->primaryKey = $primaryKey;
    }

    /**
     * @return void
     */
    public function synchronize()
    {
        $primaryMessages = $this->primaryResource->findAll();
        $primaryIdentifiers = array_map([$this, 'extractIdentifierValue'], $primaryMessages);

        $secondaryMessages = $this->secondaryResource->findAll();
        $secondaryIdentifiers = array_map([$this, 'extractIdentifierValue'], $secondaryMessages);

        // Neuer Datensatz
        $toCreate = array_diff($primaryIdentifiers, $secondaryIdentifiers);
        foreach ($toCreate as $id) {
            $item = $this->primaryResource->find($id);
            $this->secondaryResource->create($item);
        }

        // Geänderter Datensatz
        $toUpdate = array_intersect($primaryIdentifiers, $secondaryIdentifiers);
        foreach ($toUpdate as $id) {
            $item = $this->primaryResource->find($id);
            $this->secondaryResource->update($item, [$this->primaryKey => $id]);
        }

        // Gelöschter Datensatz
        $toRemove = array_diff($secondaryIdentifiers, $primaryIdentifiers);
        foreach ($toRemove as $id) {
            $this->secondaryResource->delete([$this->primaryKey => $id]);
        }

        print('create: ' . implode(',', $toCreate) . PHP_EOL);
        print('update: ' . implode(',', $toUpdate) . PHP_EOL);
        print('remove: ' . implode(',', $toRemove) . PHP_EOL);

    }

    /**
     * @param array $message
     *
     * @return mixed
     */
    public function extractIdentifierValue(array $message)
    {
        return $message[$this->primaryKey];
    }
}