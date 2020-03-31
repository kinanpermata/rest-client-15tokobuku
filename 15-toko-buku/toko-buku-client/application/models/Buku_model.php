<?php
use GuzzleHttp\Client;

class Buku_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost/15-toko-buku/toko-buku-rest-server/api/',
            'auth' => ['admin', 'admin'],
        ]);

    }

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

    public function tambahdataBuku($upload)
    {
        $data = [
            "id_buku" => $this->input->post('id_buku', true),
            "judul_buku" => $this->input->post('judul_buku', true),
            "pengarang" => $this->input->post('pengarang', true),
            "penerbit" => $this->input->post('penerbit', true),
            "harga" => $this->input->post('harga', true),
            "stok" => $this->input->post('stok', true),
            "gambar" => $upload['file']['file_name'],
            'wpu-key' => 'wpu15'
        ];
        
        $response = $this->_client->request('POST', 'buku', [
            'form_params' => $data
        ]);

        $result = json_decode ($response->getBody()->getContents(), true);
        return $result;
    }

    public function upload()
    {
        $config['upload_path'] = './uploads/buku/';
        $config['allowed_types'] = 'jpg|jpeg|png';


        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_error());
            return $return;
        }
    }

    public function hapusdataBuku($id_buku)
    {
        $response = $this->_client->request('DELETE', 'buku', [
            'form_params' => [
                'id_buku' =>$id_buku,
                'wpu-key' => 'wpu15'
            ] 
        ]);

        $result = json_decode ($response->getBody()->getContents(), true);
        return $result;
    }

    public function getBukuByID($id)
    {
        $response = $this->_client->request('GET', 'buku', [
            'query' => [
                'wpu-key' => 'wpu15',
                'id' => $id
            ] 
        ]);

        $result = json_decode ($response->getBody()->getContents(), true);
        return $result['data'][0];
    }

    public function ubahdataBuku($upload)
    {
        $data = [
            "id_buku" => $this->input->post('id_buku', true),
            "judul_buku" => $this->input->post('judul_buku', true),
            "pengarang" => $this->input->post('pengarang', true),
            "penerbit" => $this->input->post('penerbit', true),
            "harga" => $this->input->post('harga', true),
            "stok" => $this->input->post('stok', true),
            "gambar" => $upload['file']['file_name'],
            'wpu-key' => 'wpu15'
        ];

        $response = $this->_client->request('PUT', 'buku', [
            'form_params' => $data
        ]);

        $result = json_decode ($response->getBody()->getContents(), true);
        return $result;
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