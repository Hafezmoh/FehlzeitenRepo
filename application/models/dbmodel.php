<?php
class dbmodel extends CI_Model
{
    function checkuser($username, $password)
    {
        $this->db->where('b_name', $username);
        $this->db->where('kennwort', $password);
        $this->db->from('tbl_users');
        $query = $this->db->get();
        $result_row_array = $query->row_array();
        if (!empty($result_row_array)) {
            $user_role = $result_row_array['role'];
            $user_id = $result_row_array['id'];
            $user_name = $result_row_array['b_name'];
            $vor_name = $result_row_array['vorname'];
            $nach_name = $result_row_array['nachname'];
            $this->session->set_userdata('user_role_session', $user_role);
            $this->session->set_userdata('user_id_session', $user_id);
            $this->session->set_userdata('user_name_session', $user_name);
            $this->session->set_userdata('vorname_session', $vor_name);
            $this->session->set_userdata('nachname_session', $nach_name);
            return $user_role;
        } else
            return 0;
    }

    function get_all_users()
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('id !=', 1);
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function get_all_fehlzeiten()
    {

        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->join('tbl_grund', 'tbl_users.id = tbl_grund.u_id');
        $this->db->group_by('gr_id');
        $query = $this->db->get();
        return $query->result_array();
    }


    function get_autor_name_from_DB($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $row_array = $query->row_array();
        return $row_array;
    }

    function add_fehlzeit($user_id, $krank_id, $grund, $notiz, $von, $bis, $von_uhr, $bis_uhr, $reg_datum)
    {

        // list($hour1, $minute1) = explode(':', $mit_end);
        // list($hour, $minute) = explode(':', $mit_start);

        // $time_type_end_time   = mktime($hour1, $minute1);
        // $time_type_start_time = mktime($hour, $minute);
        // $time_type_total = $time_type_end_time - $time_type_start_time;
        $von_date = $von . " " . $von_uhr;
        $bis_date = $bis . " " . $bis_uhr;

        $data = array(
            'autor_id' => $user_id, 'u_id' => $krank_id, 'grund' => $grund,
            'note' => $notiz, 'von_datum' => $von_date, 'bis_datum' => $bis_date, 'reg_datum' => $reg_datum
        );
        $this->db->insert('tbl_grund', $data);
        return 1;
    }

    function add_new_mitarbeiter($mit_name, $mit_nachname, $mit_benuzter, $mit_password)
    {
        $this->db->select('*');
        $this->db->where('b_name', $mit_benuzter);
        $this->db->from('tbl_users');
        $query = $this->db->get();
        $result_array = $query->result_array();
        if (empty($result_array)) {
            $data = array(
                'vorname' => $mit_name, 'nachname' => $mit_nachname, 'b_name' => $mit_benuzter,
                'kennwort' => $mit_password, 'role' =>2
            );
            $this->db->insert('tbl_users', $data);
            return 1;
        } else {
            return 0;
        }
    }

    // function delete_project($id)
    // {
    //     $this->db->where('pro_id', $id);
    //     $this->db->delete('tbl_projekt');
    //     return 1;
    // }

    // function delete_all_aufgaben($id)
    // {
    //     $this->db->where('auf_projekt_id', $id);
    //     $this->db->delete('tbl_aufgabe');
    // }


    // function delete_all_aufgaben_von_mitarbeiter($id)
    // {
    //     $this->db->where('auf_mitarbeiter_id', $id);
    //     $this->db->delete('tbl_aufgabe');
    // }


    // function delete_time($id)
    // {

    //     $this->db->where('auf_id', $id);
    //     $this->db->delete('tbl_aufgabe');
    //     return 1;
    // }

    // function delete_mitarbeiter($id)
    // {
    //     $this->db->where('m_id', $id);
    //     $this->db->delete('tbl_mitarbeiter');
    //     return 1;
    // }

    // function has_abtielung_mit($id)
    // {
    //     $this->db->select('m_id');
    //     $this->db->where('m_abteillung_id', $id);
    //     $this->db->from('tbl_mitarbeiter');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    // function change_abt($old_id)
    // {
    //     $this->db->set('m_abteillung_id', 0);
    //     $this->db->where('m_id', $old_id);
    //     $this->db->update('tbl_mitarbeiter');
    //     return 1;
    // }

