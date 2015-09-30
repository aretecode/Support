<?php

namespace Arete\Support;

class MergeValuesTest extends \PHPUnit_Framework_TestCase {
    public function testMergeValues() {
        $arr1 = [0 => 'cat', 1 => 'dog'];
        $arr2 = [0 => 'foo', 1 => 'bar'];
        $result = Arr::mergeValues($arr1, $arr2);
        $this->assertEquals($result, [0 => 'cat', 1 => 'dog', 2 => 'foo', 3 => 'bar']);
    }
    public function testMergeValuesDuplicateValue() {
        $arr1 = [0 => 'cat', 1 => 'dog'];
        $arr2 = [0 => 'foo', 1 => 'bar', 'bar'];
        $result = Arr::mergeValues($arr1, $arr2);
        $this->assertEquals($result, [0 => 'cat', 1 => 'dog', 2 => 'foo', 3 => 'bar', 4 => 'bar']);
    }
}
