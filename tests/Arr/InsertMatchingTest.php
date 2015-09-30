<?php

namespace Arete\Support;

class InsertMatchingTest extends \PHPUnit_Framework_TestCase {
    public function testInsertAfterMatching() {
        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven'];

        $specification = function($value, $key) {
            if ($value == 'dog')
                return true;

            return false;
        };

        // inserting where 'dog' is, which is at index 1
        // make 'dog' which was 1, into 2
        $result = Arr::insertAfterMatching($array, $specification, 'spider');

        // inserts before, then changes the index
        $this->assertSame($result, [0 => 'cat', 1 => 'dog', 2 => 'spider', 3 => 'octopus', 4 => 'raven']);
    }

    public function testInsertBeforeMatching() {
        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven'];

        $specification = function($value, $key) {
            if ($value == 'dog')
                return true;

            return false;
        };

        // inserting where 'dog' is, which is at index 1
        // make 'dog' which was 1, into 2
        $result = Arr::insertBeforeMatching($array, $specification, 'spider');

        $this->assertSame($result, [0 => 'cat', 1 => 'spider', 2 => 'dog', 3 => 'octopus', 4 => 'raven']);
    }

    public function testInsertBeforeMatchingString() {
        $array = ['zero' => 'cat', 'one' => 'dog', 'two' => 'octopus', 'three' => 'raven'];

        $specification = function($value, $key) {
            if ($value == 'dog')
                return true;
            return false;
        };

        // inserting where 'dog' is, which is at index 1
        // make 'dog' which was 1, into 2
        $result = Arr::insertBeforeMatching($array, $specification, 'spider');

        $this->assertSame($result, [0 => 'cat', 1 => 'spider', 2 => 'dog', 3 => 'octopus', 4 => 'raven']);
    }
}
