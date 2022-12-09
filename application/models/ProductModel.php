<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductModel extends CI_Model
{

    // public $title;
    // public $content;
    // public $date;

    public function getList()
    {
        $query = $this->db->get('product');
        return $query->result();
    }

    public function insert_tran($code, $doc_code){
        $prod = $this->getProduct($code);
        var_dump($code);
        $price = $prod->price;
        if($prod->discount != 0){
            $price = $price - ($price * $prod->discount / 100);
        }
        $data = array(
            'document_code'=>$doc_code,
            'product_code'=>$code,
            'price'=>$price,
            'quantity'=> 0,
            'unit'=> $prod->unit,
            'sub_total'=>0,
            'currency'=> $prod->currency,
        );
    
        // $this->db->insert('transaction_detail',$data);
    }

    function getProduct($code){
        $query = $this->db->get_where('product', ['product_code' => $code]);
        return $query->row();
    }

    
}
