<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {
	
	            public function check()
                {        
                $username = $_POST['username'];
		        $password = $_POST['password'];
		        $token=$_POST['token'];
		        if(!empty($username) && !empty($password)){
				        $query = $this->db->get_where('login', array('email' => $username, 
				        	                                           'password' => $password));
				        $count = $query->num_rows() > 0;
				        if($count==1){
				        			$data=array(
										    		'token'=> $token
						    					);
				        			$this->db->where('email',$username);
								    $this->db->update('login', $data);
				        	return $query;}
				        else{return false;}
				 }else{return false;}
             }//check
//-----------------------------------------------------------------------------------------------------//
             public function getProfile($userId)
                {    
 				 $query = $this->db->get_where('userprofile', array('userId' => $userId));
 				 return $query;
                }//getProfile
//-----------------------------------------------------------------------------------------------------//
             public function getAccommodationDetail($userId)
                {    
 				 $query = $this->db->get_where('accommodation', array('userId' => $userId));
 				 return $query;
                }//getProfile
  }//Contacts_model
 ?>