<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddUsers extends CI_Controller {

			public function index(){
							   $this->load->model('Adduser_model');
							   $result['data']=$this->Adduser_model->getBuildings();
                               $this->load->view('header');
                               $this->load->view('adduser',$result);
         }

            public function Newuser(){
            	$email=$_POST['email'];
            	$name=$_POST['name'];
            	$this->load->model('Adduser_model');
            						if(isset($_POST['membercheck'])){
            							$result=$this->Adduser_model-> checkduplicateflat();
            							//echo 'this si flat result  ',$result;
            							if($result=='1'){
            							            $result1=$this->Adduser_model->checkduplicateemail();
                             						if($result1=='1'){
                             							           $result2=$this->Adduser_model->insertuserdata();//insert user
                             							           $result3=$this->Adduser_model->insertuserflats($result2);//insert his flats
                             							           if($result3){
                             							           	$this->sendMail($result2,$email,$name);//semd mail success
                             							           	//echo '-3';//success full
                             							           }else{
                             							           	echo '-4';//failed to add
                             							           }
                             						}else{
                             							echo '-2';
                             						}
                             			}else{
                             				echo '-1';
                             			}
         }else{
         	   $result4=$this->Adduser_model->insertuserdata();
         	   if($result4){
         	   		$this->sendMail($result4,$email,$name);
         	   	}else{
         	   		echo '-4';//failed to add
         	   	}
         }
    }//Buildings

    public function sendMail($user_id,$email,$name){
    									$userid=urlencode(base64_encode($user_id));
    									$result['sitelink']= site_url("Verifyemail/Verify/$userid");
										$result['email']=$email;
										$result['name']=$name;
									    $html=$this->load->view('emailverification', $result, true);
    									$this->load->library('email');
    									$this->email->initialize(array(
                                                       'protocol' => 'smtp',
                                                      'smtp_host' => 'smtp.sendgrid.net',
                                                      'smtp_user' => 'akadadi',
                                                        'smtp_pass' => 'danger44',
                                                      'smtp_port' => 587,
                                                      'crlf' => "\r\n",
                                                      'newline' => "\r\n"
                                                    ));
       									$this->email->set_mailtype("html");
										$this->email->from('abhishek@whitecode.co.in', 'ParkInfinia');
										$this->email->to($email);
										$this->email->subject('ParkInfinia Email Validation');
										$this->email->message($html);
										if($this->email->send()){
											echo '-3';
											//echo $this->email->print_debugger();
										}else{
											echo '-5';//mail sending failed please contact software providers
										}
    }

}//AddUsers

	