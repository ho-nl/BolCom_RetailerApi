<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Client;

interface ClientConfigInterface
{
    public function clientId(): string;

    public function clientSecret(): string;

    public function clientUrl(): string;

    public function accessTokenPath(): string;
}
