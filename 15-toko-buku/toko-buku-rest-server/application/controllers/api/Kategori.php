<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/format.php';

class Kategori extends REST_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Kategori_model', 'kategori');
    }

    public function index_get()
    {
        $id_kategori = $this->get('id_kategori');
        if ($id_kategori === null){
            $kategori = $this->kategori->getKategori();
        } else {
            $kategori = $this->kategori->getKategori($id_kategori);
        }

        if($kategori){
            $this->response([
                'status' => TRUE,
                'data' => $kategori
            ], REST_Controller::HTTP_OK);
        } else{
            $this->response([
                'status' => FALSE,
                'message' => 'ID tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
        
    }

    public function index_delete(){
        $id_kategori = $this->delete('id_kategori');

        if($id_kategori === null){
            $this->response([
                'status' => FALSE,
                'message' => 'Berikan ID!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->kategori->deleteKategori($id_kategori) > 0){
                $this->response([
                    'status' => TRUE,
                    'data' => $id_kategori,
                    'message' => 'Data terhapus'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'ID tidak ditemukan'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post(){
        $data = [
            'id_kategori' => $this->post('id_kategori'),
            'id_buku' => $this->post('id_buku'),
            'judul_buku' => $this->post('judul_buku'),
            'kategori' => $this->post('kategori')
        ];

        if($this->kategori->createKategori($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'Data bertambah'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Gagal untuk menambahkan data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put(){
        $id_kategori = $this->put('id_kategori');
        
        $data = [
            'id_kategori' => $this->put('id_kategori'),
            'id_buku' => $this->put('id_buku'),
            'judul_buku' => $this->put('judul_buku'),
            'kategori' => $this->put('kategori')
        ];

        if($this->kategori->updateKategori($data, $id_kategori) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'Data berhasil diubah'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Gagal untuk mengubah data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}

?>