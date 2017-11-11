<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Changepassword_model extends CI_Model {
	
	            public function CheckandChnagePassword()
										                {  
										                	$userId= $_POST['userid'];
		        											$oldPassword = $_POST['oldpassword'];
		        											$newPassword=$_POST['newpassword'];
		        											$query = $this->db->get_where('login', array('userId'=>$userId							 ,'password' => $oldPassword));
		        											$count = $query->num_rows() > 0;
		        											if($count==1){
		        													$data=array('password'=>$newPassword);
		        													$this->db->where('userId',$userId);
		        													$this->db->update('login',$data);
		        													return 	TRUE;
		        											}else{
		        												return FALSE;
		        											}
										                }//CheckandChnagePassword
 }//Changepassword_model