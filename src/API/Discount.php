<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

use function array_map;

use LemonSqueezy\Entity\Discount as DiscountEntity;

class Discount extends AbstractApi
{
    public function getAllDiscounts(): array
    {
        $discounts = $this->get('/discounts');

        return array_map(function ($discount) {
            $discountEntity = new DiscountEntity($discount->attributes);
            $discountEntity->id = (int) $discount->id;

            return $discountEntity;
        }, $discounts->data);
    }

    public function getStoreDiscounts(int $storeId): array
    {
        $discounts = $this->get('/discounts?filter[store_id]=' . $storeId);

        return array_map(function ($discount) {
            $discountEntity = new DiscountEntity($discount->attributes);
            $discountEntity->id = (int) $discount->id;

            return $discountEntity;
        }, $discounts->data);
    }

    public function getDiscount(int $discountId): DiscountEntity
    {
        $discount = $this->get('/discounts/' . $discountId);

        $discountEntity = new DiscountEntity($discount->data->attributes);
        $discountEntity->id = (int) $discount->data->id;

        return $discountEntity;
    }
}
