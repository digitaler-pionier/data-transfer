<?php

namespace Tob\DataTransfer\Resource\MicrosoftOffice;

use PhpOffice\PhpWord\IOFactory as WordFactory;
use PhpOffice\PhpWord\PhpWord;

/**
 * Class WordResource
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Resource\MicrosoftOffice
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class WordResource
{
    /**
     * @param string $source
     *
     * @return PhpWord
     */
    public function read(string $source) : PhpWord
    {
        return WordFactory::load($source);

    }

    /**
     * @param string  $source
     * @param PhpWord $phpWord
     *
     * @return void
     */
    public function writer(string $source, PhpWord $phpWord)
    {
        $writers = ['Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf'];
        foreach ($writers as $format => $extension) {
            if (null !== $extension) {
                $phpWord->save('', $format);
            }
        }
    }
}