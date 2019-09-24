<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer\CommandHandler;

use BolCom\RetailerApi\Model\Offer\Command\CreateOffer;
use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus;

interface CreateOfferHandlerInterface
{
    /**
     * @param CreateOffer $createOffer
     *
     * @throws \RuntimeException
     *
     * @return ProcessStatus
     */
    public function __invoke(CreateOffer $createOffer): ProcessStatus;
}
