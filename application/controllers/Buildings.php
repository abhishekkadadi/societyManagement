<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buildings extends CI_Controller {

			public function index(){
	                               $this->load->view('header');
	                               $this->load->view('createbuilding');
	        }

         	public function Fetch(){
                               		$this->load->model('Buildings_model');
									$result=$this->Buildings_model->Fetch();
					    			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			}

			public function verifyDuplicate(){
									$buildingName=$_GET['buildingName'];
									$this->load->model('Buildings_model');
        							$result=$this->Buildings_model->checkduplicate($buildingName);
					    			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			}

			public function Insert(){
				                     //$data = json_decode(file_get_contents("php://input"));

                               		$this->load->model('Buildings_model');
									$result=$this->Buildings_model->Insert();
									if($result){
										$data='1';
										echo $data;
									}else{
										$data='0';
										echo $data;
										
									}

			}
}//Buildings



	