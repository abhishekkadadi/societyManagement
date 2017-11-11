<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {
	
	            public function check()
                {        
                $username = $_POST['username'];
		        $password = $_POST['password'];
		        if(!empty($username) && !empty($password)){
				        $query = $this->db->get_where('login', array('email' => $username, 
				        	                                           'password' => $password));
				        $count = $query->num_rows() > 0;
				        if($count==1){
				        				foreach ($query->result() as $row)
																		{
														   			   $userId=$row->userId;
																		}
										$query1 = $this->db->get_where('userprofile', array('userId' => 
											                                                 $userId));
										foreach ($query1->result() as $row1) {
														$userType=$row1->userType;
														$userId=$row1->userId;
														$name=$row1->name;
                                                        }
                                          if($userType==0){
                                          	               return '-1';
                                          }else if($userType==1 || $userType==2){
								                     $newdata1 = array(
										                			'userType' => $userType,
													                'userId'=> $userId,
													                'name'=> $name,
													                'logged_in' => TRUE
           						                                       );
										           		//print_r($newdata1);				 
														$this->session->set_userdata($newdata1);
														return '1';
                                          }			
				            }
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