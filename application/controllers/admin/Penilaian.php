<?php

class Penilaian extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
        	$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
		$this->load->model('penilaian_model');
        $this->load->model('nilaikriteria_model');
        $this->load->model('kriteria_model');
        $this->load->model('ca_model');
		
	}

   public function index()
	{
        $data['dataKriteria'] = $this->kriteria_model->getDataKriteria();
        $data['current_user'] = $this->auth_model->current_user();
       $this->load->view('admin/penilaian', $data);
	}

   public function dataNilai()
    {
        
        $dataNilai = $this->penilaian_model->getDataNilai();
        $no =1;
        foreach ($dataNilai as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['nama_mahasiswa'];
            $aksi= "<button class='btn btn-primary ubah-nilai' data-toggle='modal' data-id=".$value['id_mahasiswa'].">Ubah</button>".' '."<button class='btn btn-danger hapus-nilai' id='id' data-toggle='modal' data-id=".$value['id_mahasiswa'].">Hapus</button>";;
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($dataNilai) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function add()
    {
        $id_kriteria = $this->input->post('id_kriteria');
        $nilai_awal = $this->input->post('id_nilaikriteria');
        $queryCek ="SELECT nilai FROM nilai_kriteria where id_kriteria =  $id_kriteria order by nilai asc";   
         $query =  $this->db->query($queryCek);
         $array = $query->result_array();
         $arr = array_column($array,"nilai");
         if ($query->num_rows() % 2 == 0) {
             if($nilai_awal > $arr[0] && $nilai_awal <= $arr[1]){
                 $queryNilai ="SELECT id_nilaikriteria FROM nilai_kriteria where id_kriteria = '$id_kriteria' and nilai = '$arr[1]' ";
                   $query =  $this->db->query($queryNilai);
                    $arrayNilai = $query->result_array();
                    $arrN = array_column($arrayNilai,"id_nilaikriteria");  
                    $id_nilaikriteria = $arrN[0]; 
             } else {
                  $queryNilai ="SELECT id_nilaikriteria FROM nilai_kriteria where id_kriteria = '$id_kriteria' and nilai = '$arr[0]' "; 
                   $query =  $this->db->query($queryNilai);
                    $arrayNilai = $query->result_array();
                    $arrN = array_column($arrayNilai,"id_nilaikriteria");  
                    $id_nilaikriteria = $arrN[0];
             }
         } else {
              if($nilai_awal > $arr[1] && $nilai_awal <= $arr[2]){
                 $queryNilai ="SELECT id_nilaikriteria FROM nilai_kriteria where id_kriteria = '$id_kriteria' and nilai = '$arr[2]' ";
                   $query =  $this->db->query($queryNilai);
                    $arrayNilai = $query->result_array();
                    $arrN = array_column($arrayNilai,"id_nilaikriteria");  
                    $id_nilaikriteria = $arrN[0]; 
             } else if ($nilai_awal > $arr[0] && $nilai_awal <= $arr[1]) {
                 $queryNilai ="SELECT id_nilaikriteria FROM nilai_kriteria where id_kriteria = '$id_kriteria' and nilai = '$arr[1]' ";
                   $query =  $this->db->query($queryNilai);
                    $arrayNilai = $query->result_array();
                    $arrN = array_column($arrayNilai,"id_nilaikriteria");  
                    $id_nilaikriteria = $arrN[0]; 
             } else {
                 $queryNilai ="SELECT id_nilaikriteria FROM nilai_kriteria where id_kriteria = '$id_kriteria' and nilai = '$arr[0]' ";
                   $query =  $this->db->query($queryNilai);
                    $arrayNilai = $query->result_array();
                    $arrN = array_column($arrayNilai,"id_nilaikriteria");  
                    $id_nilaikriteria = $arrN[0]; 
             }
         }
        

        $tambahKriteria = array (
            'id_mahasiswa'=>$this->input->post('id_mahasiswa'),
            'id_kriteria' => $id_kriteria,
            'id_nilaikriteria' => $id_nilaikriteria,
            'nilai_awal' => $nilai_awal
        );

       

        $data = $this->penilaian_model->save($tambahKriteria);

        echo json_encode($data);
    }

   public function formedit()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data['dataNilai'] = $this->penilaian_model->dataNilaiEdit($id);
        $data['dataAnggota'] = $this->ca_model->datamahasiswaedit($id);
        $data['dataKriteria'] = $this->kriteria_model->getDataKriteria();
        $this->load->view('admin/formEditNilaimahasiswa',$data);
    }

	public function ubahDataNilai()
    {

        $id_kriteria = $this->input->post('id_kriteria');
        $nilai_awal = $this->input->post('id_nilaikriteria');
        $queryCek ="SELECT nilai FROM nilai_kriteria where id_kriteria =  $id_kriteria order by nilai asc";   
         $query =  $this->db->query($queryCek);
         $array = $query->result_array();
         $arr = array_column($array,"nilai");
         if ($query->num_rows() % 2 == 0) {
             if($nilai_awal > $arr[0] && $nilai_awal <= $arr[1]){
                 $queryNilai ="SELECT id_nilaikriteria FROM nilai_kriteria where id_kriteria = '$id_kriteria' and nilai = '$arr[1]' ";
                   $query =  $this->db->query($queryNilai);
                    $arrayNilai = $query->result_array();
                    $arrN = array_column($arrayNilai,"id_nilaikriteria");  
                    $id_nilaikriteria = $arrN[0]; 
             } else {
                  $queryNilai ="SELECT id_nilaikriteria FROM nilai_kriteria where id_kriteria = '$id_kriteria' and nilai = '$arr[0]' "; 
                   $query =  $this->db->query($queryNilai);
                    $arrayNilai = $query->result_array();
                    $arrN = array_column($arrayNilai,"id_nilaikriteria");  
                    $id_nilaikriteria = $arrN[0];
             }
         } else {
              if($nilai_awal > $arr[1] && $nilai_awal <= $arr[2]){
                 $queryNilai ="SELECT id_nilaikriteria FROM nilai_kriteria where id_kriteria = '$id_kriteria' and nilai = '$arr[2]' ";
                   $query =  $this->db->query($queryNilai);
                    $arrayNilai = $query->result_array();
                    $arrN = array_column($arrayNilai,"id_nilaikriteria");  
                    $id_nilaikriteria = $arrN[0]; 
             } else if ($nilai_awal > $arr[0] && $nilai_awal <= $arr[1]) {
                 $queryNilai ="SELECT id_nilaikriteria FROM nilai_kriteria where id_kriteria = '$id_kriteria' and nilai = '$arr[1]' ";
                   $query =  $this->db->query($queryNilai);
                    $arrayNilai = $query->result_array();
                    $arrN = array_column($arrayNilai,"id_nilaikriteria");  
                    $id_nilaikriteria = $arrN[0]; 
             } else {
                 $queryNilai ="SELECT id_nilaikriteria FROM nilai_kriteria where id_kriteria = '$id_kriteria' and nilai = '$arr[0]' ";
                   $query =  $this->db->query($queryNilai);
                    $arrayNilai = $query->result_array();
                    $arrN = array_column($arrayNilai,"id_nilaikriteria");  
                    $id_nilaikriteria = $arrN[0]; 
             }
         }
        
         $updateData = array (
            'id_mahasiswa'=>$this->input->post('id_mahasiswa'),
            'id_kriteria' => $id_kriteria,
            'id_nilaikriteria' => $id_nilaikriteria,
            'nilai_awal' =>$nilai_awal
        );

        $id = $this->input->post('id_mahasiswa');
        $id_kriteria = $id_kriteria;
        $data = $this->penilaian_model->ubahDataNilai($updateData,$id, $id_kriteria);

        echo json_encode($data);
    }

	public function hapus()
    {
         // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
         $id = $this->input->post('id');

         $data = $this->penilaian_model->hapusdata($id);
         echo json_encode($data);
    }

}
