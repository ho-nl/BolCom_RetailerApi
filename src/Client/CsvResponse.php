<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Client;

use GuzzleHttp\Psr7\StreamDecoratorTrait;
use Psr\Http\Message\StreamInterface;

class CsvResponse implements StreamInterface
{
    use StreamDecoratorTrait;

    public function csv()
    {
    	$data = [];
		foreach (explode("\n", $this->getContents()) as $line) {
			$line = trim($line);
			if (!$line) continue;
			$data[] = str_getcsv($line);
		}
        return $data;
    }
}
