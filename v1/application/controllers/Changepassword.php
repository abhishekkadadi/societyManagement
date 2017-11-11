<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changepassword extends CI_Controller {
	public function ChangeUserPassword(){
									  $this->load->model('Changepassword_model');
         							  $data=$this->Changepassword_model->CheckandChnagePassword();
         							  if($data){
         							  			$final_data=array('status'=>'1','message'=>'Password changed successfully');
	           	  								$this->output->set_content_type('application/json')->set_output(json_encode
	           	  															($final_data));
         							  }else{
	         							  	$final_data=array('status'=>'0','message'=>'Wrong old password');
	           	  							$this->output->set_content_type('application/json')->set_output(json_encode
	           	  															($final_data));
         							  }
									}
}//Changepassword