<?php
/**
 * Device store access token information
 * User: mario
 * Date: 11/12/14
 * Time: 20:29
 */

class Device {

    private $accessToken;
    private $refreshToken;
    private $expireToken;
    private $installationId;

    function __construct($accessToken, $expireToken, $installationId, $refreshToken)
    {
        $this->accessToken = $accessToken;
        $this->expireToken = $expireToken;
        $this->installationId = $installationId;
        $this->refreshToken = $refreshToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $expireToken
     */
    public function setExpireToken($expireToken)
    {
        $this->expireToken = $expireToken;
    }

    /**
     * @return mixed
     */
    public function getExpireToken()
    {
        return $this->expireToken;
    }

    /**
     * @param mixed $installationId
     */
    public function setInstallationId($installationId)
    {
        $this->installationId = $installationId;
    }

    /**
     * @return mixed
     */
    public function getInstallationId()
    {
        return $this->installationId;
    }

    /**
     * @param mixed $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @return mixed
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

} 