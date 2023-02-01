<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria_model extends CI_Model
{
    private $_table = "kriteria";

    public function getDataKriteria()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dropdDownKriteria($q, $column)
    {
        $this->db->select('*');
        $this->db->limit(10);
        $this->db->from($this->_table);
        $this->db->like('namaKriteria', $q);
        return $this->db->get()->result_array();
    }

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function dataKriteriaedit($id)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id_kriteria', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahDataKriteria($data, $id)
    {
        $this->db->where('id_kriteria', $id);
        return $this->db->update($this->_table, $data);
    }

    public function hapusDataKriteria($id)
    {
        $this->db->where('id_kriteria', $id);
        $query = $this->db->delete($this->_table);
        if ($query) {
            $this->db->where('id_kriteria', $id);
            $query2 = $this->db->delete('nilai_kriteria');
            if ($query2) {
                $this->db->where('id_kriteria', $id);
                $query2 = $this->db->delete('bobot_kriteria');
            }
        }

        return $this->db->delete($this->_table);
    }
}
