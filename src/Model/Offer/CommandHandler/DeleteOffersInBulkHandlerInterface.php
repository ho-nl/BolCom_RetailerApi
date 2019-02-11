<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer\CommandHandler;

use BolCom\RetailerApi\Model\Offer\Command\DeleteOffersInBulk;

interface DeleteOffersInBulkHandlerInterface
{
    /**
     * @param DeleteOffersInBulk $deleteOffersInBulk
     *
     * @return void
     */
    public function __invoke(DeleteOffersInBulk $deleteOffersInBulk);
}
