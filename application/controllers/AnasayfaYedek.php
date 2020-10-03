<?php

/**
 * Created by PhpStorm.
 * User: AliGulec
 * Date: 17.06.2018
 * Time: 17:58
 */
class Anasayfa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        giriskontrolu();
    }

    public function index()
    {
        $this->load->view('anasayfa');
    }

    public function gdRoot()
    {
        $this->load->view('gdrive', array("icerik" => gdRoot()));
    }

    public function indir($id)
    {
        dosyaindir($id,500000);
    }

    public function dlgenerator($id)
    {
        $dosyabilgi = gdFile($id);
        $this->load->view("dlgenerator",array("dosya"=>$dosyabilgi));
    }
    public function gdKlasor($id)
    {
        $this->load->view('gdrive', array("icerik" => gdKlasor($id)));
    }

    public function gdfile($id)
    {
        $this->load->view('gfile', array("icerik" => gdFile($id)));

    }

    public function driveOauth()
    {
        require APPPATH . 'libraries/google-php-client/vendor/autoload.php';
        $client = new Google_Client();
        $client->setRedirectUri('https://gdriving.tk/anasayfa/oAuthDon');

        $client->setScopes(Google_Service_Drive::DRIVE);
        $client->setAuthConfig('credentials.json');
        $authCode = trim($_GET['code']);

        // Exchange authorization code for an access token.
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        $client->setAccessToken($accessToken);
        $tokenPath = 'token.json';
        // Check to see if there was an error.
        if (array_key_exists('error', $accessToken)) {
            throw new Exception(join(', ', $accessToken));
        }
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        tokenguncelle($client->getAccessToken());

        sayfayagit("");

    }

    public function getAccess()
    {
        require APPPATH . 'libraries/google-php-client/vendor/autoload.php';

        $client = new Google_Client();
        $client->setApplicationName('Google Drive API PHP Quickstart');
        $client->setRedirectUri('https://gdriving.tk/anasayfa/oAuthDon');

        $client->setScopes(Google_Service_Drive::DRIVE);
        $client->setAuthConfig('credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                echo "Buraya Gidin: <a href='" . $authUrl . "'>GİT</a>";

            }
            // Save the token to a file.

        }

    }

    public function afterToken()
    {
        require APPPATH . 'libraries/google-php-client/vendor/autoload.php';
        $client = new Google_Client();
        $client->setApplicationName('Google Drive API PHP Quickstart');
        $client->setRedirectUri('https://gdriving.tk/anasayfa/oAuthDon');
        $client->setScopes(Google_Service_Drive::DRIVE);
        $client->setAuthConfig('credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        $accessToken = json_decode(tokenvarmi(), true);
        $client->setAccessToken($accessToken);

        $service = new Google_Service_Drive($client);

        $parameters['q'] = "mimeType!='application/vnd.google-apps.folder' and 'root' in parents and trashed=false";
        $files = $service->files->listFiles($parameters);

// s
//                $fileId = "0B4guLkV2jkFFbEhtdU1qS3lBWTA"; // Google File ID
//            $content = $service->files->get($fileId, array("alt" => "media"));
//
//// Open file handle for output.
//
//            $outHandle = fopen("dosya.zip", "w+");
//
//// Until we have reached the EOF, read 1024 bytes at a time and write to the output file handle.
//
//            while (!$content->getBody()->eof()) {
//                fwrite($outHandle, $content->getBody()->read(1024));
//            }
//
//// Close output file handle.
//
//            fclose($outHandle);
//            echo "Done.\n";
        echo "<ul>";
        foreach ($files as $k => $file) {
            echo "<li> 
        
            {$file['name']} - {$file['id']} ---- " . $file['mimeType'];

            try {
                // subfiles
                $sub_files = $service->files->listFiles(array('q' => "'{$file['id']}' in parents"));
                echo "<ul>";
                foreach ($sub_files as $kk => $sub_file) {
                    echo "<li&gt {$sub_file['name']} - {$sub_file['id']}  ---- " . $sub_file['mimeType'] . " </li>";
                }
                echo "</ul>";
            } catch (\Throwable $th) {
                // dd($th);
            }

            echo "</li>";
        }
        echo "</ul>";
    }

}