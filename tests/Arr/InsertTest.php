<?php

namespace Arete\Support;

class InsertTest extends \PHPUnit_Framework_TestCase {
    public function testInserts() {
        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven'];

        // inserting where 'dog' is, which is at index 1
        // make 'dog' which was 1, into 2
        $result = Arr::insert($array, 'spider', 1);

        // we use `same` here because they must be identical, equals would be true regardless of the order
        $this->assertSame($result, [0 => 'cat', 1 => 'spider', 2 => 'dog', 3 => 'octopus', 4 => 'raven']);
    }

    public function testInsertsWithStringKeys() {
        $array = ['zero' => 'cat', 'one' => 'dog', 'two' => 'octopus', 'three' => 'raven'];

        // inserting before 'dog' which is at index 1
        // make 'dog' which was 1, into 2
        $result = Arr::insert($array, 'spider', 'one');

        // we use `same` here because they must be identical, equals would be true regardless of the order
        // UNFORTUNATELY, IT ONLY WORKS FOR NUMERICAL INDEXES
        $this->assertSame($result, ['zero' => 'cat', 'one' => 'dog', 'two' => 'octopus', 'three' => 'raven']);
    }
}
