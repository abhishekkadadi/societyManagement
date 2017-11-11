<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contacts_model extends CI_Model {
	
	            public function getImportantContacts()
                {       
                         $query=$this->db->get('importantcontact');
                         return $query;
                }//getImportantContacts

                public function getBuildings()
                {       
                         $query=$this->db->get('buildings');
                         return $query;
                }//getImportantContacts

                 public function getMemberContacts()
                {       
                	     $buildingId=$_POST['buildingId'];
                	     $this->db->select('up.*,acc.flatNo');
						 $this->db->from('userprofile as up');
						 $this->db->join('accommodation as acc', 'acc.userId = up.userId');
						 $this->db->where('acc.building', $buildingId);
						 $this->db->group_by('up.userId');
                         $this->db->order_by('acc.flatNo',"ASC");

						 $query = $this->db->get();
                         return $query;
                }//getImportantContacts

  }//Contacts_model
 ?>