<?php

namespace Tob\DataTransfer\Reader;

use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class CsvReader
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Reader
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class CsvReader implements ReaderInterface
{
    /**
     * @param string $resource
     *
     * @return array
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     */
    public function read(string $resource) : array
    {
        $normalizers = [new ObjectNormalizer()];
        $encoders = [new CsvEncoder(';')];
        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->decode(file_get_contents($resource), 'csv');
    }
}