<?php

/**
 * Interface DeviceDaoInt
 * is interface which have to be implemented for right usage of library.
 */
interface DeviceDaoInt {

    public function getDeviceByAccessToken($accessToken);

    public function getDeviceByRefreshToken($refreshToken);

    public function getDeviceByUserIdAndInstallationId($refreshToken, $installationId);

    public function insert(Device $device);

    public function update(Device $device);

    public function delete(Device $device);

}