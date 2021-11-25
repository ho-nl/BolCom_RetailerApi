<?php

// phpcs:ignoreFile
// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer\Query;

final class ExportFileRequest extends \Prooph\Common\Messaging\Query
{
    use \Prooph\Common\Messaging\PayloadTrait;

    const MESSAGE_NAME = 'BolCom\RetailerApi\Model\Offer\Query\ExportFileRequest';

    protected $messageName = self::MESSAGE_NAME;

    public static function with(string $format): ExportFileRequest
    {
        return new self([
            'format' => $format,
        ]);
    }

    protected function setPayload(array $payload)
    {
        if (! isset($payload['format']) || ! \is_string($payload['format'])) {
            throw new \InvalidArgumentException("Key 'format' is missing in payload or is not a string");
        }

        $this->payload = $payload;
    }
}
