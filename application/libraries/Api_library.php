<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Api_library{
    
    public function __construct()
    {
        date_default_timezone_set('Asia/Kolkata');
        $this->CI =& get_instance();
        $this->CI->load->database('default',TRUE);

    }
    
    public function getProductsByFilter($data){
        $this->CI->db->select('PV.*,P.id as pid,P.title,P.slug ')
       ->from('product_variation as PV')
       ->join('product as P', 'P.id = PV.product_id');
       if(!empty($data['id'])){
           $this->CI->db->where('P.id', $data['id']);
       }else if(!empty($data['slug'])){
           $this->CI->db->where('P.slug', $data['slug']);
       }else if(!empty($data['min_price']) && !empty($data['max_price'])){
           $this->CI->db->where('price >=', $data['min_price']);
           $this->CI->db->where('price <=', $data['max_price']);
       }else if(!empty($data['order_name_asc'])){
           $this->CI->db->order_by('attribute_name',$data['order_name_asc']);
       }else if(!empty($data['order_name_desc'])){
           $this->CI->db->order_by('attribute_name',$data['order_name_desc']);
       }
       $query = $this->CI->db->get();
       //print_r($this->CI->db->last_query());exit;
       return $result = $query->result_array();
       

    }
    public function getProductVariationByProductId($id){
        $query = $this->CI->db->select('t.*,pa.product_attr as product_attribute')->from('variation_details as t')->join('product_attribute as pa','pa.id = t.product_attribute_id')->where('t.product_variation_id', $id)->get();
         //print_r($this->CI->db->last_query());exit;
         return $result = $query->result_array();
        
    }
    
    public function getProductImagesByProductId($id){
        $query = $this->CI->db->select('*')->from('product_variation_images')->where(['product_id' => $id])->get();
         //print_r($this->CI->db->last_query());exit;
         return $result = $query->result_array();
        
    }
    public function addToCart($data){
        $exp = explode('@',$data['user_email']);
        $query = $this->CI->db->insert('add_cart_items', ['variation_details_id' => $data['variation_id'],'user_id' => $exp[0],'email' => $data['user_email'],'attribute_id' => $data['product_id'],'variation_detail_id' => $data['variation_id'],'total_item' => $data['total_item'],'status' => 0,'date' => date('Y-m-d h:i:s') ]);
        if($query) return TRUE; else FALSE;
        
    }
    public function getCart($data){
        $query = $this->CI->db->select('a.*,v.weight,v.regular_price,v.sale_price,v.order_price,pa.product_attr as product_attribute')->from('add_cart_items as a')->join('variation_details as v','v.id = a.variation_detail_id')->join('product_attribute as pa','pa.id = v.product_attribute_id')->where(['a.email' => $data['user_email'], 'a.status' => 0])->get();
        //print_r($this->CI->db->last_query());exit;
        return $result = $query->result_array();
    }

    
}