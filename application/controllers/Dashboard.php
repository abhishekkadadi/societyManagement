<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function index(){
		  
		  $this->load->view('header');
		  $this->load->view('dashboard');
         
	}
	
	public function delete_register(){
		  $id=$_GET['id'];
		  $this->load->model('Dashboard_model');
          $data=$this->Dashboard_model->delete_student($id);
	      $this->output->set_content_type('application/json')->set_output(json_encode($data));
		
	}
	
}
	
?>