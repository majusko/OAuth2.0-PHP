<?php

/**
 * Class Device
 * is domain level class which is needed for authorization process.
 * Handling token data stored in database.
 */
class Device {

    protected $userId;
    protected $accessToken;
    protected $refreshToken;
    protected $expireToken;
    protected $installationId;

    function __construct($accessToken, $expireToken, $installationId, $refreshToken, $userId)
    {
        $this->accessToken = $accessToken;
        $this->expireToken = $expireToken;
        $this->installationId = $installationId;
        $this->refreshToken = $refreshToken;
        $this->userId = $userId;
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

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

} 