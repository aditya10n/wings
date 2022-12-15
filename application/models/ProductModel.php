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
        $price = $prod->price;
        if($prod->discount != 0){
            $price = $price - ($price * $prod->discount / 100);
        }

        $data = array(
            'document_code'=>$doc_code,
            'product_code'=>$code,
            'price'=>$price,
            'quantity'=> 1,
            'unit'=> $prod->unit,
            'sub_total'=>$price,
            'currency'=> $prod->currency
        );
        $this->db->insert('transaction_detail',$data);
    }

    function getProduct($code){
        $query = $this->db->get_where('product', ['product_code' => $code]);
        return $query->row();
    }

    function getHeader($doc_code){
        $query = $this->db->get_where('transaction_header', ['document_code' => $doc_code]);
        return $query->row();
    }


    function getDetail($code, $doc_code){
        $query = $this->db->get_where('transaction_detail', [
            'document_code' => $doc_code,
            'product_code' => $code
        ]);
        return $query->row();
    }

    function insert_header($doc_code){
        $data = array(
            'document_code'=>$doc_code,
            'user'=> $this->session->user,
            'total'=>0,
            'date'=> date('Y-m-d')
        );
        $this->db->insert('transaction_header',$data);
    }

    function getCheckouts($document_code){
        $query = "SELECT transaction_detail.*, product.product_name FROM `transaction_detail` JOIN 
        product ON product.product_code = transaction_detail.product_code 
        WHERE transaction_detail.document_code = " . $document_code;

        return $this->db->query($query)->result();
    }

    function update_header($doc_code, $total){
        $data = $this->getHeader($doc_code);
        // $data->total= $total;
        // $this->db->update('transaction_header', $data);
        $query = "UPDATE `transaction_header` SET `total` = $total WHERE `transaction_header`.`document_code` = $doc_code;";
        $this->db->query($query);
    }

    function update_detail($code, $doc_code, $qty, $sub_total){
        $data = $this->getDetail($code, $doc_code);
        // $data->quantity = $qty;
        // $data->sub_total = $sub_total;
        // $this->db->where(array(
        //         'document_number' => $doc_code,
        //         'product_code' => $code));
        // $this->db->update('transaction_detail', $data);


        $query = "UPDATE `transaction_detail` SET `quantity` = $qty WHERE `transaction_detail`.`document_number` = $data->document_number;";
        $this->db->query($query);
        $query = "UPDATE `transaction_detail` SET `sub_total` = $sub_total WHERE `transaction_detail`.`document_number` = $data->document_number;";
        $this->db->query($query);
    }

    function getReportData(){
        $query = "SELECT transaction_header.*, login.user from transaction_header
        JOIN login on login.user = transaction_header.user;";

        return $this->db->query($query)->result();
    }

    
}
