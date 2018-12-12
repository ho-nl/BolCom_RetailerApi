<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Client;

use GuzzleHttp\Psr7\StreamDecoratorTrait;
use Psr\Http\Message\StreamInterface;

class JsonResponse implements StreamInterface
{
    use StreamDecoratorTrait;

    public function json()
    {
        return \GuzzleHttp\json_decode((string) $this->getContents(), true);
    }
}
