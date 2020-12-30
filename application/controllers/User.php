<?php
    use Dompdf\Dompdf;
    
    class User extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();

            $this->load->model('Adminmodel');
            $this->load->library('email');
        }

        public function index()
        {
             $this->page('index');
        }

        public function page($page = NULL)
        {
    
            //echo 'hellljj';

           $data['title']    = $page;
           $data['model2']   = $this->Adminmodel;
           $data['products'] = $this->Adminmodel->getProducts();
            
            if($page == 'shop')
            {
       
                //echo 'here';
    
                if(isset($_GET['s']) && $_GET['s'] == 'new-and-popular')
                {
                    $data['variation'] = $this->Adminmodel->getProductVariation(null,20,0);
                }
                else if(isset($_GET['s']) && $_GET['s'] == 'price-low-to-high')
                {
                    $data['variation'] = $this->Adminmodel->getProductVariationByPriceLow(20,0);
                    /*echo '<pre>';
                    print_r($data['variation']);exit;*/
        
                }
                else if(isset($_GET['s']) && $_GET['s'] == 'price-high-to-low')
                {
                    $data['variation'] = $this->Adminmodel->getProductVariationByPriceHigh(20,0);
        
                }
                else if(isset($_GET['s']) && $_GET['s'] == 'customer-review')
                {
                    $data['variation'] = $this->Adminmodel->getProductVariationByCustomerReview(20,0);
        
                }
                else if(isset($_GET['c']))
                {
                    if(!empty($_GET['c']))
                    {
                        // echo 'if';
                        $getdata = $_GET['c'];
                    }
                    else
                    {
                        // echo 'else';
                        $getdata = $this->uri->segment(4);
                    }
                    //echo 'hello';
                    $data['variation'] = $this->Adminmodel->getProductVariationByProductCategory($getdata,20,0);
                }
                else if(isset($_GET['kw']))
                {
                    $data['variation'] = $this->Adminmodel->getProductVariationByKeyword($_GET['kw']);
                }
                else
                {
                    $data['variation'] = $this->Adminmodel->getProductVariation(null,20,0);
                    //echo '<pre>';print_r($data['variation']);exit;
                }
   
            }
            else if($page == 'subscription')
            {
                //echo 'herheh';
            }
            else if($page == 'organic-mangos')
            {
       
                $this->load->helper('url');
                redirect(base_url('page-not-found'));
            }
            // Pdf Invoice 
            else if($page == 'userinvoice')
            {
                if(isset($_GET['uin']))
                {       }
                else
                {
                    if(!isset($_SESSION['login_id']))
                    {
                        $this->load->helper('url');
                        redirect(base_url('page-not-found'));
                    }
                }
    
                if(isset($_GET['i']))
                {
                    $data['invoice_details'] = $this->Adminmodel->getInvoiceDetail($_GET['i']);
                    $data['get_user_details'] = $this->Adminmodel->getUserDetails($data['invoice_details']['user_id'],$data['invoice_details']['user_type']);
                    //print_r($data['invoice_details']['user_type']);exit;
                    $data['get_cart_items'] = $this->Adminmodel->getCartItems($_GET['i']);
                }
                  //$this->load->view('public/dompdf/autoload.inc');
                  //require_once("./view/dompdf/autoload.inc.php");
                  require_once APPPATH.'views/public/dompdf/autoload.inc.php';
       

                $dompdf = new Dompdf();
                
                
                $output = "<div style='background: #ffffff;'>
                <div class='sec-pay' style='background: white;
                width: 100%;max-width: 900px;min-height:100%;border:1px #99999957 solid;margin: 20px auto 20px auto;'>
                  <div id='container' style='margin: 0 auto;padding:10px 10px;'>
                       <div id='memo' style='width: 100%; display:inline-flex'>
                            <div class='company-info' style=' width:30%; margin-bottom:20px;'>
                              <span class='company-name' style='margin-top: 10px; color: #888;'><img src='farmstop.png' style='width: 100px;height:auto;' /></span>
                            </div>
                            <div class='' style=' width:30%; text-align:right;'> </div>
                            <div class='' style=' width:40%; float:right;'>
                             <span class='company-address' style='color: #888;display:inline-block;min-width: 15px;'>1229, 4th Cross, Sector 7, HSR Layout, Bengaluru, India</span><br>
                              <span class='company-email' style='color: #888;display:inline-block;min-width: 15px;'>sales@farmstop.in</span><br>
                              <span class='company-mobile' style='color: #888;display:inline-block;min-width: 15px;'>+91-9176999541</span>
                            </div>
                       </div>
                       <div id='invoice-title-number' style='margin: 10px 0 10px 0;padding:10px;    border-top: 2px dotted #000;'>
                            <span class='invoice_title' style='font-size: 20px;color: #396E00; display: inline-block;min-width: 15px;line-height: 1em;'>Order ID: <span class='invoice-number'>".$data['invoice_details']['oid']."</span></span>
                            <div class='separator'></div>
                            <span>Thank you for buying from farmstop.</span>
                            
                       </div>
                       <div id='items-success' style='margin-top: 20px;margin-bottom: 20px;'>
                            <table border='1' class='table-responsive' cellpadding='0' cellspacing='0' style='width: 100%;'>
                            
                              <tbody>
                              
                              <tr data-iterate='item' style=''>
                                <td style='vertical-align: top;padding: 10px;'><span style='font-size: 15px;'><b>Delivery Address</b><br />
                                                    ".$data['invoice_details']['uaddress']."<br />
                ".$data['invoice_details']['udistrict']." India,".$data['invoice_details']['uzipcode']."</span></td> 
                                 <td style='vertical-align: top;padding: 10px;'><span style='font-size: 15px;'><b>Order Date:</b><br />
                Shipping Service:<br />
                Buyer Name:<br />
                Seller Name:</span></td>
                                                    <td style='vertical-align: top;padding: 10px;'><span style='font-size: 15px;'>".date("l dS F,Y", strtotime($data['invoice_details']['date']))."<br />
                Standard<br />
                ".$data['get_user_details']['name']."<br />
                FARMSTOP</span></td>
                                
                              </tr>
                            </tbody></table>
                       </div>
                          <div class='clearfix'></div>
                       
                            <table border='1' class='table-responsive' cellpadding='0' cellspacing='0' style='width: 100%; margin-top:15px;'>
                            
                              <tbody><tr>
                              <th style='font-weight: bold;padding: 10px;'>S. No.</th>
                                                    <th style='font-weight: bold;padding: 10px;'>Item</th>
                                                    <th style='font-weight: bold;padding: 10px;'>Quantity</th>
                                                    <th style='font-weight: bold;padding: 10px;'>Price</th>
                              </tr>";
                
                           $count = 1;
                          foreach($data['get_cart_items'] as $get_cart_item){
                              if($get_cart_item['saleprice'] == '0.00'){
                                    $saleprice = $get_cart_item['regularprice'];
                                }else{
                                    $saleprice = $get_cart_item['saleprice'];
                                }
                          
                $output .= "<tr data-iterate='item' style=''>
                              <td style='vertical-align: top;
                    padding: 10px;'><p style='margin: 0px 0px 0px 0px;'>".$count."</p></td>
                                                    <td style='
                    padding: 10px; width:200px;vertical-align: top;'><p style='margin: 0px 0px 0px 0px;'>".$get_cart_item['attributename']."(".$get_cart_item['attribute_value'].")</p>
                </td>
                                                    <td style='
                    padding: 10px;vertical-align: top;'><p style='margin: 0px 0px 0px 0px;'>".$get_cart_item['total_item']."</p></td>
                    <td style='
                    padding: 10px;vertical-align: top;'>".$saleprice*$get_cart_item['total_item']."</td>
                          
                              
                              </tr>"; $count = $count + 1;}
                if($data['invoice_details']['status'] == 0) $pst = 'Unpaid'; else $pst = 'Paid';
                $output .= "</tbody></table>
                            <div id='sums' style='text-align: right;margin-top: 10px;page-break-inside: avoid;'>
                            <table class='table-responsive' cellpadding='0' cellspacing='0' style='padding-left: 530px;'>
                              <tbody><tr>
                                <th style='text-transform: uppercase;color: #396E00;min-width: 200px;padding:3px;text-align: right;'>Subtotal:</th>
                                <td style='min-width: 100px;padding:0px;text-align: right;'>  ".$data['invoice_details']['sub_total_cost']."</td>
                              </tr>
                              <tr>
                                <th style='text-transform: uppercase;color: #396E00;min-width: 200px;padding:3px;text-align: right;'>Shipping:</th>
                                <td style='min-width: 100px;padding:0px;text-align: right;'>".$data['invoice_details']['shipping_cost']."</td>
                              </tr>
                              <tr>
                                <th style='text-transform: uppercase;color: #396E00;min-width: 200px;padding:3px;text-align: right;'>Total:</th>
                                <td style='min-width: 100px;padding:0px;text-align: right;'>".$data['invoice_details']['total_cost']."</td>
                              </tr>
                              <tr>
                                <th style='text-transform: uppercase;color: #396E00;min-width: 200px;padding:3px;text-align: right;'>".$pst.":</th>
                                <td style='min-width: 100px;padding:0px;text-align: right;'>".$data['invoice_details']['total_cost']."</td>
                              </tr>
                              
                            </tbody>
                            </table>
                       </div>
                       <table border='0' align='left' cellpadding='4' width='100%'>
                                                        <tbody>
                                                        
                                                        <tr>
                                                            <td><b>Thanks for buying on Farmstop.</b> For further Information please contact us at <a href='https://www.farmstop.in/contact'>FARMSTOP</a>.</td>
                                                        </tr>
                                                        </tbody></table>
                            
                            </div>
                            
                          </div>
                
                    </div>
                </div>
                </div>";
                
                $dompdf->loadHtml($output);
                
                $dompdf->setPaper('A4','portrait');
                
                $dompdf->render();
                
                $dompdf->stream('Order Invoice',array('Attachment' => 0));
                       
                       
            }
            else if($page == 'blog')
            {
               $data['blogs'] = $this->Adminmodel->getBlogs();
            }
            else if($page == 'index')
            {
               //redirect(base_url('comingsoon'));
               $data['fproduct'] = $this->Adminmodel->getFeaturedProduct(1);
               $data['nproduct'] = $this->Adminmodel->getFeaturedProduct(2);
               $data['testimonial'] = $this->Adminmodel->getTestimonial();
               $data['basket'] = $this->Adminmodel->getBasketProduct();
               //echo '<pre>';print_r($data['testimonial']);exit;
               
            }
            else if($page == 'wishlist')
            {
               if(isset($_SESSION['login_id']))
               {
                    $data['wishlist'] = $this->Adminmodel->getWishlistProduct();
                    //echo '<pre>';
                    //print_r($data['wishlist']);exit;
                }
                else
                {
                    /*$this->load->helper('url');
                   redirect(base_url('my-account'));*/
                }
            }
            else if($page == 'my-account')
            {
                if(isset($_GET['msg']))
                {
                    if($_GET['msg'] == 'yes')
                    {
                        $data['msg'] = 'Your account has been successfully verified, now you can login';
                    }
                    else if($_GET['msg'] == 'no')
                    {
                        $data['msg'] = 'Your account is not verified yet, please try again';
                    }else if($_GET['msg'] == 'saved')
                    {
                        $data['msg'] = 'You new password has been saved successfully, now you can login ';
                    }
                }
                if(isset($_SESSION['login_id']))
                {
           
                    $data['details'] = $this->Adminmodel->getUserDetails($this->session->userdata('login_id'),$this->session->userdata('login_type'));
                    $data['uaddress'] = $this->Adminmodel->getUserAddress();
                    //echo '<pre>';
                   //print_r($data['uaddress']);exit;
                }
           }
             else if($page == 'checkout')
            {
               if(isset($_SESSION['login_id']))
               {
                   $data['apartments'] = $this->Adminmodel->getApartments();
                   $data['uaddress'] = $this->Adminmodel->getUserAddress();
                   $data['coupans'] = $this->Adminmodel->getAllCoupans();
                }
                else
                {
                    /*$this->load->helper('url');
           
                    redirect(base_url('my-account'));*/
                }
            }
            else if($page == 'product-category')
            {
                //echo 'hi';
                if(isset($_GET['c']))
                {
                    $data['variation'] = $this->Adminmodel->getProductVariation(base64_decode($_GET['c']));
                }
            }
            else if($page == 'product')
            {
                if(isset($_GET['v']))
                {
                    $data['prodetail'] = $this->Adminmodel->getProductVariations(base64_decode($_GET['v']));
                    $data['minmax'] = $this->Adminmodel->getMinMaxPrice($data['prodetail']['id']);
                    $data['vardetail'] = $this->Adminmodel->getVariationDetail($data['prodetail']['id']);
                } 
            }
            else if($page == 'user_invoice' || $page == 'tracking')
            {
                if(!isset($_SESSION['login_id']))
                {
                    $this->load->helper('url');
                    redirect(base_url('page-not-found'));
                }
                if(isset($_GET['i']))
                {
                    $data['invoice_details'] = $this->Adminmodel->getInvoiceDetail($_GET['i']);
                    $data['get_user_details'] = $this->Adminmodel->getUserDetails($data['invoice_details']['user_id'],$data['invoice_details']['user_type']);
                    //print_r($data['invoice_details']['user_type']);exit;
                    $data['get_cart_items'] = $this->Adminmodel->getCartItems($_GET['i']);
                }
           }
            else if($page == 'fail')
            {
                if(!isset($_SESSION['login_id']))
                {
                    $this->load->helper('url');
                    redirect(base_url('page-not-found'));
                }
            }
            else if($page == 'reset-password')
            {
                if(isset($_GET['em']))
                {
                    $data['email'] = $_GET['em'];
                }
            }
            else if($page == 'thankyou')
            {
                $data['afterpay'] = 0;
                if(!isset($_SESSION['user_payment_id']))
                {
                    $this->load->helper('url');
                    redirect(base_url('order-list'));
                }
                if(isset($_POST["payuMoneyId"]))
                {
                    $data['afterpay'] = 1;
                    if(isset($_SESSION['your_cart_item']))
                    {
                        $data['your_cart_item'] = $this->session->userdata('your_cart_item');
                        $expci = explode(',',$data['your_cart_item']);
                        $vdid = array();
                        
                        foreach($expci as $cartitem)
                        {
                            $vdids = $this->Adminmodel->getVariationDetailsIdByCartItem($cartitem);
                            $vdid[] = $vdids['variation_details_id'];
                        }
                        $cary = array_count_values($vdid);
                        foreach($cary as $key => $value)
                        {
                           //4-2 5-1
                           $entry_by_date = $this->Adminmodel->getTodayEntryProductInventory($key,date("Y-m-d"));
                           if($entry_by_date != FALSE)
                           {
                              $update_today_entry = $this->Adminmodel->updateTodayEntryProductInventory($entry_by_date,$key,$value);
                           }
                           else
                           {
                               /* insert a row into product_inventory table.. get row where status is 1 */
                               $get_old_one = $this->Adminmodel->getOldProductInventory($key);
                               if($get_old_one != FALSE)
                               {
                                   $update_old_one = $this->Adminmodel->updateOldProductInventory($key);
                                   if($update_old_one != FALSE)
                                   {
                                     $ins_new_row = $this->Adminmodel->addProductInventory($get_old_one,$value);  
                                   }
                                   
                               }
                            }
                        }
                       /* add cart item update */
                       $data['paymsg'] = $this->Adminmodel->update_payment_status($data['your_cart_item']);
                       $this->session->unset_userdata('your_cart_item');
                       $data['userpaytb'] = $this->Adminmodel->update_user_payment($this->session->userdata('user_payment_id'),$_POST["payuMoneyId"]);
                    }
                }
                else if(isset($_POST['razorpay_payment_id']))
                {
                   $data['afterpay'] = 1;
                   if(isset($_SESSION['your_cart_item']))
                   {
                        $data['your_cart_item'] = $this->session->userdata('your_cart_item');
                        $expci = explode(',',$data['your_cart_item']);
                        $vdid = array();
                        foreach($expci as $cartitem)
                        {
                            $vdids = $this->Adminmodel->getVariationDetailsIdByCartItem($cartitem);
                            $vdid[] = $vdids['variation_details_id'];
                        }
                        $cary = array_count_values($vdid);
                        foreach($cary as $key => $value)
                        {
                           //4-2 5-1
                           $entry_by_date = $this->Adminmodel->getTodayEntryProductInventory($key,date("Y-m-d"));
                           if($entry_by_date != FALSE)
                            {
                               $update_today_entry = $this->Adminmodel->updateTodayEntryProductInventory($entry_by_date,$key,$value);
                            }
                            else
                            {
                               /* insert a row into product_inventory table.. get row where status is 1 */
                               $get_old_one = $this->Adminmodel->getOldProductInventory($key);
                               if($get_old_one != FALSE)
                                {
                                   $update_old_one = $this->Adminmodel->updateOldProductInventory($key);
                                   if($update_old_one != FALSE)
                                   {
                                     $ins_new_row = $this->Adminmodel->addProductInventory($get_old_one,$value);  
                                   }
                                }
                            }
                        }
                       /* add cart item update */
                       $data['paymsg'] = $this->Adminmodel->update_payment_status($data['your_cart_item']);
                       $this->session->unset_userdata('your_cart_item');
                       $data['userpaytb'] = $this->Adminmodel->update_user_payment($this->session->userdata('user_payment_id'),$_POST['razorpay_payment_id']);
                    }
                }
                else if(isset($_POST['postvar']))
                {
                    $data['afterpay'] = 1;
                    if(isset($_SESSION['your_cart_item']))
                    {
                       $data['your_cart_item'] = $this->session->userdata('your_cart_item');
                       $expci = explode(',',$data['your_cart_item']);
                        $vdid = array();
                       foreach($expci as $cartitem)
                       {
                           $vdids = $this->Adminmodel->getVariationDetailsIdByCartItem($cartitem);
                           $vdid[] = $vdids['variation_details_id'];
                       }
                        $cary = array_count_values($vdid);
                        foreach($cary as $key => $value)
                        {
                           //4-2 5-1
                           $entry_by_date = $this->Adminmodel->getTodayEntryProductInventory($key,date("Y-m-d"));
                           if($entry_by_date != FALSE)
                           {
                               $update_today_entry = $this->Adminmodel->updateTodayEntryProductInventory($entry_by_date,$key,$value);
                           }
                           else
                           {
                               /* insert a row into product_inventory table.. get row where status is 1 */
                               $get_old_one = $this->Adminmodel->getOldProductInventory($key);
                               if($get_old_one != FALSE)
                               {
                                   $update_old_one = $this->Adminmodel->updateOldProductInventory($key);
                                   if($update_old_one != FALSE)
                                   {
                                     $ins_new_row = $this->Adminmodel->addProductInventory($get_old_one,$value);  
                                   }
                               }
                           }
                        }
                       /* add cart item update */
                       /*$data['paymsg'] = $this->Adminmodel->update_payment_status($data['your_cart_item']);*/
                       $this->session->unset_userdata('your_cart_item');
                       $data['userpaytb'] = $this->Adminmodel->update_user_payment($this->session->userdata('user_payment_id'),'COD');
                    }
                }
                if(isset($_SESSION['user_payment_id']))
                {
       $data['invoice_details'] = $this->Adminmodel->getInvoiceDetail($this->session->userdata('user_payment_id'));
       $data['get_user_details'] = $this->Adminmodel->getUserDetails($data['invoice_details']['user_id'],$data['invoice_details']['user_type']);
       //print_r($data['invoice_details']['user_type']);exit;
       $data['get_cart_items'] = $this->Adminmodel->getCartItems($this->session->userdata('user_payment_id'));
       /*pdf code*/
       require_once APPPATH.'views/public/dompdf/autoload.inc.php';
        
        
        /**   **/
        $this->load->library("phpmailer_library");
              $mail = $this->phpmailer_library->load();
              $mail->isSMTP();
              $mail->Host = 'mail.farmstop.in';
              $mail->Port = 587; 
              $mail->SMTPAuth = false;
              $mail->SMTPSecure = false;

              $mail->Username = 'sales@farmstop.in';
              $mail->Password = 'Farmstop@123';

              $mail->setFrom('sales@farmstop.in', 'FARMSTOP');
              $mail->addAddress(trim($this->session->userdata('login_email')));
              $message ="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Untitled Document</title></head>";

if($data["invoice_details"]['payment_option'] == '1' || $data["invoice_details"]['payment_option'] == '4'){
                 $pay_method = 'Credit Card/Debit Card/NetBanking';
            }else if($data["invoice_details"]['payment_option'] == '2'){
                 $pay_method = 'Cash on delivery';
            }

$message .="<body><table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border: 1px #dcdbdb solid;;max-width:600px;margin:auto'><tbody><tr><td align='center' valign='top' style=''><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;padding-top: 14px;' width='100%'><tbody><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:Cardo;font-size:18px;font-style:normal;line-height:30px;text-align:center'><h2 style='text-align:center;margin:0'><span style='color:#000;'><span style=''>Thank you ".$data["get_user_details"]["name"]."<br>Your order has been received<br>Order Number# ".$data["invoice_details"]["oid"]."
</span></span></h2></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'  style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;font-family:Cardo;' width='100%'><tbody><tr><td align='left' style='background: #c1c1c16e; padding-left: 10px; padding-top: 10px'><p><span>".$data["get_user_details"]["name"]."</span><br><span>".$data["get_user_details"]["email"]."</span><br><span>".$data["invoice_details"]["uaddress"]."</span><br><span>".$data["invoice_details"]["udistrict"]."</span><br><span>India-".$data["invoice_details"]["uzipcode"]."</span></p></td><td align='right' style='padding-right: 10px; padding-top: 10px;background: #c1c1c16e;padding:5px;'><p>&#8377; <span style='font-size:22px;font-weight:700;'>".$data["invoice_details"]["total_cost"]."</span></p><p>".$pay_method."</p></td></tr></tbody></table></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100% font-family:Cardo;' width='100%'><tbody>";
    foreach($data['get_cart_items'] as $get_cart_itemz){ 
           if($get_cart_itemz['saleprice'] == '0.00'){
                $saleprice = $get_cart_itemz['regularprice'];
            }else{
                $saleprice = $get_cart_itemz['saleprice'];
            }
    $message .="<tr><td align='left' style='padding-left: 10px; padding-top: 10px'><img width='70' src='https://www.farmstop.in/admin/uploads/product_variation_images/".$get_cart_itemz["pfimage"]."' class='img-fluid' alt=''></td><td><p>".$get_cart_itemz["attributename"]."</p>".$get_cart_itemz["attribute_value"]."&nbsp;<strong>X ".$get_cart_itemz["total_item"]."</strong></td><td align='right' style='padding-right: 10px;'><span><span>&#8377; </span>".$saleprice*$get_cart_itemz["total_item"]."</span></td></tr>";
    }
                                                
    $message .="<tr><td align='right' colspan='2' style='padding-left: 10px; padding-top: 10px'>Subtotal</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["sub_total_cost"]."</span></td></tr>";
    "<tr><td align='right' colspan='2' style='padding-left: 10px; padding-top: 10px;font-family:Cardo;'>Sipping</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["shipping_cost"]."</span></td></tr>";
    
    if($data["invoice_details"]["coupon_id"] != ""){ 
        
					$disval = $this->Adminmodel->getCouponDiscount($data["invoice_details"]["coupon_id"]);
					if($disval['code_type'] == 'p'){
					   $dval =  $disval['code_value'].'%';
					}else if($disval['code_type'] == 'a'){
					   $dval = '&#8377; '.$disval['code_value']; 
					}
					
			$message .="<tr><td align='right' colspan='2' style='font-family:Cardo;padding-left: 10px; padding-top: 10px'>Discount</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>".$dval."</span></td></tr>";		
					
         } 

    $message .="<tr><td align='right' colspan='2' style='font-family:Cardo;padding-left: 10px; padding-top: 10px'>Order total</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["total_cost"]."</span></td></tr>";

    $message .="</tbody></table></td></tr><tr><td valign='top' style='padding:10px;text-align:center'><img src='https://www.farmstop.in/assets/images/farmstop.png' width='100'><p style='font-family:Cardo;'> #350, 10 Th main, ITI Layout,<br> Sector 7, HSR layout,<br> Bengaluru, Karnataka, 560078</p></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding:10px;text-align:left; width: 50%;'><a href='#'><img src='https://www.farmstop.in/assets/images/iphone.png' width='100'></a><a href='#'><img src='https://www.farmstop.in/assets/img/farmstop-app.png' width='100'></a></td><td valign='top' style='padding:10px;text-align:right; width: 50%;'><a target='_blank' href='https://www.facebook.com/farmstop.in'><img src='https://www.farmstop.in/assets/images/fb.png' alt='facebook' class='img-fluid' width='30'></a><a target='_blank' href='https://twitter.com/farmstopindia'><img src='https://www.farmstop.in/assets/images/tw.png' alt='Twitter' class='img-fluid' width='30'></a><a target='_blank' href='https://www.instagram.com/farmstop.in/'><img src='https://www.farmstop.in/assets/images/ista.png' alt='Instagram' class='img-fluid' width='30'></a><a target='_blank' href='https://www.linkedin.com/company/farmstop-in'><img src='https://www.farmstop.in/assets/images/linkedin.png' alt='linkedin' class='img-fluid' width='30'></a><a target='_blank' href='https://www.youtube.com/channel/UCD1Eu_hIA1tZVK88zsPwOCQ?view_as=subscriber'><img src='https://www.farmstop.in/assets/images/yt.png' alt='youtube' class='img-fluid' width='30'></a></td></tr></tbody></table></td></tr><tr><td style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;font-family:Cardo;'><p>Copyright 2020 farmstop foods private limited</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>";
              /*$dompdf = new Dompdf();
           $dompdf->loadHtml($message);

        $dompdf->setPaper('A4','portrait');
        
        $dompdf->render();
        
        $fileatt = $dompdf->output();
        
        $filename = 'Invoice.pdf';
        $encoding = 'base64';
        $type = 'application/pdf';
              $mail->AddStringAttachment($fileatt,$filename,$encoding,$type);*/
              //$mail->addAddress(trim('info@softica.in'));
              $mail->addReplyTo('sales@farmstop.in');
              $mail->isHTML(true);

              $mail->Subject = "FARMSTOP NEW ORDER MAIL";
              
              $mail->Body = $message;
              if(!$mail->send()) {
                  echo 'Message could not be sent.';
                  echo 'Mailer Error: ' . $mail->ErrorInfo;
              } else {
                //echo $ads;
              }
       /*pdf code*/
       /* ADD PRODUCT EMAIL only one time */
       /*$to   = $this->session->userdata('login_email');
        $subject = "FARMSTOP New Order Email";
        $from = 'sales@farmstop.in';

$message ="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Untitled Document</title></head>";

if($data["invoice_details"]['payment_option'] == '1' || $data["invoice_details"]['payment_option'] == '4'){
                 $pay_method = 'Credit Card/Debit Card/NetBanking';
            }else if($data["invoice_details"]['payment_option'] == '2'){
                 $pay_method = 'Cash on delivery';
            }

$message .="<body><table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border: 1px #dcdbdb solid;;max-width:600px;margin:auto'><tbody><tr><td align='center' valign='top' style=''><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;padding-top: 14px;' width='100%'><tbody><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:Cardo;font-size:18px;font-style:normal;line-height:30px;text-align:center'><h2 style='text-align:center;margin:0'><span style='color:#000;'><span style=''>Thank you ".$data["get_user_details"]["name"]."<br>Your order has been received<br>Order Number# ".$data["invoice_details"]["oid"]."
</span></span></h2></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'  style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;font-family:Cardo;' width='100%'><tbody><tr><td align='left' style='background: #c1c1c16e; padding-left: 10px; padding-top: 10px'><p><span>".$data["get_user_details"]["name"]."</span><br><span>".$data["get_user_details"]["email"]."</span><br><span>".$data["invoice_details"]["uaddress"]."</span><br><span>".$data["invoice_details"]["udistrict"]."</span><br><span>India-".$data["invoice_details"]["uzipcode"]."</span></p></td><td align='right' style='padding-right: 10px; padding-top: 10px;background: #c1c1c16e;padding:5px;'><p>Rs: <span style='font-size:22px;font-weight:700;'>".$data["invoice_details"]["total_cost"]."</span></p><p>".$pay_method."</p></td></tr></tbody></table></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100% font-family:Cardo;' width='100%'><tbody>";
    foreach($data['get_cart_items'] as $get_cart_itemz){ 
           if($get_cart_itemz['saleprice'] == '0.00'){
                $saleprice = $get_cart_itemz['regularprice'];
            }else{
                $saleprice = $get_cart_itemz['saleprice'];
            }
    $message .="<tr><td align='left' style='padding-left: 10px; padding-top: 10px'><img width='70' src='https://www.farmstop.in/teao/uploads/product_variation_images/".$get_cart_itemz["pfimage"]."' class='img-fluid' alt=''></td><td><p>".$get_cart_itemz["attributename"]."</p>".$get_cart_itemz["attribute_value"]."&nbsp;<strong>× ".$get_cart_itemz["total_item"]."</strong></td><td align='right' style='padding-right: 10px;'><span><span>₹ </span>".$saleprice*$get_cart_itemz["total_item"]."</span></td></tr>";
    }
                                                
    $message .="<tr><td align='right' colspan='2' style='padding-left: 10px; padding-top: 10px'>Subtotal</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>₹ ".$data["invoice_details"]["sub_total_cost"]."</span></td></tr>";
    "<tr><td align='right' colspan='2' style='padding-left: 10px; padding-top: 10px;font-family:Cardo;'>Sipping</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>₹ ".$data["invoice_details"]["shipping_cost"]."</span></td></tr>";

    $message .="<tr><td align='right' colspan='2' style='font-family:Cardo;padding-left: 10px; padding-top: 10px'>Order total</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>₹ ".$data["invoice_details"]["total_cost"]."</span></td></tr>";

    $message .="</tbody></table></td></tr><tr><td valign='top' style='padding:10px;text-align:center'><img src='https://www.farmstop.in/assets/images/farmstop.png' width='100'><p style='font-family:Cardo;'> #350, 10 Th main, ITI Layout,<br> Sector 7, HSR layout,<br> Bengaluru, Karnataka, 560078</p></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding:10px;text-align:left; width: 50%;'><a href='#'><img src='https://www.farmstop.in/assets/images/iphone.png' width='100'></a><a href='#'><img src='https://www.farmstop.in/assets/img/farmstop-app.png' width='100'></a></td><td valign='top' style='padding:10px;text-align:right; width: 50%;'><a target='_blank' href='https://www.facebook.com/farmstop.in'><img src='https://www.farmstop.in/assets/images/fb.png' alt='facebook' class='img-fluid' width='30'></a><a target='_blank' href='https://twitter.com/farmstopindia'><img src='https://www.farmstop.in/assets/images/tw.png' alt='Twitter' class='img-fluid' width='30'></a><a target='_blank' href='https://www.instagram.com/farmstop.in/'><img src='https://www.farmstop.in/assets/images/ista.png' alt='Instagram' class='img-fluid' width='30'></a><a target='_blank' href='https://www.linkedin.com/company/farmstop-in'><img src='https://www.farmstop.in/assets/images/linkedin.png' alt='linkedin' class='img-fluid' width='30'></a><a target='_blank' href='https://www.youtube.com/channel/UCD1Eu_hIA1tZVK88zsPwOCQ?view_as=subscriber'><img src='https://www.farmstop.in/assets/images/yt.png' alt='youtube' class='img-fluid' width='30'></a></td></tr></tbody></table></td></tr><tr><td style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;font-family:Cardo;'><p>Copyright 2020 farmstop foods private limited</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>";

    $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
       $headers .= "From: " . strip_tags($from) . "\r\n";
       $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
       mail($to, $subject, $message, $headers);*/
       /*$to   = $this->session->userdata('login_email');
        $subject = "FARMSTOP New Order Email";
        $from = 'sales@farmstop.in';
        
        $message = '<html><body style="padding-top:50px;background: #eee;><div style="display:flex;"><div style="width: 25%"></div><div style="max-width: 100%;background: #ffff;padding: 10px;width: 500px;border: 1px #808080 solid;">';
        $message .= '<table style="width:100%;" cellspacing="0"><tbody>';
        $message .= '<tr><td colspan="3" style="text-align:center;"><img style="padding: 6px;width: 90px;" src="'.base_url().'assets/images/farmstop.png"></td></tr><tr><td colspan="3" style="background-color: green;color: white;height:62px;font-size:30px;text-align:center">Thanks for your order</td></tr><tr><td colspan="3" style="font-size:18px;padding:20px;"><p>Hi '.$data["get_user_details"]["name"].',</p><p>Your order has been received and is now being processed.Your order details are shown below for your reference:</p><b>Order #'. $data["invoice_details"]["oid"] .' ('.date("l dS F,Y", strtotime($data["invoice_details"]["date"])).')</b></td></tr><tr><td style="border:1px solid grey;font-size: 18px;padding:10px;"><b>Product</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Quantity</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Price</b></td></tr>';
       foreach($data['get_cart_items'] as $get_cart_itemz){ 
           if($get_cart_itemz['saleprice'] == '0.00'){
                $saleprice = $get_cart_itemz['regularprice'];
            }else{
                $saleprice = $get_cart_itemz['saleprice'];
            }
       $message .= '<tr><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$get_cart_itemz["attributename"].'('.$get_cart_itemz["attribute_value"].')'.'</td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$get_cart_itemz["total_item"].'</td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$saleprice*$get_cart_itemz["total_item"].'</td></tr>';
       }
            if($data["invoice_details"]['payment_option'] == '1' || $data["invoice_details"]['payment_option'] == '4'){
                 $pay_method = 'Credit Card/Debit Card/NetBanking';
            }else if($data["invoice_details"]['payment_option'] == '2'){
                 $pay_method = 'Cash on delivery';
            }
       $message .= '<tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Subtotal:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["sub_total_cost"].'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Shipping:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["shipping_cost"].'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Payment Method:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$pay_method.'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Total:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["total_cost"].'</td></tr>';
      $message .= '<tr><td ><b>Billing Address:</b></td><td ><b>Shipping Address:</b></td></tr><tr><td ><p style="border:1px solid grey;font-size:18px;padding:5px;">'.$data["get_user_details"]["name"].'<br>'.$data["invoice_details"]["uaddress"].'<br>'.$data["invoice_details"]["udistrict"].','.$data["invoice_details"]["uzipcode"].'<br>India<br>'.$data["get_user_details"]["mobile"].'<br>'.$data["get_user_details"]["email"].'</p></td><td colspan="2"><p style="border:1px solid grey;font-size:18px;padding:5px;">'.$data["get_user_details"]["name"].'<br>'.$data["invoice_details"]["uaddress"].'<br>'.$data["invoice_details"]["udistrict"].','.$data["invoice_details"]["uzipcode"].'<br>India<br>'.$data["get_user_details"]["mobile"].'<br>'.$data["get_user_details"]["email"].'</p></td></tr>';
        $message .= '</tbody></table></div><div style="width: 25%"></div></div>';
        $message .= "</body></html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
       $headers .= "From: " . strip_tags($from) . "\r\n";
       $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
       mail($to, $subject, $message, $headers);*/
       
       /*-----*/
       $to   = 'sales@farmstop.in';
        $subject = "FARMSTOP New Order Email";
        $from = 'sales@farmstop.in';
        
        $message = '<html><body style="padding-top:50px;background: #eee;><div style="display:flex;"><div style="width: 25%"></div><div style="max-width: 100%;background: #ffff;padding: 10px;width: 500px;border: 1px #808080 solid;">';
        $message .= '<table style="width:100%;" cellspacing="0"><tbody>';
        $message .= '<tr><td colspan="3" style="text-align:center;"><img style="padding: 6px;width: 90px;" src="'.base_url().'assets/images/farmstop.png"></td></tr><tr><td colspan="3" style="background-color: green;color: white;height:62px;font-size:30px;text-align:center">Thanks for your order</td></tr><tr><td colspan="3" style="font-size:18px;padding:20px;"><p>Hi FARMSTOP,</p><p>You have received a order.Order details are shown below for your reference:</p><b>Order #'. $data["invoice_details"]["oid"] .' ('.date("l dS F,Y", strtotime($data["invoice_details"]["date"])).')</b></td></tr><tr><td style="border:1px solid grey;font-size: 18px;padding:10px;"><b>Product</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Quantity</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Price</b></td></tr>';
       foreach($data['get_cart_items'] as $get_cart_itemz){ 
           if($get_cart_itemz['saleprice'] == '0.00'){
                $saleprice = $get_cart_itemz['regularprice'];
            }else{
                $saleprice = $get_cart_itemz['saleprice'];
            }
       $message .= '<tr><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$get_cart_itemz["attributename"].'('.$get_cart_itemz["attribute_value"].')'.'</td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$get_cart_itemz["total_item"].'</td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$saleprice*$get_cart_itemz["total_item"].'</td></tr>';
       }
            if($data["invoice_details"]['payment_option'] == '1' || $data["invoice_details"]['payment_option'] == '4'){
                 $pay_method = 'Credit Card/Debit Card/NetBanking';
            }else if($data["invoice_details"]['payment_option'] == '2'){
                 $pay_method = 'Cash on delivery';
            }
       $message .= '<tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Subtotal:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["sub_total_cost"].'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Shipping:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["shipping_cost"].'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Payment Method:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$pay_method.'</td></tr>';
       
       if($data["invoice_details"]["coupon_id"] != ""){ 
        
					$disval = $this->Adminmodel->getCouponDiscount($data["invoice_details"]["coupon_id"]);
					if($disval['code_type'] == 'p'){
					   $dval =  $disval['code_value'].'%';
					}else if($disval['code_type'] == 'a'){
					   $dval = '&#8377; '.$disval['code_value']; 
					}
					
			$message .= '<tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Discount:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$dval.'</td></tr>';		
					
         } 
       
       $message .= '<tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Total:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["total_cost"].'</td></tr>';
      $message .= '<tr><td ><b>Billing Address:</b></td><td ><b>Shipping Address:</b></td></tr><tr><td ><p style="border:1px solid grey;font-size:18px;padding:5px;">'.$data["get_user_details"]["name"].'<br>'.$data["invoice_details"]["uaddress"].'<br>'.$data["invoice_details"]["udistrict"].','.$data["invoice_details"]["uzipcode"].'<br>India<br>'.$data["get_user_details"]["mobile"].'<br>'.$data["get_user_details"]["email"].'</p></td><td colspan="2"><p style="border:1px solid grey;font-size:18px;padding:5px;">'.$data["get_user_details"]["name"].'<br>'.$data["invoice_details"]["uaddress"].'<br>'.$data["invoice_details"]["udistrict"].','.$data["invoice_details"]["uzipcode"].'<br>India<br>'.$data["get_user_details"]["mobile"].'<br>'.$data["get_user_details"]["email"].'</p></td></tr>';
        $message .= '</tbody></table></div><div style="width: 25%"></div></div>';
        $message .= "</body></html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
       $headers .= "From: " . strip_tags($from) . "\r\n";
       $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
       mail($to, $subject, $message, $headers);
       
       /* ADD PRODUCT EMAIL */
       /*sms code*/
       $uoid = $data["invoice_details"]["oid"];
                  $uomob = $data["get_user_details"]["mobile"];
                  //$msg = "Your Farmstop order #$uoid has been placed successfully.Thank you.Visit https://www.farmstop.in";
                  $udd = $_SESSION['user_delivery_day'];
                  $msg = "Your Farmstop Order #$uoid is confirmed! You will receive your order on $udd";
                  
                $username="STfrmstop";
                $password = "Farm123";
                $type ="TEXT";
                $sender="FRMSTP";
                $mobile=$uomob;
                $message = urlencode("$msg");
                $baseurl ="http://cdn.softica.in/sendsms/sendsms.php";
                $url ="$baseurl?username=$username&password=$password&type=$type&sender=$sender&mobile=$mobile&message=$message";
                $return = file($url);
                
                $send = explode('|',$return[0]);
                /*sms code*/
       $this->session->unset_userdata('user_delivery_day');
       $this->session->unset_userdata('user_payment_id');
       }
       
   }else if($page == 'order-list'){
       
   }
   $data['orders'] = $this->Adminmodel->getAllOrderByUser();
   $this->load->view("public/header" , $data);
   $this->load->view("public/$page" , $data);
   //if($page != 'razor'){
       $this->load->view("public/footer" , $data);
   //}
    
    
  
}

public function logout()
{
        $this->session->unset_userdata('login_id');
        $this->session->unset_userdata('login_name');
        $this->session->unset_userdata('login_email');
        $this->session->unset_userdata('login_type');
        $this->session->sess_destroy();
        //unset($_COOKIE['asdfghjkl']);
        //setcookie('asdfghjkl', '', time()-3600, '/');
        return redirect('/');

}

public function page2($page2 = null){


   $data['model2'] = $this->Adminmodel;
   $data['products'] = $this->Adminmodel->getProducts();
   if($page2 == 'product-category'){
     //echo $this->uri->segment(2);exit;
     //$data['variation'] = $this->Adminmodel->getProductVariation(base64_decode($this->uri->segment(2)));
     $data['variation'] = $this->Adminmodel->getProductVariation($this->uri->segment(2));
     //echo '<pre>';
     //print_r($data['variation']);exit;
   }else if($page2 == 'blog'){
       
       $data['blogs'] = $this->Adminmodel->getBlogs($this->uri->segment(2));
       //print_r($data['blogs']);exit;
   }else if($page2 == 'organic-mangos'){
       
       
   }
   
   else if($page2 == 'product'){
    if(isset($_COOKIE['asdfghjkl'])){
      $data['cookie'] = get_cookie('asdfghjkl');
    }
     $data['prodetail'] = $this->Adminmodel->getProductVariations($this->uri->segment(2));
     $data['related_product'] = $this->Adminmodel->getRelatedProduct($data['prodetail']['product_id'],$data['prodetail']['id']);
     /*echo '<pre>';
     print_r($data['related_product']);exit;*/
     
     $data['images'] = $this->Adminmodel->getProductImages($data['prodetail']['id']);
     //echo '<pre>';
     //print_r($data['images']);exit;
     
     $data['minmax'] = $this->Adminmodel->getMinMaxPrice($data['prodetail']['id']);
     
     $data['vardetail'] = $this->Adminmodel->getVariationDetail($data['prodetail']['id']);
     
     $data['review'] = $this->Adminmodel->getApprovedUserReviews($data['prodetail']['id']);
     //echo '<pre>';
     //print_r($data['review']);exit;
   }
   $this->load->view("public/header" , $data);
   if($page2 != 'blog'){
       
        $getdata = $this->uri->segment(2);
        $data['variation'] = $this->Adminmodel->getProductVariationByProductCategory($getdata,20,0);
       
       $this->load->view("public/$page2" , $data);
   }else{
       $this->load->view("public/single-blog" , $data);
   }
   
   $this->load->view("public/footer" , $data);
} 

public function page3($page2 = null){


   $data['model2'] = $this->Adminmodel;
   $data['products'] = $this->Adminmodel->getProducts();
   if($page2 == 'product'){
    if(isset($_COOKIE['asdfghjkl'])){
      $data['cookie'] = get_cookie('asdfghjkl');
    }
     $data['prodetail'] = $this->Adminmodel->getProductVariations($this->uri->segment(3));
     $data['related_product'] = $this->Adminmodel->getRelatedProduct($data['prodetail']['product_id'],$data['prodetail']['id']);
     /*echo '<pre>';
     print_r($data['related_product']);exit;*/
     
     $data['images'] = $this->Adminmodel->getProductImages($data['prodetail']['id']);
     //echo '<pre>';
     //print_r($data['images']);exit;
     
     $data['minmax'] = $this->Adminmodel->getMinMaxPrice($data['prodetail']['id']);
     
     $data['vardetail'] = $this->Adminmodel->getVariationDetail($data['prodetail']['id']);
     
     $data['review'] = $this->Adminmodel->getApprovedUserReviews($data['prodetail']['id']);
     //echo '<pre>';
     //print_r($data['review']);exit;
   }
   $this->load->view("public/header" , $data);
   if($page2 != 'blog'){
       $this->load->view("public/$page2" , $data);
   }else{
       $this->load->view("public/single-blog" , $data);
   }
   
   $this->load->view("public/footer" , $data);
} 


}