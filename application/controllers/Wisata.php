<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wisata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
    }
    public function index()
    {
        $data['page'] = "Profil";
        $this->template->views('bo/profile', $data);
    }

    public function data_wisata()
    {
        $data['page'] = "Data Objek Wisata";
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
        $tabel = 'select * from tbl_wisata left join tbl_wisata_kategori on tbl_wisata.id_kategori=tbl_wisata_kategori.id_kategori';


        // initialize pagination
        // $tabel = 'tbl_user';
        $config['base_url'] = site_url('Wisata/data_wisata');
        $config['total_rows'] = $this->M_admin->count_data($tabel);
        $config['per_page'] = 3;
        // $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['start'] = $this->uri->segment(3);
        $data['data'] = $this->M_admin->list_data($config['per_page'],  $data['start'], $tabel);

        $this->template->views('bo/Wisata/Home', $data);
    }

    public function AddWisata()
    {
        $data['page'] = "Tambah Objek Wisata";
        $data['kategori'] = $this->M_admin->get_all_date('tbl_wisata_kategori')->result();

        $this->template->views('bo/Wisata/AddWisata', $data);
    }

    public function UpdateWisata()
    {
        $data['page'] = "Ubah Data Wisata";
        $table = 'tbl_wisata';
        $data['kategori'] = $this->M_admin->get_all_date('tbl_wisata_kategori')->result();

        $id_wisata = $this->uri->segment(3);
        $where = array('id_wisata' => $id_wisata);
        $data['Wisata'] = $this->M_admin->get_where($table, $where)->row();

        $this->template->views('bo/Wisata/UpdateWisata', $data);
    }

    public function doUpdate()
    {
        $this->form_validation->set_rules('nm_wisata', 'Nama Wisata', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi Wisata', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Wisata', 'required');
        $this->form_validation->set_rules('kategori', 'kategori Wisata', 'required');

        if ($this->form_validation->run() == TRUE) {
            $nama            = $this->input->post('nm_wisata');
            $lokasi          = $this->input->post('lokasi');
            $deskripsi       = $this->input->post('deskripsi');
            $id_kategori     = $this->input->post('kategori');
            $id_wisata       = $_GET['id_wisata'];

            $data = array(
                'nm_wisata'      => $nama,
                'id_kategori'    => $id_kategori,
                'lokasi'         => $lokasi,
                'deskripsi'      => $deskripsi,
            );

            $ret = $this->M_admin->update('id_wisata', $id_wisata, 'tbl_wisata', $data);
            // var_dump($ret);
            // die();



            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Update Berhasil</strong> Data pengguna berhasil di ubah.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>');
            redirect('Wisata/data_Wisata');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Periksa Isian!</strong>' . validation_errors() . '.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>');
            redirect('Wisata/UpdateWisata');
        }
    }

    public function simpanWisata()
    {
        $this->form_validation->set_rules('kategori', 'Kategori Wisata', 'required');
        $this->form_validation->set_rules('objek', 'Nama Objek Wisata', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if ($this->form_validation->run() == TRUE) {
            $kategori   = $this->input->post('kategori');
            $objek  = $this->input->post('objek');
            $lokasi  = $this->input->post('lokasi');
            $deskripsi  = $this->input->post('deskripsi');

            $data = array(
                'id_kategori'          => $kategori,
                'nm_wisata'      => $objek,
                'lokasi'         => $lokasi,
                'deskripsi'       => $deskripsi,
            );

            $this->M_admin->save($data, 'tbl_wisata');

            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Input Sukses </strong> Data Wisata berhasil di tambahkan.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>');
            redirect('Wisata/data_wisata');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Periksa Isian!</strong>' . validation_errors() . '.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>');
            redirect('Wisata/AddWisata');
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
        $id_name = 'id_wisata';
        $this->M_admin->delete($id_name, $id, 'tbl_wisata');

        echo json_encode(array("status" => TRUE));
    }
}
