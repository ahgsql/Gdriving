<?php

function tokenguncelle($token)
{
    $ci =& get_instance();
    $json = json_encode($token);
    $ci->db->where("kadi", sezonuseri())->update("kullanicilar", array("token" => $json));
    return true;
}
function onbellekAcik()
{
    $ci =& get_instance();
    $onbellek = $ci->db->where("kadi", sezonuseri())->get("kullanicilar")->row()->onbellegeAl;
    if ($onbellek ==1) {
        return true;
    }
    return false;
}


function tokenvarmi()
{
    $ci =& get_instance();

    $token = $ci->db->where("kadi", sezonuseri())->get("kullanicilar")->row();
    if ($token and strlen($token->token) > 10) {
        return $token->token;
    }
    return false;
}

function dosyaindir($id, $chunk = 1024)
{
    $ci =& get_instance();

    if (ob_get_level() == 0) ob_start();

    require APPPATH . 'libraries/google-php-client/vendor/autoload.php';
    $client = new Google_Client();
    $client->setAuthConfig('credentials.json');
    $accessToken = json_decode(tokenvarmi(), true);
    $client->setAccessToken($accessToken);
    $service = new Google_Service_Drive($client);

    $dosyabilgi = gdFile($id);
    $content = $service->files->get($id, array("alt" => "media"));
    $dosyayolu="files/".$dosyabilgi->isim;
    $outHandle = fopen($dosyayolu, "w+");
    $downloaded = 0;
    $total=$dosyabilgi->boyut;

    while (!$content->getBody()->eof()) {
        $yuzde=100*$downloaded/$total;

        echo round($yuzde,2) . "-";
        $downloaded += $chunk;
        echo str_pad('', 4096) . "\n";
        fwrite($outHandle, $content->getBody()->read($chunk));
        ob_flush();
        flush();
    }
    $kaydet=array("directlink"=>$dosyayolu,"fileId"=>$id,"kullaniciId"=>ben()->id,"dosyaAdi"=>$dosyabilgi->isim);
    $varmi=$ci->db->where("fileId",$id)->get("linkler")->num_rows();
    if($varmi<1){
        $ci->db->insert("linkler",$kaydet);

    }
    fclose($outHandle);

    ob_end_flush();

}
function linkler(){
    $ci =& get_instance();
    return $ci->db->where("kullaniciId",ben()->id)->get("linkler")->result();
}
function dosyalistele()
{
    require APPPATH . 'libraries/google-php-client/vendor/autoload.php';
    $client = new Google_Client();
    $client->setAuthConfig('credentials.json');
    $accessToken = json_decode(tokenvarmi(), true);
    $client->setAccessToken($accessToken);
    $service = new Google_Service_Drive($client);

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
//    $parameters['q'] = "mimeType='application/vnd.google-apps.folder' and 'root' in parents and trashed=false";
    $parameters['q'] = "mimeType='application/vnd.google-apps.folder' and 'root' in parents and trashed=false";
    $parameters2['q'] = "mimeType!='application/vnd.google-apps.folder' and 'root' in parents and trashed=false";
    $klasorler = $service->files->listFiles($parameters);
    $dosyalar = $service->files->listFiles($parameters2);

    $klasor = '1DIpnNPEHrUZFfihVVyQiKENFA0Sgzqs4';
    $icerik = $service->files->listFiles(array('q' => "'{$klasor}' in parents"));
    foreach ($dosyalar as $k => $file) {
        echo "<li> 
            {$file['name']} - {$file['id']} ---- " . $file['mimeType'];
        try {
            // subfiles
            $sub_files = $service->files->listFiles(array('q' => "'{$file['id']}' in parents"));
            echo "<ul>";
            foreach ($sub_files as $kk => $sub_file) {

                echo "<li> {$sub_file['name']} - {$sub_file['id']}  ---- " . $sub_file['mimeType'] . " </li>";
            }
            echo "</ul>";
        } catch (\Throwable $th) {
            // dd($th);
        }

        echo "</li>";
    }
    die();
    echo "<ul>";
    foreach ($klasorler as $k => $file) {
        echo "<li> 
            {$file['name']} - {$file['id']} ---- " . $file['mimeType'];
        try {
            // subfiles
            $sub_files = $service->files->listFiles(array('q' => "'{$file['id']}' in parents"));
            echo "<ul>";
            foreach ($sub_files as $kk => $sub_file) {

                echo "<li> {$sub_file['name']} - {$sub_file['id']}  ---- " . $sub_file['mimeType'] . " </li>";
            }
            echo "</ul>";
        } catch (\Throwable $th) {
            // dd($th);
        }

        echo "</li>";
    }
    echo "</ul>";
}
function objectify(& $v, $k) {
    $v_decoded = json_decode($v, true);
    if ($v_decoded) { $v = $v_decoded; }
}
function gdRoot()
{

    $ci =& get_instance();
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
    $don = array();
    $don['klasorler'] = [];
    $don['dosyalar'] = [];
    foreach ($klasorler as $k => $klasor) {
        $detay = array(
            "adi" => $klasor['name'],
            "id" => $klasor['id'],
            "turu" => $klasor['mimeType']
        );
        $don['klasorler'][] = $detay;

        $ekle=array(
            "kullanici"=>sezonuseri(),
            "tur"=>"klasor",
            "driveId"=>$klasor['id'],
        );
        $varmi=$ci->db->where("driveId",$klasor['id'])->get("onbellek")->num_rows();
        if($varmi<1){
            $ci->db->insert("onbellek",$ekle);

        }

    }
    foreach ($dosyalar as $k => $dosya) {

        $optpParams = array(
            'fields' => "size"
        );
        $response = $service->files->get($dosya['id'], $optpParams);
        $detay = array(
            "adi" => $dosya['name'],
            "id" => $dosya['id'],
            "turu" => $dosya['mimeType'],
            "boyut" => boyutDon($response->size)
        );
        $ekle=array(
            "kullanici"=>sezonuseri(),
            "tur"=>"dosya",
            "driveId"=>$dosya['id'],
        );
         $varmi=$ci->db->where("driveId",$dosya['id'])->get("onbellek")->num_rows();
         if($varmi<1){
             $ci->db->insert("onbellek",$ekle);

         }
        $don['dosyalar'][] = $detay;
    }


    return $don;
}

