<html>
    <!DOCTYPE html>
   
        <head>
            <meta charset="utf-8">
            <title>Exam</title>

            <!-- Bootstrap 3.3.5 -->
            <link href=<?php echo base_url("bootstrap/css/bootstrap.min.css"); ?> rel='stylesheet' type='text/css' />

            <!-- Font Awesome -->

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <!-- daterange picker -->
            <link href=<?php echo base_url("plugins/daterangepicker/daterangepicker-bs3.css"); ?> rel='stylesheet' type='text/css' />
            <link href=<?php echo base_url("plugins/datatables/dataTables.bootstrap.css"); ?> rel='stylesheet' type='text/css' />

            <!-- iCheck for checkboxes and radio inputs -->
            <link href=<?php echo base_url("plugins/iCheck/all.css"); ?> rel='stylesheet' type='text/css' />

            <!-- Bootstrap Color Picker -->
            <link href=<?php echo base_url("plugins/colorpicker/bootstrap-colorpicker.min.css"); ?> rel='stylesheet' type='text/css' />

            <!-- Bootstrap time Picker -->
            <link href=<?php echo base_url("plugins/timepicker/bootstrap-timepicker.min.css"); ?> rel='stylesheet' type='text/css' />

            <!-- Select2 -->
            <link href=<?php echo base_url("plugins/select2/select2.min.css"); ?> rel='stylesheet' type='text/css' />

            <!-- Theme style -->
            <link href=<?php echo base_url("dist/css/AdminLTE.min.css"); ?> rel='stylesheet' type='text/css' />

            <link href=<?php echo base_url("dist/css/skins/_all-skins.min.css"); ?> rel='stylesheet' type='text/css' />

            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script>
            
            
            
         </head>   
        <body class="hold-transition skin-blue sidebar-mini" >
            <div class="wrapper">

                <header class="main-header">
                    <!-- Logo -->
                    <a href="<?php echo base_url() . "index.php/Home"; ?>" class="logo">                   
                        <span class="logo-mini"><b>PI</b></span>                 
                        <span class="logo-lg">PI</span>
                    </a>            
                    <nav class="navbar navbar-static-top" role="navigation">                   
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a  class="dropdown-toggle" style="display: inline-block;position: absolute;color: white;font-size: 30px;margin-top: 3px;">
                            <span class="hidden-xs">ParkInfinia</span>
                        </a>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">                           
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="hidden-xs">Admin Sign out</span>
                                    </a>
                                    <ul class="dropdown-menu">  
                                        <!--<li class="user-footer">

                                            <a class="btn btn-default btn-flat" id="forgot_password" href="<?php echo base_url() . "index.php/Forgotpass/forgotpassmethod"; ?>">Change Password </a>
                                        </li> -->                                
                                        <li class="user-footer">
                                            <a href="<?php echo base_url() . "index.php/Logout"; ?>" class="btn btn-default btn-flat">Sign out</a>
                                        </li>
                                    </ul>
                                </li>                      
                            </ul>
                        </div>
                    </nav>
                </header>
                <aside class="main-sidebar">
                    <!-- sidebar: style can be found in sidebar.less -->
                    <section class="sidebar">                   
                        <ul class="sidebar-menu">
                            <li class="header">MAIN NAVIGATION</li>
                            <?php
                            $newdata = $this->session->all_userdata();
                            if (empty($newdata['userType'])) {
                              
                            } else {
                                if ($newdata['userType'] == "1") {
                                    ?>
                                    <li class="active treeview"><a href="<?php echo base_url() . "index.php/Dashboard/"; ?>"><i class="fa fa-circle-o text-yellow"></i> <span>Dashboard</span></a></li>
                                    <li class="treeview building">
                                    <a href="#">
                                        <i class="fa fa-edit text-aqua"></i> <span>Building</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="abuilding"><a href="<?php echo base_url() . "index.php/Buildings/"; ?>"><i class="fa fa-circle-o text-aqua"></i>Add new building in society</a></li>                                
                                    </ul>
                                </li>

                                    <li class="treeview nuser">
                                    <a href="#">
                                        <i class="fa fa-edit text-aqua"></i> <span>Users</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="adduser"><a href="<?php echo base_url() . "index.php/AddUsers/"; ?>"><i class="fa fa-circle-o text-aqua"></i>Add new user</a></li>
                                        <!--<li class="dqset"><a href="#""><i class="fa fa-circle-o text-red"></i>Attach Building/Flats to user</a></li>-->                                
                                    </ul>
                                </li>
                                <li class="treeview notify">
                                    <a href="#">
                                        <i class="fa fa-edit text-aqua"></i> <span>Notification</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="gnotify"><a href="<?php echo base_url() . "index.php/Notifications/GeneralNotice"; ?>"><i class="fa fa-circle-o text-red"></i>General Notice</a></li>
                                        <li class="dnotify"><a href="<?php echo base_url() . "index.php/Notifications/DueNotice"; ?>"><i class="fa fa-circle-o text-red"></i>Due Notice</a></li>                                
                                    </ul>
                                </li>
                                <li class="treeview complaints">
                                    <a href="#">
                                        <i class="fa fa-edit text-aqua"></i> <span>Complaints</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="vcomplaints"><a href="<?php echo base_url() . "index.php/Complaints/"; ?>"><i class="fa fa-circle-o text-red"></i>View Complaints</a></li>
                                                                        
                                    </ul>
                                </li>
                                     <li class="treeview stuall">
                                    <a href="#">
                                        <i class="fa fa-edit text-aqua"></i> <span>Payment's</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="dues"><a href="<?php echo base_url() . "index.php/Dues/"; ?>"><i class="fa fa-circle-o text-red"></i>Take Maintainance</a></li>                  
                                    </ul>
                                </li>                                
                                <li class="treeview member">
                                    <a href="#">
                                        <i class="fa fa-edit text-aqua"></i> <span>Members</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="vmember"><a href="<?php echo base_url() . "index.php/MemberList/"; ?>"><i class="fa fa-circle-o text-red"></i>List of all members in society</a></li>                  
                                    </ul>
                                </li> 

                                   <li class="treeview pass">
                                    <a href="#">
                                        <i class="fa fa-edit text-aqua"></i> <span>Setting's</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="chpass"><a href="<?php echo base_url() . "index.php/Settings/ChangePassword"; ?>"><i class="fa fa-circle-o text-red"></i>Change Password</a></li>
                                        <li class="setmaintain"><a href="<?php echo base_url() . "index.php/Settings/SetMaintainance"; ?>"><i class="fa fa-circle-o text-red"></i>Society Maintainance</a></li>                                
                                    </ul>  
                                </li>
                                    <?php
                                }
                            }
                            ?>  

                         

                        </ul>
                    </section>
                    <!-- /.sidebar -->
                </aside>
                <script type="text/javascript" src=<?php echo base_url("js/jquery-1.10.2.min.js"); ?>></script>
        <!-- Bootstrap 3.3.5 -->
        <script type="text/javascript" src=<?php echo base_url("bootstrap/js/bootstrap.min.js"); ?>></script>

        <!-- DataTables -->

        <script type="text/javascript" src=<?php echo base_url("plugins/datatables/dataTables.bootstrap.min.js"); ?>></script>

        <script type="text/javascript" src=<?php echo base_url("plugins/slimScroll/jquery.slimscroll.min.js"); ?>></script>
        <!-- SlimScroll -->

        <!-- FastClick -->
        <script type="text/javascript" src=<?php echo base_url("plugins/fastclick/fastclick.min.js"); ?>></script>

        <!-- AdminLTE App -->
        <script type="text/javascript" src=<?php echo base_url("dist/js/app.min.js"); ?>></script>
        <script type="text/javascript" src=<?php echo base_url("dist/js/demo.js"); ?>></script>
        <!-- AdminLTE for demo purposes -->
        <script type="text/javascript" src=<?php echo base_url("angulerJS/ui-bootstrap-tpls-0.10.0.min.js"); ?>></script>
<!--        <script type="text/javascript" src=<?php //echo base_url("js/jquery.js");   ?>></script>-->

        <script type="text/javascript" src=<?php echo base_url("js/jquery.form.min.js"); ?>></script>
        
    </html>