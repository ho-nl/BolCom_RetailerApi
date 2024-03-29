<?php

// phpcs:ignoreFile
// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Shipment;

final class ShipmentFulfilmemt
{
    private $method;
    private $distributionParty;
    private $latestDeliveryDate;

    public function __construct(\BolCom\RetailerApi\Model\Offer\FulfilmentMethod $method = null, DistributionParty $distributionParty = null, \BolCom\RetailerApi\Model\Date $latestDeliveryDate = null)
    {
        $this->method = $method;
        $this->distributionParty = $distributionParty;
        $this->latestDeliveryDate = $latestDeliveryDate;
    }

    public function method()
    {
        return $this->method;
    }

    public function distributionParty()
    {
        return $this->distributionParty;
    }

    public function latestDeliveryDate()
    {
        return $this->latestDeliveryDate;
    }

    public function withMethod(\BolCom\RetailerApi\Model\Offer\FulfilmentMethod $method = null): ShipmentFulfilmemt
    {
        return new self($method, $this->distributionParty, $this->latestDeliveryDate);
    }

    public function withDistributionParty(DistributionParty $distributionParty = null): ShipmentFulfilmemt
    {
        return new self($this->method, $distributionParty, $this->latestDeliveryDate);
    }

    public function withLatestDeliveryDate(\BolCom\RetailerApi\Model\Date $latestDeliveryDate = null): ShipmentFulfilmemt
    {
        return new self($this->method, $this->distributionParty, $latestDeliveryDate);
    }

    public static function fromArray(array $data): ShipmentFulfilmemt
    {
        if (isset($data['method'])) {
            if (! \is_string($data['method'])) {
                throw new \InvalidArgumentException("Value for 'method' is not a string in data array");
            }

            $method = \BolCom\RetailerApi\Model\Offer\FulfilmentMethod::fromValue($data['method']);
        } else {
            $method = null;
        }

        if (isset($data['distributionParty'])) {
            if (! \is_string($data['distributionParty'])) {
                throw new \InvalidArgumentException("Value for 'distributionParty' is not a string in data array");
            }

            $distributionParty = DistributionParty::fromValue($data['distributionParty']);
        } else {
            $distributionParty = null;
        }

        if (isset($data['latestDeliveryDate'])) {
            if (! \is_string($data['latestDeliveryDate'])) {
                throw new \InvalidArgumentException("Value for 'latestDeliveryDate' is not a string in data array");
            }

            $latestDeliveryDate = \BolCom\RetailerApi\Model\Date::fromString($data['latestDeliveryDate']);
        } else {
            $latestDeliveryDate = null;
        }

        return new self(
            $method,
            $distributionParty,
            $latestDeliveryDate
        );
    }
}
