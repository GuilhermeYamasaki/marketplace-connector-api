<?php

namespace App\Services;

use App\Services\Interfaces\OfferServiceInterface;
use Illuminate\Support\Facades\Http;

class OfferService implements OfferServiceInterface
{
    private $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('offers.marketplace.url'))
            ->asJson()
            ->acceptJson();

    }

    /**
     * {@inheritDoc}
     */
    public function getOffers(int $page = 1): array
    {
        $response = $this->client->get('/offers', ['page' => $page]);

        return $response->json();
    }

    /**
     * {@inheritDoc}
     */
    public function getOfferByReference(string $reference): array
    {
        $response = $this->client->get("/offers/{$reference}");

        return $response->json();

    }

    /**
     * {@inheritDoc}
     */
    public function getOfferImages(string $reference): array
    {
        $response = $this->client->get("/offers/{$reference}/images");

        return $response->json();
    }

    /**
     * {@inheritDoc}
     */
    public function getOfferPrices(string $reference): array
    {
        $response = $this->client->get("/offers/{$reference}/prices");

        return $response->json();
    }
}
