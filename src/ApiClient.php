<?php

namespace Lookstar;

use Lookstar\Exceptions\ClientException;

class ApiClient
{
    use \Lookstar\Traits\InteractWithAccessToken;
    use \Lookstar\Traits\InteractWithHttpClient;
    use \Lookstar\Traits\InteractWithCheckEnv;

    public function __construct($clientId, $clientSecret, $tenantId, $domain = 'api.lookstar.com.cn', $prefix = '/open-api')
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
