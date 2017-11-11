<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function UpdateProfile(){
        $userId=$_POST['userId'];
   		$this->load->model('Profile_model');
        $result=$this->Profile_model->UpdateProfile();
        $this->load->model('Login_model');
        $data1=$this->Login_model->getProfile($userId);
        //echo  $result; 
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
        if($result){
        				$message=array('status'=>'1','message'=>'Profile successfully updated');
                        $userdata['userData']=$userDetails1;
                 
                 //$userdata['flatDetails']=$userDetails3;
                 $final_data=array_merge($message,$userdata);
	           	  		$this->output->set_content_type('application/json')->set_output(json_encode
	           	  															($final_data));
        }else {
        		$final_data=array('status'=>'0','message'=>'Opps! Nothing changed in profile');
	           	  		$this->output->set_content_type('application/json')->set_output(json_encode
	           	  															($final_data));
        }



	}//AddComments


}