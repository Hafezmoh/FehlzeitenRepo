<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mitarbeiter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_role_session')) {
            redirect('userlogin');
        }
    }

    public function formular_con()
    {
        $array['users_array'] = $this->dbmodel->get_all_users();
        $this->load->view('layout/header');
        $this->load->view('client/sideNavClient');
        $this->load->view('client/formular', $array);
        $this->load->view('layout/footer');
    }

    public function fun_add_fehlzeit()
    {
        $user_id = $this->session->userdata('user_id_session');
        $krank_id = $this->input->post('name');
        $grund = $this->input->post('radio');
        $notiz = $this->input->post('note');
        $von = $this->input->post('von_date');
        $bis = $this->input->post('bis_date');
        $von_uhr = $this->input->post('von_uhr');
        $bis_uhr = $this->input->post('bis_uhr');
        $reg_datum = date('Y-m-d H:i');
        if ($von > $bis) {
            $temp = $von;
            $von = $bis;
            $bis = $temp;
        }
        $ist_fehlzeit_addiert = $this->dbmodel->add_fehlzeit($user_id, $krank_id, $grund, $notiz, $von, $bis, $von_uhr, $bis_uhr, $reg_datum);
        if ($ist_fehlzeit_addiert == 1) {
            $this->session->set_userdata('time_added', 1);
        }
        redirect('fehlzeiten_view');
    }
}
