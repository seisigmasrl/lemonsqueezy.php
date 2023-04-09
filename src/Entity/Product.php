<?php

declare(strict_types=1);

namespace LemonSqueezy\Entity;

use LemonSqueezy\Enum\ProductStatusEnum;

final class Product extends AbstractEntity
{
    public int $id;
    public int $store_id;
    public string $name;
    public string|null $slug;
    public string|null $description;
    public ProductStatusEnum $status;
    public string $status_formatted;
    public string|null $thumb_url;
    public string|null $large_thumb_url;
    public int|null $price;
    public bool|null $pay_what_you_want;
    public int|null $from_price;
    public int|null $to_price;
    public string|null $buy_now_url;
    public string|null $price_formatted;
    public string $created_at;
    public string $updated_at;
    public array|null $variants;
}
