<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function update($name_id, $id, $table, $data)
    {
        // var_dump($name_id, $id, $table, $data);
        // die();

        try {
            $this->db->where($name_id, $id);
            $this->db->update($table, $data);

            return true;
        } catch (Exception $e) {
            $return = $e->getMessage();
        }

        return $return;
    }

    public function save($data, $table)
    {
        $this->db->insert($table, $data);
        return true;
    }

    public function delete($id_name, $id, $table)
    {
        $this->db->where($id_name, $id);
        $this->db->delete($table);

        // var_dump($id_name, $id, $table);
        // die();

        return true;
    }

    public function list_data($limit, $offset, $tabel)
    {
        $this->db->limit($limit, $offset);
        $query = $this->db->query($tabel);
        return $query->result();
    }

    public function count_data($tabel)
    {
        return $this->db->query($tabel)->num_rows();
    }

    public function countTable($tabel)
    {
        return $this->db->get($tabel)->num_rows();
    }

    public function get_where($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function get_all_date($table)
    {
        return $this->db->get($table);
    }
}
