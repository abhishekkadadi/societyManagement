<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notices extends CI_Controller {

			public function FetchGeneralNotice(){
									$this->load->model('Notices_model');
									$result=$this->Notices_model->fetchGeneralNotice();
	                                $this->output->set_content_type('application/json')->set_output(json_encode($result));
	        }

	        public function InsertGeneralNotice(){
									$this->load->model('Notices_model');
									$result=$this->Notices_model->InsertGeneralNotice();
	                                if($result){
										$data='1';
										echo $data;
									}else{
										$data='0';
										echo $data;
										
									}
	        }

	        public function DeleteGeneralNotice(){
									$this->load->model('Notices_model');
									$result=$this->Notices_model->DeleteGeneralNotice();
	                                if($result){
										$data='1';
										echo $data;
									}else{
										$data='0';
										echo $data;
										
									}
	        }


	        
}//Notices
?>