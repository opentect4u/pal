<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('/assets/images/logo1.png'); ?>">
        <title><?php echo $title;?></title>
        <link href="<?php echo base_url('/assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <?php 

            if($link){

                echo "\n";

                foreach($link as $list){

                    echo "\t\t";

                    echo '<link href="'.base_url($list).'" rel="stylesheet">';

                    echo "\n";

                }

            }
        
        ?>
        
        <link href="<?php echo base_url('/css/style.css'); ?>" rel="stylesheet">

        <link href="<?php echo base_url('/css/colors/blue.css'); ?>" id="theme" rel="stylesheet">
        
    </head>

    <body class="fix-header fix-sidebar card-no-border">
        
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        
        <div id="main-wrapper">
            
            <header class="topbar">

                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo site_url('auths/home'); ?>">
                            <b>
                                
                                
                                <img src="<?php echo base_url('/assets/images/logo1.png'); ?>" alt="Logo" class="dark-logo" />
                                
                                <img src="<?php echo base_url('/assets/images/logo1.png'); ?>" alt="Name" class="light-logo" height="45px" />

                            </b>
                            
                            <span>
                            <img src="<?php echo base_url('/assets/images/logo2.png'); ?>" alt="homepage" class="dark-logo" />    
                            <img src="<?php echo base_url('/assets/images/logo2.png'); ?>" class="light-logo" alt="homepage" height="30px" /></span> </a>
                    </div>
                    
                    <div class="navbar-collapse">
                        
                        <ul class="navbar-nav mr-auto mt-md-0">
                            
                            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                            <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                            
                        </ul>
                        
                        <ul class="navbar-nav my-lg-0">
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url($user_dtls->img_path); ?>" height="30" width="30" alt="user" class="profile-pic" /></a>
                                <div class="dropdown-menu animated flipInY dropdown-menu-right">
                                    <ul class="dropdown-user">
                                        <li>
                                            <div class="dw-user-box">
                                                <div class="u-img"><img src="<?php echo base_url($user_dtls->img_path); ?>" alt="user"></div>
                                                <div class="u-text">
                                                    <h4 style="width: 100px;"><?php echo $user_dtls->emp_name; ?></h4>
                                                    <p class="text-muted"></p><a href="<?php echo site_url('profiles'); ?>" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                            </div>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="<?php echo site_url('auths/logout'); ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </li>
                            
                        </ul>

                    </div>

                </nav>

            </header>
            
            <aside class="left-sidebar">
                
                <div class="scroll-sidebar">
                    
                    <div class="user-profile" style="background: url(<?php echo base_url('/assets/images/background/user-info.jpg'); ?>) no-repeat;">
                        
                        <div class="profile-img"> <img src="<?php echo base_url($user_dtls->img_path); ?>" alt="user" height="50" width="50" /> </div>
                        
                        <div class="profile-text"> <a href="#" ><?php echo $user_dtls->emp_name; ?></a>
                        </div>
                    </div>    
                     
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            
                            <li> <a class="has-arrow waves-effect waves-dark" href="<?php echo site_url('auths/home'); ?>" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a> 
                            </li>
                            <li class="nav-small-cap"></li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-calendar-today"></i><span class="hide-menu">Leave</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    
                                    <li><a href="<?php echo site_url('leave'); ?>">Full Leave Application Form</a></li>
                                    <li><a href="<?php echo site_url('leave/half'); ?>">Half Leave Application Form</a></li>
                                    <li><a href="<?php echo site_url('leave/compoff'); ?>">Full Comp Off Apply Form</a></li>
                                    <li><a href="<?php echo site_url('leave/compoffhalf'); ?>">Half Comp Off Apply Form</a></li>

                                    <?php 
                                        
                                        if($this->session->userdata('loggedin')->emp_type == 'H'){
                                            
                                            //For HOD Only
                                    ?>
                                            <li><a href="<?php echo site_url('leave/recommend'); ?>">Leave Recommend</a></li>
                                            <li><a href="<?php echo site_url('leave/comprecommend'); ?>">Recommend Comp Off</a></li>

                                    <?php
                                        }
                                        if($this->session->userdata('loggedin')->emp_type == 'HR'){

                                            //For HR Only
                                    ?>      
                                            <li><a href="<?php echo site_url('leave/recommend'); ?>">Leave Recommend</a></li>
                                            <li><a href="<?php echo site_url('leave/comprecommend'); ?>">Recommend Comp Off</a></li>
                                            <li><a href="<?php echo site_url('leave/approve'); ?>">Leave Approve</a></li>
                                            <li><a href="<?php echo site_url('leave/compapprove'); ?>">Comp Off Approve</a></li>
                                            <li><a href="<?php echo site_url('leave/reject'); ?>">Reject Approved Leave</a></li>
                                            <li><a href="<?php echo site_url('leaves/closings'); ?>">Closing Balances</a></li>

                                    <?php
                                    
                                        }

                                    ?>

                                    <!--<li><a href="<?php echo site_url('leave/cancle'); ?>">Leave Cancel</a></li>-->
                                    
                                    <li><a href="#" class="has-arrow"><strong>Reports</strong> </a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?php echo site_url('leave/ledger'); ?>">Leave Ledger</a></li>
                                            <li><a href="<?php echo site_url('leave/details'); ?>">Leave Details</a></li>
                                        <?php
                                            if($this->session->userdata('loggedin')->emp_type == 'HR'){
                                        ?>
                                            <li><a href="<?php echo site_url('leave/details_all'); ?>">All Leave Details</a></li>
                                        <?php
                                            }    
                                        ?>        
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-rupee-sign"></i><span class="hide-menu">Payroll</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    
                                    <li><a href="<?php echo site_url('payroll/payslips'); ?>">Payslips</a></li>
                                    
                                    <?php
                                        
                                        if($this->session->userdata('loggedin')->emp_type == 'HR'){

                                            //For HR Only
                                    ?>

                                        <li><a href="<?php echo site_url('payroll/statements'); ?>">Earnings & Deductions</a></li>
                                        <li><a href="<?php echo site_url('payroll/payslipgeneration'); ?>">Generate Payslips</a></li>
                                        <li><a href="#" class="has-arrow"><strong>Reports</strong> </a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?php echo site_url('payroll/payment'); ?>">Payslip Details</a></li>
                                            <li><a href="<?php echo site_url('payroll/payslipdetails'); ?>">Payment Details</a></li>
                                        </ul>
                                    <?php
                                            
                                        }

                                    ?>                                        
                                </ul>
                            </li>
                            
                            
                            <?php
                                
                                if($this->session->userdata('loggedin')->emp_type == 'HR'){
                                    
                                    //For HR Only
                            ?>
                                    <!-- <li><a href="<?php echo site_url('attendance'); ?>">Attendance Details</a></li>                                         -->
                                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="far fa-clock"></i><span class="hide-menu">Attendance</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?php echo site_url('attendance/absents'); ?>">Absent & Half</a></li>                                        
                                        </ul>
                                    </li>    
                                    <!-- <li><a href="#" class="has-arrow"><strong>Reports</strong> </a>
                                        <ul aria-expanded="false" class="collapse">                                   
                                            
                                            <li><a href="<?php echo site_url('attendance/report/all-emp'); ?>">All Employees</a></li>
                                            <li><a href="<?php echo site_url('attendance/report/ind-emp'); ?>">Individual Employee</a></li>                                        

                                        </ul>
                                    </li> -->

                                    <?php
                                            
                                        }
                                            
                                    ?>

                                        <!-- <li><a href="<?php echo site_url('attendance/report/ind-emp'); ?>">Attendance Report</a></li>                                         -->
                                                            
                            
                            <li class="nav-devider"></li>
                        <?php
                                        
                            if($this->session->userdata('loggedin')->emp_type == 'HR'){

                                //For HR Only
                        ?>    
                            
                            <li class="nav-small-cap"></li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-book-multiple"></i><span class="hide-menu">Administrator</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo site_url('department'); ?>">Add Department</a></li>
                                    <li><a href="<?php echo site_url('employees'); ?>">Add Employee</a></li>
                                    <li><a href="<?php echo site_url('employees/assign'); ?>">Assign Employees</a></li>
                                    <li class="nav-devider"></li>
                                    <li><a href="<?php echo site_url('leave/forwardleaves'); ?>">Forward Leaves</a></li>
                                </ul>
                            </li>
                        
                        <?php
                                
                            }

                        ?>

                            <br><br><br><br><br>
                        </ul>
                    </nav>
                    
                </div>
                 
                <div class="sidebar-footer">

                    <a href="<?php echo site_url('profile'); ?>" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                    <a href="" class="link" data-toggle="tooltip" title="Email"></i></a>
                    <a href="<?php echo site_url('auths/logout'); ?>" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> 
                    
                </div>

            </aside>
            
            <div class="page-wrapper">
                
                <div class="container-fluid">
                    
                   