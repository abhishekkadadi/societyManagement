<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dues extends CI_Controller {


	public function index(){
                               $this->load->view('header');
                               $this->load->view('takedue');
         }

public function Fetch(){
                               		$this->load->model('Dues_model');
									$result=$this->Dues_model->Fetch();
					    			$this->output->set_content_type('application/json')->set_output(json_encode($result));
			}

public function Insertdue(){
						$data = json_decode(file_get_contents("php://input")); 
						$userId=$data->userId; 
						$Amount=$data->Amount;  
				        $this->load->model('Dues_model');
				        $data=$this->Dues_model->GetdueAmount($userId);
				        foreach ($data as $key) {
				        	$dueAmountPrevious=$key->dueAmount;
				        	$advanceAmount=$key->advanceAmount;
				        }

				        $totalSurplusAmount=$advanceAmount+$Amount;
				        if($dueAmountPrevious==$totalSurplusAmount){
				        	$dueAmountNow=0;
				        	$advanceAmountNow=0;
				        }else if($dueAmountPrevious<$totalSurplusAmount){
				        	$dueAmountNow=0;
				        	$advanceAmountNow=$totalSurplusAmount-$dueAmountPrevious;
				        }else if($dueAmountPrevious>$totalSurplusAmount){
				        	$advanceAmountNow=0;
				        	$dueAmountNow=$dueAmountPrevious-$totalSurplusAmount;
				        }
							
						$result=$this->Dues_model->Insertdue($dueAmountNow,$advanceAmountNow);
						echo $result;
			}





}//dues