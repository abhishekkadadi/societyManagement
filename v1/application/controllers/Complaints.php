<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaints extends CI_Controller {
    
    public function NewComplaint(){

        $this->load->model('Complaint_model');
        $result=$this->Complaint_model->InsertComplaint();
        if($result=='0'){
                        $final_data=array('status'=>'-1','message'=>'Opps! Files fail to upload');
                        $this->output->set_content_type('application/json')->set_output(json_encode
                                                                            ($final_data));
        }else if($result=='1'){
                        //push notification code
                        $this->load->model('QueriesforPushnotification_model');
                        $managers=$this->QueriesforPushnotification_model->getManagersToken();
                        $manager_token=array();
                        foreach ($managers as $key) {
                           if(!empty($key['token'])){
                                $manager_token[]=$key['token'];
                            }
                        }
                        $this->load->helper(array('messages_helper','new_helper'));
                        $message=complaint_message_for_push($_POST['complaintTitle']);
                        $notify=push_notify($manager_token,$message);
                        //push notification code ends
                        $final_data=array('status'=>'1','message'=>'Your complaint was added successfully');
                        $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
        }else{
                $final_data=array('status'=>'0','message'=>'Opps! Some thing went wrong');
                        $this->output->set_content_type('application/json')->set_output(json_encode
                                                                            ($final_data));
        }


    }

    public function AddComments(){

        $this->load->model('Complaint_model');
        $result=$this->Complaint_model->AddComments(); 
        if($result){
                      //push notification code
                     $this->load->model('QueriesforPushnotification_model');
                     $individualId=$this->QueriesforPushnotification_model->individualCommentToken($_POST['complaintId']);
                     $individual_token=array();
                        foreach ($individualId as $key) {
                           if(!empty($key['token'])){
                                $individual_token[]=$key['token'];
                                $complaintTitle=$key['complaintTitle'];
                            }
                        }
                        $this->load->helper(array('messages_helper','new_helper'));
                        $message=comments_message_for_push($complaintTitle);
                        $notify=push_notify($individual_token,$message);
                     //push notification code ends
                        $final_data=array('status'=>'1','message'=>'Comment successfully added');

                       $this->output->set_content_type('application/json')->set_output(json_encode($final_data));      
    }else{
                        $final_data=array('status'=>'0','message'=>'Opps! Some thing went wrong');
                        $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
        }



    }//AddComments

    public function FetchComplaints(){

        $this->load->model('Complaint_model');
        $result=$this->Complaint_model->FetchComplaints(); 
        if($result){
                        $status=array('status'=>'1','message'=>'Complaints successfully fetched');
                        $data['data']=$result;
                        $final_data=array_merge($status,$data);
                        $this->output->set_content_type('application/json')->set_output(json_encode($final_data));      
        }else{
                        $final_data=array('status'=>'0','message'=>'No complaints found');
                        $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
            }

    }//FetchComplaints

    public function fetchDetailedComplaint(){

    $this->load->model('Complaint_model');
        $result=$this->Complaint_model->fetchDetailedComplaint(); 
        $result1=$this->Complaint_model->fetchComments(); 
        if($result){
                        $status=array('status'=>'1','message'=>'Complaints successfully fetched');
                        $data['data']=$result;
        
                        $data['comments']=$result1;
                        $final_data=array_merge($status,$data);
                        $this->output->set_content_type('application/json')->set_output(json_encode($final_data));      
        }else{
                        $final_data=array('status'=>'0','message'=>'Opps! Some thing went wrong');
                        $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
            }

    }//FetchComplaints
    
    
    public function updateComplaint(){

        $this->load->model('Complaint_model');
        $result=$this->Complaint_model->updateComplaint();
         if($result=='1'){
                         //push notification code
                     $this->load->model('QueriesforPushnotification_model');
                     $individualId=$this->QueriesforPushnotification_model->getManagersToken();
                     $individual_token=array();
                        foreach ($individualId as $key) {
                           if(!empty($key['token'])){
                                $individual_token[]=$key['token'];
                            }
                        }
                        $this->load->helper(array('messages_helper','new_helper'));
                        if($_POST['complaintStatus']=='1'){//complaint closed notice
                        $message=complaint_close_message_for_push($_POST['complaintTitle']);
                        $notify=push_notify($individual_token,$message);    
                        }else{//complaint updated notice
                        $message=complaint_update_message_for_push($_POST['complaintTitle']);
                             $notify=push_notify($individual_token,$message);    
                        }
                       
                     //push notification code ends
                        $final_data=array('status'=>'1','message'=>'Your complaint was updated successfully');
                        $this->output->set_content_type('application/json')->set_output(json_encode
                                                                            ($final_data));
        }else{
                $final_data=array('status'=>'0','message'=>'Opps! Some thing went wrong');
                        $this->output->set_content_type('application/json')->set_output(json_encode
                                                                            ($result));
        }


    }
}
?>