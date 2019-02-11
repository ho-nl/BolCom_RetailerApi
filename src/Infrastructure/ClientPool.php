<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Infrastructure;

use BolCom\RetailerApi\Model\ClientInterface;
use BolCom\RetailerApi\Model\ClientPoolInterface;
use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Client\ClientConfig;

class ClientPool implements ClientPoolInterface
{
    /** @var array $clients */
    private $clients = [];

    /**
     * @param array $clients
     */
    public function __construct(array $clients = [])
    {
        foreach ($clients as $name => $client) {
            $this->add($name, $client);
        }
    }

    /**
     * @param string $name
     *
     * @param ClientInterface $client
     *
     * @return void
     */
    private function add(string $name, ClientInterface $client)
    {
        $this->clients[$name] = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function names(): array
    {
        return array_keys($this->clients);
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $clientName): ClientInterface
    {
        if (! isset($this->clients[$clientName])) {
            throw new \RuntimeException(sprintf('Client with name "%s" not defined or disabled.', $clientName));
        }

        return $this->clients[$clientName];
    }

    /**
     * @param ClientConfig $clientConfig
     *
     * @return ClientPoolInterface
     */
    public static function configure(ClientConfig $clientConfig): ClientPoolInterface
    {
        return new static([
            static::DEFAULT_CLIENT_NAME => new Client($clientConfig)
        ]);
    }
}
