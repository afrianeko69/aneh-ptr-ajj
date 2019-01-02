<?php

namespace App\Providers;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class PintariaAuthProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(config('services.pintaria_auth_provider.auth_url'), $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return config('services.pintaria_auth_provider.token_url');
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessToken($code)
    {
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'headers' => ['Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret)],
            'body'    => $this->getTokenFields($code),
        ]);

        return $this->parseAccessToken($response->getBody());
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_add(
            parent::getTokenFields($code), 'grant_type', 'authorization_code'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(config('services.pintaria_auth_provider.user_url'), [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function formatScopes(array $scopes, $separator = ' ')
    {
        return implode($separator, $scopes);
    }
    
    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id'        => $user['id'],
            'nickname'  => $user['name'],
            'name'      => $user['name'],
            'email'     => $user['email'],
            'remember'  => !empty($user['remember_token']) ? true : false,
            'avatar'    => !empty($user['images']) ? $user['images'][0]['url'] : null,
        ]);
    }

    public function tokenLink($token)
    {
        $response = $this->getHttpClient()->put(config('services.pintaria_auth_provider.url') . '/api/token-link', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
