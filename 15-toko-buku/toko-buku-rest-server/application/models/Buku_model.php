<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends CI_Model
{

    public function getBuku($id_buku = null)
    {
        if ($id_buku === null){
            return $this->db->get('buku')->result_array();
        } else {
            return $this->db->get_where('buku', ['id_buku' => $id_buku])->result_array();
        }
    }

    public function deleteBuku($id_buku)
    {
        $this->db->delete('buku', ['id_buku' => $id_buku]);
        return $this->db->affected_rows();
        
    }

    public function createBuku($data)
    {
        $this->db->insert('buku', $data);
        return $this->db->affected_rows();
    }

    public function updateBuku($data, $id_buku)
    {
        $this->db->update('buku', $data, ['id_buku' => $id_buku]);
        return $this->db->affected_rows();
    }

}