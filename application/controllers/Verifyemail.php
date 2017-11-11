<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifyemail extends CI_Controller {
    public function Verify(){
    	$last = $this->uri->total_segments();
		$record_num = $this->uri->segment($last);
		$userid=base64_decode(urldecode($record_num));
		$this->load->model('Verifymail_model');
		$result1=$this->Verifymail_model->updatEmailBit($userid);
		if($result1){
			      $password = mt_rand(10000000, 99999999);
			      $result2=$this->Verifymail_model->createLogin($userid,$password);
			      if($result2){
			      			$userEmaildata=$this->Verifymail_model->fetchEmail($userid);
			      			foreach ($userEmaildata as $key) {
			      				$email=$key->email; 
			      				$name=$key->name; 
			      			}
			      			//print_r($email);
                            			$result['userEmailId']=$email;     
    									$result['password']= $password;
										//$result['email']=$email;
										$result['name']=$name;
									    $html=$this->load->view('sendPasswordemail', $result, true);
    									$this->load->library('email');
    									$this->email->initialize(array(
											            'protocol' => 'smtp',
											            'smtp_host' => 'smtp.sendgrid.net',
											            'smtp_user' => 'Shridhar@Shridhar',
											            'smtp_pass' => 'shridhar123@',
											            'smtp_port' => 587,
											            'crlf' => "\r\n",
											            'newline' => "\r\n"
											        ));
       									$this->email->set_mailtype("html");
										$this->email->from('abhishek@whitecode.co.in', 'ParkInfinia');
										$this->email->to($email);
										$this->email->subject('ParkInfinia Email Validation');
										$this->email->message($html);
										if($this->email->send()){
											$this->load->view('thankyou');
											//echo $this->email->print_debugger();
										}else{
											echo '-5';//mail sending failed please contact software providers
										}

			      }
		}else{
			$this->load->view('thankyou');
		}
    }
}

