<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
	
	public function FetchPaymentStatement(){
		$this->load->model('Payment_model');
		$result=$this->Payment_model->FetchPaymentStatement();
		$due=$this->Payment_model->getDueAmount();
		$final_data=array('status'=>'1','message'=>'Payment history successfully fetched');
		$final_data['dueAmount']=$due;
		$final_data['paymentHistory']=$result;
        $this->output->set_content_type('application/json')->set_output(json_encode($final_data));

	}
}