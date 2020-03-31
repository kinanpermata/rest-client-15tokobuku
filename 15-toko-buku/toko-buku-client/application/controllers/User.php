<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Login_model');
        $this->load->model('User_model');
        $this->load->model('Buku_model');

        if($this->session->userdata('level')!="nonadmin"){
            redirect('login','refresh');
        }
    }

    public function index()
    {
        
        $data['title']='List Kategori Buku';
        $data['buku']=$this->Buku_model->getAllbuku();

        if($this->input->post('keyword')){
            $data['buku']=$this->Buku_model->cariDataBuku();
        }

        $this->load->view('template/header_user', $data);
        $this->load->view('user/homeuser', $data);
        $this->load->view('template/footer');
        
    }

}

/* End of file user.php */

?>