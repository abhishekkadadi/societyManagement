<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {
	
	public function ImportantContacts(){
                                		
                                		  $this->load->model('Contacts_model');
                                      $data=$this->Contacts_model->getImportantContacts();
                                           if($data->num_rows() > 0){
                                                                  	$data1=array('status'=>'1','message'=>'Successfully fetched important contacts');
                                           	foreach ($data->result() as $row) {
                                                               		$sortContacts=array(
                                                               							'contactId'=>$row->contactId,
                                                               							'name'=>$row->name,
                                                               							'profession'=>$row->profession,
                                                               							'mobileNo'=>$row->mobileNo
                                                               						   );
                                                               		$importantContacts[]=$sortContacts;	
                                           	}
                                           	$importantContacts1['data']=$importantContacts;
                                           	$final_data=array_merge($data1,$importantContacts1);
                                           	$this->output->set_content_type('application/json')->set_output(json_encode($final_data));
                                           }else{
                                           	      $final_data=array('status'=>'0','message'=>'No data available');
                                           	      $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
                                           }
        }//ImportantContacts
	
	public function MemberContacts(){
                                  
                                    $this->load->model('Contacts_model');
                                    $data=$this->Contacts_model->getMemberContacts();
                                    //print_r($data->result());
                                         if($data->num_rows() > 0){
                                                                   $data1=array('status'=>'1','message'=>'Successfully fetched member contacts');
                                          foreach ($data->result() as $row) {
                                                          $sortContacts=array(
                                                                    'userId'=>$row->userId,
                                                                    'name'=>$row->name,
                                                                    'mobileNo'=>$row->mobileNo,
                                                                    'userPicture'=>$row->userPicture,
                                                                    'flatNo'=>$row->flatNo
                                                                     );
                                                          $MemberContacts[]=$sortContacts; 
                                          }
                                          $MemberContacts1['data']=$MemberContacts;
                                          $final_data=array_merge($data1,$MemberContacts1);
                                          $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
                                         }else{
                                                $final_data=array('status'=>'0','message'=>'No data available');
                                                $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
                                         }
        }//MemberContacts

  public function GetBuildings(){
                                $this->load->model('Contacts_model');
                                $data=$this->Contacts_model->getBuildings();
                                if($data->num_rows() > 0){
                                                    $data1=array('status'=>'1','message'=>'Successfully fetched building details');
                                                    foreach ($data->result() as $row) {
                                                          $sortContacts=array(
                                                                    'buildingId'=>$row->buildingId,
                                                                    'buildingName'=>$row->buildingName,
                                                                     );
                                                          $buildingDetails[]=$sortContacts; 
                                                    }
                                                      $buildingDetails1['data']=$buildingDetails;
                                                      $final_data=array_merge($data1,$buildingDetails1);
                                                      $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
                                }else{
                                      $final_data=array('status'=>'0','message'=>'No data available');
                                      $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
                                }
        }//GetBuilings
}
	
?>