<?php

// phpcs:ignoreFile
// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Order;

final class OrderItem
{
    private $orderItemId;
    private $fulfilment;
    private $offer;
    private $product;
    private $quantity;
    private $quantityShipped;
    private $quantityCancelled;
    private $unitPrice;
    private $commission;
    private $cancellationRequest;
    private $selectedDeliveryWindow;

    public function __construct(OrderItemId $orderItemId, OrderFulfilmemt $fulfilment, OrderOffer $offer, OrderProduct $product, Quantity $quantity, Quantity $quantityShipped = null, Quantity $quantityCancelled = null, Price $unitPrice, \BolCom\RetailerApi\Model\CurrencyAmount $commission, bool $cancellationRequest = null, SelectedDeliveryWindow $selectedDeliveryWindow = null)
    {
        $this->orderItemId = $orderItemId;
        $this->fulfilment = $fulfilment;
        $this->offer = $offer;
        $this->product = $product;
        $this->quantity = $quantity;
        $this->quantityShipped = $quantityShipped;
        $this->quantityCancelled = $quantityCancelled;
        $this->unitPrice = $unitPrice;
        $this->commission = $commission;
        $this->cancellationRequest = $cancellationRequest;
        $this->selectedDeliveryWindow = $selectedDeliveryWindow;
    }

    public function orderItemId(): OrderItemId
    {
        return $this->orderItemId;
    }

    public function fulfilment(): OrderFulfilmemt
    {
        return $this->fulfilment;
    }

    public function offer(): OrderOffer
    {
        return $this->offer;
    }

    public function product(): OrderProduct
    {
        return $this->product;
    }

    public function quantity(): Quantity
    {
        return $this->quantity;
    }

    public function quantityShipped()
    {
        return $this->quantityShipped;
    }

    public function quantityCancelled()
    {
        return $this->quantityCancelled;
    }

    public function unitPrice(): Price
    {
        return $this->unitPrice;
    }

    public function commission(): \BolCom\RetailerApi\Model\CurrencyAmount
    {
        return $this->commission;
    }

    public function cancellationRequest()
    {
        return $this->cancellationRequest;
    }

    public function selectedDeliveryWindow()
    {
        return $this->selectedDeliveryWindow;
    }

    public function withOrderItemId(OrderItemId $orderItemId): OrderItem
    {
        return new self($orderItemId, $this->fulfilment, $this->offer, $this->product, $this->quantity, $this->quantityShipped, $this->quantityCancelled, $this->unitPrice, $this->commission, $this->cancellationRequest, $this->selectedDeliveryWindow);
    }

    public function withFulfilment(OrderFulfilmemt $fulfilment): OrderItem
    {
        return new self($this->orderItemId, $fulfilment, $this->offer, $this->product, $this->quantity, $this->quantityShipped, $this->quantityCancelled, $this->unitPrice, $this->commission, $this->cancellationRequest, $this->selectedDeliveryWindow);
    }

    public function withOffer(OrderOffer $offer): OrderItem
    {
        return new self($this->orderItemId, $this->fulfilment, $offer, $this->product, $this->quantity, $this->quantityShipped, $this->quantityCancelled, $this->unitPrice, $this->commission, $this->cancellationRequest, $this->selectedDeliveryWindow);
    }

    public function withProduct(OrderProduct $product): OrderItem
    {
        return new self($this->orderItemId, $this->fulfilment, $this->offer, $product, $this->quantity, $this->quantityShipped, $this->quantityCancelled, $this->unitPrice, $this->commission, $this->cancellationRequest, $this->selectedDeliveryWindow);
    }

    public function withQuantity(Quantity $quantity): OrderItem
    {
        return new self($this->orderItemId, $this->fulfilment, $this->offer, $this->product, $quantity, $this->quantityShipped, $this->quantityCancelled, $this->unitPrice, $this->commission, $this->cancellationRequest, $this->selectedDeliveryWindow);
    }

    public function withQuantityShipped(Quantity $quantityShipped = null): OrderItem
    {
        return new self($this->orderItemId, $this->fulfilment, $this->offer, $this->product, $this->quantity, $quantityShipped, $this->quantityCancelled, $this->unitPrice, $this->commission, $this->cancellationRequest, $this->selectedDeliveryWindow);
    }

    public function withQuantityCancelled(Quantity $quantityCancelled = null): OrderItem
    {
        return new self($this->orderItemId, $this->fulfilment, $this->offer, $this->product, $this->quantity, $this->quantityShipped, $quantityCancelled, $this->unitPrice, $this->commission, $this->cancellationRequest, $this->selectedDeliveryWindow);
    }

    public function withUnitPrice(Price $unitPrice): OrderItem
    {
        return new self($this->orderItemId, $this->fulfilment, $this->offer, $this->product, $this->quantity, $this->quantityShipped, $this->quantityCancelled, $unitPrice, $this->commission, $this->cancellationRequest, $this->selectedDeliveryWindow);
    }

