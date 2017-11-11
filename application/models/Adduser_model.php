<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Adduser_model extends CI_Model {
		public function getBuildings(){
										$query=$this->db->get('buildings');
										return $query->result();
									  }

		public function insertuserdata(){
										$data= array(
			                                         'name' => $_POST['name'],
			                                         'email' => $_POST['email'],
			                                         'mobileNo'=>$_POST['phoneno'],
			                                         'userType' =>$_POST['optradio']
			  										);//1st array
                                        
                                        if(isset($_POST['membercheck'])){
                                        	$data['isMember']='1';//if user is member
                                        }
									   $this->db->insert('userprofile',$data);
									   $insert_id = $this->db->insert_id();
									   return $insert_id;
   									 }
        
        public function insertuserflats($user_id){
										$building_id=$_POST['faculty'];
        								$flat_no=$_POST['flatno'];
 										$flatnbuilding=array_combine($flat_no,$building_id);
										foreach ($flatnbuilding as $key => $value) {
											if(!empty($key)){
										     $data[] = array(
					                                         'userId' => $user_id,
					                                         'flatNo' => $key,//flat no
					                                         'building'=>$value//building no
                                          					);
									  }
									}
									  	$this->db->insert_batch('accommodation', $data);
									  	return ($this->db->affected_rows() < 1) ? false : true;
									}

        
        public function checkduplicateflat(){
        								$building_id=$_POST['faculty'];
        								$flat_no=$_POST['flatno'];

 										$flatnbuilding=array_combine($flat_no,$building_id);
										foreach ($flatnbuilding as $key => $value) {
										  	 					$query = $this->db->get_where('accommodation', array('flatNo' => $key, 
				        	                                           'building' => $value));
				       											 $count = $query->num_rows();
				        										 if($count==0){
										  						continue;
										  						}else{
										  							   return false;
										  						}
									  	  }
									  	  return '1';
									  	 }

		public function checkduplicateemail(){
        								$email=$_POST['email'];
										$query = $this->db->get_where('userprofile',array('email'=>
											     $email));
				       					$count = $query->num_rows() > 0;
				        				if($count==0){
										  			   return '1';
										  						}else{
										  							   return '-2';//email already present
										  						}
									  	  
									  	 }
}//Adduser_model

?>