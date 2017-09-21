<?php

declare(strict_types=1);

namespace Tests\Shwrm\Opineo;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\RequestOptions;
use PHPUnit\Framework\TestCase;
use Shwrm\Opineo\OpineoClient;
use Shwrm\Opineo\QueryParams;

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
                new Uri(OpineoClient::URI),
                [
                    RequestOptions::QUERY => [
                        'login' => 'login123',
                        'pass'  => 'pass345',
                        'type'  => 'php',
                        'email' => 'aneta@test.pl',
                        'queue' => 5,
                    ],
                ]
            )
        ;

        $tested = new OpineoClient($client, 'login123', 'pass345');
        $tested->send(new QueryParams('aneta@test.pl'));
    }
}
