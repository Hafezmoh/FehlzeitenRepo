<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_rule_session')) {
            redirect('userlogin');
        }
    }
    public function new_project()
    {
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav', $project_array);
        $this->load->view('admin/add_project');
        $this->load->view('layout/footer');
    }
    public function new_abteilung()
    {
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav', $project_array);
        $this->load->view('admin/add_abteilung');
        $this->load->view('layout/footer');
    }

    public function update_mit($id)
    {

        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $array['get_mit_info_from_DB'] = $this->dbmodel->get_mit($id);
        $array['abteilungen_from_DB'] = $this->dbmodel->get_all_abteilungen();
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav', $project_array);
        $this->load->view('admin/update_mit', $array);
        $this->load->view('layout/footer');
    }

    public function new_mitarbeiter()
    {
        $abteilung_array['abteilungen_from_DB'] = $this->dbmodel->get_all_abteilungen();
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav', $project_array);
        $this->load->view('admin/add_mitarbeiter', $abteilung_array);
        $this->load->view('layout/footer');
    }

    public function all_projects()
    {
        $project_array['worked_time_from_DB'] = $this->dbmodel->get_all_project_time();
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav', $project_array);
        $this->load->view('admin/all_projects', $project_array);
        $this->load->view('layout/footer');
    }

    public function update_project($id)
    {
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $one_project_array['get_one_project_from_DB'] = $this->dbmodel->get_one_project($id);
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav', $project_array);
        $this->load->view('admin/update_project', $one_project_array);
        $this->load->view('layout/footer');
    }

    public function update_time($id)
    {
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $aufgabe_array['get_aufgabe_from_DB'] = $this->dbmodel->get_aufgabe($id);
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav', $project_array);
        $this->load->view('admin/update_time', $aufgabe_array);
        $this->load->view('layout/footer');
    }

    public function all_mitarbeiter()
    {
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $array['mitarbeiter_from_DB'] = $this->dbmodel->get_all_mitarbeiter();
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav', $project_array);
        $this->load->view('admin/all_mitarbeiter', $array);
        $this->load->view('layout/footer');
    }

    public function delete_mit($id)
    {
        $is_last_admin = $this->dbmodel->check_is_last_admin();
        $is_mit = $this->dbmodel->check_is_mit($id);
        if (count($is_mit) == 0) {
            if (count($is_last_admin) != 1) {
                $this->dbmodel->delete_all_aufgaben_von_mitarbeiter($id);
                $is_mit_deleted = $this->dbmodel->delete_mitarbeiter($id);
                if ($is_mit_deleted == 1) {
                    $this->session->set_userdata('mit_deleted', 1);
                }
            } else {
                $this->session->set_userdata('last_admin', 1);
            }
        } else {
            $this->dbmodel->delete_all_aufgaben_von_mitarbeiter($id);
            $is_mit_deleted = $this->dbmodel->delete_mitarbeiter($id);
            if ($is_mit_deleted == 1) {
                $this->session->set_userdata('mit_deleted', 1);
            }
        }
        redirect('admin_all_mitarbeiter');
    }

    public function project($id)
    {
        $one_project_array['worked_time_from_DB'] = $this->dbmodel->get_project_time($id);
        $one_project_array['get_one_project_from_DB'] = $this->dbmodel->get_one_project($id);
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav', $project_array);
        $this->load->view('admin/project', $one_project_array);
        $this->load->view('layout/footer');
    }

    public function add_abteilung()
    {
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $new_abteilung_name =  $this->input->post('abt_name');
        $is_abteilung_added = $this->dbmodel->add_abteilung_name($new_abteilung_name);
        if ($is_abteilung_added == 1) {
            $this->session->set_userdata('success', 1);
        } else {
            $this->session->set_userdata('fail', 1);
        }
        redirect('add_abteilung');
    }

    public function update_abt_in_DB()
    {
        $abt_id =   $this->input->post('abteilung_id');
        $abt_name =   $this->input->post('abt_name');
        $is_abt_updated_ = $this->dbmodel->update_abteilungen_in_DB($abt_id, $abt_name);
        if ($is_abt_updated_ == 1) {
            $this->session->set_userdata('abt_updated', 1);
        } else {
            $this->session->set_userdata('same_name', 1);
        }
        redirect('updateabteilung/' . $abt_id);
    }

    public function delete_project($id)
    {
        $this->dbmodel->delete_all_aufgaben($id);
        $is_pro_deleted = $this->dbmodel->delete_project($id);
        if ($is_pro_deleted == 1) {
            $this->session->set_userdata('deleted', 1);
        }
        redirect('admin_all_projects');
    }

    public function abteilungen()
    {
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $array['abteilungen_from_DB'] = $this->dbmodel->get_all_abteilungen();
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav', $project_array);
        $this->load->view('admin/abteilungen', $array);
        $this->load->view('layout/footer');
    }

    public function delete_abteilung($id)
    {
        $mit_in_deleted_abt = $this->dbmodel->has_abtielung_mit($id);


        $deleted_abt_mit_id =  $mit_in_deleted_abt[0]['m_id'];


        if (isset($mit_in_deleted_abt)) {
            $result = $this->dbmodel->change_abt($deleted_abt_mit_id);
        }
        $is_abt_deleted = $this->dbmodel->delete_abteilung_from_DB($id);
        if ($is_abt_deleted == 1) {
            $this->session->set_userdata('deleted', 1);
        }
        redirect('admin_abteilung');
    }

    public function con_add_mitarbeiter()
    {
        $mit_name      =   $this->input->post('m_name');
        $mit_benuzter  =   $this->input->post('b_name');
        $mit_password  =   $this->input->post('passwort');
        $key = $this->config->item('encryption_key');
        $salt1 = hash('sha512', $key . $mit_password);
        $salt2 = hash('sha512', $mit_password  . $key);
        $hashedCode = hash('sha512', $salt1 . $mit_password  . $salt2);
        $mit_abteilung =   $this->input->post('m_abteilung');
        $mit_is_admin  =   $this->input->post('m_is_admin');
        if (!isset($mit_is_admin)) {
            $mit_is_admin = 2;
        }
        $is_mit_added = $this->dbmodel->add_new_mitarbeiter($mit_name, $mit_benuzter, $hashedCode, $mit_abteilung, $mit_is_admin);
        if ($is_mit_added == 1) {
            $this->session->set_userdata('success', 1);
        } else {
            $this->session->set_userdata('fail', 1);
        }
        redirect('add_mitarbeiter');
    }

    public function update_mit_in_DB()
    {
        $mit_id              = $this->input->post('mit_id');
        $mit_name            = $this->input->post('m_name');
        $mit_benuzter_name   = $this->input->post('b_name');
        $mit_abteilung_id    = $this->input->post('m_abteilung');
        $mit_password        = $this->input->post('passwort');
        $w_password          = $this->input->post('w_passwort');
        if (null !== ($this->input->post('m_is_admin'))) {
            $mit_role       = 1;
        } else {
            $mit_role       = 2;
        }
        $name_not_changed = $this->dbmodel->check_is_same_Bname($mit_id, $mit_benuzter_name);
        $is_last_admin_changed = $this->dbmodel->check_is_last_Admin_changed($mit_id, $mit_role);
        $is_Benuzter_exsitiert = $this->dbmodel->check_is_Bname_existiert($mit_benuzter_name);
        $is_last_admin = $this->dbmodel->check_is_last_admin();
        $is_mit = $this->dbmodel->check_is_mit($mit_id);
        if ($name_not_changed == 1) {
            if ($mit_password == "") {
                if (($is_mit) != 1) {
                    if (($is_last_admin) == 1) {
                        if ($is_last_admin_changed == 1) {
                            $this->session->set_userdata('last_admin', 1);
                            redirect('admin_all_mitarbeiter');
                            return;
                        }
                    }
                }
                $is_mit_updated = $this->dbmodel->update_mitarbeiter_same_Bname($mit_id, $mit_name, $mit_benuzter_name, $mit_abteilung_id, $mit_role);
                if ($is_mit_updated == 1) {
                    $this->session->set_userdata('success_updated', 1);
                }
            } else {
                if ($mit_password == $w_password) {
                    $key = $this->config->item('encryption_key');
                    $salt1 = hash('sha512', $key . $mit_password);
                    $salt2 = hash('sha512', $mit_password  . $key);
                    $hashedCode = hash('sha512', $salt1 . $mit_password . $salt2);
                    $is_mit_updated = $this->dbmodel->update_mitarbeiter_with_pass_same_Bname($mit_id, $mit_name, $mit_benuzter_name, $mit_abteilung_id, $hashedCode, $mit_role);
                    if ($is_mit_updated == 1) {
                        $this->session->set_userdata('success_updated', 1);
                    }
                } else {
                    $this->session->set_userdata('wrong_pass', 1);
                    return;
                }
            }
        } else {
            if ($is_Benuzter_exsitiert == 1) {
                $this->session->set_userdata('fail_name', 1);
            } else {
                if (is_null($mit_password)) {
                    if (($is_mit) != 1) {
                        if (($is_last_admin) == 1) {
                            if ($is_last_admin_changed == 1) {
                                $this->session->set_userdata('last_admin', 1);
                                redirect('admin_all_mitarbeiter');
                                return;
                            }
                        }
                    }
                    $is_mit_updated = $this->dbmodel->update_mitarbeiter($mit_id, $mit_name, $mit_benuzter_name, $mit_abteilung_id, $mit_role);
                    if ($is_mit_updated == 1) {
                        $this->session->set_userdata('success_updated', 1);
                    }
                } else {
                    if ($mit_password == $w_password) {
                        $key = $this->config->item('encryption_key');
                        $salt1 = hash('sha512', $key . $mit_password);
                        $salt2 = hash('sha512', $mit_password  . $key);
                        $hashedCode = hash('sha512', $salt1 . $mit_password  . $salt2);
                        $is_mit_updated = $this->dbmodel->update_mitarbeiter_with_pass($mit_id, $mit_name, $mit_benuzter_name, $mit_abteilung_id, $hashedCode, $mit_role);
                        if ($is_mit_updated == 1) {
                            $this->session->set_userdata('success_updated', 1);
                        }
                    } else {
                        $this->session->set_userdata('wrong_pass', 1);
                        return;
                    }
                }
            }
        }
        redirect('ref_update_mit/' . $mit_id);
    }

    public function  admin_add_time()
    {
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav', $project_array);
        $this->load->view('admin/add_time', $project_array);
        $this->load->view('layout/footer');
    }

    public function act_admin_add_time()
    {
        $user_id = $this->session->userdata('user_id_session');
        $mit_pro_id =  $this->input->post('mit_project');
        $mit_date =  $this->input->post('pro_date');
        $mit_start =  $this->input->post('start_time');
        $mit_end =  $this->input->post('end_time');
        if ($mit_start > $mit_end) {
            $temp = $mit_start;
            $mit_start = $mit_end;
            $mit_end = $temp;
        }
        $is_time_added = $this->dbmodel->add_mitarbeiter_work_time($user_id, $mit_pro_id, $mit_date, $mit_start, $mit_end);
        if ($is_time_added == 1) {
            $this->session->set_userdata('time_added', 1);
        }
        redirect('admin_ref_add_time');
    }

    public function update_project_in_DB()
    {
        $pro_id =             $this->input->post('pro_id');
        $new_project_name  =  $this->input->post('new_pro_name');
        $new_kunde_name    =  $this->input->post('new_kunde_name');
        $new_kunde_adresse =  $this->input->post('new_kunde_address');
        $new_kunde_nummer  =  $this->input->post('new_kunde_nummer');
        $new_kunde_email   =  $this->input->post('new_kunde_email');
        $one_project_array['get_one_project_from_DB'] = $this->dbmodel->get_one_project($pro_id);
        $is_update_success = $this->dbmodel->update_project($pro_id, $new_project_name, $new_kunde_name, $new_kunde_adresse, $new_kunde_nummer, $new_kunde_email);
        if ($is_update_success == 1) {
            $this->session->set_userdata('updated', 1);
        } else {
            $this->session->set_userdata('failed', 1);
        }
        redirect('admin_all_projects');
    }

    public function add_project_data_to_DB()
    {
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $new_project_name  =  $this->input->post('pname');
        $new_kunde_name    =  $this->input->post('kname');
        $new_kunde_adresse =  $this->input->post('kadresse');
        $new_kunde_nummer  =  $this->input->post('knummer');
        $new_kunde_email   =  $this->input->post('kemail');
        $is_new_pro_added = $this->dbmodel->add_new_project($new_project_name, $new_kunde_name, $new_kunde_adresse, $new_kunde_nummer, $new_kunde_email);

        if ($is_new_pro_added  == 1) {
            $this->session->set_userdata('pro_added', 1);
        } else {
            $this->session->set_userdata('fail', 1);
        }
        redirect('add_project');
    }

    public function update_time_in_DB()
    {
        $auf_id         = $this->input->post('auf_id');
        $auf_date       = $this->input->post('pro_date');
        $auf_start_time = $this->input->post('start_time');
        $auf_end_time   = $this->input->post('end_time');
        $is_time_added = $this->dbmodel->update_aufgabe($auf_id, $auf_date, $auf_start_time, $auf_end_time);
        if ($is_time_added != 0) {
            $this->session->set_userdata('time_added', 1);
        }
        redirect('updatetime/' . $auf_id);
    }

    public function update_abteilung($abt_id)
    {
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $array['abteilungen_from_DB'] = $this->dbmodel->get_abteilung($abt_id);
        $this->load->view('layout/header');
        $this->load->view('admin/sidenav', $project_array);
        $this->load->view('admin/update_abteilung', $array);
        $this->load->view('layout/footer');
    }
}
