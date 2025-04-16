<?php

namespace Tests;

use App\HttpClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    public function testReturnResponse(): void
    {
        $clientMock = $this->createMock(Client::class);
        $clientMock->method('get')->willReturn(new Response(200, [], '{json:true}'));

        $httpClient = new HttpClient($clientMock);

        $response = $httpClient->get('test');

        $this->assertSame('{json:true}', $response);
    }

    public function testThrowException(): void
    {
        $clientMock = $this->createMock(Client::class);
        $clientMock->method('get')->willReturn(new Response(505, [], 'Exception1'));

        $httpClient = new HttpClient($clientMock);

        $this->expectException(\Exception::class);
        $this->expectExceptionCode(505);
        $this->expectExceptionMessage('Exception1');

        $httpClient->get('test');
    }
}
