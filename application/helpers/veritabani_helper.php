<?php


function tabloAl($tablo){
    $ci =& get_instance();
    $tumData=$ci->db->get($tablo)->result();
    return $tumData;
}
function satirAl($tablo,$id){
    $ci =& get_instance();
    $tumData=$ci->db->where("id",$id)->get($tablo)->row();
    return $tumData;
}

function tablolar(){
    $ci =& get_instance();
    return $ci->db->list_tables();
}
function tabloAlanlari($tablo){
    $ci =& get_instance();
    return $ci->db->list_fields($tablo);
}