    // function delete_abteilung_from_DB($id)
    // {
    //     $this->db->where('abt_id', $id);
    //     $this->db->delete('tbl_abteilung');
    //     return 1;
    // }

    // function add_mitarbeiter_work_time($user_id, $mit_pro_id, $mit_date, $mit_start, $mit_end)
    // {

    //     list($hour1, $minute1) = explode(':', $mit_end);
    //     list($hour, $minute) = explode(':', $mit_start);

    //     $time_type_end_time   = mktime($hour1, $minute1);
    //     $time_type_start_time = mktime($hour, $minute);
    //     $time_type_total = $time_type_end_time - $time_type_start_time;
    //     $data = array(
    //         'auf_mitarbeiter_id' => $user_id, 'auf_projekt_id' => $mit_pro_id, 'auf_datum' => $mit_date,
    //         'auf_start_zeit' => $mit_start, 'auf_ende_zeit' => $mit_end, 'auf_gesamt_zeit' => $time_type_total
    //     );
    //     $this->db->insert('tbl_aufgabe', $data);
    //     return 1;
    // }

    // function add_abteilung_name($new_abteilung_name)
    // {
    //     $this->db->select('*');
    //     $this->db->where('abt_name', $new_abteilung_name);
    //     $this->db->from('tbl_abteilung');
    //     $query = $this->db->get();
    //     $result_array = $query->result_array();
    //     if (empty($result_array)) {
    //         $data = array('abt_name' => $new_abteilung_name);
    //         $this->db->insert('tbl_abteilung', $data);
    //         return 1;
    //     } else {
    //         return 0;
    //     }
    // }

    // function update_abteilungen_in_DB($abt_id, $abt_name)
    // {
    //     $this->db->select('*');
    //     $this->db->where('abt_name', $abt_name);
    //     $this->db->from('tbl_abteilung');
    //     $query = $this->db->get();
    //     $result_array = $query->result_array();
    //     if (empty($result_array)) {
    //         $data = array(
    //             'abt_name' => $abt_name
    //         );
    //         $this->db->where('abt_id', $abt_id);
    //         $this->db->update('tbl_abteilung', $data);
    //         return 1;
    //     } else {
    //         return 0;
    //     }
    // }

    // function update_aufgabe($auf_id, $auf_date, $auf_start_time, $auf_end_time)
    // {
    //     list($hour1, $minute1) = explode(':', $auf_end_time);
    //     list($hour, $minute) = explode(':', $auf_start_time);

    //     $time_type_end_time   = mktime($hour1, $minute1);
    //     $time_type_start_time = mktime($hour, $minute);
    //     $time_type_total = $time_type_end_time - $time_type_start_time;
    //     $data = array(
    //         'auf_datum' => $auf_date,
    //         'auf_start_zeit' => $auf_start_time, 'auf_ende_zeit' => $auf_end_time, 'auf_gesamt_zeit' => $time_type_total
    //     );
    //     $this->db->where('auf_id', $auf_id);
    //     $this->db->update('tbl_aufgabe', $data);
    //     return $auf_id;
    // }

    // function add_new_project($new_project_name, $new_kunde_name, $new_kunde_adresse, $new_kunde_nummer, $new_kunde_email)
    // {
    //     $this->db->select('*');
    //     $this->db->where('pro_name', $new_project_name);
    //     $this->db->from('tbl_projekt');
    //     $query = $this->db->get();
    //     $result_array = $query->result_array();
    //     if (empty($result_array)) {

    //         $data = array(
    //             'pro_name' => $new_project_name, 'pro_kunde_name' => $new_kunde_name,
    //             'pro_kunde_adresse' => $new_kunde_adresse, 'pro_kunde_nummer' => $new_kunde_nummer, 'pro_kunde_email' => $new_kunde_email
    //         );
    //         $this->db->insert('tbl_projekt', $data);
    //         return 1;
    //     } else {
    //         return 0;
    //     }
    // }

