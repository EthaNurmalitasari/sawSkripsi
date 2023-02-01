<?php

class mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        if (!$this->auth_model->current_user()) {
            redirect('auth/login');
        }

        if ($this->auth_model->current_user()->level == '2') {
            redirect('admin/dashboard');
        }
        $this->load->model('ca_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['current_user'] = $this->auth_model->current_user();
        $this->load->view('admin/mahasiswa', $data);
    }

    public function add()
    {
        $nama = $this->input->post('nama');
        $nim = $this->input->post('nim');
        $jurusan = $this->input->post('jurusan');

        $tambahmhs = array(
            'nama_mahasiswa' => $nama,
            'nim'        => $nim,
            'jurusan_mahasiswa' => $jurusan
        );

        $data = $this->ca_model->save($tambahmhs);

        echo json_encode($data);
    }

    public function datamahasiswa()
    {

        $datamahasiswa = $this->ca_model->getdatamahasiswa();
        $no = 1;
        foreach ($datamahasiswa as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['nama_mahasiswa'];
            $tbody[] = $value['nim'];
            $tbody[] = $value['jurusan_mahasiswa'];
            $aksi = "<button class='btn btn-primary ubah-mahasiswa' data-toggle='modal' data-id=" . $value['id_mahasiswa'] . ">Ubah</button>" . ' ' . "<button class='btn btn-danger hapus-mahasiswa' id='id' data-toggle='modal' data-id=" . $value['id_mahasiswa'] . ">Hapus</button>";
            $tbody[] = $aksi;
            $data[] = $tbody;
        }

        if ($datamahasiswa) {
            echo json_encode(array('data' => $data));
        } else {
            echo json_encode(array('data' => 0));
        }
    }

    //dropdown 
    public function dropDown()
    {
        $cari = $this->input->get('q');
        $query = $this->ca_model->dropdDownCA($cari, 'nama_mahasiswa');

        echo json_encode($query);
    }

    public function formedit()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data['datapermahasiswa'] = $this->ca_model->datamahasiswaedit($id);
        $this->load->view('admin/formEditmahasiswa', $data);
    }

    public function ubahDatamahasiswa()
    {
        $objdata = array(
            'nama_mahasiswa' => $this->input->post('editnama'),
            'nim' => $this->input->post('editnim'),
            'jurusan_mahasiswa' => $this->input->post('editjurusan'),
        );

        $id = $this->input->post('id');
        $data = $this->ca_model->ubahDatamahasiswa($objdata, $id);

        echo json_encode($data);
    }

    public function hapus()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = $this->ca_model->hapusDatamahasiswa($id);
        echo json_encode($data);
    }
}
