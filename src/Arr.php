<?php

namespace Arete\Support;

use Illuminate\Support\Arr as IlluminatedArray;

/**
 * [ ] how deep does it go?
 * [ ] get arrays that have arrays, with their keys
 * [ ] aka isMultiDimensionalArray as isMulti
 */
class Arr extends IlluminatedArray {

    /**
     * all values of the $array equal the $value
     *
     * @param  mixed $value
     * @param  array $array
     * @return bool
     */
    public static function allEqual($value, array $array) {
        foreach ($array as $item)
            if ($value !== $item)
                return false;

        return true;
    }

    /**
     *
     * @example
     *     input   [0 => array(), 1, 2, 3]
     *     return  true
     *
     * @example
     *     input   [0, 1, 2, 3]
     *     return   false
     *
     * @param  array $array
     * @return bool
     */
    public static function isMultiDimensional($array) {
        foreach ($array as $value)
            if (is_array($value))
                return true;

        return false;
    }

    /**
     * Returns true, or the indexes/keys that have sub arrays
     *
     * @example
     *     input   [0 => array(), 1, 2, 3 => array()]
     *     return  [0, 3]
     *
     * @example
     *     input   [0 => array(), 1 => array(), 2 => array(), 3 => array()]
     *     return  true
     *
     * @param  array $array
     * @return bool
     */
    public static function multiDimensionalIndexes($array) {
        $multiDimen = [];
        foreach ($array as $key => $value)
            if (is_array($value))
                $multiDimen[$key] = $value;

        return array_keys($multiDimen);
    }

    /**
     * takes the array, sorts it by the key length
     *
     * @example
     *      pass in ['1' => true, '11' => true]
     *      returns ['11' => true, '1' => true]
     *
     * @param array $array
     * return array
     */
    public static function sortByKeyLength(array $array, $descending = true) {
        uksort(
            $array,
            function($a, $b) use ($descending) {
                // if sort by descending, $b-$a
                // else sort by ascending, $a-$b
                return $descending ? strlen($b) - strlen($a) : strlen($a) - strlen($b);
            }
        );
        return $array;
    }

    /**
     * Similar to sortByKeyLength, except with values
     *
     * takes the array, sorts it by the value length
     * @example
     *      pass in ['1', '11']
     *      returns ['11', '1']
     *
     * @param array $array
     * return array
     */
    public static function sortByLength(array $array, $descending = true) {
        usort(
            $array,
            function($a, $b) use ($descending) {
                // if sort by descending, $b-$a
                // else sort by ascending, $a-$b
                return $descending ? strlen($b) - strlen($a) : strlen($a) - strlen($b);
            }
        );
        return $array;
    }

    /**
     * @example
     *      input   [0 => 'cat', 1 => 'dog'], [0 => 'foo', 1 => 'bar']
     *      return  [0 => 'cat', 1 => 'dog', 2 => 'foo', 3 => 'bar']
     *
     * @param  array $array1
     * @param  array $array2
     * @return array
     */
    public static function mergeValues($array1, $array2) {
        return array_merge(array_values($array1), array_values($array2));
    }

    /**
     * [ ] removeEmptyStringAndNullKeys
     * [ ] removeEmptyStringAndNullValues
     *
     * @param  array  &$array
     * @return array
     */
    public static function removeEmptyStringAndNullKeyAndValues(&$array = array()) {
        // one piece, remove empties
        foreach ($array as $key => $value) {
            if (is_array($value))
                $array[$key] = removeEmptyStringAndNullKeyAndValues($value);
            if ("" === $key || null === $key)
                unset($array[$key]);
            if ("" === $value || null === $value)
                unset($array[$key]);
        }
        return $array;
    }

    /**
     * [ ] also do recursively?
     *
     * @param  array  &$array
     * @return array
     */
    public static function removeEmptyArrays(&$array = array()) {
        foreach ($array as $key => $value)
            if (is_array($value) && count($value) == 0)
                unset($array[$key]);

        return $array;
    }

    /**
     * could add some more @ params and do it in a loop
     *
     * @param  array  $array
     * @param  string $keyIfSet
     * @param  string $keyIfNotSet
     * @return mixed
     */
    public static function keyTernary(array $array, $keyIfSet, $keyIfNotSet) {
        return isset($array[$keyIfSet])
        ?
            $array[$keyIfSet]
        :
            $array[$keyIfNotSet];
    }

    /**
     * could add some more @ params and do it in a loop for existing
     *
     * @param  mixed  $array
     * @param  key    $key
     * @return bool
     */
    public static function isArrayWithKey($array, $key) {
        return is_array($array) && isset($array[$keyIfSet]);
    }

    /**
     * @param  mixed  $array
     * @param  key    $key
     * @return mixed|null
     */
    public static function atPosition($array, $key) {
        return self::isArrayWithKey($array, $key) ? $array[$key] : null;
    }

