<?php

namespace LookstarClient;

use LookstarClient\Exceptions\ClientException;

class ApiClient
{
    use \LookstarClient\Traits\InteractWithAccessToken;
    use \LookstarClient\Traits\InteractWithHttpClient;
    use \LookstarClient\Traits\InteractWithCheckEnv;

    public function __construct($clientId, $clientSecret, $tenantId, $domain = 'api.lookstar.com.cn', $prefix = '')
    {
        $clientId = trim($clientId);
        $clientSecret = trim($clientSecret);

        if (empty($clientId)) {
            throw new ClientException("client id is empty");
        }
        if (empty($clientSecret)) {
            throw new ClientException("client secret is empty");
        }
        if (empty($tenantId)) {
            throw new ClientException("tenantId is empty");
        }

        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->tenantId = $tenantId;
        $this->domain = $domain;
        $this->prefix = $prefix;

        self::checkEnv();
    }
}
