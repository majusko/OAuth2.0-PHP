<?php



/**
 * Interface DeviceDaoInt
 * is interface which have to be implemented for right usage of library.
 */
interface DeviceDaoInt {

    public function getDeviceByAccessToken($accessToken);

    public function getDeviceByRefreshToken($refreshToken);

    public function getDeviceByUserId($refreshToken);

    public function insert(Device $device);

    public function ubpdate(Device $device);

    public function delete(Device $device);

}