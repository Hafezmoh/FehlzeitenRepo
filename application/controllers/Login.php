<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function register()
    {
        $username =  $this->input->post('username');
        $userpass =  $this->input->post('password');
        $check_user_type = $this->dbmodel->checkuser($username, $userpass);
        switch ($check_user_type) {
            case 1:                //  1 is the admin role
                $this->load->helper('info_helper');
                $array['mitarbeiter_from_DB'] = $this->dbmodel->get_all_fehlzeiten();
                $this->load->view('layout/header');
                $this->load->view('admin/sidenav');
                $this->load->view('admin/fehlzeiten', $array);
                $this->load->view('layout/footer');
                $array['error'] = null;
                break;

            case 2:                // 2 is the client role
                $array['users_array'] = $this->dbmodel->get_all_users();
                $this->load->view('layout/header');
                $this->load->view('client/sideNavClient');
                $this->load->view('client/formular', $array);
                $this->load->view('layout/footer');
                $array['error'] = null;
                break;

            case 0:                // 0 is wrong user name or password
                $array['error'] = 1;
                $this->load->view('login', $array);
                // Fehler msg!!
                break;
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $array['error'] = null;
        $this->load->view('login', $array);
    }
}
