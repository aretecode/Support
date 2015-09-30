<?php

namespace Arete\Support;

class InsertAfterTest extends \PHPUnit_Framework_TestCase {
    public function testInsertAfterAndOldTo() {
        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven'];

        // inserting after 'dog' which is at index 1
        // will make 'dog' stay at index 1 and 'spider' go to index 4,
        // BUT, in the sorting, spider will be second.
        // IMPORTANT TO NOTE, that will be #4 right after the #1, unless it is sorted
        $result = Arr::insertAfter($array, 1, 4, 'spider');

        // we use `same` here because they must be identical, equals would be true regardless of the order
        $this->assertSame($result, [0 => 'cat', 1 => 'dog', 4 => 'spider', 2 => 'octopus',  3 => 'raven']);
    }
}
