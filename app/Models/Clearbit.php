<?php

namespace App\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use App\Exceptions\AsyncLookingException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class Clearbit
{
    private $httpClient;
    private $token;

    public function __construct(string $token)
    {
        $this->httpClient = new Client();
        $this->token      = $token;
    }

    public function getCompany(string $domain)
    {
        $options = array_merge([
            'scheme' => 'https',
            'host'   => 'company.clearbit.com',
            'path'   => '/v2/companies/find'
        ]);

        $url = sprintf(
            '%s://%s%s?%s',
            $options['scheme'],
            $options['host'],
            $options['path'],
            'domain=' . $domain
        );

        $headers = ['Host'          => $options['host'],
                    'Authorization' => "Bearer {$this->token}"];

        $request  = new Request('GET', $url, $headers);
        $response = $this->httpClient->sendRequest($request);

        $statusCode = $response->getStatusCode();

        switch (true) {
            case 202 == $statusCode:
                throw new AsyncLookingException();
            case 404 == $statusCode:
                throw new NotFoundHttpException();
            case 200 != $statusCode:
                throw new BadRequestException($response->getBody()->getContents());
        }

        return $response->getBody()->getContents();
    }
}