<?php

class Hasil extends CI_Controller
{
    var  $valueMinMax = array(), $kriteriaArray = array(), $mahasiswaArray = array(), $forminmax = array(), $simpanNormalisasi = array(), $bobotArray = array();
    var   $indexArray = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        if (!$this->auth_model->current_user()) {
            redirect('auth/login');
        }
        $this->load->model('kriteria_model');
        $this->load->model('bobot_model');
        $this->load->model('nilaikriteria_model');
        $this->load->model('hasil_model');

        if (count($this->hasil_model->Bobot()) > 0) {
            foreach ($this->hasil_model->Bobot() as $dataBobot) {
                $this->bobotArray[$dataBobot['id_kriteria']] = @$dataBobot['bobot'];
            }
        }

        if (count($this->hasil_model->getDataKriteria()) > 0) {
            foreach ($this->hasil_model->getDataKriteria() as $data) {
                $this->kriteriaArray[] = $data['namaKriteria'];
            }
        }

        // if(count($this->hasil_model->dataCalonAnggota())>0) {
        //     foreach ($this->hasil_model->dataCalonAnggota() as $dataAlternative) {
        //         foreach ($this->hasil_model->getDataKriteria() as $data) {
        //          $this->kriteriaArray[]=$data['namaKriteria'];
        //     }

        //     }

        // }

    }

    public function index()
    {
        $data['executeQueryTabel'] = $this->hasil_model->getDataKriteria();
        $data['executeGetAlternative'] = $this->hasil_model->datamahasiswa();
        $data['urutNilaiAnggota'] = $this->hasil_model->urutNilaiAnggota();
        $data['current_user'] = $this->auth_model->current_user();
        $this->load->view('admin/hasil', $data);
    }

    function normalisasi($value, $arrayValue, $sifat)
    {
        if ($sifat == 'benefit') {
            $result = $value / max($arrayValue);
        } elseif ($sifat == 'cost') {
            $result = min($arrayValue) / $value;
        }
        return round($result, 3);
    }
}
