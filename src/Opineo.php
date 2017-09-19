<?php

namespace Shwrm\Opineo;

use Assert\Assertion;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Uri;

class Opineo
{
    const URI = 'http://www.wiarygodneopinie.pl/gate.php';

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

    public function __construct(ClientInterface $client, $login, $password)
    {
        Assertion::string($login);
        Assertion::string($password);

        $this->client   = $client;
        $this->login    = $login;
        $this->password = $password;
    }

    public function send(QueryParams $queryParams)
    {
        $params = $queryParams->toArray();

        $params['login'] = $this->login;
        $params['pass']  = $this->password;

        return $this->client->request(
            'POST',
            new Uri(self::URI),
            [
                'query' => $params,
            ]
        );
    }

}
