<?php

namespace App\UseCases;

use App\Entities\OfferEntity;
use App\Entities\OfferImageEntity;
use App\Entities\OfferPriceEntity;
use App\Repositories\Interfaces\OfferImageRepositoryInterface;
use App\Repositories\Interfaces\OfferPriceRepositoryInterface;
use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\Services\Interfaces\MarketplaceServiceInterface;
use App\UseCases\Interfaces\OfferPersistUseCaseInterface;
use Illuminate\Support\Collection;

class OfferPersistUseCase implements OfferPersistUseCaseInterface
{
    public function __construct(
        private readonly MarketplaceServiceInterface $marketplaceService,
        private readonly OfferRepositoryInterface $offerRepository,
        private readonly OfferImageRepositoryInterface $offerImageRepository,
        private readonly OfferPriceRepositoryInterface $offerPriceRepository,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function import(int $offerId): void
    {
        $offerDatabase = $this->offerRepository->find($offerId);

        if (empty($offerDatabase)) {
            $offerEntity = $this->getDetails($offerId);
            $this->offerRepository->persist($offerEntity);
        }

        if (empty(data_get($offerDatabase, 'images'))) {
            $this->getImages($offerId)
                ->each(
                    fn (OfferImageEntity $entity) => $this->offerImageRepository->persist($entity)
                );
        }

        if (! empty(data_get($offerDatabase, 'prices'))) {
            return;
        }

        $priceEntity = $this->getPrices($offerId);
        $this->offerPriceRepository->persist($priceEntity);
    }

    /**
     * Retrieves offer details from the marketplace API and converts them into an OfferEntity.
     *
     * @param  int  $offerId  The unique identifier of the offer to fetch.
     * @return OfferEntity The hydrated entity containing the offer details.
     */
    private function getDetails(int $offerId): OfferEntity
    {
        $response = $this->marketplaceService->getOfferByReference($offerId);

        $data = data_get($response, 'data');

        return OfferEntity::hydrate((object) $data);
    }

    /**
     * Retrieves offer images from the marketplace API and returns them as a collection of entities.
     *
     * @param  int  $offerId  The unique identifier of the offer whose images are to be fetched.
     * @return Collection A collection of OfferImageEntity instances representing the offer's images.
     */
    private function getImages(int $offerId): Collection
    {
        $response = $this->marketplaceService->getOfferImages($offerId);

        return collect(data_get($response, 'data.images'))
            ->map(function ($image) use ($offerId) {
                return new OfferImageEntity(
                    $offerId,
                    data_get($image, 'url')
                );
            });
    }

    /**
     * Retrieves the offer price from the marketplace API and converts it into an OfferPriceEntity.
     *
     * @param  int  $offerId  The unique identifier of the offer whose price is to be fetched.
     * @return OfferPriceEntity The entity containing the offer price information.
     */
    private function getPrices(int $offerId): OfferPriceEntity
    {
        $response = $this->marketplaceService->getOfferPrices($offerId);

        return new OfferPriceEntity(
            $offerId,
            data_get($response, 'data.price')
        );
    }
}
