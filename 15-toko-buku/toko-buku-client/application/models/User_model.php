<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function getAllbuku()
    {
        $response = $this->_client->request('GET', 'buku', [
            'query' => [
                'wpu-key' => 'wpu15'
            ]
        ]);

        $result = json_decode ($response->getBody()->getContents(), true);
        return $result['data'];
    }

    public function cariDataBuku()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('judul_buku', $keyword);
        $this->db->or_like('pengarang', $keyword);
        return $this->db->get('buku')->result_array();
    }

}

?>