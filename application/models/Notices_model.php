<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notices_model extends CI_Model {

		public function fetchGeneralNotice(){
								$query=$this->db->get_where('generalnotice',array('Active'=>'1'));
								return $query->result_array();
							

		}

		public function InsertGeneralNotice(){ 
                			   	$data = json_decode(file_get_contents("php://input"));  
                			   	$noticeTitle=$data->noticeTitle; 
                			   	$noticeText=$data->noticeText;   
		                		$data1=array(
								    		'noticeTitle'=> $noticeTitle,
								    		'noticeText'=> $noticeText,
								    		'Active'=> '1',
								    		'noticeBy'=>$this->session->userdata('userId')
					    		);	
					    $this->db->insert('generalnotice', $data1);
					    return ($this->db->affected_rows() != 1) ? false : true;
        }

        public function DeleteGeneralNotice(){ 
                			   $NoticeId=$_GET['NoticeId'];
					   		    $data = array(
								               'Active' => '0',             
								);

						$this->db->where('notificationId', $NoticeId);
						$this->db->update('generalnotice', $data);
					    return ($this->db->affected_rows() != 1) ? false : true;
        }
}
?>