    public function withCommission(\BolCom\RetailerApi\Model\CurrencyAmount $commission): OrderItem
    {
        return new self($this->orderItemId, $this->fulfilment, $this->offer, $this->product, $this->quantity, $this->quantityShipped, $this->quantityCancelled, $this->unitPrice, $commission, $this->cancellationRequest, $this->selectedDeliveryWindow);
    }

    public function withCancellationRequest(bool $cancellationRequest = null): OrderItem
    {
        return new self($this->orderItemId, $this->fulfilment, $this->offer, $this->product, $this->quantity, $this->quantityShipped, $this->quantityCancelled, $this->unitPrice, $this->commission, $cancellationRequest, $this->selectedDeliveryWindow);
    }

    public function withSelectedDeliveryWindow(SelectedDeliveryWindow $selectedDeliveryWindow = null): OrderItem
    {
        return new self($this->orderItemId, $this->fulfilment, $this->offer, $this->product, $this->quantity, $this->quantityShipped, $this->quantityCancelled, $this->unitPrice, $this->commission, $this->cancellationRequest, $selectedDeliveryWindow);
    }

    public static function fromArray(array $data): OrderItem
    {
        if (! isset($data['orderItemId']) || ! \is_string($data['orderItemId'])) {
            throw new \InvalidArgumentException("Key 'orderItemId' is missing in data array or is not a string");
        }

        $orderItemId = OrderItemId::fromString($data['orderItemId']);

        if (! isset($data['fulfilment']) || ! \is_array($data['fulfilment'])) {
            throw new \InvalidArgumentException("Key 'fulfilment' is missing in data array or is not an array");
        }

        $fulfilment = OrderFulfilmemt::fromArray($data['fulfilment']);

        if (! isset($data['offer']) || ! \is_array($data['offer'])) {
            throw new \InvalidArgumentException("Key 'offer' is missing in data array or is not an array");
        }

        $offer = OrderOffer::fromArray($data['offer']);

        if (! isset($data['product']) || ! \is_array($data['product'])) {
            throw new \InvalidArgumentException("Key 'product' is missing in data array or is not an array");
        }

        $product = OrderProduct::fromArray($data['product']);

        if (! isset($data['quantity']) || ! \is_int($data['quantity'])) {
            throw new \InvalidArgumentException("Key 'quantity' is missing in data array or is not a int");
        }

        $quantity = Quantity::fromScalar($data['quantity']);

        if (isset($data['quantityShipped'])) {
            if (! \is_int($data['quantityShipped'])) {
                throw new \InvalidArgumentException("Value for 'quantityShipped' is not a int in data array");
            }

            $quantityShipped = Quantity::fromScalar($data['quantityShipped']);
        } else {
            $quantityShipped = null;
        }

        if (isset($data['quantityCancelled'])) {
            if (! \is_int($data['quantityCancelled'])) {
                throw new \InvalidArgumentException("Value for 'quantityCancelled' is not a int in data array");
            }

            $quantityCancelled = Quantity::fromScalar($data['quantityCancelled']);
        } else {
            $quantityCancelled = null;
        }

        if (! isset($data['unitPrice']) || (! \is_float($data['unitPrice']) && ! \is_int($data['unitPrice']))) {
            throw new \InvalidArgumentException("Key 'unitPrice' is missing in data array or is not a float");
        }

        $unitPrice = Price::fromScalar($data['unitPrice']);

        if (! isset($data['commission']) || (! \is_float($data['commission']) && ! \is_int($data['commission']))) {
            throw new \InvalidArgumentException("Key 'commission' is missing in data array or is not a float");
        }

        $commission = \BolCom\RetailerApi\Model\CurrencyAmount::fromScalar($data['commission']);

        if (isset($data['cancellationRequest'])) {
            if (! \is_bool($data['cancellationRequest'])) {
                throw new \InvalidArgumentException("Value for 'cancellationRequest' is not a bool in data array");
            }

            $cancellationRequest = $data['cancellationRequest'];
        } else {
            $cancellationRequest = null;
        }

        if (isset($data['selectedDeliveryWindow'])) {
            if (! \is_array($data['selectedDeliveryWindow'])) {
                throw new \InvalidArgumentException("Value for 'selectedDeliveryWindow' is not an array in data array");
            }

            $selectedDeliveryWindow = SelectedDeliveryWindow::fromArray($data['selectedDeliveryWindow']);
        } else {
            $selectedDeliveryWindow = null;
        }

        return new self(
            $orderItemId,
            $fulfilment,
            $offer,
            $product,
            $quantity,
            $quantityShipped,
            $quantityCancelled,
            $unitPrice,
            $commission,
            $cancellationRequest,
            $selectedDeliveryWindow
        );
    }
}
