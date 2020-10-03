<?php
function geridon(){
    redirect($_SERVER['HTTP_REFERER']);
}
function anliksayfa($str,$n=2){
    $ci=&get_instance();
//    return  $ci->uri->segment(2);
    return  ($str==$ci->uri->segment($n)? true : false);
}
function anliksaBas($str){
    if (anliksayfa($str)){
        echo "bg-gray-900";
    }
}
function outputProgress($current, $total) {
    echo "<span style='position: absolute;z-index:$current;background:#FFF;'>" . round($current / $total * 100) . "% </span>";
    myFlush();
    sleep(1);
}

/**
 * Flush output buffer
 */
function myFlush() {
    echo(str_repeat(' ', 256));
    if (@ob_get_contents()) {
        @ob_end_flush();
    }
    flush();
}
function boyutDon($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}

function rastgeleuret($length = 3) {
    $characters = 'aeijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function bas($metin){
    echo $metin;
    echo "<hr>";
}
function bg(){
    $files = glob("assets/images/bg" . '/*.*');
    return $files[array_rand($files)];

}
function arasinial($metin, $basi, $sonu){
    $metin = ' ' . $metin;
    $ini = strpos($metin, $basi);
    if ($ini == 0) return '';
    $ini += strlen($basi);
    $len = strpos($metin, $sonu, $ini) - $ini;
    return substr($metin, $ini, $len);
}
function postt($post){
    $ci =& get_instance();
    return $ci->input->post($post);
}
function postvarmi($post){
    $ci =& get_instance();
    if($ci->input->post($post)!=null){
        return true;
    }
}
function rastgel(){
    $sayi=rand(0,1500);
    return "?v=$sayi";
//    return "";
}
function sayfayagit($str){
    redirect(base_url($str));
}
function icerirseaktif(...$str){
   $var=false;
    foreach ($str as $item) {
        if (strpos(current_url(), $item) !== false) {
            $var=true;
        }
   }

    if($var) return "bg-gray-900";
}
function insertDon(...$var){


    $arr=array();
    foreach ($var as $key=>$eleman) {
        $arr[$eleman]=postt($eleman);
    }
    return $arr;
}function insertDon2($var){

    $arr=array();
    foreach ($var as $key=>$eleman) {

        $arr[$eleman]=postt($eleman);
    }
    return $arr;
}
function seoUrl ( $fonktmp ) {
    $returnstr = "";
    $turkcefrom = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
    $turkceto   = array("G","U","S","I","O","C","g","u","s","i","o","c");
    $fonktmp = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/"," ",$fonktmp);
    // Türkçe harfleri ingilizceye çevir
    $fonktmp = preg_replace($turkcefrom,$turkceto,$fonktmp);
    // Birden fazla olan boşlukları tek boşluk yap
    $fonktmp = preg_replace("/ +/"," ",$fonktmp);
    // Boşukları - işaretine çevir
    $fonktmp = preg_replace("/ /","-",$fonktmp);
    // Tüm beyaz karekterleri sil
    $fonktmp = preg_replace("/\s/","",$fonktmp);
    // Karekterleri küçült
    $fonktmp = strtolower($fonktmp);
    // Başta ve sonda - işareti kaldıysa yoket
    $fonktmp = preg_replace("/^-/","",$fonktmp);
    $fonktmp = preg_replace("/-$/","",$fonktmp);
    $returnstr =  $fonktmp;
    return $returnstr;
}
function kisalt($str,$len=17){
    if (mb_strlen($str)<$len) return $str;
    return mb_substr($str,0,$len).'..';
}
function zamanyazi($datetime = 'now'){
    return strftime('%d %B %Y %A ',strtotime($datetime));
}