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
            $http.get('<?php echo site_url('Candidates/fetch_all'); ?>').success(function($data){
                console.log(JSON.parse(JSON.stringify($data)));
                $scope.users = $data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 20; //max no of items to display in a page
                $scope.filteredItems = $scope.users.length; //Initially for no filter  
            });
        }
        
        
      $scope.download = function(candidateid) {
        //alert($id);
        $http({

        method: 'POST',
        data:{
            candidate_id: candidateid,
        },
        url: '<?php echo site_url('Candidates/Download');?>',
        responseType: 'arraybuffer'
    }).success(function(data) {
                         //alert(data);
                         var blob = new Blob([data], {type: "application/pdf"});
                         var objectUrl = URL.createObjectURL(blob);
                         window.open(objectUrl);             
                })
                
                
    };
       
       
       $scope.sendMail = function(candidateid) {
        //alert($id);
        $http.post('<?php echo site_url('Candidates/MailResult');?>',
                        {
                            'candidate_id': candidateid,
                    
                        }
                )
                        .success(function(data) {

                   alert(data);
                    //alert("Question Set Deleted Successfully");
                })
                
                
    };
       
        
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
                                        <h3 class="box-title">Members</h3>
                                    </div><!-- /.box-header -->
                                   <p><input type="text" ng-model="test" class="form-control" placeholder="Search By Email Address / Name /Flat No"></p>
                                    <div class="box-body">
                                        <table ng-init="get_product()" id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <td><b>ID</b></td>
                                                    <td><b>Name</b></td>
                                                    <td><b>Email Id</b></td>
                                                    <td><b>Building</b></td>
                                                    <td><b>Flat No</b></td>
                                                    <td><b>Action</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                    <td>1</td>
                                                    <td>demo</td>
                                                    <td>demo@demo.com</td>
                                                    <td>Infina - B</td>
                                                    <td>25</td>
                                                    <td><a href="" ng-click="download(user.id)"></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-md-12" ng-show="filteredItemsGallery > 0">    
                                            <div pagination="" page="currentPageGallery" on-select-page="setPageGallery(page)" boundary-links="true" total-items="filteredItemsGallery" items-per-page="entryLimitGallery" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
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
               $('.complaints').removeClass('active');
              $('.vcomplaints').removeClass('active');
              $('.member').addClass('active');
              $('.vmember').addClass('active');
               $('.pass').removeClass('active');
                $('.chpass').removeClass('active');
                
                // $('.aque').removeClass('active');
                 });
                </script><?php

?>