<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

	public function UpdateProfile(){
		                             $userId=$_POST['userId'];
									 $name=$_POST['name'];
									 $mobileNo=$_POST['mobileNo'];
									  if(isset($_FILES['userPicture'])){
										  		if(!empty($_FILES['userPicture'])){
										  			$url1="userPicture";
										  		    $path1=$this->do_upload($url1); 

										  		}
									   }
										    

									 $data=array(
										    		'name'=> $name,
										    		'mobileNo'=>$mobileNo
						    					);
									 if(isset($path1)){
						    					if($path1!='0'){$data['userPicture']=base_url("/profile_images/$path1");}else{
						    						return false;
						    					}
						    					
						    				}
									 $this->db->where('userId', $userId);
									 $this->db->update('userprofile', $data);
									 return ($this->db->affected_rows() != 1) ? false : true;

		}//UpdateProfile


	public function do_upload($url)
        {
                $config['upload_path']          = './profile_images';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                
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