<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    // public function index()
    // {
    // 	$this->load->view('layout/header');	
    // 	$this->load->view('welcome_message');
    // 	$this->load->view('layout/footer');	
    // }

    public function register()
    {
        $username =  $this->input->post('username');
        $userpass =  $this->input->post('password');

        // $key = $this->config->item('encryption_key');
        // $salt1 = hash('sha512', $key . $userpass);
        // $salt2 = hash('sha512', $userpass  . $key);
        // $hashedCode = hash('sha512', $salt1 . $userpass  . $salt2);

        $check_user_type = $this->dbmodel->checkuser($username, $userpass);
        // $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        // $project_array['worked_time_from_DB'] = $this->dbmodel->get_all_project_time();

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
