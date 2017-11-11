<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dues_model extends CI_Model {
		public function Fetch(){
						 $this->db->select('up.*,acc.dueAmount,acc.advanceAmount');
						 $this->db->from('userprofile as up');
						 $this->db->join('totaldueamount as acc', 'acc.userId = up.userId');
						 return $this->db->get()->result_array();
						 
		}

		public function Insertdue($dueAmountNow,$advanceAmountNow){
								$data = json_decode(file_get_contents("php://input"));  
                			   	// $name=$data->name; 
                			   	// $email=$data->email;
                			   	$statement=$data->statement;
                			   	$userId=$data->userId;
                			   	$Amount=$data->Amount; 
                			   	//check if data present with id
                			   	$this->db->where('userId',$userId);
   								$q = $this->db->get('totaldueamount');
   								$dueAmountTable=array(
                			   						  'dueAmount'=>$dueAmountNow,
                			   						  'advanceAmount'=>$advanceAmountNow,
                			   						  'userId'=>$userId);            
   								if ( $q->num_rows() > 0 ){
   										$this->db->where('userId',$userId);
     									$this->db->update('totaldueamount',$dueAmountTable);
   								}else{
   									  $this->db->insert('totaldueamount',$dueAmountTable);	
   								} 
                			   	  if($this->db->affected_rows() == 1){
                			   	  	$paymentHistory=array(
									    		'paymentStatement'=> $statement,
									    		'amountPaid'=> $Amount,
									    		'userId'=> $userId
								    		     );	
								    $this->db->insert('paymenthistory', $paymentHistory);
								    return ($this->db->affected_rows() != 1) ? false : true;	
								}else{
									return '2';//failed to update table
								}
		                					 
		}

		public function GetdueAmount($userId){
			$query=$this->db->get_where('totaldueamount',array('userId'=>$userId));
			return $query->result();
		
		}

}

?>