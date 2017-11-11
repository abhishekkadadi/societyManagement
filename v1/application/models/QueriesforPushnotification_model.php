<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class QueriesforPushnotification_model extends CI_Model {
	

public function getManagersToken()
                {       
                	     $this->db->select('log.token');
						 $this->db->from('login as log');
						 $this->db->join('userprofile as up', 'up.userId = log.userId');
						 $this->db->where('up.userType','1');
						 $query = $this->db->get();
                         return $query->result_array();
                }//getManagersToken

public function getAlltokens()
                {       
                	     $this->db->select('log.token');
						 $this->db->from('login as log');
						 $this->db->join('userprofile as up', 'up.userId = log.userId');
						 $query = $this->db->get();
                         return $query->result_array();
                }//getManagersToken

public function selectedTokens($ids)
                {        //$user_ids=array($ids);
                		$user_ids= explode(',', $ids);
                	     $this->db->select('log.token');
						 $this->db->from('login as log');
						 $this->db->where_in('log.userId', $user_ids);
						 $query = $this->db->get();
                         return $query->result_array();
                }//getManagersToken

public function individualCommentToken($complaintId)
                {        //$user_ids=array($ids);
            		 $this->db->select('log.token,comp.complaintTitle');
					 $this->db->from('login as log');
					 $this->db->join('complaints as comp', 'comp.complaintBy = log.userId');
					 $this->db->where('comp.complaintId', $complaintId);
					 $query = $this->db->get();
					 return $query->result_array();
                }//getManagersToken





}//QueriesforPushnotification_model