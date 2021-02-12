<?php

namespace TeiaCardSdk\Endpoints;

use TeiaCardSdk\Client;

abstract class Endpoint
{
    /** @var string */
    protected const POST = 'POST';

    /** @var string */
    protected const GET = 'GET';

    /** @var string */
    protected const PUT = 'PUT';

    /** @var string */
    protected const DELETE = 'DELETE';

    /** @var Client */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}

