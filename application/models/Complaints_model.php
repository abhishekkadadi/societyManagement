<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Complaints_model extends CI_Model {

								public function getComplaints(){
												
													$this->db->select("*");
									  				$this->db->from('complaints');
									  				$this->db->join('userprofile', 'userprofile.userId = complaints.complaintBy');
													$query = $this->db->get();
													return $query->result();
								}
							

		}

?>