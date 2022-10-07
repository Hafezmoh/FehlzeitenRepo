<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitarbeiter extends CI_Controller {
public function __construct()
{
	parent::__construct();
	if (!$this->session->userdata('user_rule_session'))
	{
		redirect('userlogin');
	}

}

    public function mit_all_projects()
    {
        $project_array['worked_time_from_DB'] = $this->dbmodel->get_all_project_time();
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $this->load->view('layout/header');
        $this->load->view('client/sidenav_mitarbeiter', $project_array);
        $this->load->view('client/mit_all_projects', $project_array);
        $this->load->view('layout/footer');
    }
   

    public function  mit_add_time()
    {
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $this->load->view('layout/header');
        $this->load->view('client/sidenav_mitarbeiter', $project_array);
        $this->load->view('client/mit_add_time',$project_array);
        $this->load->view('layout/footer');
    }
    public function act_mit_add_time()
    {
        $user_id = $this->session->userdata('user_id_session');
        $mit_pro_id =  $this->input->post('mit_project');
        $mit_date =  $this->input->post('pro_date');
        $mit_start =  $this->input->post('start_time');
        $mit_end =  $this->input->post('end_time');
        if($mit_start > $mit_end){
            $temp = $mit_start;
            $mit_start = $mit_end;
            $mit_end = $temp;
        }
        $is_time_added = $this->dbmodel->add_mitarbeiter_work_time($user_id, $mit_pro_id, $mit_date, $mit_start, $mit_end);
        if ($is_time_added == 1) {
            $this->session->set_userdata('time_added', 1);
        }
        redirect('mit_ref_add_time');
    }

    
    public function mit_project($id)
    {
        $user_id= $this->session->userdata('user_id_session');
        $one_project_array['worked_time_from_DB'] = $this->dbmodel->get_project_time_for_session_id($id , $user_id);
        $one_project_array['get_one_project_from_DB']= $this->dbmodel->get_one_project($id);
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $this->load->view('layout/header');
        $this->load->view('client/sidenav_mitarbeiter', $project_array);
        $this->load->view('client/mit_project', $one_project_array);
        $this->load->view('layout/footer');
    }

    public function delete_time($id)
    {
        $pro_id = $this->dbmodel->get_project_id($id);
        $is_time_deleted = $this->dbmodel->delete_time($id);
        if ($is_time_deleted == 1) {
            $this->session->set_userdata('delete_success', 1);
        }
        redirect('mit_project/' . $pro_id[0]['auf_projekt_id']);
    }
    
    public function update_time($id)
    {
        $project_array['projects_from_DB'] = $this->dbmodel->get_all_projects();
        $aufgabe_array['get_aufgabe_from_DB'] = $this->dbmodel->get_aufgabe($id);
        $this->load->view('layout/header');
        $this->load->view('client/sidenav_mitarbeiter', $project_array);
        $this->load->view('client/mit_update_time', $aufgabe_array);
        $this->load->view('layout/footer');
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
        redirect('ref_mit_updatetime/' . $auf_id);
    }
}
