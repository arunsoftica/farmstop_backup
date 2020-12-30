<?php

require_once APPPATH . 'libraries/REST_Controller.php';
/*use Rest_server\libraries\CI_Controller;*/
use CI_Controller;
     
class RestApiController extends REST_Controller {
    
	  
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
	
    public function __construct() {
       parent::__construct();
       $this->load->database();
      $apiModel = $this->load->model('ApiModel');
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	/*public function index_get($id = 0)
	{

		//$data = $this->db->get("product")->result();
		
		//$data['id'] = 30;
		//$data['slug'] = 'CEREALS-N-GRAINS';
		//$data['min_price'] = 40.00;
        //$data['max_price'] = 90.00;
        $data['order_name_asc'] = 'asc';
        //$data['order_name_desc'] = 'desc';
		$data=$this->ApiModel->getProducts($data);
		/*echo '<pre>';
        print_r($data);exit;
     
        $this->response($data, REST_Controller::HTTP_OK);
	}*/
	
	public function add_to_cart(){
	    $data['user_email'] = 'creativearun24@gmail.com';
	    $data['product_id'] = 53;
	    $data['variation_id'] = 78;
	    $data['total_item'] = 1;

        print_r($data); die;
	    $data=$this->ApiModel->addToCart($data);
	    $this->response($data, REST_Controller::HTTP_OK);
	}
	public function get_cart(){
	    $data['user_email'] = 'creativearun24@gmail.com';
	    $data=$this->ApiModel->getCart($data);
	    $this->response($data, REST_Controller::HTTP_OK);
	}
      
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('items',$input);
     
        $this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
    } 
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('items', $input, array('id'=>$id));
     
        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        $this->db->delete('items', array('id'=>$id));
       
        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
    }
    	
}