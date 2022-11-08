<?php
class dbmodel extends CI_Model
{
    function checkuser($username, $password)
    {
        $this->db->where('b_name', $username);
        $this->db->from('tbl_users');
        $query = $this->db->get();
        $result_row_array = $query->row_array();
        if (!empty($result_row_array)) {
            $inc_password = $this->encryption->decrypt($result_row_array['kennwort']); // decrypt the DB password and the users password
            if ($inc_password == $password) {
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
            }
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
        $this->db->from('tbl_grund');
        $this->db->join('tbl_users', 'tbl_users.id = tbl_grund.u_id');
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
        if (empty($result_array)) { // check if the user name already exist in the DB
            $data = array(
                'vorname' => $mit_name, 'nachname' => $mit_nachname, 'b_name' => $mit_benuzter,
                'kennwort' => $mit_password, 'role' => 2
            );
            $this->db->insert('tbl_users', $data);
            return 1;
        } else {
            return 0; // Benutzername existiert schon in DB
        }
    }

    function get_mit($id) // getting the user info to show it in the update view
    {
        $this->db->from('tbl_users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function check_is_Bname_existiert($mit_benuzter)
    {
        $this->db->select('*');
        $this->db->where('b_name', $mit_benuzter);
        $this->db->from('tbl_users');
        $query = $this->db->get();
        $result_array = $query->result_array();
        if (!empty($result_array)) {
            return 1; // Benutzername  existier
        }
        else
        {
            return 0; // Benutzername  existiert nicht
        }
    }

    function check_is_same_Bname($mit_id, $mit_benuzter)
    {
        $this->db->select('*');
        $this->db->where('id', $mit_id);
        $this->db->where('b_name', $mit_benuzter);
        $this->db->from('tbl_users');
        $query = $this->db->get();
        $result_array = $query->result_array();
        if (!empty($result_array)) {
            return 1; // Selbe Benutzer
        }
        else{
            return 0; // nicht der Selbe Benutzer
        }
    }

    function update_mitarbeiter_same_Bname($mit_id, $mit_vorname, $mit_nachname)
    {
        $data = array(
            'vorname' => $mit_vorname, 'nachname' => $mit_nachname
        );
        $this->db->where('id', $mit_id);
        $this->db->update('tbl_users', $data);
        return 1;
    }

    function update_mitarbeiter_with_pass_same_Bname($mit_id, $mit_vorname, $mit_nachname, $mit_password)
    {
        $data = array(
            'vorname' => $mit_vorname, 'nachname' => $mit_nachname, 'kennwort' => $mit_password
        );
        $this->db->where('id', $mit_id);
        $this->db->update('tbl_users', $data);
        return 1;
    }

    function update_mitarbeiter_with_pass($mit_id, $mit_vorname, $mit_nachname, $mit_benuzter_name, $mit_password)
    {
        $data = array(
            'vorname' => $mit_vorname, 'nachname' => $mit_nachname, 'kennwort' => $mit_password, 'b_name' => $mit_benuzter_name
        );
        $this->db->where('id', $mit_id);
        $this->db->update('tbl_users', $data);
        return 1;
    }

    function delete_mitarbeiter($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_users');
        return 1;
    }

    function delete_all_fehlzeiten($id)
    {
        $this->db->where('u_id', $id);
        $this->db->delete('tbl_grund');
    }

    function change_admin_pass_in_DB($admin_password)
    {
        $this->db->set('kennwort', $admin_password);
        $this->db->where('id', 1);
        $this->db->update('tbl_users');
        return 1;
    }
}
