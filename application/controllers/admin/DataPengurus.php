<?php

class DataPengurus extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
        $this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
		$this->load->model('Pengurus_model');
		
	}

   public function index()
	{
        $data['current_user'] = $this->auth_model->current_user();
       $this->load->view('admin/pengurus', $data);
	}

    public function setting()
	{
        $data['current_user'] = $this->auth_model->current_user();
       $this->load->view('admin/setting', $data);
	}

    public function data()
    {
        
        $dataPengurus = $this->Pengurus_model->getDataPengurus();
        $no =1;
        foreach ($dataPengurus as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['username'];
            $tbody[] = $value['text'];
            if($value== '1') {
                $tbody[] = 'Admin';
            } else {
                $tbody[] = 'Pengurus';
            }
            
            $aksi= "<button class='btn btn-danger hapus-dataPengurus' id='id' data-toggle='modal' data-id=".$value['Id_user'].">Hapus</button>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($dataPengurus) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function add()
    {
        $username = $this->input->post('username'); 
        $password = $this->input->post('password');
        $level = $this->input->post('level');

        $tambah = array (
            'username'=>$username,
            'password'  => password_hash($password,PASSWORD_DEFAULT),
            'text' => $password,
            'level' => $level
        );

        $data = $this->Pengurus_model->save($tambah);

        echo json_encode($data);
    }

      public function update()
    {
        $objdata = array(
            'username'=>$this->input->post('username'),
            'password'=>password_hash($this->input->post('password'),PASSWORD_DEFAULT),
            'text'=>$this->input->post('password'),
        );

        $id = $this->input->post('id');
        $data = $this->Pengurus_model->ubahDataPengurus($objdata,$id);

        echo json_encode($data);
    }

     public function hapus()
    {
         // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
         $id = $this->input->post('id');
         $data = $this->Pengurus_model->hapusDataPengurus($id);
         echo json_encode($data);
    }


}
