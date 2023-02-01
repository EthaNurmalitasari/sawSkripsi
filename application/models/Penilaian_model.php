<?php defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian_model extends CI_Model
{
    private $_table = "nilai_mahasiswa";

    public function getdatanilai()
    {
        $this->db->select('*');
        $this->db->from('nilai_mahasiswa');
        $this->db->join('kriteria', 'kriteria.id_kriteria = nilai_mahasiswa.id_kriteria');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = nilai_mahasiswa.id_mahasiswa');
        $this->db->group_by('nilai_mahasiswa.id_mahasiswa');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function dataNilaiEdit($id)
    {
        $this->db->select('*');
        $this->db->from('nilai_mahasiswa');
        $this->db->join('kriteria', 'kriteria.id_kriteria = nilai_mahasiswa.id_kriteria');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = nilai_mahasiswa.id_mahasiswa');
        $this->db->where('nilai_mahasiswa.id_mahasiswa', $id);
        $this->db->order_by('nilai_mahasiswa.id_kriteria', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ubahDataNilai($data, $id, $id_kriteria)
    {
        $this->db->where('id_mahasiswa', $id);
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->update($this->_table, $data);
    }

    public function hapusdata($id)
    {
        $this->db->where('id_mahasiswa', $id);
        return $this->db->delete($this->_table);
    }
}
