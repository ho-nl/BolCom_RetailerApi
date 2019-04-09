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
use BolCom\RetailerApi\Model\ProcessStatus\EventType;

interface EntityLinkInterface
{
    const ENTITY_TYPE = 'entity_type';
    const EVENT_TYPE = 'event_type';
    const INTERNAL_REFERENCE = 'internal_reference';
    const EXTERNAL_REFERENCE = 'external_reference';
    const SCOPE = 'scope';
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
     * @return EventType
     */
    public function getEventType(): EventType;

    /**
     * @param EventType $eventType
     *
     * @return EntityLinkInterface
     */
    public function setEventType(EventType $eventType): self;

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
     * @return string
     */
    public function getScope(): string;

    /**
     * @param string $scope
     *
     * @return EntityLinkInterface
     */
    public function setScope(string $scope): self;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;
}
