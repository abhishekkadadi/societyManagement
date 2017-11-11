<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crons extends CI_Controller {


	public function AddMaintainance(){
                             $this->load->model('Crons_model');
                             $result=$this->Crons_model->getSettings();
                             foreach ($result as $key) {
                             	$maintainanceAmount=$key->maintainanceAmount;
                             	//$fineInterest=$key->maintainanceAmount;
                             }
                              $getUsers=$this->Crons_model->getAllUsersInDue();
                              $RunCron=$this->Crons_model->runCronAddMonthlyMaintainance($getUsers,$maintainanceAmount);
                              echo $RunCron;


         }


}