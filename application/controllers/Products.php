<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Dompdf\Dompdf;
class Products extends CI_Controller
{
	public function __construct()
	{
		//load database in autoload libraries 
		parent::__construct();
		$this->load->model('ProductModel');
	}

	public function index(){
		return $this->list();
	}

	public function list()
	{
		$products = new ProductModel;
		$data = $products->getList();
		
		$this->load->view('product/list', array('products'=>$data));
	}

	public function checkout($document_code)
	{
		$products = new ProductModel;
		$data = $products->getCheckouts($document_code);
		$this->load->view('product/checkout', array(
			'products'=>$data,
			'document_code'=> $document_code
		));
	}

	public function done($document_code)
	{
		$products = new ProductModel;
		$data = $products->getHeader($document_code);
		$this->load->view('product/done', array(
			'header'=> $data
		));
	}

	public function save_tran_header($doc_code){
		$products = new ProductModel;
		$products->insert_header($doc_code);
	}

	public function save_tran_detail($code, $doc_code){
		$products = new ProductModel;
		$products->insert_tran($code, $doc_code);
	}

	public function get_detail($code){
		$products = new ProductModel;
		$res = $products->getProduct($code);
		// var_dump($res);
		$data = array(
			'product_code'=> $res->product_code,
			'product_name'=> $res->product_name,
			'price'=> $res->price,
			'currency'=> $res->currency,
			'discount'=> $res->discount,
			'dimension'=> $res->dimension,
			'unit'=> $res->unit
		);
		echo json_encode($data);
	}

	function update_tran_detail($code, $doc_code, $qty, $sub_total){
		$products = new ProductModel;
		var_dump($code, $doc_code, $qty, $sub_total);
		$products->update_detail($code, $doc_code, $qty, $sub_total);

	}

	function update_tran_header($doc_code, $total){
		$products = new ProductModel;
		$products->update_header($doc_code, $total);
	}

	function report(){
		$this->load->library('pdf');
		$products = new ProductModel;
		$head_user_data = $products->getReportData();

		$items = [];
		foreach ($head_user_data as $item) {
			if(!isset($items[$item->document_code])){
				$items[$item->document_code] = [];
			}
			$item_ = $products->getCheckouts($item->document_code);
			
			foreach ($item_ as $value) {
				array_push($items[$item->document_code],$value);
			}
			
		}
		
		
        $html = $this->load->view('report', ['data'=> $head_user_data, 'items'=>$items], true);
        $this->pdf->createPDF($html, 'report', false);

		
	   }

}
