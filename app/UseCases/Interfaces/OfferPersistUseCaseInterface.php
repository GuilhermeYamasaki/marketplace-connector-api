<?php

namespace App\UseCases\Interfaces;

interface OfferPersistUseCaseInterface
{
    /**
     * Imports all details of a specified offer.
     *
     * This method fetches the offer's details, images, and prices from the marketplace
     * and persists them in the database. If the offer already exists in the database, it updates
     * only the missing information.
     *
     * @param  int  $offerId  The unique identifier of the offer to be imported.
     */
    public function import(int $offerId): void;
}
