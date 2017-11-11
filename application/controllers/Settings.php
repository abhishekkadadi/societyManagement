<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

			public function ChangePassword(){
                               $this->load->view('header');
                               $this->load->view('changepassword');
         }

         public function SetMaintainance(){
                               $this->load->view('header');
                               $this->load->view('setmaintainance');
         }

       
}//Buildings



	