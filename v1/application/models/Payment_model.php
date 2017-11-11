<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_model extends CI_Model {

	public function FetchPaymentStatement()
                {       
                         		$userId=$_POST['userId'];
        						$limitNumber=$_POST['limitNumber'];
        						$start=10 * $limitNumber;
        						$this->db->select('*');
        						$this->db->from('paymenthistory');
        						$this->db->where('userId',$userId);
        						$this->db->limit(10,$start);
        						$this->db->order_by('historyId', 'desc');
								$query = $this->db->get()->result_array();
								return $query;
                }//FetchPaymentStatement


    public function getDueAmount()
                {       
                            $userId=$_POST['userId'];
                            $query=$this->db->get_where('totaldueamount',array('userId'=>$userId));
                    
                            return $query->result_array();
                }//FetchPaymentStatement




}