<?php
/**
 * Created by PhpStorm.
 * User: AliGulec
 * Date: 17.03.2019
 * Time: 12:23
 */

function logout(){
    $ci =& get_instance();
    $ci->session->sess_destroy();
    redirect(base_url());
}
function giriskontrolu(){
    $ci =& get_instance();
    if($ci->session->userdata("logged")!="1"){
        $url= base_url(uri_string());
        $ci->session->set_userdata("return",$url);
        redirect(base_url("login"));
        die();
    }
}
function ben(){
    $ci =& get_instance();
    return $ci->db->where("kadi",sezonuseri())->get("kullanicilar")->row();
}

function login_kontrolu($kadi,$sifre){
    $ci =& get_instance();
    $uservarmi=$ci->db->where("kadi",$kadi)->get("kullanicilar")->num_rows();
    if ($uservarmi<1){
        return 0;
    }
    $gerceksifre=$ci->db->where("kadi",$kadi)->get("kullanicilar")->row()->sifre;
    if ($sifre==$gerceksifre){
        $ci->session->set_userdata("logged","1");
        $ci->session->set_userdata("user",$kadi);
        return true;
    }else{
        return false;
    }

}

function sezonuseri(){
    $ci =& get_instance();
    return $ci->session->userdata("user");
}
