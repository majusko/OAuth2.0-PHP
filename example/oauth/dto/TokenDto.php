<?php

/**
 * Class TokenDto
 * is class of data transfer layer which is used for requested access token response
 */
class TokenDto {

    public $access_token;
    public $expires_in;
    public $refresh_token;

    /**
     * @param Device $device - Constructor will convert domain object into data transfer object.
     */
    function __construct(Device $device) {
        $this->access_token = $device->getAccessToken();
        $this->expires_in = $device->getExpireToken();
        $this->refresh_token = $device->getRefreshToken();
    }

    /**
     * @param mixed $access_token - Access token.
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * @return mixed - Access token.
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @param mixed $expires_in - Expiration of access token information.
     */
    public function setExpiresIn($expires_in)
    {
        $this->expires_in = $expires_in;
    }

    /**
     * @return mixed - Expiration of access token information.
     */
    public function getExpiresIn()
    {
        return $this->expires_in;
    }

    /**
     * @param mixed $refresh_token - Refresh token.
     */
    public function setRefreshToken($refresh_token)
    {
        $this->refresh_token = $refresh_token;
    }

    /**
     * @return mixed - Refresh token.
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

} 