    // function update_project($pro_id, $new_project_name, $new_kunde_name, $new_kunde_adresse, $new_kunde_nummer, $new_kunde_email)
    // {
    //     $this->db->select('*');
    //     $this->db->where('pro_name', $new_project_name);
    //     $this->db->from('tbl_projekt');
    //     $query = $this->db->get();
    //     $result_array = $query->result_array();
    //     if (empty($result_array)) {
    //         $data = array(
    //             'pro_name' => $new_project_name, 'pro_kunde_name' => $new_kunde_name,
    //             'pro_kunde_adresse' => $new_kunde_adresse, 'pro_kunde_nummer' => $new_kunde_nummer, 'pro_kunde_email' => $new_kunde_email
    //         );
    //         $this->db->where('pro_id', $pro_id);
    //         $this->db->update('tbl_projekt', $data);
    //         return 1;
    //     } else {
    //         return 0;
    //     }
    // }



    // function update_mitarbeiter($mit_id, $mit_name, $mit_benuzter, $mit_abteilung_id , $mit_role)
    // {
    //     $this->db->select('*');
    //     $this->db->where('m_benutzer', $mit_benuzter);
    //     $this->db->from('tbl_mitarbeiter');
    //     $query = $this->db->get();
    //     $result_array = $query->result_array();
    //     if (empty($result_array)) {
    //         $data = array(
    //             'm_name' => $mit_name, 'm_benutzer' => $mit_benuzter, 'm_abteillung_id' => $mit_abteilung_id ,
    //             'm_rule' => $mit_role
    //         );
    //         $this->db->where('m_id ', $mit_id);
    //         $this->db->update('tbl_mitarbeiter', $data);
    //         return 1;
    //     } else {
    //         return 0;
    //     }
    // }

    // function update_mitarbeiter_same_Bname($mit_id, $mit_name, $mit_benuzter, $mit_abteilung_id , $mit_role)
    // {
    //         $data = array(
    //             'm_name' => $mit_name, 'm_benutzer' => $mit_benuzter, 'm_abteillung_id' => $mit_abteilung_id ,
    //             'm_rule' => $mit_role
    //         );
    //         $this->db->where('m_id ', $mit_id);
    //         $this->db->update('tbl_mitarbeiter', $data);
    //         return 1;
    //     }

    // function update_mitarbeiter_with_pass_same_Bname($mit_id, $mit_name, $mit_benuzter, $mit_abteilung_id ,$mit_password, $mit_role)
    // {
    //         $data = array(
    //             'm_name' => $mit_name, 'm_benutzer' => $mit_benuzter, 'm_abteillung_id' => $mit_abteilung_id ,
    //             'm_passwort' => $mit_password, 'm_rule' => $mit_role
    //         );
    //         $this->db->where('m_id ', $mit_id);
    //         $this->db->update('tbl_mitarbeiter', $data);
    //         return 1;
    // }

    // function update_mitarbeiter_with_pass($mit_id, $mit_name, $mit_benuzter, $mit_abteilung_id ,$mit_password, $mit_role)
    // {
    //     $this->db->select('*');
    //     $this->db->where('m_benutzer', $mit_benuzter);
    //     $this->db->from('tbl_mitarbeiter');
    //     $query = $this->db->get();
    //     $result_array = $query->result_array();
    //     if (empty($result_array)) {
    //         $data = array(
    //             'm_name' => $mit_name, 'm_benutzer' => $mit_benuzter, 'm_abteillung_id' => $mit_abteilung_id ,
    //             'm_passwort' => $mit_password, 'm_rule' => $mit_role
    //         );
    //         $this->db->where('m_id ', $mit_id);
    //         $this->db->update('tbl_mitarbeiter', $data);
    //         return 1;
    //     } else {
    //         return 0;
    //     }
    // }

    // function check_is_same_Bname($mit_id, $mit_benuzter)
    // {
    //     $this->db->select('*');
    //     $this->db->where('m_id', $mit_id);
    //     $this->db->where('m_benutzer', $mit_benuzter);
    //     $this->db->from('tbl_mitarbeiter');
    //     $query = $this->db->get();
    //     $result_array = $query->result_array();
    //     if (!empty($result_array)) {
    //         return 1;
    //     }
    // }


