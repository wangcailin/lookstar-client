<?php

namespace LookstarClient\Traits;

use GuzzleHttp\Client as GuzzleHttpClient;

trait InteractWithHttpClient
{
    protected $clientId;
    protected $clientSecret;
    protected $tenantId;
    protected $prefix;
    protected $domain;
    protected $httpClient;

    /**
     * GET request.
     *
     * @param string $url
     * @param array  $query
     */
    public function get(string $url, array $query = [])
    {
        return $this->request($url, 'GET', ['query' => $query, 'headers' => $this->getAuthHeaders()]);
    }

    /**
     * POST request.
     *
     * @param string $url
     * @param array  $data
     */
    public function post(string $url, array $data = [])
    {
        return $this->request($url, 'POST', ['json' => $data, 'headers' => $this->getAuthHeaders()]);
    }

    /**
     * PUT request.
     *
     * @param string $url
     * @param array  $data
     */
    public function put(string $url, array $data = [])
    {
        return $this->request($url, 'PUT', ['json' => $data, 'headers' => $this->getAuthHeaders()]);
    }
    /**
     * @param string $url
     * @param string $method
     * @param array $options headers和body
     * @param false $returnRaw
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request(string $url, string $method = 'GET', array $options = [], $returnRaw = false)
    {
        $method = strtoupper($method);

        $response = $this->getHttpClient()->request($method, 'https://' . $this->domain . $this->prefix . $url, $options);
        return json_decode($response->getBody()->getContents());
    }

    private function getHttpClient()
    {
        if (!$this->httpClient) {
            $this->httpClient = new GuzzleHttpClient();
        }
        return $this->httpClient;
    }

    private function getAuthHeaders()
    {
        return [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $this->accessToken()['access_token'],
            'X-Tenant'  => $this->tenantId,
        ];
    }
}