    /**
     * http://binarykitten.com/php/52-php-insert-element-and-shift.html
     * @param  array  $array   array you are altering
     * @param  mixed  $index   what you are putting it before
     * @param  mixed  $newKey  the key to replace the position of the old one with
     * @param  mixed  $element what you're adding
     * @return array
     */
    public static function insertBefore(array $array, $index, $newKey, $element) {
        if (!array_key_exists($index, $array))
            throw new \Exception("Index not found");

        $tempArray = array();
        foreach ($array as $key => $value) {
            if ($key === $index)
                $tempArray[$newKey] = $element;

            $tempArray[$key] = $value;
        }
        return $tempArray;
    }

    /**
     * @param  array  $array   array you are altering
     * @param  mixed  $index   what you are putting it after
     * @param  mixed  $newKey  the key to replace the position of the old one with
     * @param  mixed  $element what you're adding
     * @return array
     */
    public static function insertAfter(array $array, $index, $newKey, $element) {
        if (!array_key_exists($index, $array))
            throw new Exception("Index not found");
        $tempArray = array();
        foreach ($array as $key => $value) {
            $tempArray[$key] = $value;
            if ($key === $index)
                $tempArray[$newKey] = $element;
        }
        return $tempArray;
    }

    /**
     * (this is from somewhere)
     * @example
     *   [description] $categories = array(
     *      740073 => 'Leetee Cat 1',
     *      720102 => 'cat 1 subcat 1',
     *      730106 => 'subsubcat',
     *      740107 => 'and another',
     *      730109 => 'test cat'
     *   );
     *   $category = removeElementsFromArrayAfterIndex(720102, $categories);  // will keep leetee cat 1, cat 1 & remove the rest
     *
     * @param  mixed  $removeAfterThisIndex
     * @param  array  $array
     * @return array
     */
    public static function removeElementsFromArrayAfterIndex($removeAfterThisIndex, $array, $removeTheIndexPassedIn = false) : array {
        // Find the position of the key you're looking for.
        $position = array_search($removeAfterThisIndex, array_keys($array));

        // would do removeTheIndexPassedIn + 1 if $removeIndexPassed in, but it may be a String...
        // If a position is found, splice the array.
        if ($position !== false)
            array_splice($array, ($position));

        return $array;
    }
    /**
     * @param  mixed   $value
     * @param  array   $array
     * @param  boolean $onlyOnce
     * @return array
     */
    public static function removeElementsFromArrayFromValue($value, array $array, $onlyOnce = true) {
        foreach ($array as $key => $value){
            if ($value == $value)
                unset($array[$key]);

            if ($onlyOnce)
                return $array;
        }
        return $array;
    }

    /**
     * @param array &$array
     * @param mixed $value (or Specificiation or callable later @TODO)
     * @return void
     */
    public static function removeValueForEach(&$array, $value) {
        foreach ($array as $key => $val)
            if ($val == $value)
                unset($array[$key]);
    }

    /**
     * @param array &$array
     * @param mixed $value
     * @return array
     */
    public static function removeValue(&$array, $value) {
        if (($key = array_search($value, $array)) !== false)
            unset($array[$key]);
        return $array;
    }


    /**
     * @param  string?  $keySpecification
     * @return bool
     */
    public static function hasKeyMatching(array $array, $keySpecification) {
        if (is_object($keySpecification))
            if (self::indexMatching($array, $keySpecification))
                return true;
        else
            foreach ($array as $key => $value)
                if (self::internallySatisfiedKey($key, $value, $specification))
                    return true;

        return false;
    }
    /**
     * ONLY WORKS NUMERICALLY
     *
     * also, indexMatching*s*
     *
     * @param  string|Specification|callable $specification
     * @return mixed                         $index
     */
    public static function indexMatching(array $array, $specification) {
        $index = 0;
        foreach ($array as $key => $value) {
            $index++;

            // should abstract this so it can be used before the fe loop
            if (self::internallySatisfied($key, $value, $specification))
                return $index;
        }

        return null;
    }

    /**
     * @param  string|int                    $key
     * @param  mixed                         $value
     * @param  string|Specification|callable $specification
     * @return bool
     */
    private static function internallySatisfied($key, $value, $specification) {
        return ((
            is_callable($specification) &&
            $specification($value, $key)
        ) || (
            method_exists($specification, 'specification') &&
            $specification->isSatisfiedBy($value, $key)
        ) || (
            gettype($value) == gettype($specification) &&
            $value == $specification
        ));
    }
    private static function internallySatisfiedKey($key, $value, $specification) {
        return ((
            is_callable($specification) &&
            $specification($callable)
        ) || (
            method_exists('specification', $specification) &&
            $specification->isSatisfiedBy($value, $key)
        ) || (
            gettype($value) == gettype($specification) &&
            $key == $specification
        ));
    }

