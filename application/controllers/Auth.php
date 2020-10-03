<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{

    public function __construct()
{
    parent::__construct();
    // Your own constructor code
    giriskontrolu();
}

    public function tokenal()
    {

        require APPPATH . 'libraries/google-php-client/vendor/autoload.php';
        $client = new Google_Client();
        $client->setApplicationName('Google Drive Direct Link');
        $client->setRedirectUri('https://www.gdriving.tk/auth/redirect');
        $client->setScopes(Google_Service_Drive::DRIVE);
//        $client->setAuthConfig('credentials.json');
        $client->setClientId(OAUTH2_CLIENT_ID);
        $client->setClientSecret(OAUTH2_CLIENT_SECRET);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $tokenPath = 'token.json';

        if (tokenvarmi()){
            $client->setAccessToken(tokenvarmi());
            echo ("token alınmış");

        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                $authUrl = $client->createAuthUrl();
                header('Location: '.$authUrl);

            }
            // Save the token to a file.

        }
        
}

    public function redirect()
    {
        require APPPATH . 'libraries/google-php-client/vendor/autoload.php';
        $client = new Google_Client();
        $client->setApplicationName('Google Drive Direct Link');
        $client->setRedirectUri('https://www.gdriving.tk/auth/redirect');
        $client->setScopes(Google_Service_Drive::DRIVE);
        $client->setAuthConfig('credentials.json');

        $authCode = trim($_GET['code']);
        // Exchange authorization code for an access token.
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        $client->setAccessToken($accessToken);

        // Check to see if there was an error.
        if (array_key_exists('error', $accessToken)) {
            throw new Exception(join(', ', $accessToken));
        }

       tokenguncelle($client->getAccessToken());

        sayfayagit("");
    }
}
