<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberList extends CI_Controller {

			public function index(){
                               $this->load->view('header');
                               $this->load->view('memberlist');
         }

         public function DueNotice(){
                               $this->load->view('header');
                               $this->load->view('duesnotices');
         }
}//Buildings



	