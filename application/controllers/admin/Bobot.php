<?php

class Bobot extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
        $this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
         if($this->auth_model->current_user()->level == '2'){
			redirect('admin/dashboard');
		}
		$this->load->model('bobot_model');
		
	}

   public function index()
	{
        $data['bobot'] = $this->bobot_model->getDataBobot();
        $data['current_user'] = $this->auth_model->current_user();
       $this->load->view('admin/bobot', $data);
	}

   public function dataBobot()
    {
        
        $dataKriteria = $this->bobot_model->getDataBobot();
        $no =1;
        foreach ($dataKriteria as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['namaKriteria'];
            $tbody[] = $value['bobot'];
            $aksi= "<button class='btn btn-primary ubah-nilai-bobot' data-toggle='modal' data-id=".$value['id_bobotkriteria'].">Ubah</button>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($dataKriteria) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

   public function formedit()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data['dataBobot'] = $this->bobot_model->dataBobotedit($id);
        $this->load->view('admin/formEditBobot',$data);
    }

	public function ubahDataBobot()
    {
        $id = $this->input->post('id');
        $bobot = $this->input->post('bobot');
        $queryNilai ="SELECT sum(bobot)+'$bobot' as total FROM bobot_kriteria where id_bobotkriteria not in ('$id') "; 
        $query =  $this->db->query($queryNilai);
                    $arrayNilai = $query->result_array();
                    $arrN = array_column($arrayNilai,"total");  
                    $total = $arrN[0];

       if ($total <= 100) {
           $objdata = array(
            'bobot'=> $bobot,
           );
        $id = $this->input->post('id');
        $data = $this->bobot_model->ubahDataBobot($objdata,$id);
       } else {
           $data = 'error';
       }

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
