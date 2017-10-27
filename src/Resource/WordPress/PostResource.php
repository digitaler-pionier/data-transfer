<?php

namespace Tob\DataTransfer\Resource\WordPress;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Tob\DataTransfer\Resource\ResourceInterface;

/**
 * Class PostResource
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Tob\DataTransfer\Resource\WordPress
 * @author    Simplicity Trade GmbH <development@simplicity.ag>
 * @copyright 2014-2017 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class PostResource implements ResourceInterface
{
    /** @var Client */
    protected $client;

    /**
     * PostResource constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $id
     *
     * @return array
     * @throws \RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function find($id) : array
    {
        $response = $this->client->get('wp/v2/posts/' . $id);

        return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return array
     * @throws \RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function findAll() : array
    {
        $response = $this->client->get('wp/v2/posts');

        return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data) : array
    {
        $response = $this->client->post('POST', 'wp/v2/posts');
    }

    /**
     * @param array $data
     * @param array $identifier
     *
     * @return array
     */
    public function update(array $data, array $identifier) : array
    {
        $options = [
            'auth' => [
                'tobiasoberrauch',
                '(WgvM0aN1$TVsXad',
            ],
            'form_params' => $data,
        ];
        $response = $this->client->put( 'wp/v2/posts/' . $identifier['id'], $options);

        var_dump($response);
        exit;
    }

    /**
     * @param array $identifier
     *
     * @return bool
     */
    public function delete(array $identifier) : bool
    {
        $response = $this->client->delete( 'wp/v2/posts/' . $identifier['id']);
    }
}