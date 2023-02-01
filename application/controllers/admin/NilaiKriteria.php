<?php

class NilaiKriteria extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nilaikriteria_model');
    }
    //tampilkan data kriteria
    public function datanilaikriteria()
    {

        $dataKriteria = $this->nilaikriteria_model->getdatanilaikriteria();
        $no = 1;
        foreach ($dataKriteria as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['namaKriteria'];
            $tbody[] = $value['keterangan'];
            $tbody[] = $value['nilai'];
            $aksi = "<button class='btn btn-primary ubah-nilai-kriteria' data-toggle='modal' data-id=" . $value['id_nilaikriteria'] . ">Ubah</button>" . ' ' . "<button class='btn btn-danger hapus-nilai-kriteria' id='id' data-toggle='modal' data-id=" . $value['id_nilaikriteria'] . ">Hapus</button>";
            $tbody[] = $aksi;
            $data[] = $tbody;
        }

        if ($dataKriteria) {
            echo json_encode(array('data' => $data));
        } else {
            echo json_encode(array('data' => 0));
        }
    }

    public function add()
    {
        $id = $this->input->post('id');
        $nilai = $this->input->post('nilai');
        $keterangan = ucwords($this->input->post('keterangan'));

        $tambahsubKriteria = array(
            'id_kriteria' => $id,
            'nilai' => $nilai,
            'keterangan' => $keterangan
        );

        $data = $this->nilaikriteria_model->save($tambahsubKriteria);

        echo json_encode($data);
    }

    public function formedit()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data['datanilaikriteria'] = $this->nilaikriteria_model->datanilaiKriteriaedit($id);
        $this->load->view('admin/formEditNilaiKriteria', $data);
    }

    public function ubahdatanilaikriteria()
    {
        $objdata = array(
            'nilai' => $this->input->post('nilai'),
            'keterangan' => $this->input->post('keterangan'),
        );

        $id = $this->input->post('id');
        $data = $this->nilaikriteria_model->ubahdatanilaikriteria($objdata, $id);

        echo json_encode($data);
    }

    public function hapus()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = $this->nilaikriteria_model->hapusdatanilaikriteria($id);
        echo json_encode($data);
    }
}
