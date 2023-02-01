<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengurus_model extends CI_Model
{
    private $_table = "user";

    public function getDataPengurus()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('level', 2);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function ubahDataPengurus($data, $id)
    {
        $this->db->where('Id_user', $id);
        return $this->db->update($this->_table, $data);
    }

    public function hapusDataPengurus($id)
    {
        $this->db->where('Id_user', $id);
        return $this->db->delete($this->_table);
    }
}
