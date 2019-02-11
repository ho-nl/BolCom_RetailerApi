<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Api\Data;

use BolCom\RetailerApi\Model\EntityLink\ExternalReference;
use BolCom\RetailerApi\Model\EntityLink\InternalReference;
use BolCom\RetailerApi\Model\EntityLink\Type;

interface EntityLinkInterface
{
    const ENTITY_TYPE = 'entity_type';
    const INTERNAL_REFERENCE = 'internal_reference';
    const EXTERNAL_REFERENCE = 'external_reference';
    const CREATED_AT = 'created_at';

    /**
     * @return Type
     */
    public function getEntityType(): Type;

    /**
     * @param Type $entityType
     *
     * @return EntityLinkInterface
     */
    public function setEntityType(Type $entityType): self;

    /**
     * @return InternalReference
     */
    public function getInternalReference(): InternalReference;

    /**
     * @param InternalReference $reference
     *
     * @return EntityLinkInterface
     */
    public function setInternalReference(InternalReference $reference): self;

    /**
     * @return ExternalReference
     */
    public function getExternalReference(): ExternalReference;

    /**
     * @param ExternalReference $reference
     *
     * @return EntityLinkInterface
     */
    public function setExternalReference(ExternalReference $reference): self;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;
}
