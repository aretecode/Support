<?php

namespace Arete\Support;

class SubStringAllTest extends \PHPUnit_Framework_TestCase {
    public function testSubStringAll() {
        $result = Str::substringAll('dddasdfdddasdffff', 'asdf');

        // our first time this is true is 3 characters in
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals($result[0], 3);

        // our second time this is true is 10 characters in
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals($result[1], 10);
    }
    public function testSubStringNotAll() {
        $result = Str::substringAll('dddasdfdddasdffff', 'aaaaaaaaaaaaa');

        // this string never occurs
        $this->assertEmpty($result);
    }
}
