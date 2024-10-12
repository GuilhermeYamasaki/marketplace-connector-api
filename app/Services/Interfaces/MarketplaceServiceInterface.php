<?php

namespace App\Services\Interfaces;

interface MarketplaceServiceInterface
{
    /**
     * Get offers.
     */
    public function getOffers(): array;

    /**
     * Get offer by reference.
     */
    public function getOfferByReference(string $reference): array;

    /**
     * Get offer images.
     */
    public function getOfferImages(string $reference): array;

    /**
     * Get offer prices.
     */
    public function getOfferPrices(string $reference): array;
}
