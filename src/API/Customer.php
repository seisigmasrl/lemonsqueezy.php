<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

use LemonSqueezy\Entity\Customer as CustomerEntity;

class Customer extends AbstractApi
{
    public function getAllCustomers(): array
    {
        $customers = $this->get('/customers');

        return array_map(function ($customer) {
            $customerEntity = new CustomerEntity($customer->attributes);
            $customerEntity->id = (int) $customer->id;

            return $customerEntity;
        }, $customers->data);
    }

    public function getStoreCustomers(int $storeId): array
    {
        $customers = $this->get('/customers?filter[store_id]=' . $storeId);

        return array_map(function ($customer) {
            $customerEntity = new CustomerEntity($customer->attributes);
            $customerEntity->id = (int) $customer->id;

            return $customerEntity;
        }, $customers->data);
    }

    public function getCustomer(int $customerId): CustomerEntity
    {
        $customer = $this->get('/customers/' . $customerId);

        $customerEntity = new CustomerEntity($customer->data->attributes);
        $customerEntity->id = (int) $customer->data->id;

        return $customerEntity;
    }
}
