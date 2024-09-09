<?php

declare(strict_types=1);

namespace LemonSqueezy\Entity;

use LemonSqueezy\Enum\CustomerStatusEnum;

final class Customer extends AbstractEntity
{
    public int $id;
    public int $store_id;
    public string $name;
    public string $email;
    public CustomerStatusEnum $status;
    public string|null $city;
    public string|null $region;
    public string|null $country;
    public int $total_revenue_currency;
    public int $mrr;
    public string|null $status_formatted;
    public string|null $country_formatted;
    public string|null $total_revenue_currency_formatted;
    public string|null $mrr_formatted;
    public string $created_at;
    public string $updated_at;
    public bool $test_mode;
    public \stdClass|null $urls;
}
