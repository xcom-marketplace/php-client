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
        foreach ($array as &$value) {
            if (is_array($value) && $value) {
                $value = self::whereNotEmpty($value);
            }
        }

        return array_filter($array, static function ($value) {
            return $value !== null && $value !== '' && $value !== [];
        });
    }
}
