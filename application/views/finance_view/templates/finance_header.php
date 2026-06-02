<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Finance Access</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
      <link rel="icon" href="assets/images/fevicon.png" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
 
      <link href="<?php echo base_url('assets/toggle/bootstrap4-toggle.min.css');?>" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css" />
      <!-- color css -->
      <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/colors.css" /> -->
      <!-- select bootstrap -->
      <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-select.css" /> -->
      <!-- scrollbar css -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/fontawesome-webfont.woff2" />
      <!--[if lt IE 9]>


      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
        
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.js"></script>
   </head>

<style>


.midde_cont {
    display: flex;
    flex-direction: column;
    min-height: 75vh; /* Ensure full viewport height */
}

.container-fluid {
    flex: 1; /* Fill remaining space */
}

.footer {
    background-color: darkslategrey;
    border-right: 5px solid darkgoldenrod;
    border-left: 5px solid darkgoldenrod;
    color: white;
    padding: 10px;
    margin-top: auto; /* Push the footer to the bottom */
}
.footer p{
    color:white;
}

.cursor-pointer {
        cursor: pointer;
    }

    .show-hint::after {
        content: "Click to show";
        margin-left: 5px;
        color: #999;
        font-size: 12px;
    }
    .hint-text {
        margin-left: 5px;
        color: #999;
        font-size: 12px;
    }
     .sidebar_blog_2 .list-unstyled.components li a:hover {
        background-color: lightgrey; /* Change to desired hover background color */
        border-right: 10px solid darkgrey;
    }

    .sidebar_blog_2 .list-unstyled.components li a span:hover {
        color: black; /* Change to desired text color */
        font-weight: 500; /* Change to desired background color */
    }

    .all_header_style {
        background-color: skyblue !important;
        border-right: 10px solid #11798a !important;
    }

    
    
    .all_header_style_span {
        color: black !important; /* Change text color */
        font-weight: 500 !important;
    }

    #body_name{
    border-radius: 5px;
      box-shadow:
        0px 0px 0px rgba(100, 100, 100, 0.3),
        0px 0px 0px rgba(100, 100, 100, 0.4),
        0px 0px 15px rgba(100, 100, 100, 0.5);
    }

    .btn {
         font-size: 17px;
         margin-bottom: 10px;
    }

    #sidebar.active .logo_section {
        background: center;
        margin-top: 10px;
    }
}


