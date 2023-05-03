<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

class FluentApi
{
    public array $attributes;

    public function product(int $productId): static
    {
        $this->attributes['productId'] = $productId;

        return $this;
    }

    public function withVariants(bool $variants = true): static
    {
        $this->attributes['variants'] = $variants;

        return $this;
    }

    public function get()
    {
        //        ray($this->attributes);
    }
}
