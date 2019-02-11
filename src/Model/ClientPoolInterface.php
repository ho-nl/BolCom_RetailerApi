<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model;

interface ClientPoolInterface
{
    const DEFAULT_CLIENT_NAME = 'default';

    /**
     * @return array
     */
    public function names(): array;

    /**
     * @param string $clientName
     *
     * @return ClientInterface
     */
    public function get(string $clientName): ClientInterface;
}
