<?php defined('BASEPATH') or exit('No direct script access allowed');

class Nilaikriteria_model extends CI_Model
{
    private $_table = "nilai_kriteria";

    public function getdatanilaikriteria()
    {
        $this->db->select('*');
        $this->db->from('nilai_kriteria');
        $this->db->join('kriteria', 'kriteria.id_kriteria = nilai_kriteria.id_kriteria');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function datanilaiKriteriaedit($id)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id_nilaikriteria', $id);
        $this->db->join('kriteria', 'kriteria.id_kriteria = nilai_kriteria.id_kriteria');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahdatanilaikriteria($data, $id)
    {
        $this->db->where('id_nilaikriteria', $id);
        return $this->db->update($this->_table, $data);
    }

    public function hapusdatanilaikriteria($id)
    {
        $this->db->where('id_nilaiKriteria', $id);
        return $this->db->delete($this->_table);
    }
}
