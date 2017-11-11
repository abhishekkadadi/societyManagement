<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Crons_model extends CI_Model {
		public function getSettings(){
								$query=$this->db->get('settings');
								return $query->result();
						 
		}

		public function getAllUsersInDue(){
								$query=$this->db->get('totaldueamount');
								return $query->result();
						 
		}

		public function runCronAddMonthlyMaintainance($getUsers,$maintainanceAmount){
								$updateArray = array();
								foreach ($getUsers as $key) {
								$userId=$key->userId;
								$dueAmount=$key->dueAmount;
								$advanceAmount=$key->advanceAmount;
								if($advanceAmount==0){
									$updateArray[] = array(
										            'userId'=>$userId,
											        'dueAmount' => $maintainanceAmount+$dueAmount
											    );
								}else if($advanceAmount>$maintainanceAmount){	
										$updateArray[] = array(
													'userId'=>$userId,
											        'dueAmount' =>'0',
											        'advanceAmount'=>$advanceAmount-$maintainanceAmount
											    );
								}else if($advanceAmount<$maintainanceAmount){
										$updateArray[] = array(
													'userId'=>$userId,
											        'dueAmount' =>$maintainanceAmount-$advanceAmount,
											        'advanceAmount'=>'0'
											    );
								}else if($advanceAmount==$maintainanceAmount){
									$updateArray[] = array(
													'userId'=>$userId,
											        'dueAmount' =>'0',
											        'advanceAmount'=>'0'
											    );
								}
							}//foreach
						 $this->db->update_batch('totaldueamount',$updateArray, 'userId'); 
											 
		}
}