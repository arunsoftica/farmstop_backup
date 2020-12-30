<?php

class ProductApiModel extends CI_Model
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Kolkata');
    }


    public function getAllOrderByUser($user_id)
    {
        $query = $this->db->select('t.*,a.email as umail,a.address as adrs,a.district as dist,a.zipcode as pin,u.id as order_no')->from('user_payment as t')->join('user_address as a', 'a.id = t.address_id')->join('user_order as u', 't.id = u.payment_id')->where('t.user_id', $user_id)
        ->where('t.transaction_id !=', "")->order_by('t.date', 'desc')->get();
        //print_r($this->db->last_query());exit;
        if ($query) {
            return $result = $query->result_array();
        } else {
            false;
        }

    }

	public function getOrderDetails($user_id,$order_id)
    {
		$query = $this->db->select('t.*,c.attribute_id as prod_id,v.attribute_name,p.image,c.variation_detail_id as variation_id ,c.total_item,c.variation_price as variation_price,a.address as adrs,a.district as dist,a.zipcode as pin,u.id as order_no')
		->from('user_payment as t')
		->join('user_order as u', 't.id = u.payment_id')
		->join('user_address as a', 'a.id = t.address_id')
        ->join('add_cart_items as c', 't.id = c.pay_id')
        ->join('product_variation as v', 'v.id = c.attribute_id')
        ->join('product_variation_images as p', 'p.product_id = c.attribute_id')
		->where('u.id', $order_id)->where('p.fstatus', 1)->get();
        // print_r($this->db->last_query());exit;
        if ($query) {
            return $result = $query->result_array();
        } else {
            false;
        }

	}
	
    public function getProducts($id = null, $start = null, $end = null)
    {
        if ($id != null) {
            $query = $this->db->get_where('product', ['id' => $id]);
            return $result = $query->row_array();
        } else {
            $query = $this->db->select('t.*,c.email as mail,i.image as img')->from('product as t')->join('institute_tbl as c', 'c.id = t.admin_id')->
                join('product_images as i', 'i.product_id = t.id')
                ->where(['i.fstatus' => 1])
                ->get();
            //$query = $this->db->get('product');
            return $result = $query->result_array();
        }
    }

    public function getBasket()
    {
        $query = $this->db->select('t.*,c.title as pname,i.email as mail,p.image as fimage')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->join('product_variation_images as p','t.id = p.product_id')->where('p.fstatus',1)
        ->where('t.product_id',37)->order_by('t.id','asc')->get();
        // $query = $this->db->select('t.*,c.email as mail,i.image as img')->from('product as t')->join('institute_tbl as c', 'c.id = t.admin_id')->
        //     join('product_images as i', 'i.product_id = t.id')
        //     ->where(['i.fstatus' => 1])
        //     ->get();
            //print_r($this->db->last_query());exit;
        //$query = $this->db->get('product');
        //return $result = $query->result_array();
        
        if ($query){
            return $result = $query->result_array();
        } else {
            false;
        }
    }

    public function getProductVariation($id = null, $start = null, $end = null)
    {
        $query = $this->db->select('t.*,c.title as pname,i.email as mail,p.image as fimage, t.inventory_status')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->join('product_variation_images as p', 't.id = p.product_id')->where('p.fstatus', 1)->where('c.id', $id)->where('t.status',1)
            ->order_by('t.id', 'desc')->limit($end, $start)->get();
        //print_r($this->db->last_query());exit;
        return $result = $query->result_array();
    }

    public function getProductVariationByKeyword($kw)
    {
        $query = $this->db->select('t.*,c.title as pname,i.email as mail,p.image as fimage,t.inventory_status')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->join('product_variation_images as p', 't.id = p.product_id')->where('p.fstatus', 1)->where('t.status', 1)
            ->order_by('t.id', 'desc')->like('t.attribute_name', $kw)->get();
        return $result = $query->result_array();
    }

    public function getProductAutoComplete($kw)
    {
        // if(strlen($kw)>3){
        //   $query = $this->db->select('t.attribute_name')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->join('product_variation_images as p','t.id = p.product_id')->where('p.fstatus',1)
        //   ->order_by('t.id','desc')->like('t.attribute_name',$kw,'after')->limit(10)->get();
        //    return $result = $query->result_array();
        // }else{
        $query = $this->db->select('id,product_id,attribute_name')->from('product_variation')->where('status',1)
            ->order_by('id', 'desc')->get();
        //  print_r($this->db->last_query());exit;
        return $result = $query->result_array();
        // }
    }

    public function getWishListItem($user_id)
    {
        //$query = $this->db->get_where('wishlist_product', ['userid' => $this->session->userdata('login_id')]);
        $query = $this->db->select('t.*,c.attribute_name as attributename,p.image')
            ->from('wishlist_product as t')
            ->join('product_variation as c', 'c.id = t.product_variation_id')
            ->join('product_variation_images as p', 'p.product_id = c.id')
            ->where(['t.userid' => $user_id, 'p.fstatus' => 1])->get();
        //print_r($this->db->last_query());exit;
        return $query->result_array();

    }

    public function getUserWishListItem($user_id)
    {

        //$query = $this->db->get_where('wishlist_product', ['userid' => $this->session->userdata('login_id')]);
        $query = $this->db->select('t.product_variation_id as id,t.id as wish_list_id,c.attribute_name,p.image as fimage,c.product_id,c.price,c.inventory_status')
            ->from('wishlist_product as t')
            ->join('product_variation as c', 'c.id = t.product_variation_id')
            ->join('product_variation_images as p', 'p.product_id = c.id')
            ->where(['t.userid' => $user_id, 'p.fstatus' => 1])->get();
        //print_r($this->db->last_query());exit;
        return $query->result_array();

    }

    public function getCartItemList($user_id)
    {

        $query = $this->db->select('distinct(t.id) as cart_item_id,t.attribute_id as prod_id,t.total_item as selectedQty, t.variation_detail_id as selectedVariationID,c.attribute_name,p.image as fimage,c.product_id as prod_cat_id,c.price')
            ->from('add_cart_items as t')
            ->join('product_variation as c', 'c.id = t.attribute_id')
            ->join('product_variation_images as p', 'p.product_id = c.id')
            ->where(['t.user_id' => $user_id, 't.pay_id' => '', 't.status' => 0,'p.fstatus' => 1])->get();
        // print_r($this->db->last_query());exit;
        return $query->result_array();

    }

}