</style>


   <body class="dashboard dashboard_1">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                     <div class="logo_section" >
                         <?php
                            foreach($profile as $pic)
                            {
                                echo'<a href="index.html"><img class="logo_icon img-responsive" src="' . base_url() . '/assets/uploads/users/' . $pic['firstname'] . '/' . $pic['profile'] . '" alt="#" style="border-radius: 50px; width: 80px; height: 75px; background-color: aliceblue;"/></a>';
                            }
                        ?>
                     </div>
                  </div>
                  <div class="sidebar_user_info">
                    <div class="icon_setting"></div>
                    <div class="user_profle_side">
                        <div style="background-image: url('assets/images/logo/store_go_logo.png'); background-repeat: no-repeat; background-size: contain; width: 200px; height: 200px; margin-top: -71px; margin-bottom: -62px; z-index: -999;"></div>
                        <!-- Adjust width and height values as needed -->
                        <!-- Other content -->
                    </div>
                </div>

               <div class="sidebar_blog_2">
               
                  <h4><span id="show_hide" style="color:white;" 
                        data-toggle="collapse" data-target="#get_bu"
                        class="cursor-pointer">BU Handled&nbsp;<i class="fa fa-chevron-down"></i><span id="hintText" class="hint-text">Click to show</span></span> 
                        
                    
                    <div class="collapse" id="get_bu" style="text-align:center;">
                       <?php
     
                          echo '<img src="'.base_url('assets/store_logo/altacitta.png').'" class="img-fluid profile-nav" alt="Profile" style="height: 65px; border-radius:5px; width: 75px;">';
                          echo '<img src="'.base_url('assets/store_logo/alturas.png').'" class="img-fluid profile-nav" alt="Profile" style="height: 80px; width: 100px;"><br>';
                          echo '<img src="'.base_url('assets/store_logo/talibon.png').'" class="img-fluid profile-nav" alt="Profile" style="height: 70px; width: 105px;"><br>';
                          echo '<img src="'.base_url('assets/store_logo/icm.png').'" class="img-fluid profile-nav" alt="Profile" style="height: 85px; width: 95px;">';
                          echo '<img src="'.base_url('assets/store_logo/marcela.png').'" class="img-fluid profile-nav" alt="Profile" style="height: 100px; width: 90px; margin-bottom: -42px; margin-top: -31px;"><br>';
                        ?>
                    </div>
                </h4>
                  
                  <ul class="list-unstyled components">
                    
                      <li class="homepage-menu">
                          <a onclick="finance_home_js()" style="cursor: pointer"><i class="fa fa-dashboard yellow_color"></i> <span>Home</span></a>
                      </li>

                      <li class="nav_monitor_data">
                          <a onclick="finance_nav_data_js()" class="dynamic-style" style="cursor: pointer">🖥️ <span>Monitoring Navision Data</span></a>
                      </li>

                      <li class="nav_allo_basis">
                          <a onclick="finance_nav_allo_js()" class="dynamic-style" style="cursor: pointer">📊 <span>Navision Allocation Basis</span></a>
                      </li>

                      <li class="exp_monitor_data">
                          <a onclick="exp_monitor_data_js()" class="dynamic-style" style="cursor: pointer">🕹️ <span>Monitoring Expense Data</span></a>
                      </li>

                      <li class="go_expense">
                          <a onclick="go_expense_js()" class="dynamic-style" style="cursor: pointer">📈 <span>Store GO Expense</span></a>
                      </li>

                      <li class="reports_menu">
                          <a onclick="report_menu_js()" class="dynamic-style" style="cursor: pointer">💾 <span>Report</span></a>
                      </li>
                      
                  </ul>

               </div>
            </nav>

            <div id="content">
               <!-- topbar -->
               <div class="topbar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="full">
            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
            <div style="background: url('assets/images/logo/FINANCE.png') no-repeat ; background-size: contain;height: 251px; margin-top: -85px; margin-bottom: -206px; padding-bottom: 53px; margin-left: 67px;position: relative;">
                <!-- You can adjust the height and other properties here -->
            </div>
            <div class="right_topbar">
                <div class="icon_info">
                    <!-- <ul>
                        <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                        <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>
                    </ul> -->
                    <ul class="user_profile_dd">
                        <li>
                            <?php 
                                foreach($profile as $pic)
                                {
                                    echo'<a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" style="width: 38px; height: 36px;" src="' . base_url() . '/assets/uploads/users/' . $pic['firstname'] . '/' . $pic['profile'] . '" alt="#" /><span class="name_user">'.$pic['firstname'].'&nbsp;'.$pic['lastname'].'</span></a>';
                                }
                            ?>
                            
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>&nbsp;&nbsp;My Profile</a>
                                <a class="dropdown-item" onclick="leasing_about_us()"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;About Us</a>
                                <!-- <a class="dropdown-item" href="help.html">Help</a> -->
                                <a class="dropdown-item" href="<?php echo base_url('Welcome/logout') ?>"><span>Log Out</span><i class="fa fa-sign-out"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        
        var homepageMenuItem = document.querySelector('.homepage-menu');
        if (homepageMenuItem) {
            // Trigger the homepage_js() function
            finance_home_js();
        }
    });

   $(document).ready(function() {
        $('#show_hide').on('click', function() {
            $('#hintText').hide(); // Hide the hint text when the toggle button is clicked
        });

        $('#get_bu').on('hidden.bs.collapse', function () {
            $('.cursor-pointer').addClass('show-hint');
        });

        $('#get_bu').on('shown.bs.collapse', function () {
            $('.cursor-pointer').removeClass('show-hint');
        });
    });

</script>
