<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

use function array_map;

use LemonSqueezy\Entity\Store as StoreEntity;

class Store extends AbstractApi
{
    public function getAllStores(): array
    {
        $stores = $this->get('/stores');

        return array_map(function ($store) {
            $storeEntity = new StoreEntity($store->attributes);
            $storeEntity->id = (int) $store->id;
            return $storeEntity;
        }, $stores->data);
    }

    public function getStore(int $storeId): StoreEntity
    {
        $store = $this->get('/stores/' . $storeId);

        $storeEntity = new StoreEntity($store->data->attributes);
        $storeEntity->id = (int) $store->data->id;
        return $storeEntity;
    }
}
