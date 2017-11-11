<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notices_model extends CI_Model {

		public function fetchGeneralNotice(){
								$query=$this->db->get_where('generalnotice',array('Active'=>'1'),20);
								return $query->result_array();
							

		}

		public function InsertGeneralNotice(){ 
                			   	$noticeTitle=$_POST['noticeTitle']; 
                			   	$noticeText=$_POST['noticeText']; 
                			   	$noticeBy=$_POST['noticeBy'];   
		                		$data1=array(
								    		'noticeTitle'=> $noticeTitle,
								    		'noticeText'=> $noticeText,
								    		'Active'=> '1',
								    		'noticeBy'=>$noticeBy
					    		);	
					    $this->db->insert('generalnotice', $data1);
					    return ($this->db->affected_rows() != 1) ? false : true;
        }

        public function DeleteGeneralNotice(){ 
                			    $NoticeId=$_POST['NoticeId'];
					   		    $data = array(
								               'Active' => '0',             
								);

						$this->db->where('notificationId', $NoticeId);
						$this->db->update('generalnotice', $data);
					    return ($this->db->affected_rows() != 1) ? false : true;
        }
        
        public function InsertIndividualNotice(){ 
                			   	$noticeTitle=$_POST['noticeTitle']; 
                			   	$noticeText=$_POST['noticeText']; 
                			   	$noticeBy=$_POST['noticeBy'];
                			   	$noticeTo=$_POST['noticeTo'];
                			   	$decoded= explode(',', $noticeTo);
                			   	
                			   	$data=array();
                			   	foreach ($decoded as $key=>$value) {
                			   		$data[]=array(
								    		'duesNoticeTitle'=> $noticeTitle,
								    		'duesNoticeText'=> $noticeText,
								    		'noticeBy'=>$noticeBy,
								    		'sentNoticeTo'=>$value
					    						 );	
                			   	}   
					    $this->db->insert_batch('duesnotices',$data); 
					    return ($this->db->affected_rows() >= 1) ? true : false;
        }
        
        public function fetchDueAndIndividualNotices(){
        						$userId=$_POST['userId'];
        						$limitNumber=$_POST['limitNumber'];
        						$start=10 * $limitNumber;
        						$this->db->select('*');
        						$this->db->from('duesnotices');
        						$this->db->where('sentNoticeTo',$userId);
        						$this->db->limit(10,$start);
        						$this->db->order_by('duesId', 'desc');
								$query = $this->db->get()->result_array();
								return $query;
							

	}
	
	public function isReadNotice(){
        						$userId=$_POST['userId'];
  								$this->db->set('isRead','1') ;       
    							$this->db->where('sentNoticeTo', $userId);
  								$this->db->update('duesnotices');
								return ($this->db->affected_rows() >= 1) ? true : false;
								
		}
}
?>