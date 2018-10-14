<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer\CommandHandler;

use BolCom\RetailerApi\Model\Offer\Command\CreateOrUpdateOffer;

interface CreateOrUpdateOfferHandlerInterface
{
    public function __invoke(CreateOrUpdateOffer $createOrUpdateOffer) : void;
}
