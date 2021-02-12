<?php

namespace TeiaCardSdk\Data\Requests\Autenticacao;

use TeiaCardSdk\Data\Traits\FormatDataTrait;
use TeiaCardSdk\Data\DataTransferObject;

class Credenciais extends DataTransferObject
{
    use FormatDataTrait;

    /** @var string */
    private $client_id;

    /** @var string */
    private $client_secret;

    /** @var string */
    private $grant_type;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var string */
    private $refresh_token;

    /** @var string  */
    private const GRANT_TYPE_PASSWORD = 'password';

    /** @var string  */
    private const GRANT_TYPE_REFRESH_TOKEN = 'refresh_token';

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     * @return Credenciais
     */
    public function setClientId(string $client_id): Credenciais
    {
        $this->client_id = $client_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    /**
     * @param string $client_secret
     * @return Credenciais
     */
    public function setClientSecret(string $client_secret): Credenciais
    {
        $this->client_secret = $client_secret;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Credenciais
     */
    public function setUsername(string $username): Credenciais
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Credenciais
     */
    public function setPassword(string $password): Credenciais
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }

    /**
     * @param string $refresh_token
     * @return $this
     */
    public function setRefreshToken(string $refresh_token): Credenciais
    {
        $this->refresh_token = $refresh_token;
        return $this;
    }

    public function setGrantTypePassword(): Credenciais
    {
        $this->grant_type = self::GRANT_TYPE_PASSWORD;
        return $this;
    }

    public function setGrantTypeRefreshToken(): Credenciais
    {
        $this->grant_type = self::GRANT_TYPE_REFRESH_TOKEN;
        return $this;
    }
}
