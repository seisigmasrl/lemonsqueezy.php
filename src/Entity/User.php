<?php

declare(strict_types=1);

namespace LemonSqueezy\Entity;

use DateTime;

final class User extends AbstractEntity
{
    public string $name;
    public string $email;
    public string $color;
    public string $avatar_url;
    public bool $has_custom_avatar;
    public string $createdAt;
    public string $updatedAt;
}
