<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notices extends CI_Controller {

			public function FetchGeneralNotice(){
									$this->load->model('Notices_model');
									$result=$this->Notices_model->fetchGeneralNotice();
	                                if($result){
										$final_data=array('status'=>'1','message'=>'General notice successfully fetched');
										$final_data['general_list']=$result;
                                                $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
									}else{
										$final_data=array('status'=>'0','message'=>'Oops! No general notice found');
                                                $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
										
									}
	        }

	        public function InsertGeneralNotice(){
							$this->load->model('Notices_model');
							$result=$this->Notices_model->InsertGeneralNotice();
                            if($result){
                            	//push notification code
                            $this->load->model('QueriesforPushnotification_model');
                            $tokens=$this->QueriesforPushnotification_model->getAlltokens();
                            $allTokens=array();
		                        foreach ($tokens as $key) {
		                           if(!empty($key['token'])){
		                                $allTokens[]=$key['token'];
		                            }
		                        }
                            $this->load->helper(array('messages_helper','new_helper'));
               				$message=general_notice_for_push($_POST['noticeTitle']);
							$notify=push_notify($allTokens,$message);
							//push notification code ends
							$final_data=array('status'=>'1','message'=>'General notice successfully added');
                            $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
							}else{
								$final_data=array('status'=>'0','message'=>'Oops! Some thing went wrong');
                                 $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
								
							}
	        }

	        public function DeleteGeneralNotice(){
									$this->load->model('Notices_model');
									$result=$this->Notices_model->DeleteGeneralNotice();
	                                if($result){
										$final_data=array('status'=>'1','message'=>'General notice successfully deleted');
                                                $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
									}else{
										$final_data=array('status'=>'0','message'=>'Oops! Some thing went wrong');
                                                $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
										
									}
	        }

	        public function IndividualNotices(){
						$this->load->model('Notices_model');
						$result=$this->Notices_model->InsertIndividualNotice();
                        if($result){
                        	//push notification code
                        	$ids=$_POST['noticeTo'];
                            $this->load->model('QueriesforPushnotification_model');
                        $tokens=$this->QueriesforPushnotification_model->selectedTokens($ids);
                            $allTokens=array();
		                        foreach ($tokens as $key) {
		                           if(!empty($key['token'])){
		                                $allTokens[]=$key['token'];
		                            }
		                        }
		                       
                           $this->load->helper(array('messages_helper','new_helper'));
               			   $message=individual_notice_for_push($_POST['noticeTitle']);
						   $notify=push_notify($allTokens,$message);
							//push notification code ends



							$final_data=array('status'=>'1','message'=>'Individual notice successfully sent');
                             $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
						}else{
							$final_data=array('status'=>'0','message'=>'Oops! Some thing went wrong');
                                    $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
							
						}
	        }

	        public function fetchDueAndIndividualNotice(){
									$this->load->model('Notices_model');
									$result=$this->Notices_model->fetchDueAndIndividualNotices();
	                                if($result){
										$final_data=array('status'=>'1','message'=>'Dues notice successfully fetched');
										$final_data['duesNotices']=$result;
                                                $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
									}else{
										$final_data=array('status'=>'0','message'=>'Oops! No notice found');
                                                $this->output->set_content_type('application/json')->set_output(json_encode($result));
										
									}
	        }

	        public function isReadNotice(){
									$this->load->model('Notices_model');
									$result=$this->Notices_model->isReadNotice();
	                                if($result){
										$final_data=array('status'=>'1','message'=>'Notices status changed to read');
										
                                                $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
									}else{
										$final_data=array('status'=>'0','message'=>'All notices are read already');
                                                $this->output->set_content_type('application/json')->set_output(json_encode($final_data));
										
									}
	        }




}//Notices
?>