    /**
     * You will lose your indexes! They will be transformed into numerical
     *
     * @param  array                          $array              array you are altering
     * @param  string|Specification|callable  $specification      what you're looking to match
     * @param  mixed                          $value              what you're adding
     * @return array
     */
    public static function insertAfterMatching(array $array, $specification, $value) {
        $index = self::indexMatching($array, $specification);

        $first = array_slice($array, 0, $index, $preserveKeys = true);
        $second = array_slice($array, $index, null, $preserveKeys = true);
        $new = array($index => $value);

        $array = array_merge(
            $first, $new, $second
        );

        return $array;
    }

    /**
     * You will lose your indexes! They will be transformed into numerical
     *
     *
     * http://stackoverflow.com/questions/3797239/insert-new-item-in-array-on-any-position-in-php
     * http://binarykitten.com/php/52-php-insert-element-and-shift.html
     *
     * now returning the state so we can keep trying to insert before the matching
     *
     *
     * @param  array                          $array              array you are altering
     * @param  string|Specification|callable  $specification      what you're looking to match
     * @param  mixed                          $value              what you're adding
     * @return array
     */
    public static function insertBeforeMatching(array $array, $specification, $value) {
        $tempArray = array();
        $index = 0;
        foreach ($array as $key => $arrayValue) {
            if (self::internallySatisfied($key, $arrayValue, $specification)) {
                $tempArray[$index] = $value; // was $key+1
                ++$index;
            }
            $tempArray[$index] = $arrayValue;
            ++$index;
        }
        $array = $tempArray;
        return $array; // added the return
    }

    /**
     * You will lose your indexes! They will be transformed into numerical
     *
     * @param  array       $array
     * @param  string|int  $key
     * @param  mixed       $value
     * @return array
     */
    public static function insertBeforeKey(array $array, $key, $value) {
        $tempArray = array();
        $index = 0;
        foreach ($array as $arrayKey => $arrayValue) {
            if ($key == $arrayKey) {
                $tempArray[$index] = $value;
                ++$index;
            }

            $tempArray[$index] = $arrayValue;
            ++$index;
        }
        $array = $tempArray;
        return $array; // added the return
    }

    /**
     * You will lose your indexes! They will be transformed into numerical
     *
     * @param  array       $array
     * @param  string|int  $afterKey
     * @param  mixed       $value
     * @param  string|int  [$keyForValue] (optional) the key to be used for the value passed in, not needed since keys are reset
     * @return array
     */
    public static function insertAfterKey(array $array, $afterKey, $value, $keyForValue = null) {
        // if no key is passed in, use the $afterKey - it doesn't make a difference since when array merging the keys are lost
        if (!$keyForValue)
            $keyForValue = $afterKey;

        // the position of the item with that key in the array
        $positionOfKey = array_search($afterKey, array_keys($array));

        // if it is the very end, we need to add one
        // `end` requires a variable to be passed in by ref
        $keys = array_keys($array);
        if ($afterKey == end($keys))
            $positionOfKey += 1;

        // if it is the start, we need to add one  // if ($afterKey == 0)
        else
            $positionOfKey += 1;


        $first = array_slice($array, 0, $positionOfKey, $preserveKeys = true);
        $second = array_slice($array, $positionOfKey, null, $preserveKeys = true);
        $new = array($keyForValue => $value);

        $arrayMerged = array_merge(
            $first, $new, $second
        );

        return $arrayMerged;
    }

    /**
     * @param  array                          $array              array you are altering
     * @param  string|Specification|callable  $specification      what you're looking to match
     * @param  mixed                          $value              what you're adding
     * @return array
     */
    public static function removeSatisfying($array, $specification) {
        foreach ($array as $key => $value)
            if (self::internallySatisfied($key, $value, $specification))
                unset($array[$key]);

        return $array;
    }




    public static function removeElementsFromArrayAfterIndexAlternate($removeAfterThisIndex, $array, $useValue = true) {
        $delete = false;
        foreach($array as $key => $value){
            if ($value == $removeAfterThisIndex || $delete){
                unset($array[$key]);
                $delete = true;
            }
        }
        return $array;
    }
    public static function insert(&$array, $element, $position = null) {
        if (count($array) == 0) {
            $array[] = $element;
        }
        elseif (is_numeric($position) && $position < 0) {
            if ((count($array)+$position) < 0) {
                $array = self::insert($array, $element, 0);
            }
            else {
                $array[count($array)+$position] = $element;
            }
        }
        elseif (is_numeric($position) && isset($array[$position])) {
            $part1 = array_slice($array, 0, $position, true);
            $part2 = array_slice($array, $position, null, true);
            $array = array_merge($part1,array($position => $element), $part2);
            foreach($array as $key => $item) {
                if (is_null($item)) {
                    unset($array[$key]);
                }
            }
        }
        elseif (is_null($position)) {
            $array[] = $element;
        }
        elseif (!isset($array[$position])) {
            $array[$position] = $element;
        }
        $array = array_merge($array);
        return $array;
    }
}
