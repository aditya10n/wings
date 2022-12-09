<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct()
	{
		//load database in autoload libraries 
		parent::__construct();
		$this->load->model('ProductModel');
	}

	public function list()
	{
		$products = new ProductModel;
		$data = $products->getList();
		
		$this->load->view('product/list', array('products'=>$data));
	}

	public function save_tran_detail(){
		$products = new ProductModel;
		$code = $this->input->post('code');
		$doc_code = $this->input->post('doc_code');
		$products->insert_tran($code, $doc_code);
		var_dump($this->input->post);
	}

}
