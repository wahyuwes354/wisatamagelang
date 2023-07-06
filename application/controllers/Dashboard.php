<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends AUTH_Controller
{
    public function index()
    {
        $this->load->model('M_admin');
        $data['page'] = "Dashboard";
        $data['register'] = $this->M_admin->get_where('tbl_user', array('id_status' => 3))->num_rows();
        $data['aktif'] = $this->M_admin->get_where('tbl_user', array('id_status' => 1))->num_rows();
        $data['nonaktif'] = $this->M_admin->get_where('tbl_user', array('id_status' => 2))->num_rows();
        $data['wisata'] = $this->M_admin->countTable('tbl_wisata');
        $this->template->views('bo/Dashboard/Home', $data);
    }
}
