<?php

declare(strict_types=1);

namespace LemonSqueezy\Entity;

use LemonSqueezy\Enum\DiscountAmountTypeEnum;
use LemonSqueezy\Enum\DiscountDurationEnum;
use LemonSqueezy\Enum\DiscountStatusEnum;
use function date_default_timezone_get;

use DateTime;

use DateTimeZone;

use function debug_backtrace;

use const E_USER_NOTICE;

use Exception;

use function get_object_vars;

use function implode;

use function is_null;
use function is_object;
use function lcfirst;

use LemonSqueezy\Enum\CustomerStatusEnum;

use LemonSqueezy\Enum\ProductStatusEnum;

use LemonSqueezy\Exception\RuntimeException;

use function preg_last_error_msg;
use function preg_replace_callback;

use function preg_split;

use function property_exists;

use ReflectionClass;

use ReflectionException;

use ReflectionProperty;

use function sprintf;

use function strtolower;
use function strtoupper;
use function trigger_error;

abstract class AbstractEntity
{
    public function __construct($parameters = null)
    {
        if (is_null($parameters)) {
            return;
        }

        if (is_object($parameters)) {
            $parameters = get_object_vars($parameters);
        }

        $this->build($parameters);
    }

    public function __get($property)
    {
        $property = static::convertToCamelCase($property);
        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property ' . $property .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE
        );

        return null;
    }

    public function build(array $parameters): void
    {
        foreach ($parameters as $property => $value) {
            //            $property = static::convertToCamelCase($property);

            if (property_exists($this, $property)) {
                $this->$property = match ($property) {
                    'amount_type' => match (get_class($this)) {
                        Discount::class => DiscountAmountTypeEnum::from($value),
                    },
                    'duration' => match (get_class($this)) {
                        Discount::class => DiscountDurationEnum::from($value),
                    },
                    'status' => match (get_class($this)) {
                        Customer::class => CustomerStatusEnum::from($value),
                        Product::class => ProductStatusEnum::from($value),
                        Discount::class => DiscountStatusEnum::from($value),
                        default => null,
                    },
                    default => $value,
                };
            }
        }
    }

    /**
     * @throws ReflectionException
     */
    public function toArray(): array
    {
        $settings = [];
        $called = static::class;

        $reflection = new ReflectionClass($called);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            $prop = $property->getName();
            if (isset($this->$prop) && $property->class == $called) {
                $settings[self::convertToSnakeCase($prop)] = $this->$prop;
            }
        }

        return $settings;
    }

    /**
     * @throws Exception
     */
    protected static function convertToIso8601(string $date): string
    {
        $date = new DateTime($date);
        $date->setTimezone(new DateTimeZone(date_default_timezone_get()));

        return $date->format(DateTime::ATOM);
    }

    protected static function convertToCamelCase(string $str): string
    {
        $callback = function ($match): string {
            return strtoupper($match[2]);
        };

        $replaced = preg_replace_callback('/(^|_)([a-z])/', $callback, $str);

        if (is_null($replaced)) {
            throw new RuntimeException(sprintf('preg_replace_callback error: %s', preg_last_error_msg()));
        }

        return lcfirst($replaced);
    }

    protected static function convertToSnakeCase(string $str): string
    {
        $replaced = preg_split('/(?=[A-Z])/', $str);

        if (! $replaced) {
            throw new RuntimeException(sprintf('preg_split error: %s', preg_last_error_msg()));
        }

        return strtolower(implode('_', $replaced));
    }
}
