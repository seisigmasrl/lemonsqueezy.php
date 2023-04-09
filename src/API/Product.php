<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

use function array_map;

use LemonSqueezy\Entity\Product as ProductEntity;

class Product extends AbstractApi
{
    public function getAllProducts(): array
    {
        $products = $this->get('/products');

        return array_map(function ($product) {
            $productEntity = new ProductEntity($product->attributes);
            $productEntity->id = (int) $product->id;

            return $productEntity;
        }, $products->data);
    }

    public function getStoreProducts(int $storeId): array
    {
        $products = $this->get('/products?filter[store_id]=' . $storeId);

        return array_map(function ($product) {
            $productEntity = new ProductEntity($product->attributes);
            $productEntity->id = (int) $product->id;

            return $productEntity;
        }, $products->data);
    }

    public function getProduct(int $productId): ProductEntity
    {
        $product = $this->get('/products/' . $productId);

        $productEntity = new ProductEntity($product->data->attributes);
        $productEntity->id = (int) $product->data->id;

        return $productEntity;
    }

    public function getProductVariants(int $productId): array
    {
        $variants = $this->get('/products/' . $productId . '/variants');

        return array_map(function ($variant) {
            $productEntity = new ProductEntity($variant->attributes);
            $productEntity->id = (int) $variant->id;

            return $productEntity;
        }, $variants->data);
    }

    public function getProductWithVariants(int $productId): ProductEntity
    {
        $product = $this->getProduct($productId);
        $product->variants = $this->getProductVariants($productId);

        return $product;
    }
}
