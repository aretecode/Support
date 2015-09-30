<?php

namespace Arete\Support;

use Illuminate\Support\Str as IlluminatedString;

class Str extends IlluminatedString {
    /**
     * @example
     *     input   "dddasdfdddasdffff", "asdf"
     *     return  [3, 10]
     *
     * @param  string $haystack
     * @param  string $needle
     * @return array<int>
     */
    public static function substringAll($haystack, $needle) {
        $lastPos = 0;
        $positions = array();

        while (($lastPos = strpos($haystack, $needle, $lastPos))!== false) {
            $positions[] = $lastPos;
            $lastPos = $lastPos + strlen($needle);
        }

        return $positions;
    }

    /**
     * @example
     *     - containsAnySubStrings('testing', ['ts', 'ing']); returns true;
     *
     * @param  string $haystack
     * @param  array  $needle
     * @return bool
     */
    public static function containsAnySubStrings($haystack, array $needles) {
        foreach ($needles as $needle)
            if (false !== strpos($haystack, $needle))
                return true;
        return false;
    }

    /**
     * @example
     *     - containsAllSubStrings('testing', ['ts', 'ing']); returns false because 'ts' is not in 'testingd'
     *     - containsAllSubStrings('testing', ['tes', 'ing']); returns true because 'tes' & 'ing' are in 'testing'
     *
     * @param  string $haystack
     * @param  array  $needle
     * @return bool
     */
    public static function containsAllSubStrings($haystack, array $needles) {
        foreach ($needles as $needle)
            if (false === strpos($haystack, $needle))
                return false;
        return true;
    }

    /**
     * @example
     *     - containsSubString('testing', 'ing'); returns true because 'ing' is in 'testing'
     *     - containsSubString('testing', 'something'); returns false because 'something' is NOT in 'testing'
     *
     * @param  string $haystack
     * @param  string  $needle
     * @return bool
     */
    public static function containsSubString($haystack, $needle) {
        return false !== strpos($haystack, $needle);
    }
}
