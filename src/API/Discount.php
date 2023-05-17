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

    /**
     * @param DiscountEntity $discount
     * @param array<int|string> $variantIds
     * @return int
     */
    public function createDiscount(DiscountEntity $discount, array $variantIds = []): int
    {
        $data = [
            "type" => "discounts",
            "attributes" => $discount->toArray(),
            "relationships" => [
                "store" => [
                    "data" => [
                        "type" => "stores",
                        "id" => (string) $discount->store_id,
                    ],
                ],
            ],
        ];

        if (! empty($variantIds)) {
            $variants = [];
            foreach ($variantIds as $id) {
                $variants[] = [
                    "type" => "variants",
                    "id" => (string) $id,
                ];
            }
            $data["relationships"]["variants"] = [
                "data" => $variants,
            ];
        }

        $object = $this->post('/discounts/', ['data' => $data]);

        return (int) $object->data->id;
    }
}
