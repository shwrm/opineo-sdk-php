<?php

namespace Shwrm\Opineo;

use PHPUnit\Framework\TestCase;

class QueryParamsTest extends TestCase
{
    public function testToArray()
    {
        $tested   = new QueryParams('test@test.test');
        $actual   = $tested->toArray();
        $expected = [
            'type'  => 'php',
            'email' => 'test@test.test',
            'queue' => 5,
        ];
        $this->assertSame($expected, $actual);
    }
}
