<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{

    public function login($user, $pass)
    {
        $this->db->select('id_user,nama,username,id_role');
        $this->db->from('tbl_user');
        $this->db->where('tbl_user.email', $user);
        $this->db->where('tbl_user.pass', md5($pass));

        $data = $this->db->get();

        $this->db->close();

        if ($data->num_rows() == 1) {
            return $data->row();
        } else {
            return false;
        }
    }

    public function cek_email($email)
    {
        $this->db->select('email');
        $this->db->from('tbl_user');
        $this->db->where('tbl_user.email', $email);

        $data = $this->db->get();

        $this->db->close();

        if ($data->num_rows() == 1) {
            return $data->row();
        } else {
            return false;
        }
    }
    public function logout($date, $id)
    {
        $this->db->where('tbl_user.id_user', $id);
        $this->db->update('tbl_user', $date);
    }
}
