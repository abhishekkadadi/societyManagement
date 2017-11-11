<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaint_model extends CI_Model {

	public function InsertComplaint(){
									 $complaintTitle=$_POST['complaintTitle'];
									 $complaintDescription=$_POST['complaintDescription'];
									 $priority=$_POST['priority'];
									 $complaintBy=$_POST['complaintBy'];
										  if(isset($_FILES['url1'])){
										  		if(!empty($_FILES['url1'])){
										  			$url1="url1";
										  		    $path1=$this->do_upload($url1); 
										  		}
										    }

										  if(isset($_FILES['url2'])){
										  		if(!empty($_FILES['url2'])){
										  			$url2="url2";
										  		    $path2=$this->do_upload($url2);   
										  		}
										    }

										  if(isset($_FILES['url3'])){
										  		if(!empty($_FILES['url3'])){
										  			$url3="url3";
										  		    $path3=$this->do_upload($url3); 
										  		}  
										  	}   

										  if(isset($_FILES['url4'])){
										  		if(!empty($_FILES['url4'])){
										  			$url4="url4";
										  		    $path4=$this->do_upload($url4);
										  		}   
										  	}
									$data=array(
										    		'complaintTitle'=> $complaintTitle,
										    		'complaintBy'=>$complaintBy,
										    		'complaintDescription'=> $complaintDescription,
										    		'priority'=> $priority
						    					);
						    				if(isset($path1)){
						    					if($path1=='0'){return "-1";}
						    					else{$data['url1']=base_url("/complaint_images/$path1");}
						    				}
						    				if(isset($path2)){
						    					if($path2=='0'){return "-1";}
						    					else{$data['url2']=base_url("/complaint_images/$path2");}
						    				}
						    				if(isset($path3)){
						    					if($path3=='0'){return "-1";}
						    					else{$data['url3']=base_url("/complaint_images/$path3");}					
						    				}
						    				if(isset($path4)){
						    					if($path4=='0'){return "-1";}
						    					else{$data['url4']=base_url("/complaint_images/$path4");}
						    				}	
										    $this->db->insert('complaints', $data);
										    return ($this->db->affected_rows() != 1) ? false : true;
																	
	}



	

      	public function AddComments(){
									 $commentBy=$_POST['userId'];
									 $comment=$_POST['comment'];
									 $complaintId=$_POST['complaintId'];
									 $data=array(
										    		'userId'=> $commentBy,
										    		'comment'=>$comment,
										    		'complaintId'=> $complaintId,
										    		'commentDate'=>date("Y-m-d")
						    					);
									 $this->db->insert('comments', $data);
									 return ($this->db->affected_rows() != 1) ? false : true;

		}//AddComments


		public function FetchComplaints(){
			                         $priority=array();
									 $userId=$_POST['userId'];
									 $limitNumber=$_POST['limitNumber'];
									 if(!empty($_POST['low'])){
									 	$priority[] = $_POST['low'];
									 }
									 if(!empty($_POST['medium'])){
									 	$priority[] = $_POST['medium'];
									 }
									 if(!empty($_POST['high'])){
									 	$priority[] = $_POST['high'];
									 }
									 $start=10 * $limitNumber;
									
									 	if(!empty($userId)){
									 					$this->db->select('c.complaintId,c.complaintBy,c.complaintTitle,c.complaintDescription,up.name as complainerName,up.userPicture as complainerPicture');
														$this->db->from('complaints as c');
														$this->db->where('c.complaintBy',$userId);

														//$this->db->where('c.priority','Medium');
														$this->db->join('userprofile as up', 'up.userId = c.complaintBy');
														$this->db->limit(10,$start);
														$this->db->order_by('c.complaintId', 'desc');
														$query = $this->db->get()->result_array();
														return $query;
										 }else{
									 		$this->db->select('c.complaintId,c.complaintBy,c.complaintTitle,c.complaintDescription,up.name as complainerName,up.userPicture as complainerPicture');
														$this->db->from('complaints as c');
														//$this->db->where('c.complaintBy',$userId);
														if(!empty($priority)){
														$this->db->where_in('c.priority',$priority);
														}
														$this->db->join('userprofile as up', 'up.userId = c.complaintBy');
														$this->db->limit(10,$start);
														$this->db->order_by('c.complaintId', 'desc');
														$query = $this->db->get()->result_array();
														return $query;
									 	 }
									   


		}//FetchComplaints

		public function fetchDetailedComplaint(){
									 $complaintId=$_POST['complaintId'];
									 $this->db->select('c.*,up.name as complainerName,up.userPicture as complainerPicture');
									 $this->db->from('complaints as c');
									 $this->db->where('c.complaintId',$complaintId);
									 $this->db->join('userprofile as up', 'up.userId = c.complaintBy');
									 $query = $this->db->get()->result_array();
									 return $query;
		}//FetchComplaints

		public function fetchComments(){
									 $complaintId=$_POST['complaintId'];
									 $this->db->select('c.*,up.name as commenterName');
									 $this->db->from('comments as c');
									 $this->db->where('c.complaintId',$complaintId);
									 $this->db->join('userprofile as up', 'up.userId = c.userId');
									 $query = $this->db->get()->result_array();
									 return $query;
		}//FetchComplaints


		public function updateComplaint(){
									 $complaintTitle=$_POST['complaintTitle'];
									 $complaintDescription=$_POST['complaintDescription'];
									 $priority=$_POST['priority'];
									 $complaintId=$_POST['complaintId'];
									 $complaintStatus=$_POST['complaintStatus'];
										  if(isset($_FILES['url1'])){
										  		if(!empty($_FILES['url1'])){
										  			$url1="url1";
										  		    $path1=$this->do_upload($url1); 
										  		}
										    }

										  if(isset($_FILES['url2'])){
										  		if(!empty($_FILES['url2'])){
										  			$url2="url2";
										  		    $path2=$this->do_upload($url2);   
										  		}
										    }

										  if(isset($_FILES['url3'])){
										  		if(!empty($_FILES['url3'])){
										  			$url3="url3";
										  		    $path3=$this->do_upload($url3); 
										  		}  
										  	}   

										  if(isset($_FILES['url4'])){
										  		if(!empty($_FILES['url4'])){
										  			$url4="url4";
										  		    $path4=$this->do_upload($url4);
										  		}   
										  	}
									$data=array(
										    		'complaintTitle'=> $complaintTitle,
										    		'complaintStatus'=>$complaintStatus,
										    		'complaintDescription'=>$complaintDescription,
										    		'priority'=> $priority
						    					);
						    				if(isset($path1)){
						    					if($path1){$data['url1']=base_url("/complaint_images/$path1");}
						    					}
						    				if(isset($path2)){
						    					if($path2){$data['url2']=base_url("/complaint_images/$path2");}
						    				}
						    				if(isset($path3)){
						    					if($path3){$data['url3']=base_url("/complaint_images/$path3");}					
						    				}
						    				if(isset($path4)){
						    					if($path4){$data['url4']=base_url("/complaint_images/$path4");}
						    				}	
										    $this->db->where('complaintId', $complaintId);
											$this->db->update('complaints', $data);
										    return ($this->db->affected_rows() != 1) ? false : true;
																	
	}//updateComplaint

	  public function do_upload($url)
        {
                $config['upload_path']          = './complaint_images';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                
                $this->load->library('upload', $config);
                $new_name = uniqid().$_FILES[$url]['name'];
				$config['file_name'] = $new_name;
                if ( ! $this->upload->do_upload($url))
                {
                        $error = array('error' => $this->upload->display_errors());
                        return '0';
                        //$this->load->view('upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        return $data['upload_data']['file_name'];
                       //print_r($data);
                }
        }


}
?>