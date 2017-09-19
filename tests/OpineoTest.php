<?php

namespace Shwrm\Opineo;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;

class OpineoTest extends TestCase
{
    public function testSend()
    {
        /** @var ClientInterface|\PHPUnit_Framework_MockObject_MockObject $client */
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                new Uri(Opineo::URI),
                [
                    'query' => [
                        'login' => 'login123',
                        'pass'  => 'pass345',
                        'type'  => 'php',
                        'email' => 'aneta@test.pl',
                        'queue' => 5,
                    ],
                ]
            )
        ;

        $tested = new Opineo($client, 'login123', 'pass345');
        $tested->send(new QueryParams('aneta@test.pl'));
    }
}
