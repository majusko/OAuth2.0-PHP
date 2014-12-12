<?php

class AuthCommon {

    //HEADER_PARAMS
    const HEADER_AUTHORIZATION = "Authorization";
    const BEARER = "Bearer";
    const BASIC = "Basic";

    //URL_PARAMS
    const EMAIL = "email";
    const CLIENT_ID = "client_id";
    const CLIENT_SECRET = "client_secret";
    const GRAND_TYPE = "grant_type";
    const INSTALLATION_ID = "installation_id";

    //GRAND TYPE = registration
    //potrebujes - registration_code, client id, client secret
    const GRAND_TYPE_REGISTRATION = "registration";
    const REGISTRATION_CODE = "registration_code";

    //GRAND TYPE = password
    //potrebujes - client id, client secret, username, pass, installation_d
    const GRAND_TYPE_PASSWORD = "password";
    const USERNAME = "username";
    const PASSWORD = "password";
    const APPVERSION = "appversion";

    //GRAND TYPE = facebook
    //potrebujes - client id, client secret, facebook_access_token, installation_id
    const GRAND_TYPE_FACEBOOK = "facebook";
    const FACEBOOK_ACCESS_TOKEN = "facebook_access_token";

    //GRAND TYPE = google
    //potrebujes - client id, client secret, google_access_token, installation_id
    const GRAND_TYPE_GOOGLE = "google";
    const GOOGLE_ACCESS_TOKEN = "google_access_token";

    //GRAND TYPE = refresh_token
    //potrebujes - client id, client secret, refresh_token
    const GRAND_TYPE_REFRESH_TOKEN = "refresh_token";
    const REFRESH_TOKEN = "refresh_token";

    //GRAND TYPE = authorization_code
    //potrebujes - client id, client secret, authorization_code, code
    const GRAND_TYPE_AUTHORIZATION_CODE = "authorization_code";
    const CODE = "code";

    /**
     * Common messages
     */
    const INVALID_TOKEN_MESSAGE = "Access token is not valid.";

}