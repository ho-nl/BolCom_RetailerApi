<?php

// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer\Command;

final class DeleteOffersInBulk extends \Prooph\Common\Messaging\Command
{
    use \Prooph\Common\Messaging\PayloadTrait;

    public const MESSAGE_NAME = 'BolCom\RetailerApi\Model\Offer\Command\DeleteOffersInBulk';

    protected $messageName = self::MESSAGE_NAME;

    /**
     * @return \BolCom\RetailerApi\Model\Offer\RetailerOfferIdentifier[]
     */
    public function retailerOfferIdentifier(): array
    {
        $__returnValue = [];

        foreach ($this->payload['retailerOfferIdentifier'] as $__value) {
            $__returnValue[] = \BolCom\RetailerApi\Model\Offer\RetailerOfferIdentifier::fromArray($__value);
        }

        return $__returnValue;
    }

        /**
     * @param \BolCom\RetailerApi\Model\Offer\RetailerOfferIdentifier[]|null $retailerOfferIdentifier
     */
public static function with(\BolCom\RetailerApi\Model\Offer\RetailerOfferIdentifier ...$retailerOfferIdentifier): DeleteOffersInBulk
    {
        $__array_retailerOfferIdentifier = [];

        foreach ($retailerOfferIdentifier as $__value) {
            $__array_retailerOfferIdentifier[] = $__value->toArray();
        }

        return new self([
            'retailerOfferIdentifier' => $__array_retailerOfferIdentifier,
        ]);
    }

    protected function setPayload(array $payload): void
    {
        if (! isset($payload['retailerOfferIdentifier']) || ! \is_array($payload['retailerOfferIdentifier'])) {
            throw new \InvalidArgumentException("Key 'retailerOfferIdentifier' is missing in payload or is not an array");
        }

        foreach ($payload['retailerOfferIdentifier'] as $__value) {
            if (! \is_array($__value)) {
                throw new \InvalidArgumentException("Key 'retailerOfferIdentifier' is not an array of arrays in payload");
            }
        }

        $this->payload = $payload;
    }
}
