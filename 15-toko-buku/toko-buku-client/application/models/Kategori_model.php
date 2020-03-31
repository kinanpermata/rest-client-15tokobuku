<?php
use GuzzleHttp\Client;

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost/15-toko-buku/toko-buku-rest-server/api/',
            'auth' => ['admin', 'admin'],
        ]);

    }

    public function getAllkategori()
    {
        $this->db->select('ktg.*, bk.id_buku, bk.judul_buku');
        $this->db->from('kategori ktg');
        $this->db->join('buku bk','bk.id_buku = ktg.id_buku');
        
        $response = $this->_client->request('GET', 'kategori', [
            'query' => [
                'wpu-key' => 'wpu15'
            ]
        ]);

        $result = json_decode ($response->getBody()->getContents(), true);
        return $result['data'];
        
    }

    public function getBukuID()
    {
        $this->db->select('id_buku, judul_buku');
        $this->db->from('buku');
        return $this->db->get()->result_array();
    }

    public function tambahdatakategori()
    {
        $data=[
            "id_kategori" => $this->input->post('id_kategori',true), 
            "id_buku" => $this->input->post('id_buku',true),
            "judul_buku" => $this->input->post('judul_buku',true),
            "kategori" => $this->input->post('kategori',true),
            'wpu-key' => 'wpu15'
        ];
        
        $response = $this->_client->request('POST', 'kategori', [
            'form_params' => $data
        ]);

        $result = json_decode ($response->getBody()->getContents(), true);
        return $result;
    }

    public function hapusdataKategori($id_kategori){
        $response = $this->_client->request('DELETE', 'kategori', [
            'form_params' => [
                'id_kategori' =>$id_kategori,
                'wpu-key' => 'wpu15'
            ] 
        ]);

        $result = json_decode ($response->getBody()->getContents(), true);
        return $result;
    }

    public function getKategoriByID($id){
        $response = $this->_client->request('GET', 'kategori', [
            'query' => [
                'wpu-key' => 'wpu15',
                'id' => $id
            ] 
        ]);

        $result = json_decode ($response->getBody()->getContents(), true);
        return $result['data'][0];
    }

    public function ubahdataKategori($id_kategori){
        $data=[
            "id_kategori" => $this->input->post('id_kategori',true), 
            "id_buku" => $this->input->post('id_buku',true),
            "judul_buku" => $this->input->post('judul_buku',true),
            "kategori" => $this->input->post('kategori',true),
            'wpu-key' => 'wpu15'
        ];

        $response = $this->_client->request('PUT', 'kategori', [
            'form_params' => $data
        ]);

        $result = json_decode ($response->getBody()->getContents(), true);
        return $result;
    }

    public function cariDataKategori(){
        $keyword=$this->input->post('keyword');
        $this->db->like('id_kategori',$keyword);
        $this->db->or_like('judul_buku',$keyword);
        $this->db->or_like('kategori',$keyword);
        return $this->db-> get('kategori')->result_array();
    }

}

?>