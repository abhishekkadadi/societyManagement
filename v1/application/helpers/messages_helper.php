<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

 function complaint_message_for_push($title){

							$message="New complaint registered. $title";
							return $message;
}

 function general_notice_for_push($title){

							$message="New general notice has been posted. $title";
							return $message;
}


function individual_notice_for_push($title){

							$message="You a due notice. $title";
							return $message;
}

function comments_message_for_push($title){

							$message="New comment on $title complaint";
							return $message;
}

function complaint_close_message_for_push($title){

							$message="Complaint '".$title."' has been closed";
							return $message;
}

function complaint_update_message_for_push($title){

							$message="Complaint '".$title."' has been updated";
							return $message;
}