<?php

namespace Arete\Support;

class RemoveEmptyTest extends \PHPUnit_Framework_TestCase {
    public function testRemoveUseless() {
        $array = [0 => 'cat', 1 => 'dog', 2 => '', 3 => null, '' => 'eh', 'eh2', 7 => 'index7'];

        $result = Arr::removeEmptyStringAndNullKeyAndValues($array);

        // important to note the keys
        $this->assertEquals($result, [0 => 'cat', 1 => 'dog', 4 => 'eh2', 7 => 'index7']);
    }

    // should do this recursively?
    public function testRemoveEmpty() {
        $array = [0 => [], 1 => ['eh'], 2 => 'ehv'];

        $result = Arr::removeEmptyArrays($array);

        // important to note the keys
        $this->assertEquals($result, [1 => ['eh'], 2 => 'ehv']);
    }
}
