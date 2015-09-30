<?php

namespace Arete\Support;

class InsertBeforeKeyTest extends \PHPUnit_Framework_TestCase {
    public function testInsertBeforeKey() {
        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven'];
        $result = Arr::insertBeforeKey($array, 1, 'spider', 4);
        $this->assertSame($result, [0 => 'cat', 1 => 'spider', 2 => 'dog', 3 => 'octopus',  4 => 'raven']);
    }
    public function testInsertBeforeKeyFirst() {
        $array = [0 => 'cat', 1 => 'dog', 2 => 'octopus', 3 => 'raven'];
        $result = Arr::insertBeforeKey($array, 0, 'spider', 4);
        $this->assertSame($result, [0 => 'spider', 1 => 'cat', 2 => 'dog', 3 => 'octopus',  4 => 'raven']);
    }
    public function testInsertBeforeKeyLengthOne() {
        $array = [0 => 'cat'];
        $result = Arr::insertBeforeKey($array, 0, 'spider', 1);
        $this->assertSame($result, [0 => 'spider', 1 => 'cat']);
    }
}
