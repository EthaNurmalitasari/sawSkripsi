<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class  Bobot_model extends CI_Model {
         private $_table = "bobot_kriteria";

        public function save($data)
        {
            return $this->db->insert($this->_table, $data);
        }

    public function getDataBobot()
    {
            $this->db->select('*');
            $this->db->from('bobot_kriteria');
            $this->db->join('kriteria','kriteria.id_kriteria = bobot_kriteria.id_kriteria');      
            $query = $this->db->get();
            return $query->result_array();
    }

    public function dataBobotedit($id)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('kriteria','kriteria.id_kriteria = bobot_kriteria.id_kriteria'); 
        $this->db->where('id_bobotkriteria',$id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahDataBobot($data,$id)
    {
        $this->db->where('id_bobotkriteria',$id);
        return $this->db->update($this->_table,$data);

    }

    public function hapusDataBobot($id)
    {
        $this->db->where('id_bobotkriteria',$id);
        return $this->db->delete($this->_table);
        
    }
    
    }
