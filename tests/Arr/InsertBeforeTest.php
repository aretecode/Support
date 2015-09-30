<?php

namespace Arete\Support;

class InsertBeforeTest extends \PHPUnit_Framework_TestCase {

    public function testInsertBeforeAndOldTo() {
        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven'];

        // inserting before 'dog' which is at index 1
        // will make 'dog' stay at index one and 'spider' go to index 4,
        // BUT, in the sorting, spider will be first.
        // IMPORTANT TO NOTE, that will be #4 right after the #1, unless it is sorted
        $result = Arr::insertBefore($array, 1, 4, 'spider');

        // we use `same` here because they must be identical, equals would be true regardless of the order
        $this->assertSame($result, [0 => 'cat', 4 => 'spider', 1 => 'dog', 2 => 'octopus',  3 => 'raven']);
    }
}
