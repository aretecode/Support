<?php

namespace Arete\Support;

class SortByTest extends \PHPUnit_Framework_TestCase {
    function testSortByKeyLength() {
        // indexes are labeled this way to indicate length, not index since it really starts @0
        $array = ['1' => true, '2_' => true, '4___' => true, '3__' => true, 'zero+', 'zero', 'zero++'];

        $sorted = Arr::sortByKeyLength($array, true);

        $arrayExpected = ['4___' => true, '3__' => true, '2_' => true, '1' => true, 'zero+', 'zero', 'zero++'];
        $this->assertEquals($sorted, $arrayExpected);
    }

    function testSortByKeyLengthAscending() {
        // indexes are labeled this way to indicate length, not index since it really starts @0
        $array = ['1' => true, '2_' => true, '4___' => true, '3__' => true, 'zero+', 'zero', 'zero++', 1000 => "eh"];

        $sorted = Arr::sortByKeyLength($array, false);

        // Important to note this order!!!
        $arrayExpected = [1 => true, 2 => 'zero+', 3 => 'zero', 4 => 'zero++', '2_' => true, '3__' => true, '4___' => true, 1000 => "eh"];
        $this->assertEquals($sorted, $arrayExpected);
    }
    function testSortByKeyLengthAscendingString() {
        // indexes are labeled this way to indicate length, not index since it really starts @0
        $array = ['one' => true, '4___' => true, '6_____' => true, '5____' => true, 'zero+', 'zero', 'zero++', 1000 => "eh", 10000 => "eh2"];

        $sorted = Arr::sortByKeyLength($array, false);

        // Important to note this order!!!
        $arrayExpected = [
            0 => 'zero+', 1 => 'zero', 2 => 'zero++',
            'one' => true, 1000 => "eh", '4___' => true,
            '5____' => true, '6_____' => true, 10000 => "eh2"];
        $this->assertEquals($sorted, $arrayExpected);
    }

}
