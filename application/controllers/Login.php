<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
	{
		//load database in autoload libraries 
		parent::__construct();
		$this->load->model('AuthModel');
	}

	public function index()
	{
		$this->load->view('login');
	}

    public function login(){
        $auth = new AuthModel;
        $username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->session->set_userdata('user', 'username');

        if($auth->login($username, $password)){
			redirect('products/list');
		} else {
            // $this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan username dan passwrod benar!');
            redirect('');
		}

    }

	public function logout(){
		$this->session->unset_userdata('user');
		redirect('');
    }

}
