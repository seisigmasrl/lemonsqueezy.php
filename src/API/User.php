<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

use LemonSqueezy\Entity\User as UserEntity;
use stdClass;

class User extends AbstractApi
{
    private stdClass $userData;

    private function getUserData(): stdClass
    {
        return $this->userData = $this->get('/users/me');
    }

    public function getUserId(): int
    {
        $account = $this->userData ?? $this->getUserData();
        return (int) $account->data->id;
    }

    public function getUserInformation(): UserEntity
    {
        $account = $this->userData ?? $this->getUserData();
        return new UserEntity($account->data->attributes);
    }
}
