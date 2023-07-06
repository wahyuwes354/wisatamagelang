<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
        $this->load->model('M_admin');
    }

    public function index()
    {
        // $this->session->sess_destroy();
        // $this->load->model('M_admin', 'admin');

        // $session = $this->session->userdata();

        // if ($session == '') {
        redirect('Home');
        // } else {
        //     redirect('Dashboard');
        // }
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'username', 'required|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $username = trim($this->input->post('username'));
            $password = trim($this->input->post('password'));

            $data     = $this->M_auth->login($username, $password);

            if ($data == false) {
                $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Gagal Login</strong> Pastikan User dan password yang Anda Masukkan Benar.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>');
                redirect('Home');
            } else {
                $userdata = array(
                    'id_user'     => $data->id_user,
                    'nama'        => $data->nama,
                    'username'    => $data->username,
                    'role'        => $data->id_role
                );
                $this->session->set_userdata($userdata);
                redirect('Dashboard');
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Periksa Isian!</strong>' . validation_errors() . '.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>');

            redirect('Home');
        }
    }


    function addRegister()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $pass   = trim($this->input->post('password'));
            $nama   = $this->input->post('name');
            $email  = $this->input->post('email');

            $data = array(
                'nama'          => $nama,
                'username'      => $nama,
                'email'         => $email,
                'pass'          => md5($pass),
                'id_status'     => '3',
                'id_role'       => '2',
            );
            $this->M_admin->save($data, 'tbl_user');

            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Registrasi Berhasil</strong> Silakan Login menggunakan Email Dan Password anda.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>');

            redirect('Home');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Periksa Isian!</strong>' . validation_errors() . '.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>');
            redirect('Home/Register');
        }
    }


    public function logout()
    {
        // update last login
        date_default_timezone_set("ASIA/JAKARTA");
        $date = array('last_login' => date('Y-m-d H:i:s'));
        $id = $this->session->userdata('id_user');
        $this->M_auth->logout($date, $id);
        // destroy session
        $this->session->sess_destroy();
        redirect('Home');
    }
}
