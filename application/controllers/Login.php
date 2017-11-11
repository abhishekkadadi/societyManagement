<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  public function index()
  {
    $this->load->view('login');
  }

	public function LoginCheck(){
                         		  $this->load->model('Login_model');
                              $data=$this->Login_model->check();
                              if($data=='-1'){
                                  	          echo'-1';
                              }else if($data=='1'){
                               echo '1';
                              }
                                  	      
         }
}//Login

?>