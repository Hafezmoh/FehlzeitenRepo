<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_role_session')) {
            redirect('userlogin');
        }
    }

    public function all_fehlzeiten()
    {
        $this->load->helper('info_helper');
        $array['mitarbeiter_from_DB'] = $this->dbmodel->get_all_fehlzeiten();
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav');
        $this->load->view('admin/fehlzeiten', $array);
        $this->load->view('layout/footer');
    }

    public function all_mitarbeiter()
    {
        $array['mitarbeiter_from_DB'] = $this->dbmodel->get_all_users();
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav');
        $this->load->view('admin/all_mitarbeiter', $array);
        $this->load->view('layout/footer');
    }

    public function add_mitarbeiter()
    {
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav');
        $this->load->view('admin/add_mitarbeiter');
        $this->load->view('layout/footer');
    }

    public function con_add_mitarbeiter()
    {
        $mit_name      =   $this->input->post('m_name');
        $mit_nachname  =   $this->input->post('nach_name');
        $mit_benuzter  =   $this->input->post('b_name');
        $mit_password  =   $this->input->post('passwort');
        $key = $this->encryption->encrypt($mit_password);
        $is_mit_added = $this->dbmodel->add_new_mitarbeiter($mit_name, $mit_nachname, $mit_benuzter, $key);
        if ($is_mit_added == 1) {
            $this->session->set_userdata('success', 1);
        } else {
            $this->session->set_userdata('fail', 1);
        }
        redirect('add_mitarbeiter_ref');
    }

    public function update_mit_in_DB()
    {
        $mit_id              = $this->input->post('mit_id');
        $mit_vorname         = $this->input->post('m_name');
        $mit_nachname        = $this->input->post('nach_name');
        $mit_benuzter_name   = $this->input->post('b_name');
        $mit_password        = $this->input->post('passwort');
        $key = $this->encryption->encrypt($mit_password);
        $name_not_changed = $this->dbmodel->check_is_same_Bname($mit_id, $mit_benuzter_name);
        $is_Benuzter_exsitiert = $this->dbmodel->check_is_Bname_existiert($mit_benuzter_name);
        if ($name_not_changed == 1) {
            if ($mit_password == "") {
                $is_mit_updated = $this->dbmodel->update_mitarbeiter_same_Bname($mit_id, $mit_vorname, $mit_nachname);
                if ($is_mit_updated == 1) {
                    $this->session->set_userdata('success_updated', 1);
                }
            } else {
                $is_mit_updated = $this->dbmodel->update_mitarbeiter_with_pass_same_Bname($mit_id, $mit_vorname, $mit_nachname, $key);
                if ($is_mit_updated == 1) {
                    $this->session->set_userdata('success_updated', 1);
                }
            }
        } else {
            if ($is_Benuzter_exsitiert == 1) {
                $this->session->set_userdata('fail_name', 1);
                redirect('update_mitarbeiter/' . $mit_id);
            } else {
                $is_mit_updated = $this->dbmodel->update_mitarbeiter_with_pass($mit_id, $mit_vorname, $mit_nachname, $mit_benuzter_name, $key);
                if ($is_mit_updated == 1) {
                    $this->session->set_userdata('success_updated', 1);
                }
            }
        }

        redirect('all_mitarbeiter_ref/');
    }

    public function update_mit($id)
    {
        $array['get_mit_info_from_DB'] = $this->dbmodel->get_mit($id);
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav');
        $this->load->view('admin/update_mit', $array);
        $this->load->view('layout/footer');
    }

    public function delete_mitarbeiter($id)
    {
        $this->dbmodel->delete_all_fehlzeiten($id);
        $is_mitarbeiter_deleted = $this->dbmodel->delete_mitarbeiter($id);
        if ($is_mitarbeiter_deleted == 1) {
            $this->session->set_userdata('deleted', 1);
        }
        redirect('all_mitarbeiter_ref');
    }

    public function update_admin_pass()
    {
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav');
        $this->load->view('admin/update_pass');
        $this->load->view('layout/footer');
    }

    public function update_admin_pass_in_DB()
    {
        $admin_password        = $this->input->post('passwort');
        $key = $this->encryption->encrypt($admin_password);

        $is_admin_pass_changed = $this->dbmodel->change_admin_pass_in_DB($key);

        if ($is_admin_pass_changed == 1) {
            $this->session->set_userdata('success_admin_pass_updated', 1);
        }
        redirect('all_mitarbeiter_ref/');
    }
}
