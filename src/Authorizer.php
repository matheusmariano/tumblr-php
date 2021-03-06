<?php

namespace MatheusMariano\Tumblr;

use MatheusMariano\Tumblr\Connector\HttpClient;
use MatheusMariano\Tumblr\Connector\Auth\Authenticable;

class Authorizer
{
    use HttpClientTrait;
    
    /**
     * Base URI.
     */
    const BASE_URI = 'https://www.tumblr.com/oauth/';

    /**
     * The Authenticable instance.
     *
     * @var Authenticable
     */
    protected $auth;

    /**
     * Create a new Authorizer instance.
     *
     * @param Authenticable $auth
     */
    public function __construct(Authenticable $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Send a request to get temporary tokens.
     *
     * @param  string  $callback
     * @return array
     */
    public function getTemporaryTokens($callback)
    {
        $httpClient = $this->getHttpClient();

        $response = $httpClient->request('post', 'request_token', [
            'oauth_callback' => $callback
        ]);

        return $this->parseResponse($response);
    }

    /**
     * Send a request to get the definitive tokens.
     *
     * @param  string  $verifier
     * @return array
     */
    public function getTokens($verifier)
    {
        $httpClient = $this->getHttpClient();

        $response = $httpClient->request('post', 'access_token', [
            'oauth_verifier' => $verifier
        ]);

        return $this->parseResponse($response);
    }

    /**
     * Parse the raw response.
     *
     * @param  string  $raw
     * @return array
     */
    protected function parseResponse($raw)
    {
        parse_str($raw, $tokens);

        return $tokens;
    }
}
