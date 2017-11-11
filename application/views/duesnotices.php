<script type="text/javascript">

   $(document.body).on('click', '#add_login', function(e) {
  	var password1=document.getElementById("new_password").value;
    var confrim_password1 = document.getElementById("confirm").value;
    var examname1=document.getElementById("examname").value;
    var date1=document.getElementById("datepicker").value;
    var password=password1.trim();
    var confrim_password=confrim_password1.trim();
    var examname=examname1.trim();
    var examdate=date1.trim();
    //alert(examdate);
    if(password && confrim_password && examname && examdate){
	   var value=check();
	   if(value==true){
	   	 $.ajax({
                            url: "<?php echo site_url('Createlogin/CreateExamLogin'); ?>",
                                     //base_url("index.php/Login/login_check"); 
                            type: "POST",
                            data: {'examname':examname,
                                    'password':password,
                                    'exam_date':examdate},
                            cache: false,
                            beforeSend: function()
                            { console.log('going');},
                            success: function(response) {  
                            //alert(response);
                                  if(response=='1'){
								  	document.getElementById('message').innerHTML  = 'Successfully Created';
								  	document.getElementById('message2').innerHTML  = '';
								  	document.getElementById("new_password").value = "";
								  	document.getElementById("examname").value = "";
								  	document.getElementById("datepicker").value = "";
								  	document.getElementById("confirm").value = "";
								  }else
								  {
								  	document.getElementById('message').innerHTML  = 'Oops! Some thing went wrong';
								  	document.getElementById('message2').innerHTML  = '';
								  }
                            }
                        });
	   }else{
	   	 	document.getElementById('message').innerHTML  = 'Please check passwords you enter';
	   }
  } else{
   	document.getElementById('message2').innerHTML  = 'All Fields Compulsary';
   }
   	
   	});
   
   
   function check() {
   	var password=document.getElementById("new_password").value;
    var confrim_password = document.getElementById("confirm").value;
   if (password){
   	           if(confrim_password==password){
			   	
			   		document.getElementById('message2').innerHTML  = 'Password Match';
			   		return true;
			   }else{
			   	
			   	document.getElementById('message2').innerHTML  = 'Password are not matching';
			   	return false;
			   }
   	
   }else{
   	
   	document.getElementById('message2').innerHTML  = 'Please fill the new-password field';
   	return false;
   }
} 	

 var app = angular.module("app", ['ui.bootstrap']);  
 app.controller("MsgCtrl", function($scope, $http) {

        $scope.verifyDuplicate = function(){
        	$http.get('<?php echo site_url('Createlogin/verifyDuplicate'); ?>', {
                             params: { examname:$scope.examname }
                                                 }).success(function($data){
                                                  //alert ($data2);
                                                  console.log($data); 
                                                  if($data==1){
												  	$scope.message="Name already used.Please select another name";
												  	$scope.canMoveForward=true;
												  }else{
												  	$scope.message="Exam name is unique";
												  	$scope.canMoveForward=false;
												  }
                                               
                                                 });
        }//duplicate
        
      });
      
</script>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="app" ng-controller="MsgCtrl">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Parkinfinia

        </h1>

    </section>
    <section class="content" style="min-height: 0px;">
        <div class="row" >
            <div class="col-md-12">

                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Due's Notices</h3>
                    </div>
                    <div class="box-body">
                    <form action="" method="post" id="add_question" enctype="multipart/form-data" name="add_product" class="form-inline" name="myForm"> 
                            <div class="form-group" style="display: block">                                
                               <label class="sr-only" for="Source Station">Create New Due's Notice</label>
                                <div class="row">                                  
                                   
                                
                                <div class="col-md-4">
                                <input type="text" id="examname" style="width: 100%" name="op1" ng-model="examname" placeholder="Enter notice heading" class="form-control" ng-change="verifyDuplicate()">  
                                    </div>

                                    <div class="col-md-4">
                                <input type="text" id="examname" style="width: 100%" name="op1" ng-model="examname" placeholder="Send notice to (write email address of person)" class="form-control" ng-change="verifyDuplicate()">  
                                    </div>
                                    <br>   <br>
                                   <div class="col-md-10">
                                  <textarea class="form-control" rows="5" placeholder="Enter notice text"  id="comment" style="min-width: 100%"></textarea>
                                    </div>   
                                   
                                 
                                   
                                  <div class="col-md-9" style="padding-top: 14PX;">
                                    <button  type="button" id="add_login" class="btn btn-primary" name="add_product" class="form-inline" ng-disabled="canMoveForward">Submit</button>
                                    </div>
                                </div>
     
                        </form>
                        
                        <div class="form-group" style="margin-left: 13px;">
                            <div id="progressbox" style="display:none;"><div id="progressbar"></div><div id="statustxt">0%</div></div>
                             <label id='message' ng-bind="message"></label><br/>	
                              <label id='message2' ng-bind="message2"></label>
                            <div id="output" class="output"></div>
                        </div>
                    </div><!-- /.box-body -->
                </div>



            </div><!-- /.col (left) -->

        </div><!-- /.row -->
   <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">List of Due's Notices</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <table ng-init="get_product()" id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <td><b>Notice Id</b></td>
                                                    <td><b>Notice Heading</b></td>
                                                    <td><b>Notice Text</b></td>
                                                    <td><b>Sent To</b></td>
                                                    <td><b>Email address</b></td>
                                                    <td><b>Is notice read</b></td>
                                                    <td><b>Date</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                                    <td>1</td>
                                                    <td>Maintainanced</td>
                                                    <td>Please pay you society maintainance of 1000 RS as soon as possible.</td>
                                                    <td>Demo Demo</td>
                                                    <td>Demo@demo.com</td>
                                                    <td>Yes</td>
                                                    <td>22/12/2016</td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-md-12" ng-show="filteredItemsGallery > 0">    
                                            <div pagination="" page="currentPageGallery" on-select-page="setPageGallery(page)" boundary-links="true" total-items="filteredItemsGallery" items-per-page="entryLimitGallery" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
                                        </div>
                                    </div><!-- /.box-body -->

                                </div><!-- /.box -->
                            </div>
</section>

</div>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
            $(document).ready(function() {
            	  
               $('.building').removeClass('active');
               $('.abuilding').removeClass('active');
               $('.nuser').removeClass('active');
               $('.adduser').removeClass('active');
               $('.notify').addClass('active');
               $('.gnotify').removeClass('active');
               $('.dnotify').addClass('active');
            	// $('.aque').removeClass('active');
            	 });
            	</script>
            	
      <script>
  $( function() {
    $( "#datepicker" ).datepicker({
    	 dateFormat: 'yy-mm-dd'
    });
   
  } );
  </script>