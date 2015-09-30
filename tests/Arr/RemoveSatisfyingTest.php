<?php

namespace Arete\Support;

class RemoveSatisfyingTest extends \PHPUnit_Framework_TestCase {
    public function testRemoveSatisfying() {

        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus'];

        $result = Arr::removeSatisfying($array, function($val, $key) {if ($val == 'dog' || 2 == $key) return true; });

        $this->assertSame($result, [0 => 'cat']);
    }

    public function testInsertAfterKeyTwo() {
        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven'];
        $result = Arr::insertAfterKey($array, 2, 'spider', 3);
        $this->assertSame($result, [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'spider',  4 => 'raven']);
    }
}
