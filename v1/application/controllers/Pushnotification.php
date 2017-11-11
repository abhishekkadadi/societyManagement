<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pushnotification extends CI_Controller {
	
	






        public function trial(){
           $this->load->helper('new_helper');
           // $name="abhishek";
            
             push_notify();
        }

	}
