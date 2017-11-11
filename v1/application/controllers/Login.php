<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  public function LoginCheck(){
      $this->load->model('Login_model');
          $data=$this->Login_model->check();
          if($data){
                   foreach ($data->result() as $row) {
                           $userId=$row->userId;
                   }
                  $data1=$this->Login_model->getProfile($userId);
                  $data2=$this->Login_model->getAccommodationDetail($userId);
       
                  foreach ($data1->result() as $row) {
                      $userDetails=array(
                                'userId'=>$row->userId,
                                'name'=>$row->name,
                                'email'=>$row->email,
                                'mobileNo'=>$row->mobileNo,
                                'userType'=>$row->userType,
                                'userPicture'=>$row->userPicture
                                );
                                $userDetails1[]=$userDetails; 
                 }//foreach

                /*foreach ($data2->result() as $row1) {
                      $userDetails2=array(
                                'flatNo'=>$row1->flatNo,
                                'building'=>$row1->building,  
                                );
                                $userDetails3[]=$userDetails2;  
                 }//foreach*/
                 
                 $message=array('status'=>'1','message'=>'Successfully logged in');
                 $userdata['userData']=$userDetails1;
                 
                 //$userdata['flatDetails']=$userDetails3;
                 $final_data=array_merge($message,$userdata);
                 $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
          }else{
               $final_data=array('status'=>'0','message'=>'Please check your credentials or Contact your society manager');
               $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
               }
         }
}//Login

?>