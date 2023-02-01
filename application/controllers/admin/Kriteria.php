<?php

class Kriteria extends CI_Controller
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
        $this->load->model('kriteria_model');
        $this->load->model('bobot_model');
    }

    public function index()
    {
        $data['current_user'] = $this->auth_model->current_user();
        $this->load->view('admin/kriteria_view', $data);
    }

    //tampilkan data kriteria
    public function dataKriteria()
    {

        $dataKriteria = $this->kriteria_model->getDataKriteria();
        $no = 1;
        foreach ($dataKriteria as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['namaKriteria'];
            $tbody[] = $value['sifat'];
            $aksi = "<button class='btn btn-primary ubah-kriteria' data-toggle='modal' data-id=" . $value['id_kriteria'] . ">Ubah</button>" . ' ' . "<button class='btn btn-danger hapus-kriteria' id='id' data-toggle='modal' data-id=" . $value['id_kriteria'] . ">Hapus</button>";
            $tbody[] = $aksi;
            $data[] = $tbody;
        }

        if ($dataKriteria) {
            echo json_encode(array('data' => $data));
        } else {
            echo json_encode(array('data' => 0));
        }
    }

    //dropdown 
    public function dropDown()
    {
        $cari = $this->input->get('q');
        $query = $this->kriteria_model->dropdDownKriteria($cari, 'namaKriteria');

        echo json_encode($query);
    }

    public function add()
    {
        $nama = $this->input->post('nama');
        $sifat = $this->input->post('sifat');

        $tambahKriteria = array(
            'namaKriteria' => $nama,
            'sifat' => $sifat
        );

        $data = $this->kriteria_model->save($tambahKriteria);
        $insertId = $this->db->insert_id();

        $tambahBobot = array(
            'id_kriteria' => $insertId,
            'bobot' => 0
        );

        $saveBobot = $this->bobot_model->save($tambahBobot);


        echo json_encode($data);
    }

    public function formedit()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data['dataKriteria'] = $this->kriteria_model->dataKriteriaedit($id);
        $this->load->view('admin/formEditKriteria', $data);
    }

    public function ubahDataKriteria()
    {
        $objdata = array(
            'namaKriteria' => $this->input->post('editnama'),
            'sifat' => $this->input->post('editsifat'),
        );

        $id = $this->input->post('id');
        $data = $this->kriteria_model->ubahDataKriteria($objdata, $id);

        echo json_encode($data);
    }

    public function hapus()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = $this->kriteria_model->hapusDataKriteria($id);
        echo json_encode($data);
    }
}
