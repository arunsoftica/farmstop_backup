<?php

class Basic_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('email');
        date_default_timezone_set('Asia/Kolkata');
    }
    
    public function update_item_to_cart($cart_Items,$email,$pay_id)
    {

        $cart_ids = explode(",",$cart_Items);
        if(is_array($cart_ids) && count($cart_ids)>0)
        {
            $this->db->set([ 'status' => 1,"email"=>$email,"pay_id"=>$pay_id]);
            $this->db->where_in('id', $cart_ids);
            $this->db->update('add_cart_items');
            //print_r($this->db->last_query());exit;
            return $this->db->affected_rows();
        }
        else
        {
            return false;
        }
    }

    public function getNotification($user_id)
    {
        $query = $this->db->select('*')->from('user_notification')->where('user_id', $user_id)
        ->order_by('date', 'desc')->get();
        //print_r($this->db->last_query());exit;
        if ($query) 
        {
            return $result = $query->result_array();
        }
        else 
        {
            false;
        }
    }

    public function update($table, $data, $condition)
    {
        $this->db->update($table, $data, $condition);
        //print_r($this->db->last_query());exit;
        return $this->db->affected_rows();

    }

    public function updateData($table, $data, $condition)
    {
        $this->db->update($table, $data, $condition);
        // print_r($this->db->last_query());
        return $this->db->affected_rows();

    }

    public function insert($table, $data)
    {

        $this->db->insert($table, $data);
        return $this->db->insert_id();

    }

    public function insertBatch($table, $data)
    {
        $this->db->insert_batch($table, $data);
        return $this->db->insert_id();
    }

    public function delete($table, $condition)
    {

        $this->db->delete($table, $condition);

        return $this->db->affected_rows();

    }
    
    public function verifyUserName($usernm)
    {    
        $query = $this->db->where('mobile',$usernm)->or_where('email',$usernm)->get('register_user');
        return $result = $query->row_array();
    }

    public function getSingleRecord($table, $condition)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $query = $this->db->get();
        $result = $query->row_array();
        // print_r($result);die("basic_model");
        if (is_array($result) && count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function selectSglRecord($table, $condition)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $query = $this->db->get();
        $result = $query->row_array();
        // print_r($result);die("basic_model");
        if (is_array($result) && count($result) > 0) 
        {
            return $result;
        }
        else 
        {
            return false;
        }
    }

    public function getSingleRecordData($table, $condition)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $query = $this->db->get();
        $result = $query->row_array();
        // print_r($result);die("basic_model");
        if (is_array($result) && count($result) > 0) 
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public function selectAll($table, $condition)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $this->db->order_by('id','asc');
        $query = $this->db->get();
        $result = $query->result_array();
        // print_r($result);die("basic_model");
        if (is_array($result) && count($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function selectLike($table, $keyword,$cloumn)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where("$cloumn LIKE '%$keyword%'");
        $this->db->limit(10,0);
        $query = $this->db->get();
        $result = $query->result_array();

        if (is_array($result) && count($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function validateUser($email, $mobile, $password)
    {
        // echo $email."-".$mobile."-".$password;
        $this->db->select('id,name,email,type,mobile');
        $this->db->from('register_user');
        if ($mobile == true) {
            $this->db->where('mobile', $email);
        } else {
            $this->db->where('email', $email);
        }
        $this->db->where('password', $password);

        $query = $this->db->get();
       // print_r($this->db->last_query());exit;

        $result = $query->row_array();
        
        if (is_array($result) && count($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function validateHeader($token)
    {
        // $jwt = $this->input->request_headers();
        $key = "secret";
        // echo json_encode($jwt);
        if( $token =="" )
        {
          $error = array("status"=>0, "message" => "Authentication failed");
          echo json_encode($error);
          exit;
        }
        else
        {
            $token = JWT::decode($token, $key, array('HS256'));
            $type = $token->data->type;
            if($type==1)
            {
                if( $token->data->id > 0 )
                {
                    $result = $this->getSingleRecordData("register_user",array('id'=>$token->data->id));
                    if(!is_array($result) && count($result) ==0){
                        $error = array("status"=>0, "message" => "Authentication failed");
                        echo json_encode($error);
                        exit;
                }
                return $result;
                }
                else
                {
                    $error = array("status"=>0, "message" => "Authentication failed");
                    echo json_encode($error);
                    exit;
                }
            }
            else if($type == 2 || $type ==3)
            {
                $userId = $token->data->social_id;
                if( $userId > 0 )
                {
                    $result = $this->getSingleRecordData("social_user",array('social_id'=>$userId));
                    if(!is_array($result) && count($result) ==0)
                    {
                        $error = array("status"=>0, "message" => "Authentication failed");
                        echo json_encode($error);
                        exit;
                    }

                    return $result;
                }
                else
                {
                    $error = array("status"=>0, "message" => "Authentication failed");
                    echo json_encode($error);
                    exit;
                }
            }
            else
            {
                $error = array("status"=>0, "message" => "Authentication failed");
                echo json_encode($error);
                exit;
            }
        }
    }

    public function sendOtpModel($email, $mob, $votp, $username)
    {
        if ($mob != '') 
        {
            $msgs = "Your otp for verification is $votp";
            $username="STfrmstop";
            $password = "Farm123";
            $type ="TEXT";
            $sender="FRMSTP";
            $mobile=trim($mob);
            $message = urlencode("$msgs");
            $baseurl ="http://cdn.softica.in/sendsms/sendsms.php";
            $url ="$baseurl?username=$username&password=$password&type=$type&sender=$sender&mobile=$mobile&message=$message";
            $return = file($url);
                
            $send = explode('|',$return[0]);
                
            //if($send[0] == "SUBMIT_SUCCESS ") echo $votp; else echo "send message failed";
            // $curl = curl_init();

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => "https://sms.softica.in/api_v2/message/send",
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => "",
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 30,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => "POST",
            //     CURLOPT_POSTFIELDS => "sender_id=FRMSTP&message=$msgs&mobile_no=" . $mobile,
            //     CURLOPT_HTTPHEADER => array(
            //         "authorization: Bearer G8hmyDa5mbaAadViHGJeb5-_dTAawETLw60FXvuGhozl3imZUu4JLQra3pVbYOtz",
            //         "cache-control: no-cache",
            //         "content-type: application/x-www-form-urlencoded",
            //     ),
            // ));

            // $response = curl_exec($curl);
            // $err = curl_error($curl);

            // curl_close($curl);
            if ($send[0] == "SUBMIT_SUCCESS ")
            {
                //echo "cURL Error #:" . $err;
                return true;
            }
            else
            {
                return false;
            }
        }
        //OTP
        if ($email != '') {
            $link = 'https://farmstop.in';//base_url();
            //print_r($link);
            // extract($_POST);
            $this->load->library("phpmailer_library");
            $mail = $this->phpmailer_library->load();
            $mail->isSMTP();
            $mail->Host = 'mail.farmstop.in';
            $mail->Port = 587;
            /*$mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';*/
            $mail->SMTPAuth = false;
            $mail->SMTPSecure = false;

            $mail->Username = 'sales@farmstop.in';
            $mail->Password = 'Farmstop@123';

            $mail->setFrom('sales@farmstop.in', 'FARMSTOP');
            $mail->addAddress(trim($email));
            $mail->addReplyTo('sales@farmstop.in');
            $mail->isHTML(true);

            $mail->Subject = "FARMSTOP Register User Verify Email";
            $mail->Body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Untitled Document</title></head><body><table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border: 1px #dcdbdb solid;;max-width:600px;margin:auto'><tbody><tr><td align='center' valign='top' style='background-color:#54312a;'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;padding-top: 14px;' width='100%'><tbody><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,Verdana,sans-serif;font-size:25px;font-style:normal;font-weight:bold;line-height:100%;text-align:center'><h1 style='text-align:center;margin:0'><span style='color:#ffffff'><span style='font-size:32px'>Farmstop Verify User Mail</span></span></h1></td></tr></tbody></table></td></tr></tbody></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding:0px 18px 9px;text-align:center'></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'  style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='center' border='0' cellpadding='0' cellspacing='0' width='54' style='max-width:54px'><tbody><tr><td valign='top' style='padding-top:0;padding-right:9px;padding-bottom:9px;padding-left:9px;text-align:center'><img align='center' alt='' src='https://www.demo.farmstop.in/assets/img/email-verification.png' width='200' style='max-width:200px;padding-bottom:0;display:inline!important;vertical-align:bottom'></td></tr></tbody></table></td></tr><tr><td valign='top' style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;'><h1><span style='color:#000'><span style='font-size:20px'>Hi  '" . $username . "',</span></span></h1><p><span style='color:#7f7f7f'><span style='font-size:16px'> thanks for register with us.</span></span></p><h1><span style='color:#000'><span style='font-size:20px'>Enter OTP <span style='font-size:30px; letter-spacing:2; margin-left:10px; margin-right:10px;font-family: cursive;
              color:#3dbbf2;'>'" . $votp . "'</span> to continue.</span></span></h1></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top' align='right'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%;    padding: 10px;'><tbody><tr><td style='padding-top: 26px;' valign='top' align='center'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse:separate!important;border-radius:3px;background-color:#5c3a34bd;width: 100%;'><tbody><tr><td align='center' valign='middle' style='font-family:Arial;font-size:16px;padding:15px'><a title='View Tracking Details' href='#' style='font-weight:bold;letter-spacing:normal;line-height:15px;text-align:center;text-decoration:none;color:#ffffff' target='_blank' data-saferedirecturl='#'></a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>";

            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                return false;
            } else {
                return true;
            }
        }
    }

    public function sendPushNotification( $android_server_key, $mobiletokens, $message )
    {
        $token  = explode(",", $mobiletokens);
        $url = 'https://fcm.googleapis.com/fcm/send';
        $validTokens = array();

        foreach ($token as $key => $value) 
        {
                $ch = curl_init();
                $fields = array(
                    'registration_ids' => array($value),
                'data' => $message,
                );
            // print_r($fields);
            // die;
            $headers = array(
                'Authorization:key='.$android_server_key ,
                'Content-Type: application/json'
            );
    
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            return $result;
        }
    }
}
