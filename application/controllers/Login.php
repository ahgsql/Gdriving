<?php

/**
 * Created by PhpStorm.
 * User: AliGulec
 * Date: 19.11.2018
 * Time: 13:18
 */
class Login extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata("logged") == "1") {
            redirect(base_url());
            die();
        }
        $this->load->view("login");
    }

    public function girdir()
    {
        if ($this->session->userdata("logged") == "1") {
            redirect(base_url());
            die();
        }

        $sifre = $this->input->post("sifre");
        $kadi = $this->input->post("kadi");

        $girdimi = login_kontrolu($kadi,$sifre);

        if ($girdimi) {
            $url = $this->session->return;
            $this->session->unset_userdata("return");
            redirect($url);
        } else {
            //hatamesaji("Giriş Başarısız");
            redirect(base_url());
        }


    }

    public function cikis()
    {
        logout();
    }

}