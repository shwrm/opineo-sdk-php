<?php

declare(strict_types=1);

namespace Shwrm\Opineo;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\RequestOptions;
use Shwrm\Opineo\Exception\AuthenticationException;
use Shwrm\Opineo\Exception\InvitationsDisabledException;

class OpineoClient
{
    const URI = 'https://www.wiarygodneopinie.pl/gate.php';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    public function __construct(ClientInterface $client, string $login, string $password)
    {
        $this->client   = $client;
        $this->login    = $login;
        $this->password = $password;
    }

    public function send(QueryParams $queryParams)
    {
        $params = $queryParams->toArray();

        $params['login'] = $this->login;
        $params['pass']  = $this->password;

        try {
            $this->client->request(
                'POST',
                new Uri(self::URI),
                [
                    RequestOptions::QUERY => $params,
                ]
            );
        } catch (ClientException $e) {
            if (404 == $e->getResponse()->getStatusCode()) {
                throw new AuthenticationException();
            } elseif (403 == $e->getResponse()->getStatusCode()) {
                throw new InvitationsDisabledException();
            }
        }
    }
}
