<?php

use Arete\Support\Arr;
use Arete\Support\Str;

if (!function_exists('substringAll')) {
    /**
     * @example
     *     input   "dddasdfdddasdffff", "asdf"
     *     return
     *
     * @param  string $haystack
     * @param  string $needle
     * @return array<int>
     */
    function substringAll($haystack, $needle) {
        return Str::substringAll($haystack, $needle);
    }
}

if (!function_exists('containsAnySubStrings')) {
    /**
     * @example
     *     - containsAnySubStrings('testing', ['ts', 'ing']); returns true;
     *
     * @param  string $haystack
     * @param  array  $needle
     * @return bool
     */
    function containsAnySubStrings($haystack, array $needles) {
        return Str::containsAnySubStrings($haystack, $needles);
    }
}

if (!function_exists('containsAllSubStrings')) {
    /**
     * @example
     *     - containsAllSubStrings('testing', ['ts', 'ing']); returns false because 'ts' is not in 'testingd'
     *     - containsAllSubStrings('testing', ['tes', 'ing']); returns true because 'tes' & 'ing' are in 'testing'
     *
     * @param  string $haystack
     * @param  array  $needle
     * @return bool
     */
    function containsAllSubStrings($haystack, array $needles) {
        return Str::containsAllSubStrings($haystack, $needles);
    }
}

if (!function_exists('containsSubString')) {
    /**
     * @example
     *     - containsSubString('testing', 'ing'); returns true because 'ing' is in 'testing'
     *     - containsSubString('testing', 'something'); returns false because 'something' is NOT in 'testing'
     *
     * @param  string $haystack
     * @param  string  $needle
     * @return bool
     */
    function containsSubString($haystack, $needle) {
        return false !== strpos($haystack, $needle);
    }
}

if (!function_exists('pregMatchAll')) {
    /**
     * Convenience method for one line preg match
     *
     * @param  string $x
     * @param  string $regex
     * @return array
     */
    function pregMatchAll($x, $regex) {
        preg_match_all($regex, $x, $matches);
        return $matches;
    }
}
