<?php

namespace Arete\Support;

class ContainsAllSubStringsTest extends \PHPUnit_Framework_TestCase {
    public function testContainingBoth() {
        $result = Str::containsAllSubStrings('testing', ['tes', 'ing']);

        // both should match
        $this->assertTrue($result);
    }

    public function testContainingOneButNotOther() {
        $result = Str::containsAllSubStrings('testing', ['test', 'notMe']);

        // one should match, but the other does not
        $this->assertFalse($result);
    }

    public function testContainingNeither() {
        $result = Str::containsAllSubStrings('testing', ['notInHere', 'notMeEither']);

        // neither should match
        $this->assertFalse($result);
    }

    public function testContainingOne() {
        $result = Str::containsAllSubStrings('testing', ['test']);

        // one should match
        $this->assertTrue($result);
    }

    public function testNotContainingOne() {
        $result = Str::containsAllSubStrings('testing', ['notInHere']);

        // one should NOT match
        $this->assertFalse($result);
    }
}
