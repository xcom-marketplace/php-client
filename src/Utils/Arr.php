<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Utils;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
final class Arr
{
    public static function whereNotEmpty(array $array): array
    {
        return array_filter($array, 'self::isNotEmpty');
    }

    private static function isNotEmpty($value): bool
    {
        if (is_array($value)) {
            return (bool) array_filter($value, 'self::isNotEmpty');
        }

        return $value !== null && $value !== '';
    }
}