    // function check_is_last_Admin_changed($mit_id,$mit_rule)
    // {
    //     $this->db->select('*');
    //     $this->db->where('m_id', $mit_id);
    //     $this->db->where('m_rule', $mit_rule);
    //     $this->db->from('tbl_mitarbeiter');
    //     $query = $this->db->get();
    //     $result_array = $query->result_array();
    //     if (empty($result_array)) {
    //         return 1;
    //     }
    // }

    // function check_is_Bname_existiert($mit_benuzter)
    // {
    //     $this->db->select('*');
    //     $this->db->where('m_benutzer', $mit_benuzter);
    //     $this->db->from('tbl_mitarbeiter');
    //     $query = $this->db->get();
    //     $result_array = $query->result_array();
    //     if (!empty($result_array)) {
    //         return 1;
    //     }
    // }

    // function check_is_last_admin()
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_mitarbeiter');
    //     $this->db->where('m_rule', 1);
    //     $query = $this->db->get();
    //     $result_array = $query->result_array();
    //     if (count($result_array) == 1) {
    //         return 1;
    //     }
    // }

    // function check_is_mit($id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_mitarbeiter');
    //     $this->db->where('m_id', $id);
    //     $this->db->having('m_rule', 2);
    //     $query = $this->db->get();
    //     $result_array = $query->result_array();
    //     if (!empty($result_array)) {
    //         return 1;
    //     }
    // }


    // function get_one_project($id)
    // {
    //     $this->db->from('tbl_projekt');
    //     $this->db->where('pro_id', $id);
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    // function get_mit($id)
    // {
    //     $this->db->from('tbl_mitarbeiter');
    //     $this->db->where('m_id', $id);
    //     $this->db->join('tbl_abteilung', 'tbl_mitarbeiter.	m_abteillung_id = tbl_abteilung.abt_id', 'right');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    // function get_abteilung($abt_id)
    // {
    //     $this->db->from('tbl_abteilung');
    //     $this->db->where('abt_id', $abt_id);
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }


    // function get_aufgabe($id)
    // {
    //     $this->db->from('tbl_aufgabe');
    //     $this->db->where('auf_id', $id);
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    // function get_project_id($id)
    // {
    //     $this->db->select('auf_projekt_id');
    //     $this->db->where('auf_id', $id);
    //     $this->db->from('tbl_aufgabe');
    //     $query = $this->db->get();
    //     $result_array = $query->result_array();
    //     return $result_array;
    // }

    // function get_project_time_for_session_id($id,$mit_id)
    // {
    //     $this->db->select('*');
    //     $this->db->select_sum('auf_gesamt_zeit');
    //     $this->db->from('tbl_aufgabe');
    //     $this->db->where('auf_projekt_id', $id);
    //     $this->db->where('auf_mitarbeiter_id' , $mit_id);
    //     $this->db->join('tbl_projekt', 'tbl_projekt.pro_id = tbl_aufgabe.auf_projekt_id');
    //     $this->db->join('tbl_mitarbeiter', 'tbl_mitarbeiter.m_id = tbl_aufgabe.auf_mitarbeiter_id');
    //     $this->db->group_by('auf_id ');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    // function get_project_time($id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_aufgabe');
    //     $this->db->where('auf_projekt_id', $id);
    //     $this->db->join('tbl_projekt', 'tbl_projekt.pro_id = tbl_aufgabe.auf_projekt_id');
    //     $this->db->join('tbl_mitarbeiter', 'tbl_mitarbeiter.m_id = tbl_aufgabe.auf_mitarbeiter_id');
    //     $this->db->group_by('auf_id ');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    // function get_all_project_time()
    // {
    //     $this->db->select('*');
    //     $this->db->select_sum('auf_gesamt_zeit');
    //     $this->db->from('tbl_aufgabe');
    //     $this->db->join('tbl_projekt', 'tbl_projekt.pro_id = tbl_aufgabe.auf_projekt_id', 'right');
    //     $this->db->group_by('pro_id');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

}
