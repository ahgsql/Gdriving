<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Gdrive extends CI_Controller
{
    public function dosyalistesi()
    {
        require APPPATH . 'libraries/google-php-client/vendor/autoload.php';
        $client = new Google_Client();
        $client->setAuthConfig('credentials.json');
        $accessToken = json_decode(tokenvarmi(), true);
        $client->setAccessToken($accessToken);
        $service = new Google_Service_Drive($client);

        $parameters['q'] = "mimeType='application/vnd.google-apps.folder' and 'root' in parents and trashed=false";
        $parameters2['q'] = "mimeType!='application/vnd.google-apps.folder' and 'root' in parents and trashed=false";
        $klasorler = $service->files->listFiles($parameters);
        $dosyalar = $service->files->listFiles($parameters2);
        $don=array();

        foreach ($klasorler as $k => $klasor) {
            $detay=array(
                "adi"=>$klasor['name'],
                "id"=>$klasor['id'],
                "turu"=>$klasor['mimeType']
            );
            $don['klasorler'][]=$detay;
        }
        foreach ($dosyalar as $k => $dosya) {
            $detay=array(
                "adi"=>$dosya['name'],
                "id"=>$dosya['id'],
                "turu"=>$dosya['mimeType']
            );
            $don['dosyalar'][]=$detay;
        }
        header('Content-Type: application/json');
        echo json_encode($don);
    }
    public function klasor($id)
    {
        require APPPATH . 'libraries/google-php-client/vendor/autoload.php';
        $client = new Google_Client();
        $client->setAuthConfig('credentials.json');
        $accessToken = json_decode(tokenvarmi(), true);
        $client->setAccessToken($accessToken);
        $service = new Google_Service_Drive($client);

        $parameters['q'] = "mimeType='application/vnd.google-apps.folder' and '{$id}' in parents and trashed=false";
        $parameters2['q'] = "mimeType!='application/vnd.google-apps.folder' and '{$id}' in parents and trashed=false";
        $klasorler = $service->files->listFiles($parameters);
        $dosyalar = $service->files->listFiles($parameters2);

        $don=array();

        foreach ($klasorler as $k => $klasor) {
            $detay=array(
                "adi"=>$klasor['name'],
                "id"=>$klasor['id'],
                "turu"=>$klasor['mimeType']
            );
            $don['klasorler'][]=$detay;
        }
        foreach ($dosyalar as $k => $dosya) {
            $detay=array(
                "adi"=>$dosya['name'],
                "id"=>$dosya['id'],
                "turu"=>$dosya['mimeType']
            );
            $don['dosyalar'][]=$detay;
        }
        header('Content-Type: application/json');

        echo json_encode($don);
    }

    public function dosya($id)
    {

    }
}
