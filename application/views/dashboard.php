<script type="text/javascript">
    
    var app = angular.module("app", ['ui.bootstrap']);  
    app.filter('startFrom', function() {
        return function(input, start) {
            if (input) {
                start = +start; //parse to int                        
                return input.slice(start);
            }
            return [];
        }
    });
    
     app.controller("MsgCtrl", function($scope, $http) {
        $scope.pagedItems = [];
        $scope.currentPage = 0;
        $scope.add_prod = true;
       $scope.get_product = function() {
            $scope.users = [];        
            $http.get('<?php echo site_url('Dashboard/fetch_online_test'); ?>').success(function($data){
                //alert($data);
                $scope.users = $data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 20; //max no of items to display in a page
                $scope.filteredItems = $scope.users.length; //Initially for no filter  
            });
        }
        
      $scope.show_popup = function(id,name,email,amount){
	  	$scope.name_to_create_user=name;
	  	$scope.user_email=email;
	  	$scope.user_amount=amount;
	  	$scope.student_id=id;
	  }//showpopuo
      
       $scope.prod_delete = function(sid){
       	 
	  	$http.get('<?php echo site_url('Dashboard/delete_register'); ?>', {
                             params: { id:sid }
                                                 }).success(function($data2){
                                                  //alert (JSON.stringify($data2)); 
                                                 //$scope.tableParams.reload();
                                                 $scope.get_product();
                                                 
                                                  //$scope.users1 = $data2;	
                                                 });
	  }//prod_delete
        
      });
      
      
</script>



         
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Parkinfinia Dashboard                      
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">Yet to customize</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <table ng-init="get_product()" id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                            </tbody>
                                        </table>
                                        <div class="col-md-12" ng-show="filteredItemsGallery > 0">    
                                            <div pagination="" page="currentPageGallery" on-select-page="setPageGallery(page)" boundary-links="true" total-items="filteredItemsGallery" items-per-page="entryLimitGallery" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
                                        </div>
                                    </div><!-- /.box-body -->

                                </div><!-- /.box -->
                            </div>

                            
                        <!--  <div class="col-md-12" ng-show="filteredItems == 0">
                              <div class="col-md-12">
                                  <h4>No customers found</h4>
                              </div>
                          </div>-->
                        <!-- <div class="col-md-12" ng-show="filteredItems > 0">    
                             <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
                         </div>-->
                    </div><!-- /.row -->
                </section><!-- /.content -->

<div class="col-md-12" ng-show="filteredItems > 0">    
                <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
            </div>
              
                
                
              
            </div>
            
            <footer class="main-footer">
                <strong>Copyright &copy; 2015-2016 <a href="http://whitecode.co.in" target="_blank">WhiteCode</a>.</strong> All rights reserved.
            </footer>


 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Account For Student</h4>
        </div>
        <div class="modal-body">
        
        <div class="form-group">
          <label for="usr">Student Id</label>
          <input type="text" class="form-control" id="student_id" readonly ng-model="student_id">
          </div>
        
          <div class="form-group">
          <label for="usr">Name</label>
          <input type="text" class="form-control" id="student_name" readonly ng-model="name_to_create_user">
          </div>
          
          <div class="form-group">
          <label for="usr">Email</label>
          <input type="text" class="form-control" id="student_email" readonly ng-model="user_email">
          </div>
          
          <div class="form-group">
          <label for="usr">Payment Amount</label>
          <input type="text" class="form-control" id="usr" readonly ng-model="user_amount">
          </div>
          
          <div class="form-group">
            <label for="sel1">Select Account Expiry:</label>
            <select class="form-control" id="expire">
            <option value="1">1 Month</option>
            <option value="2">2 Month</option>
            <option value="3">3 Month</option>
            <option value="4">4 Month</option>
            <option value="5">5 Month</option>
            <option value="6">6 Month</option>
            </select>
         </div>
          <button  type="button"  style="float: left" id="update_question" class="btn btn-primary" name="add_product" class="form-inline" >Create User Account</button>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<script>
	 $(document.body).on('click', '#update_question', function(e) {
	 	$("#myModal").modal('hide');
	 	 var table = document.getElementById ("example1");
            
	 	var student_id=document.getElementById("student_id").value;
		var student_name = document.getElementById("student_name").value;
		var student_email=document.getElementById("student_email").value;
		var expire=document.getElementById("expire").value;
		//alert(expire);
		$.ajax({
                                url: '<?php echo site_url() . "/Student_approve/create_student"; ?>',  
                                type: "POST",    
                                data: {'student_id':student_id,
                                	   'student_name':student_name,
                				       'student_email':student_email,
                				       'expire':expire
                				       },
                                cache: false,
                                success: function (html) {
                            angular.element(document.getElementById('example1')).scope().get_product();
                                alert("Mail Sent");
                                //$scope.get_product();
                             }         
                        });//ajax ends
	 	
	 });
	
	
</script>


