<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaints extends CI_Controller {

			public function index(){
                               $this->load->view('header');
                               $this->load->view('complaints');
         }

         public function DueNotice(){
                               $this->load->view('header');
                               $this->load->view('duesnotices');
         }

         public function getComplaints(){
                               $this->load->model('Complaints_model');
         					   $data=$this->Complaints_model->getComplaints();
         					   $this->output->set_content_type('application/json')->set_output(json_encode($data));
         }
}//Complaints



	