function gdKlasor($id)
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

    $don = array();
    $don['klasorler'] = [];
    $don['dosyalar'] = [];
    foreach ($klasorler as $k => $klasor) {
        $detay = array(
            "adi" => $klasor['name'],
            "id" => $klasor['id'],
            "turu" => $klasor['mimeType'],
        );
        $don['klasorler'][] = $detay;
    }
    foreach ($dosyalar as $k => $dosya) {
        $optpParams = array(
            'fields' => "size"
        );
        $response = $service->files->get($dosya['id'], $optpParams);
        $detay = array(
            "adi" => $dosya['name'],
            "id" => $dosya['id'],
            "turu" => $dosya['mimeType'],
            "boyut" => boyutDon($response->size)
        );
        $don['dosyalar'][] = $detay;
    }
    return $don;
}

function gdFile($id)
{
    require APPPATH . 'libraries/google-php-client/vendor/autoload.php';
    $client = new Google_Client();
    $client->setAuthConfig('credentials.json');
    $accessToken = json_decode(tokenvarmi(), true);
    $client->setAccessToken($accessToken);
    $service = new Google_Service_Drive($client);
    $optpParams = array(
        'fields' => "size,name,mimeType,parents,webContentLink,fileExtension"
    );
    $response = $service->files->get($id, $optpParams);
    $detay = array(
        "boyut" => $response['size'],
        "id" => $id,
        "isim" => $response['name'],
        "tur" => $response['fileExtension'],
        "parents" => $response['parents'],
        "indirmelinki" => $response['webContentLink']
    );
    return (object)$detay;
}