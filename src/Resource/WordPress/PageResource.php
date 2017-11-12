<?php

namespace Tob\DataTransfer\Resource\WordPress;

use GuzzleHttp\ClientInterface;
use Tob\DataTransfer\Resource\ResourceInterface;

/**
 * Class PageResource
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Resource\WordPress
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class PageResource implements ResourceInterface
{
    /** @var ClientInterface */
    protected $client;

    /**
     * PageResource constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function find($id) : array
    {
        $response = $this->client->get('wp/v2/pages/' . $id);

        return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return array
     */
    public function findAll() : array
    {
        $response = $this->client->get('wp/v2/pages');

        return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $data) : array
    {
        $response = $this->client->request('POST', '/wp/v2/pages');
    }

    /**
     * @param array $data
     * @param array $identifier
     *
     * @return array
     */
    public function update(array $data, array $identifier) : array
    {
        // TODO: Implement update() method.
    }

    /**
     * @param array $identifier
     *
     * @return bool
     */
    public function delete(array $identifier) : bool
    {
        // TODO: Implement delete() method.
    }
}