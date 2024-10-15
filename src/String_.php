<?php

declare(strict_types=1);

namespace Inilim\GenClass;

final class String_
{
    // 
    /**
     * Make a string's first character uppercase.
     */
    function ucfirst(string $string): string
    {
        return $this->upper($this->substr($string, 0, 1)) . $this->substr($string, 1);
    }

    /**
     * Returns the portion of the string specified by the start and length parameters.
     */
    function substr(string $string, int $start, ?int $length = null, string $encoding = 'UTF-8'): string
    {
        return \mb_substr($string, $start, $length, $encoding);
    }

    /**
     * Convert the given string to upper-case.
     */
    function upper(string $value): string
    {
        return \mb_strtoupper($value, 'UTF-8');
    }

    /**
     * Convert the given string to lower-case.
     */
    function lower(string $value): string
    {
        return \mb_strtolower($value, 'UTF-8');
    }

    /**
     * Convert a value to camel case.
     */
    function camel(string $value): string
    {
        // if (isset($this->camel_cache[$value])) {
        // return $this->camel_cache[$value];
        // }

        // return $this->camel_cache[$value] = \lcfirst($this->studly($value));
        return \lcfirst($this->studly($value));
    }

    /**
     * Convert a value to studly caps case.
     */
    function studly(string $value): string
    {
        // $key = $value;

        // if (isset($this->studly_cache[$key])) return $this->studly_cache[$key];

        $words = \explode(' ', $this->replace(['-', '_'], ' ', $value));

        $studly_words = \array_map(fn($word) => $this->ucfirst($word), $words);

        // return $this->studly_cache[$key] = \implode($studly_words);
        return \implode($studly_words);
    }

    /**
     * Replace the given value in the given string.
     * @param  string|string[]  $search
     * @param  string|string[]  $replace
     * @param  string|string[]  $subject
     * @return string|string[]
     */
    function replace($search, $replace, $subject, bool $case_sensitive = true)
    {
        return $case_sensitive
            ? \str_replace($search, $replace, $subject)
            : \str_ireplace($search, $replace, $subject);
    }

    function endsWith(string $haystack, string $needle): bool
    {
        if ('' === $needle || $needle === $haystack) {
            return true;
        }

        if ('' === $haystack) {
            return false;
        }

        $needleLength = \strlen($needle);

        return $needleLength <= \strlen($haystack) && 0 === \substr_compare($haystack, $needle, -$needleLength);
    }

    function startsWith(string $haystack, string $needle): bool
    {
        return 0 === \strncmp($haystack, $needle, \strlen($needle));
    }
}
