<?php

namespace App\UseCases\Interfaces;

interface OfferUseCaseInterface
{
    /**
     * Dispatches an event to request offers from the marketplace.
     *
     * This method triggers the GetOffersEvent, which handles the process of fetching offers.
     */
    public function requestOffers(): void;

    /**
     * Fetches offers from the marketplace and transitions each offer to the 'creating' state.
     *
     * This method retrieves paginated offers data and, for each offer, it creates an `OfferEntity` and sets
     * its state to `OfferCreatingState`, which subsequently triggers the `ImportOfferEvent`.
     * The method continues fetching until all available pages are processed.
     */
    public function getOffers(): void;

    /**
     * Changes the state of a specific offer to 'exporting' and triggers the export process.
     *
     * This method sets the state of the offer to `OfferExportingState`, which in turn dispatches
     * the `ExportOfferEvent` for further processing.
     *
     * @param  int  $offerId  The unique identifier of the offer to be exported.
     */
    public function requestExport(int $offerId): void;

    /**
     * Exports an offer to the hub.
     *
     * This method retrieves an offer by its ID from the repository, converts it into an OfferHubEntity,
     * and sends it to the hub service for creation.
     *
     * @param  int  $offerId  The unique identifier of the offer to export.
     */
    public function export(int $offerId): void;
}
