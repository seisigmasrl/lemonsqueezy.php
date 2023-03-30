# Lemon Squeezy API client for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/seisigmasrl/lemonsqueezy-php.svg?style=flat-square)](https://packagist.org/packages/ricardov03/lemonsqueezy-php)
[![Tests](https://img.shields.io/github/actions/workflow/status/seisigmasrl/lemonsqueezy.php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/seisigmasrl/lemonsqueezy.php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/seisigmasrl/lemonsqueezy-php.svg?style=flat-square)](https://packagist.org/packages/ricardov03/lemonsqueezy-php)

I love the competition that came from innovation. For businesses and creators worldwide, being able to charge for services is one of the most needed requirements in this global world. Sadly, few companies can bring this kind of solution. Lemon Squeeze brings payments, tax & subscriptions for software companies by being your merchant of record, handling the tax compliance burden so you can focus on more revenue and less headache.

This SDK wraps the Lemon Squeeze API to simplify the service integration with the PHP language.

> I started this project with personal and professional motivation. So I'm putting all the effort into finishing the to-do list as fast as possible. To start the hype about the package, I'm opening this from day one and pushing every new endpoint as a new feature release. I include the package core + Users endpoint information for the first release.

# Installation
This version is only tested for PHP 8.2. To get started, simply require the project using [Composer](https://getcomposer.org/).
You can install the package via composer like this:

```bash
composer require seisigmasrl/lemonsqueezy.php
```
This SDK architecture is highly inspired by the [DigitalOcean Client](https://github.com/DigitalOceanPHP/Client) package by decoupling from any HTTP messaging client by using [PSR-7](https://www.php-fig.org/psr/psr-7/), [PSR-17](https://www.php-fig.org/psr/psr-17/), [PSR-18](https://www.php-fig.org/psr/psr-18/), and [HTTPlug](https://httplug.io/).
You can visit [HTTPlug for library users](https://docs.php-http.org/en/latest/httplug/users.html) to get more information about installing HTTPlug related packages. This package
will automatically discover an HTTP client to use from what you have available.

## Usage
>I'll be creating an official website with the final documentation of the SDK, but in the meantime, here are the details of the current options:

```php
# Initializing the Package
<?php
require_once  'vendor/autoload.php';

// Create a new LemonSqueezy client
$client = new \LemonSqueezy\LemonSqueezy();

// Authenticate the client by providing your API Token which can be
// generated at https://app.lemonsqueezy.com/settings/api
$client->authenticate('yourApiToken');
```

Here's the list of the current methods provided by this package base on the existed endpoints:

### User
```php
<?php
# Initialize the Package from the step before
...
// Get the user information base on the defined in the Lemon Squeeze API Documentation
// https://docs.lemonsqueezy.com/api/users#the-user-object
$user = $client->user();
$userDetails = $user->getUserInformation();

var_dump($userDetails);
// object(LemonSqueezy\Entity\User)#4567 (7) {
//   ["name"]=> string(14) "Marco Polo"
//   ["email"]=> string(19) "marco@polo.com"
//   ["color"]=> string(7) "#7047EB"
//   ["avatar_url"]=> string(72) "https://www.gravatar.com/avatar/cc27e9f9e9a66d0fb6a988a?d=blank"
//   ["has_custom_avatar"]=> bool(false)
//   ["createdAt"]=> string(27) "2023-01-18T13:56:46.000000Z"
//   ["updatedAt"]=> string(27) "2023-01-18T14:00:01.000000Z"
// }

// Get only the ID of the User
$userId = $user->getUserId();

var_dump($userId);
// int(350103)
```


## Roadmap / To-Do
- [ ] General
    - [x] Authentication
        - [x] Rate Limiting
        - [x] Errors (Exceptions)
        - [ ] Pagination - WIP
    - [ ] Related Resources
    - [ ] Filtering
- [x] Users
    - [x] Retrieve Authenticated User Information
    - [x] Retrieve logged User's Id
- [ ] Stores
    - [ ] List all Stores
    - [ ] Retrieve Store
- [ ] Customers
    - [ ] List all Customers
    - [ ] Retrieve a Customer
- [ ] Products
    - [ ] List all products
    - [ ] Retrieve a Product
        - [ ] List all Variants of a Product
        - [ ] Retrieve a Variant
- [ ] Files
    - [ ] List all Files
    - [ ] Retrieve a File
- [ ] Orders
    - [ ] List all Orders
    - [ ] Retrieve an Order
        - [ ] List all Order Items
        - [ ] Retrieve an Order Item
- [ ] Subscriptions
    - [ ] List all Subscriptions
    - [ ] Retrieve a Subscription
    - [ ] Update a Subscription
    - [ ] Cancel a Subscription
        - [ ] List all Subscription Invoices
        - [ ] Retrieve a Subscription Invoice
- [ ] Discounts
    - [ ] Create a Discount
    - [ ] List all Discounts
    - [ ] Retrieve a Discount
    - [ ] Delete a Discount
        - [ ] List all Discount Redemptions
        - [ ] Retrieve a Discount Redemption
- [ ] Checkouts
    - [ ] List all Checkouts
    - [ ] Retrieve a Checkout
    - [ ] Create a Checkout
- [ ] License Keys
    - [ ] List all License Keys
    - [ ] Retrieve a License Key
        - [ ] List all License Key Instances
        - [ ] Retrieve a License Key Instance

Webhooks? TBD


