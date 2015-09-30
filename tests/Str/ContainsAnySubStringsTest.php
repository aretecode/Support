<?php

namespace Arete\Support;

class ContainsAnySubStringsTest extends \PHPUnit_Framework_TestCase {
    public function testContainingMultiple() {
        $result = Str::containsAnySubStrings('testing', ['tes', 'ing']);

        // both should match
        $this->assertTrue($result);
    }

    public function testContainingOneButNotOther() {
        $result = Str::containsAnySubStrings('testing', ['test', 'notMe']);

        // one should match
        $this->assertTrue($result);
    }
}
