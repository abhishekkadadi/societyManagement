<script type="text/javascript">
 var app = angular.module("app", ['ui.bootstrap']);  
 app.controller("MsgCtrl", function($scope, $http) {

        $scope.verifyDuplicate = function(){
        	$http.get('<?php echo site_url('Buildings/verifyDuplicate'); ?>', {
                             params: { buildingName:$scope.buildingName }
                                                 }).success(function($data){
                                                  //alert ($data);
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

        $scope.get_product = function() {
            $scope.users = [];        
            $http.get('<?php echo site_url('Buildings/Fetch'); ?>').success(function($data){
                console.log(JSON.parse(JSON.stringify($data)));
                $scope.users = $data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 20; //max no of items to display in a page
                $scope.filteredItems = $scope.users.length; //Initially for no filter  
            });
        }//get_product


        $scope.add = function() {
          
                      if($scope.buildingName){
                                            var method = 'POST';
                                            var url = "<?php echo site_url('Buildings/Insert'); ?>";

                                            var FormData = {
                                            'buildingName' : $scope.buildingName
                                           };
                      $http({
                            method: method,
                            url: url,
                            data: FormData,
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                          }).
                          success(function(response) {
                            //alert(response);
                               if(response=="1"){
                                                $scope.get_product();
                                                $scope.message="Record Successfully added";
                               }else{
                                    $scope.message="Oops! Some thing went wrong";
                               }
                          }).
                          error(function(response) {
                             $scope.message="Oops! Some thing went wrong";
                          });
                      }else{
                            $scope.message="Empty record cannot be added";
                            $scope.canMoveForward=false;
                      }
           
        }//add
        
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
                        <h3 class="box-title">Add New Buiding</h3>
                    </div>
                    <div class="box-body">
                    <form action="" method="post" id="add_question" enctype="multipart/form-data" name="add_product" class="form-inline" name="myForm"> 
                            <div class="form-group" style="display: block">                                
                               <label class="sr-only" for="Source Station">Create New Exam Login</label>
                                <div class="row">                                  
                                   
                                <div class="col-md-3">
                                <input type="text" id="buildingName" style="width: 100%" name="op1" ng-model="buildingName" placeholder="Enter Unique Building Name" class="form-control" ng-change="verifyDuplicate()" >  
                                    </div>   
                                   
                                 
                                   
                                  <div class="col-md-9">
                                    <button  type="button" id="add_login" class="btn btn-primary" name="add_product" class="form-inline" ng-disabled="canMoveForward" ng-click="add()">Submit</button>
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
                                        <h3 class="box-title">List of Buildings</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <table ng-init="get_product()" id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <td><b>Building ID</b></td>
                                                    <td><b>Building Name</b></td>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <tr ng-repeat="user in users">
                                                    <td>{{user.buildingId}}</td>
                                                    <td>{{user.buildingName}}</td>
                                                   
                                                </tr>
                                            </tbody>
                                        </table>
                                       <div class="col-md-12" ng-show="filteredItems > 0">    
                <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
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
            	  
               $('.building').addClass('active');
               $('.abuilding').addClass('active');
               $('.qset').removeClass('active');
            	 $('.qtype').removeClass('active');
            	 $('.que').removeClass('active');
            	 $('.switch').removeClass('active');
            	 $('.dstuall').removeClass('active');
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