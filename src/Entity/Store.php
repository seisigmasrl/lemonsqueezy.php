<?php

declare(strict_types=1);

namespace LemonSqueezy\Entity;

final class Store extends AbstractEntity
{
    public int $id;
    public string $name;
    public string $slug;
    public string $domain;
    public string $url;
    public string $avatar_url;
    public string $plan;
    public string $country;
    public string $country_nicename;
    public string $currency;
    public int $total_sales;
    public int $total_revenue;
    public int $thirty_day_sales;
    public int $thirty_day_revenue;
    public string $created_at;
    public string $updated_at;
}
