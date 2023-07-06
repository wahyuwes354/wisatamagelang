<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
    }
    public function index()
    {
        $data['page'] = "Profil";
        $data['user'] = $this->M_admin->get_where('tbl_user', array('id_user' => $this->session->userdata('id_user')))->row();

        // var_dump($this->session->userdata('id_user'));
        // die();

        $this->template->views('bo/profile', $data);
    }

    public function data_pengguna()
    {
        $data['page'] = "Data Pengguna";
        $this->load->library('pagination');

        // styling
        $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        // definiton data
        $tabel = 'select * from tbl_user 
                left join tbl_status on tbl_user.id_status=tbl_status.id_status
                left join tbl_role on tbl_user.id_role=tbl_role.id_role';

        // initialize pagination
        $config['base_url'] = site_url('User/data_pengguna');
        $config['total_rows'] = $this->M_admin->count_data($tabel);
        $config['per_page'] = 3;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['start'] = $this->uri->segment(3);
        $data['data'] = $this->M_admin->list_data($config['per_page'],  $data['start'], $tabel);

        $this->template->views('bo/User/Home', $data);
    }

    public function AddUSer()
    {
        $data['page'] = "Tambah Pengguna";
        $data['role'] = $this->M_admin->get_all_date('tbl_role')->result();
        $data['status_pengguna'] = $this->M_admin->get_all_date('tbl_status')->result();

        $this->template->views('bo/User/AddUser', $data);
    }

    public function UpdateUser()
    {
        $data['page'] = "Ubah Pengguna";
        $table = 'tbl_user';

        $data['role'] = $this->M_admin->get_all_date('tbl_role')->result();
        $data['status_pengguna'] = $this->M_admin->get_all_date('tbl_status')->result();

        $id_user = $this->uri->segment(3);
        $where = array('id_user' => $id_user);
        $data['user'] = $this->M_admin->get_where($table, $where)->row();

        $this->template->views('bo/User/UpdateUser', $data);
    }

    public function doUpdate()
    {
        $this->form_validation->set_rules('nm_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == TRUE) {
            $nama       = $this->input->post('nm_lengkap');
            $email      = $this->input->post('email');
            $role       = $this->input->post('role');
            $status     = $this->input->post('status');
            $id_user     = $_GET['id_user'];

            $data = array(
                'nama'          => $nama,
                'username'      => $nama,
                'email'         => $email,
                'id_status'     => $status,
                'id_role'       => $role,
            );

            $this->M_admin->update('id_user', $id_user, 'tbl_user', $data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Update Berhasil</strong> Data pengguna berhasil di ubah.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>');
            redirect('User/data_pengguna');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Periksa Isian!</strong>' . validation_errors() . '.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>');
            redirect('User/UpdateUser');
        }
    }

    public function simpanUser()
    {
        $this->form_validation->set_rules('nm_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        $this->form_validation->set_rules('repass', 'Re Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $pass   = trim($this->input->post('pass'));
            $repass = trim($this->input->post('repass'));
            $nama   = $this->input->post('nm_lengkap');
            $email  = $this->input->post('email');
            $role  = $this->input->post('role');


            if ($pass != $repass) {
                $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Password Failed</strong>Password Tidak Sama.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>');
                redirect('User/AddUser');
            }

            $data = array(
                'nama'          => $nama,
                'username'      => $nama,
                'email'         => $email,
                'pass'          => md5($repass),
                'id_status'     => '1',
                'id_role'       => $role,
            );

            $this->M_admin->save($data, 'tbl_user');

            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Registrasi Berhasil</strong> Silakan Login menggunakan Email Dan Password anda.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>');
            redirect('User/AddUser');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Periksa Isian!</strong>' . validation_errors() . '.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>');
            redirect('User/AddUser');
        }
    }

    public function update()
    {
        $table = 'tbl_calon';
        $data = array(
            'nama' => $this->input->post('nmcalon'),
            'nourut' => $this->input->post('nourut'),
        );
        $id = $this->input->post('id_calon');

        $this->db->where('id', $id);
        $this->db->update($table, $data);

        echo json_encode(TRUE);
    }

    public function delete($id)
    {
        $id_name = 'id_user';
        $this->M_admin->delete($id_name, $id, 'tbl_user');

        echo json_encode(array("status" => TRUE));
    }

    public function get_id($id)
    {
        $tbl = 'tbl_calon';
        $id_name = 'id';
        $data = $this->admin->get_id_tbl($id_name, $tbl, $id);
        echo json_encode($data);
    }
}
