<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Verifymail_model extends CI_Model {

	public function updatEmailBit($userid){
		$data = array(
               'emailVerified' => '1'
            );
		$this->db->where('userId', $userid);
		$this->db->update('userprofile',$data); 
        return ($this->db->affected_rows() < 1) ? false : true;
	}
    
    public function createLogin($userid,$password){
    	$userEmaildata=$this->fetchEmail($userid);
    	foreach ($userEmaildata as $key) {
    		$userEmailId=$key->email;
    	}
    	
		$data= array(
			         'email' => $userEmailId,
			         'password' => $password,
			         'userId'=>$userid
                    );//1st array
		$this->db->insert('login',$data);
		return ($this->db->affected_rows() < 1) ? false : true;
	}

	public function fetchEmail($userid){
		$query=$this->db->get_where('userprofile',array('userId'=>$userid));
		return $query->result();
	}

}
?>