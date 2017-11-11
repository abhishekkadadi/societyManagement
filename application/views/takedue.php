<script type="text/javascript">


   
   
   function check() {
   	var usertype=$('input[name=optradio]:checked').val();
    var buildings=document.getElementById("faculty").value;
    var flatno=document.getElementById("flat_no").value;
    //flat_no
    if ($('input#membercheck').is(':checked')) { 
                    if(flatno && buildings){
                       return true;
                      }else{
                        return false;
                      }
                    }else{
                       return true;
                    }
   
            } 	


</script>
<script type="text/javascript">
 var app = angular.module("app", ['ui.bootstrap']);  
 app.controller("MsgCtrl", function($scope, $http) {


        $scope.get_product = function() {
            $scope.users = [];        
            $http.get('<?php echo site_url('Dues/Fetch'); ?>').success(function($data){
                console.log(JSON.parse(JSON.stringify($data)));
                $scope.users = $data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 20; //max no of items to display in a page
                $scope.filteredItems = $scope.users.length; //Initially for no filter  
            });
        }//get_product

        $scope.EditRow=function (employee) {
               
                $scope.name=employee.name;
                $scope.email=employee.email;
                $scope.Amount=employee.dueAmount;
                $scope.userId=employee.userId;
        }

        $scope.insertDue=function (employee) {
          if($scope.Amount<=0){
            alert('zero');
             }else{
                
               
               if($scope.name && $scope.email && $scope.Amount && $scope.statement){
                  $http.post('<?php echo site_url('Dues/Insertdue');?>',
                        {
                            'name': $scope.name,
                            'email':$scope.email,
                            'Amount':$scope.Amount,
                            'statement':$scope.statement,
                            'userId':$scope.userId

                        }
                )
                        .success(function(data) {
                          if(data=='2'){
                            $scope.message="Failed to update table. Do not try to enter duplicate entry";
                             $scope.get_product();
                          }else if(data==""){
                             $scope.message="Failed to make entry. Amount is updated in database";
                              $scope.get_product();
                          }else{
                            $scope.name='';
                            $scope.email='';
                            $scope.Amount='';
                            $scope.userId='';
                            $scope.statement='';
                            $scope.message="Record inserted";
                            $scope.get_product();
                          }
                            
                    //alert("Question Set Deleted Successfully");
                })

                        .error(function(data) {

                });
               }else{
                alert(' empty');
               }
             }

            
               
        }


        
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
                        <h3 class="box-title">Take due</h3>
                    </div>
                    <div class="box-body">
                    <form action="" method="post" id="addUser" enctype="multipart/form-data" name="add_product" class="form-inline" name="myForm"> 
                            <div class="form-group" style="display: block">                                
                               <label class="sr-only" for="Source Station">Payer Name</label>
                                <div class="row">                                 
                                <div class="col-md-4">
                                <input type="text" ng-model="name" id="name" style="width: 100%" name="name"  placeholder="Enter Name *" class="form-control" readonly>  
                                    </div>  
                                 <div class="col-md-4">
                                <input type="text" ng-model="email" id="phoneno" style="width: 100%" name="phoneno"  placeholder="Enter email address*" class="form-control" readonly>  
                                    </div> 
                                   <div class="col-md-4">
                                <input type="text" ng-model="Amount" id="email" style="width: 100%" name="email"  placeholder="Enter amount *" class="form-control" >  
                                    </div>
                                    <div class="col-md-3">
                                <input type="text" ng-model="userId" id="email" style="width: 100%" name="email"  placeholder="User Id" class="form-control" readonly="">  
                                    </div>
                                     <div class="col-md-12" style="margin-top: 10px;">
                                <input type="text" ng-model="statement" id="email" style="width: 100%" name="email"  placeholder="Enter statement" class="form-control" >  
                                    </div>
                                 <br><br>
                                
                                 
                           
                                  
                                  <div  style="text-align: center; padding-top: 70PX;">
                                    <button  type="button" id="create_user" class="btn btn-primary" name="add_product" ng-click="insertDue()"class="form-inline">Submit</button><br>
                                    <img  src=<?php echo base_url()."box.gif";?> alt="Smiley face" height="42" width="42" id="spinner">
                                    </div>
                                </div>
     
                        </form>
                        
                        <div class="form-group" style="margin-left: 13px;">
                            <div id="progressbox" style="display:none;"><div id="progressbar"></div><div id="statustxt">0%</div></div>
                             <label id='message' ng-bind="message"></label><br/>	
                              <label id='message2'></label>
                            <div id="output" class="output"></div>
                        </div>
                    </div><!-- /.box-body -->
                </div>



            </div><!-- /.col (left) -->

        </div><!-- /.row -->
                                
    </section>
  <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">Members</h3>
                                    </div><!-- /.box-header -->
                                   <p><input type="text" ng-model="test" class="form-control" placeholder="Search By Email Address / Name / Due Amount"></p>
                                    <div class="box-body">
                                        <table ng-init="get_product()" id="example1" class="table table-bordered table-striped">
                                             <thead>
                                                <tr>
                                                    <td><b>User Id</b></td>
                                                    <td><b>User Name</b></td>
                                                    <td><b>User Email</b></td>
                                                    <td><b>Due Amount</b></td>
                                                    <td><b>Advance Amount</b></td>            
                                                    <td><b>Action</b></td>
                                                   
                                                </tr>
                                            </thead>
                                             <tbody>
                                             <tr ng-repeat="user in filtered = (users | filter:test | orderBy : predicate :reverse)">
                                                    <td>{{user.userId}}</td>
                                                    <td>{{user.name}}</td>
                                                    <td>{{user.email}}</td>
                                                    <td>{{user.dueAmount}}</td>
                                                    <td>{{user.advanceAmount}}</td>
                                                     <td><a href="#" ng-click="EditRow(user);">Pay</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-md-12" ng-show="filteredItemsGallery > 0">    
                                            <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
                                        </div>
                                    </div><!-- /.box-body -->

                                </div><!-- /.box -->
                            </div>

                     
                         
<div class="col-md-12" ng-show="filteredItems > 0">    
                <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
            </div>
                         </div>
                    </div><!-- /.row -->
                </section><!-- /.content -->

</div>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
            $(document).ready(function() {
            	 var $loading = $('#spinner').hide();
               $('.building').removeClass('active');
               $('.abuilding').removeClass('active');
               $('.nuser').removeClass('active');
            	 $('.adduser').removeClass('active');
            	 $('.que').removeClass('active');
            	 $('.switch').removeClass('active');
            	 $('.dstuall').removeClass('active');
               $('.member').removeClass('active')
               $('.dues').addClass('active');
               $('.stuall').addClass('active');
               
            	// $('.aque').removeClass('active');



               $("#add_more").on('click', function(e){
                                  e.preventDefault(); // Prevent Default the event
                                  var clone = $(".faculty_row").eq(0).clone(); // clone only first item
                                  $("#faculty_wrapper").append(clone); // append it to our form
                });



                 $('#membercheck').change(function(){
        if(this.checked){
                        $('#faculty_wrapper').fadeIn('slow');
                        $('#attach_more').fadeIn('slow');
                  }else{
                        $('#attach_more').fadeOut('slow');
                        $('#faculty_wrapper').fadeOut('slow');
                       }
    });

                   $(document.body).on('click', '#create_user', function(e) {
    var usertype=$("input[name=optradio]:checked").val();
    var name=document.getElementById("name").value;
    var phoneno = document.getElementById("phoneno").value;
    var email=document.getElementById("email").value;
    var buildings=document.getElementById("faculty").value;
    if(name && phoneno && email){
     var value=check();
     if(value==true){

       $.ajax({
                            url: "<?php echo site_url('AddUsers/Newuser'); ?>",
                                     //base_url("index.php/Login/login_check"); 
                            type: "POST",
                            data: $('#addUser').serialize(),
                            cache: false,
                            beforeSend: function()
                            {  $loading.show();

                             },
                            success: function(response) {  
                              $loading.hide();
                           //alert(response);
                              if(response=='-1'){
                            document.getElementById('message').innerHTML  = 'Flat is already attached to other member';
                              }else if(response=='-2'){
                                document.getElementById('message').innerHTML  = 'Email already present';
                              }else if(response=='-3'){
                                document.getElementById('addUser').reset();
                              document.getElementById('message').innerHTML  = 'Data Successfully added';
                              }else if(response=='-4'){
                              document.getElementById('message').innerHTML  = 'Oops! Some thing went wrong';
                              }else if(response=='-5'){
                              document.getElementById('message').innerHTML  = 'Oops!Email sending failed please contact server providers';
                              }
                          }
                        });
     }else{
        document.getElementById('message').innerHTML  = 'Compulsary Fields Empty';
     }
  } else{
    document.getElementById('message2').innerHTML  = 'Compulsary Fields Empty';
   }
    
    });

});
            	</script>
            	
   