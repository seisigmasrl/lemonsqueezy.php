<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

use LemonSqueezy\Entity\User as UserEntity;

class User extends AbstractApi
{
    public function getUserInformation(): UserEntity
    {
        $account = $this->get('/users/me');

        return new UserEntity($account->account);
    }
}
