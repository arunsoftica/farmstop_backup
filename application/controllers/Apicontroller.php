<?php

class Apicontroller extends CI_Controller{

public function __construct(){
  parent::__construct();
  
  $this->load->model('Adminmodel');
  $this->load->library('email');
     
  
}

public function page($page = NULL){

//echo $page;exit;
if($page == 'listProduct'){
$response = $this->listProduct();
}else if($page == 'searchProduct'){
$response = $this->searchProduct();    
}else if($page == 'addTocart'){
$response = $this->addTocart();    
}else if($page == 'getCart'){
$response = $this->getCart();    
}else if($page == 'getOrderList'){
$response = $this->getOrderList();    
}else if($page == 'checkout'){
$response = $this->checkout();    
}

}

public function listProduct(){
    
    
}
public function searchProduct(){
    
    
}
public function addTocart(){
    
    
}
public function getCart(){
    
    
}
public function getOrderList(){
    
    
}
public function checkout(){
    
    
}



}