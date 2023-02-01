<?php defined('BASEPATH') or exit('No direct script access allowed');

class Ca_model extends CI_Model
{
    private $_table = "mahasiswa";

    // public $nama_calon_anggota;
    // public $nim;
    // public $jurusan_calon_anggota;

    public function rules()
    {
        return [
            [
                'field' => 'namamahasiswa',
                'label' => 'namamahasiswa',
                'rules' => 'required'
            ],

            [
                'field' => 'nim',
                'label' => 'nim',
                'rules' => 'numeric'
            ],

            [
                'field' => 'jurusan',
                'label' => 'jurusan',
                'rules' => 'required'
            ]
        ];
    }

    public function getdatamahasiswa()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save($data)
    {
        $this->db->where('nama_mahasiswa', $data);


        // return $this->db->insert($this->_table, $data);
    }

    public function datamahasiswaedit($id)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id_mahasiswa', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahDatamahasiswa($data, $id)
    {
        $this->db->where('id_mahasiswa', $id);
        return $this->db->update($this->_table, $data);
    }

    public function hapusDatamahasiswa($id)
    {
        $this->db->where('id_mahasiswa', $id);
        return $this->db->delete($this->_table);
    }

    public function dropdDownCA($q, $column)
    {
        $this->db->select('*');
        $this->db->limit(10);
        $this->db->from($this->_table);
        $this->db->like('nama_mahasiswa', $q);
        return $this->db->get()->result_array();
    }
}
