<?php declare(strict_types=1);

namespace Tests\Shwrm\Opineo;

use PHPUnit\Framework\TestCase;
use Shwrm\Opineo\QueryParams;

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
