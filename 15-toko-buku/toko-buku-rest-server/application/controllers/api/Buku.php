<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/format.php';

class Buku extends REST_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Buku_model', 'buku');
    }

    public function index_get()
    {
        $id_buku = $this->get('id_buku');
        if ($id_buku === null){
            $buku = $this->buku->getBuku();
        } else {
            $buku = $this->buku->getBuku($id_buku);
        }

        if($buku){
            $this->response([
                'status' => TRUE,
                'data' => $buku
            ], REST_Controller::HTTP_OK);
        } else{
            $this->response([
                'status' => FALSE,
                'message' => 'ID tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
        
    }

    public function index_delete(){
        $id_buku = $this->delete('id_buku');

        if($id_buku === null){
            $this->response([
                'status' => FALSE,
                'message' => 'Berikan ID!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->buku->deleteBuku($id_buku) > 0){
                $this->response([
                    'status' => TRUE,
                    'data' => $id_buku,
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
            'id_buku' => $this->post('id_buku'),
            'judul_buku' => $this->post('judul_buku'),
            'pengarang' => $this->post('pengarang'),
            'penerbit' => $this->post('penerbit'),
            'harga' => $this->post('harga'),
            'stok' => $this->post('stok'),
            'gambar' => $this->post('gambar')
        ];

        if($this->buku->createBuku($data) > 0){
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
        $id_buku = $this->put('id_buku');
        
        $data = [
            'id_buku' => $this->put('id_buku'),
            'judul_buku' => $this->put('judul_buku'),
            'pengarang' => $this->put('pengarang'),
            'penerbit' => $this->put('penerbit'),
            'harga' => $this->put('harga'),
            'stok' => $this->put('stok'),
            'gambar' => $this->put('gambar')
        ];

        if($this->buku->updateBuku($data, $id_buku) > 0){
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