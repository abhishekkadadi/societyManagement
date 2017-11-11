<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Buildings_model extends CI_Model {
		public function Fetch(){
								$query=$this->db->get('buildings');
								return $query->result_array();
							

		}

		public function checkduplicate($buildingName)
                			   {       
		                		$query= $this->db->get_where('buildings',array('buildingName'=>$buildingName));
		                         $count=$query->num_rows();
		                         return $count;
        }

        public function Insert()
                			   { 
                			   	$data = json_decode(file_get_contents("php://input"));  
                			   	$buildingName=$data->buildingName;    
		                		$data1=array(
								    		'buildingName'=> $buildingName
					    		);
					   $this->db->insert('buildings', $data1);
					   return ($this->db->affected_rows() != 1) ? false : true;
        }


}//Buildings_model
?>