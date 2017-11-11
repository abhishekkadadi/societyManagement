<script type="text/javascript">
	var app = angular.module("app", ['ui.bootstrap']);  
 app.controller("MsgCtrl", function($scope, $http,$window) {
        $scope.get_product = function() {
            $scope.users = [];        
            $http.get('<?php echo site_url('Notices/FetchGeneralNotice'); ?>').success(function($data){
                console.log(JSON.parse(JSON.stringify($data)));
                $scope.users = $data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 20; //max no of items to display in a page
                $scope.filteredItems = $scope.users.length; //Initially for no filter  
            });
        }//get_product

        $scope.add = function() {
          
                      if($scope.noticeTitle && $scope.noticeText){
                                            var method = 'POST';
                                            var url = "<?php echo site_url('Notices/InsertGeneralNotice'); ?>";

                                            var FormData = {
                                            'noticeTitle' : $scope.noticeTitle,
                                            'noticeText' : $scope.noticeText
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
                                                $scope.noticeTitle = null;
                                                $scope.noticeText = null;
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

        $scope.prod_delete = function(NoticeId1){
        var deleteUser = $window.confirm('Are you absolutely sure you want to delete?');
           if (deleteUser) {
                          $http.get('<?php echo site_url('Notices/DeleteGeneralNotice'); ?>', {
                                 params: { NoticeId:NoticeId1 }
                                                            }).success(function($data2){
                                                                        alert('Successfully Removed');
                                                                        $scope.get_product();
                                                 
                                                 
                                                               });
           }
        }//prod_delete
        
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
                        <h3 class="box-title">General Notices</h3>
                    </div>
                    <div class="box-body">
                    <form action="" method="post" id="add_question" enctype="multipart/form-data" name="add_product" class="form-inline" name="myForm"> 
                            <div class="form-group" style="display: block">                                
                               <label class="sr-only" for="Source Station">Create New General Notice</label>
                                <div class="row">                                  
                                   
                                <div class="col-md-4">
                                <input type="text" id="examname" style="width: 100%" name="op1" ng-model="noticeTitle" placeholder="Enter notice heading" class="form-control" ng-change="verifyDuplicate()">  
                                    </div><br>   <br>
                                   <div class="col-md-10">
                                  <textarea class="form-control" rows="5" placeholder="Enter notice text"  id="comment" ng-model="noticeText" style="min-width: 100%"></textarea>
                                    </div>   
                                   
                                 
                                   
                                  <div class="col-md-9" style="padding-top: 14PX;">
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
                                        <h3 class="box-title">List of General Notices</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <table ng-init="get_product()" id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <td><b>Notice Id</b></td>
                                                    <td><b>Notice Heading</b></td>
                                                    <td><b>Notice Text</b></td>
                                                    <td><b>Date</b></td>
                                                    <td><b>Action</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <tr ng-repeat="user in users">
                                                    <td>{{user.notificationId}}</td>
                                                    <td>{{user.noticeTitle}}</td>
                                                    <td>{{user.noticeText}}</td>
                                                    <td>{{user.timeStamp}}</td>
                                                    <td><a href="" ng-click="prod_delete(user.notificationId)">Delete</a></td>
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
               $('.gnotify').addClass('active');
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