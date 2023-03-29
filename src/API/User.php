<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

use LemonSqueezy\Entity\User as UserEntity;

class User extends AbstractApi
{
    public function getUserId(): int
    {
        $account = $this->get('/users/me');
        return (int) $account->data->id;
    }
    public function getUserInformation(): UserEntity
    {
        $account = $this->get('/users/me');
        return new UserEntity($account->data->attributes);
    }
}
