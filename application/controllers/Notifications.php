<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

			public function GeneralNotice(){
                               $this->load->view('header');
                               $this->load->view('generalnotification');
         }

         public function DueNotice(){
                               $this->load->view('header');
                               $this->load->view('duesnotices');
         }
}//Buildings



	