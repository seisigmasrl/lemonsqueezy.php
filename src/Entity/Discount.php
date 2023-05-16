<?php

declare(strict_types=1);

namespace LemonSqueezy\Entity;

use LemonSqueezy\Enum\DiscountAmountTypeEnum;
use LemonSqueezy\Enum\DiscountDurationEnum;
use LemonSqueezy\Enum\DiscountStatusEnum;

final class Discount extends AbstractEntity
{
    public int $id;
    public int $store_id;
    public string $name;
    public string $code;
    public int $amount;
    public DiscountAmountTypeEnum $amount_type;
    public bool $is_limited_to_products;
    public bool $is_limited_redemptions;
    public int $max_redemptions;
    public string|null $starts_at;
    public string|null $expires_at;
    public DiscountDurationEnum $duration;
    public int $duration_in_months;
    public DiscountStatusEnum $status;
    public string|null $status_formatted;
    public string $created_at;
    public string $updated_at;
    //public bool $test_mode;
}
