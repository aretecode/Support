<?php

namespace Arete\Support;

class InsertAfterKeyTest extends \PHPUnit_Framework_TestCase {
    public function testInsertAfterKey() {
        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven'];

        // inserting after 'dog' which is at index 1
        // will make 'dog' stay at index 1 and 'spider' go to index 4,
        // BUT, in the sorting, spider will be second.
        // IMPORTANT TO NOTE, that will be #4 right after the #1, unless it is sorted
        $result = Arr::insertAfterKey($array, 1, 'spider', 3);

        // we use `same` here because they must be identical, equals would be true regardless of the order
        $this->assertSame($result, [0 => 'cat', 1 => 'dog', 2 => 'spider', 3 => 'octopus',  4 => 'raven']);
    }

    public function testInsertAfterKeyTwo() {
        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven'];
        $result = Arr::insertAfterKey($array, 2, 'spider', 3);
        $this->assertSame($result, [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'spider',  4 => 'raven']);
    }
    public function testInsertAfterKeyLengthOne() {
        $array = [0 => 'cat'];
        $result = Arr::insertAfterKey($array, 0, 'spider', 1);
        $this->assertSame($result, [0 => 'cat', 1 => 'spider']);
    }

    public function testInsertAfterKeyFirst() {
        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven'];
        $result = Arr::insertAfterKey($array, 0, 'spider', 4);
        $this->assertSame($result, [0 => 'cat', 1 => 'spider', 2 => 'dog', 3 => 'octopus',  4 => 'raven']);
    }
    public function testInsertAfterKeyLast() {
        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven'];
        $result = Arr::insertAfterKey($array, 3, 'spider', 3);
        $this->assertSame($result, [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven',  4 => 'spider']);
    }
}
