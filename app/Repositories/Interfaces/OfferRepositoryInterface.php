<?php

namespace App\Repositories\Interfaces;

use App\Entities\OfferEntity;

interface OfferRepositoryInterface
{
    /**
     * Saves the given offer entity to the database.
     *
     * This method creates a new record or updates an existing one
     * based on the unique identifier of the offer entity.
     *
     * @param  OfferEntity  $entity  The offer entity to be persisted.
     */
    public function persist(OfferEntity $entity): void;

    /**
     * Finds an offer entity by its unique identifier.
     *
     * This method retrieves the offer from the database along with its associated
     * prices and images. If no offer is found, it returns null.
     *
     * @param  int  $offerId  The unique identifier of the offer to be found.
     * @return OfferEntity|null The offer entity if found, null otherwise.
     */
    public function find(int $offerId): ?OfferEntity;
}
