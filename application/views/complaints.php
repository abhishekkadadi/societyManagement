
<style type="text/css">
    .hidden {
    display: none;
}
</style>

<script type="text/javascript">
    
    var app = angular.module("app",['ui.bootstrap']);  
     app.controller("MsgCtrl", function($scope, $http) {
        $scope.pagedItems = [];
        $scope.currentPage = 0;
        $scope.add_prod = true;
       $scope.get_product = function() {
            $scope.users = [];        
            $http.get('<?php echo site_url('Complaints/getComplaints'); ?>').success(function($data){
                //alert (JSON.stringify($data));
                $scope.users = $data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 20; //max no of items to display in a page
                $scope.filteredItems = $scope.users.length; //Initially for no filter  
            });
        }
        
      
       
        
      });
      
      
</script>



         
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Parkinfinia                    
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row" ng-app="app" ng-controller="MsgCtrl">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">Complaints</h3>
                                    </div><!-- /.box-header -->
                                   <p><input type="text" ng-model="test" class="form-control" placeholder="Search By Email Address / Name"></p>
                                    <div class="box-body">
                                        <table ng-init="get_product()" id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <td><b>ID</b></td>
                                                    <td><b>Name</b></td>
                                                    <td><b>Mobile</b></td>
                                                    <td><b>Complaint</b></td>
                                                    <td><b>Priority</b></td>
                                                    <td><b>View Images</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <tr ng-repeat="user in users">
                                                    <td>{{user.complaintId}}</td>
                                                    <td>{{user.name}}</td>
                                                    <td>{{user.mobileNo}}</td>
                                                    <td>{{user.complaintDescription}}</td>
                                                    <td>{{user.priority}}</td>
                                                <td><a href="" data-toggle="modal" data-target="#myModal" class="viewimage" img1="{{user.url1}}" img2="{{user.url2}}" img3="{{user.url3}}" img4="{{user.url4}}">View Pic's</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div><!-- /.box-body -->

                                </div><!-- /.box -->
                            </div>

                            
                       
                         

                         </div>
                    </div><!-- /.row -->
                </section><!-- /.content -->
 <!--modal  -->  
  <div class="container">

  <!-- Trigger the modal with a button -->
  

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Complaint Pictures</h4>
        </div>
        <div class="modal-body">
          <p><img src="" class="img1"  height="300" width="570"></p>
          <p><img src="" class="img2" height="300" width="570"></p>
          <p><img src="" class="img3" height="300" width="570"></p>
          <p><img src="" class="img4"  height="300" width="570"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>            
   <!--  modal-->             
                
              
            </div>
            
            <footer class="main-footer">
                <strong>Copyright &copy; 2015-2016 <a href="http://whitecode.co.in" target="_blank">WhiteCode</a>.</strong> All rights reserved.
            </footer>

<script>
            $(document).ready(function() {
            	
               $('.building').removeClass('active');
               $('.abuilding').removeClass('active');
               $('.nuser').removeClass('active');
               $('.adduser').removeClass('active');
               $('.notify').removeClass('active');
               $('.gnotify').removeClass('active');
               $('.dnotify').removeClass('active');
               $('.complaints').addClass('active');
               $('.vcomplaints').addClass('active');
            	
            	// $('.aque').removeClass('active');
$(document).on('click', ".viewimage", function() {
              var img1=$(this).attr('img1');
              var img2=$(this).attr('img2');
              var img3=$(this).attr('img3');
              var img4=$(this).attr('img4');
              
              $('.img1').attr('src',img1);
              $('.img2').attr('src',img2);
              $('.img3').attr('src',img3);
              $('.img4').attr('src',img4);
              
             
                });
             });
            	</script>