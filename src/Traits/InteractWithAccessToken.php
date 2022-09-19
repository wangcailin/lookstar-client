<?php

namespace Lookstar\Traits;

trait InteractWithAccessToken
{
    protected $accessTokenUrl = '/tenant/oauth/token';

    public function accessToken()
    {
        //非过期刷新
        $obj = $this->getAccessToken();
        if (!empty($obj)) {
            return $obj;
        }
        return $this->setAccessToken();
    }

    protected function getAccessToken()
    {
        $content = @file_get_contents($this->getFilePath());
        if ($content !== false) {
            $obj = json_decode($content, true);
            if ($obj['time'] + $obj['expires_in'] - 30 > time()) {
                return $obj;
            }
        }
        return null;
    }

    protected function setAccessToken()
    {
        $response = $this->request(
            $this->accessTokenUrl,
            'POST',
            [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'scope' => '*'
                ],
                'headers'  => ['X-Tenant'  => $this->tenantId,]
            ]
        );
        $obj = json_decode($response->getBody()->getContents(), true);
        $obj['time'] = time();
        @file_put_contents($this->getFilePath(), json_encode($obj));
        return $obj;
    }

    /**
     * 返回 access token 路径
     * @return string
     */
    private function getFilePath()
    {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . md5($this->clientId);
    }
}
