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

    public function bak()
    {
        header('Content-Type: application/json');
        echo json_encode(gdRoot());

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
        dosyaindir($id,1200024);
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

    }  public function linkler()
    {
        $this->load->view('linkler');

    }

    public function onbellek()
    {
        $onbellek=$this->db->where("kadi", sezonuseri())->get("kullanicilar")->row()->onbellegeAl;
        $yeni=($onbellek==1?0:1);
        $this->db->where("kadi", sezonuseri())->update("kullanicilar",array("onbellegeAl"=>$yeni));
        geridon();
    }



}