<?php

namespace Tob\DataTransfer\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * VeranstaltungReferent
 *
 * @ORM\Entity
 * @ORM\Table(name="dbo.VERANSTALTUNG_REFERENT")
 */
class VeranstaltungReferent implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="BERUFSBEZEICHNUNG", type="string", length=255, nullable=true)
     */
    private $berufsbezeichnung;

    /**
     * @var string
     *
     * @ORM\Column(name="VORNAME", type="string", length=50, nullable=true)
     */
    private $vorname;

    /**
     * @var string
     *
     * @ORM\Column(name="NACHNAME", type="string", length=50, nullable=true)
     */
    private $nachname;

    /**
     * @var string
     *
     * @ORM\Column(name="ARBEITSSTAETTE", type="string", nullable=true)
     */
    private $arbeitsstaette;

    /**
     * @var string
     *
     * @ORM\Column(name="BILD", type="string", nullable=true)
     */
    private $bild;

    /**
     * @var integer
     *
     * @ORM\Column(name="VERBAND", type="integer", nullable=true)
     */
    private $verband;

    /**
     * @var string
     *
     * @ORM\Column(name="KENNNUMMER", type="string", nullable=true)
     */
    private $kennummer;

    /**
     * @var boolean
     *
     * @ORM\Column(name="GELOESCHT", type="boolean", nullable=true)
     */
    private $geloescht;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getBerufsbezeichnung() : ?string
    {
        return $this->berufsbezeichnung;
    }

    /**
     * @param string $berufsbezeichnung
     *
     * @return void
     */
    public function setBerufsbezeichnung(string $berufsbezeichnung)
    {
        $this->berufsbezeichnung = $berufsbezeichnung;
    }

    /**
     * @return string
     */
    public function getVorname() : string
    {
        return $this->vorname;
    }

    /**
     * @param string $vorname
     *
     * @return void
     */
    public function setVorname(string $vorname)
    {
        $this->vorname = $vorname;
    }

    /**
     * @return string
     */
    public function getNachname() : string
    {
        return $this->nachname;
    }

    /**
     * @param string $nachname
     *
     * @return void
     */
    public function setName(string $nachname)
    {
        $this->nachname = $nachname;
    }

    /**
     * @return string
     */
    public function getArbeitsstaette() : ?string
    {
        return $this->arbeitsstaette;
    }

    /**
     * @param string $arbeitsstaette
     *
     * @return void
     */
    public function setArbeitsstaette(string $arbeitsstaette)
    {
        $this->arbeitsstaette = $arbeitsstaette;
    }

    /**
     * @return string
     */
    public function getBild()
    {
        return $this->bild;
    }

    /**
     * @param string $bild
     *
     * @return void
     */
    public function setBild(string $bild)
    {
        $this->bild = $bild;
    }

    /**
     * @return int
     */
    public function getVerband() : ?int
    {
        return $this->verband;
    }

    /**
     * @param int $verband
     *
     * @return void
     */
    public function setVerband(int $verband)
    {
        $this->verband = $verband;
    }

    /**
     * @return string
     */
    public function getKennummer() : string
    {
        return $this->kennummer;
    }

    /**
     * @param string $kennummer
     *
     * @return void
     */
    public function setKennummer(string $kennummer)
    {
        $this->kennummer = $kennummer;
    }

    /**
     * @return boolean
     */
    public function getGeloescht() : bool
    {
        return $this->geloescht;
    }

    /**
     * @param bool $geloescht
     *
     * @return void
     */
    public function setGeloescht(bool $geloescht)
    {
        $this->geloescht = $geloescht;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $data = [
            'id'                => $this->getId(),
            'verband'           => $this->getVerband(),
            'vorname'           => $this->getVorname(),
            'nachname'          => $this->getNachname(),
            'arbeitsstaette'    => $this->getArbeitsstaette(),
            'berufsbezeichnung' => $this->getBerufsbezeichnung(),
            'bild'              => $this->getBild(),
            'kennummer'         => $this->getKennummer(),
        ];

        $data = array_map(
            function ($element) {
                if (is_string($element)) {
                    return utf8_encode($element);
                }

                return $element;
            }, $data
        );

        return $data;
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function populate(array $data)
    {
        $this->setGeloescht(0);

        if (array_key_exists('Vorname', $data)) {
            $this->setVorname($data['Vorname']);
        }
        if (array_key_exists('Name', $data)) {
            $this->setName($data['Name']);
        }
        if (array_key_exists('Beruf_1_TS_K', $data)) {
            $this->setBerufsbezeichnung($data['Beruf_1_TS_K']);
        }
        if (array_key_exists('Kennummer', $data)) {
            $this->setKennummer($data['Kennummer']);
        }
        if (array_key_exists('verband', $data)) {
            $this->setVerband($data['verband']);
        }
    }
}

