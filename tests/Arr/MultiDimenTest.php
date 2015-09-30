<?php

namespace Arete\Support;

class MultiDimenTest extends \PHPUnit_Framework_TestCase {
    public function testNotMultiDimen() {
        $result = Arr::isMultiDimensional([0, 1, 2, 3]);

        // none are multi dimensional so
        $this->assertFalse($result);
    }

    public function testMultiDimenPartialFailure() {
        $result = Arr::isMultiDimensional([0 => [], 1, 2, 3 => []]);

        // 0 & 3 are multi dimensional
        $this->assertTrue($result);
        // $this->assertEquals($result, [0, 3]);
    }

    public function testMultiDimen() {
        $result = Arr::isMultiDimensional([0 => [], 1 => [], 2 => [], 3 => []]);

        // all are multi dimensional
        $this->assertTrue($result);
    }


    public function testMultiDimenWithStrings() {
        $result = Arr::isMultiDimensional(['0s' => [], '1s' => [], '2s' => [], '3s' => []]);

        // all are multi dimensional
        $this->assertTrue($result);
    }
    public function testMultiDimenWithStringsPartialFailure() {
        $result = Arr::isMultiDimensional(['0s' => [], '1s', '2s', '3s' => []]);

        // 0 & 3 are multi dimensional
        $this->assertTrue($result);
        // $this->assertEquals($result, [0, 3]);
    }
    public function testMultiDimenWithStringsFailure() {
        $result = Arr::isMultiDimensional(['0s', '1s', '2s', '3s']);

        // none are multi dimensional so
        $this->assertFalse($result);
    }



    public function testMultiDimenIndexes() {
        $result = Arr::multiDimensionalIndexes([0 => [], 1, 2, 3 => []]);

        // 0 & 3 are multi dimensional
        $this->assertEquals($result, [0, 3]);
    }
    public function testMultiDimenIndexesFull() {
        $result = Arr::multiDimensionalIndexes([0 => [], 1 => [], 2 => [], 3 => []]);

        // all are multi dimensional
        $this->assertEquals($result, [0, 1, 2, 3]);
    }
    public function testMultiDimenIndexesFailure() {
        $result = Arr::multiDimensionalIndexes([0, 1, 2, 3]);

        // none are multi dimensional
        $this->assertEquals($result, []);
    }
}
