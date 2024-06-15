<?php

namespace MouYong\ECloudHousekeeper;

use ZhenMu\Support\Traits\Clientable;
use Psr\Http\Message\ResponseInterface;
use ZhenMu\Support\Traits\DefaultClient;
use MouYong\ECloudHousekeeper\Exceptions\RuntimeException;

class ECloudHousekeeperClient implements \ArrayAccess
{
    use Clientable;
    use DefaultClient;

    protected $api = '';

    const TOKEN_NAME = 'e_cloud_house_keeper-token';

    public function getBaseUri(): ?string
    {
        if ($this->api) {
            return $this->api;
        }

        return config('e-cloud-housekeeper.api');
    }

    public function setBaseUri(string $api)
    {
        $this->api = $api;

        return $this;
    }

    public function getOptions()
    {
        $headers['Accept'] = 'application/json';
        if ($token = $this->getToken()) {
            $headers['Authorization'] = $token;
        }

        return [
            'base_uri' => $this->getBaseUri(),
            'timeout' => 60, // 请求 60s 超时
            'http_errors' => false,
            'headers' => $headers,
        ];
    }

    public function getAccount()
    {
        return config('e-cloud-housekeeper.account');
    }

    public function getPassword()
    {
        return config('e-cloud-housekeeper.password');
    }

    public function eCloudLogin()
    {
        $data = cache()->rememberForever(ECloudHousekeeperClient::TOKEN_NAME, function () {
            $resp = $this->json('/member/login', [
                'account' => $this->getAccount(),
                'password' => $this->getPassword(),
            ]);

            return $resp['data']->toArray();
        });

        if (!$data) {
            cache()->forget(ECloudHousekeeperClient::TOKEN_NAME);
        }

        return $data;
    }

    public function getToken()
    {
        return cache()->get(ECloudHousekeeperClient::TOKEN_NAME)['Authorization'] ?? null;
    }

    public function json(string $url, array $data = [], array $options = [])
    {
        $options = array_merge([
            'json' => $data,
        ], $options);

        $resp = $this->post($url, $options);

        info($url.' '.json_encode($resp->toArray(), 448));

        return $resp;
    }

    public function handleEmptyResponse(?string $content = null, ?ResponseInterface $response = null)
    {
        throw new RuntimeException(sprintf("Request fail , response body is ein class %s", static::class), $response->getStatusCode());
    }

    public function isErrorResponse(array $data): bool
    {
        if (empty($data['code'])) {
            return true;
        }

        return $data['code'] !== "1000";
    }

    public function handleErrorResponse(?string $content = null, array $data = [])
    {
        throw new RuntimeException(sprintf("Request fail, %s", json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)), $data['code'] ?? $data['status']);
    }
}
