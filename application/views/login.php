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
    <title>Login</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
    <!-- site css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-select.css" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/perfect-scrollbar.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" />

     <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert.css">
        <!-- <script src="<?php echo base_url(); ?>assets/js/site.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/js/sweetalert.js"></script>         
        <!-- <script src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
        <script src="<?php echo base_url(); ?>assets/js/sweetalert2@11.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>
    img {
       margin-top: -140px;
       margin-bottom: -78px;
       padding-top: 44px;
    }
    </style>
<body class="inner_page login">
    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <div class="login_section">
                    <div class="logo_login">
                        <div class="center"
     style="background: url('<?php echo base_url('assets/images/logo/store_go_logo.png'); ?>') no-repeat center center;
            background-size: contain;
            height: 290px;
            margin-top: -127px;
            margin-bottom: -108px;
            padding-bottom: 53px;">
</div>
                    </div>
                    <div class="login_form">
                        <form id="loginUserForm">
                            <fieldset>
                                <div class="field">
                                    <!-- <label class="label_field hidden">Username</label> -->
                                    <input type="text" id="user" name="user" placeholder="Username" />
                                </div>
                                <div class="field">
                                    <label class="label_field hidden">Password</label>
                                    <input type="password" id="pass" name="pass" placeholder="Password" />
                                </div>
                                <div class="field">
                                    <label class="form-check-label"><input type="checkbox" id="remember-me" class="form-check-input"> Remember Me</label>
                                    <label class="label_field hidden">hidden label</label>
                                    <!-- <a class="forgot" href="">Forgotten Password?</a> -->
                                </div>
                                <div class="field margin_0" style="text-align:right;">
                                    <label class="label_field hidden">hidden label</label>
                                    <button class="main_bt">Login</button>
                                </div>
                                
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- <script src="assets/js/popper.min.js"></script> -->
    <!-- <script src="assets/js/bootstrap.min.js"></script> -->
    <!-- custom js -->
    <script>
        $(function() {
  $('#loginUserForm').submit(function(e){
    e.preventDefault();
    $.ajax({ 
            type:'POST',
            url:'<?php echo base_url('login_route'); ?>',  // This line
            data: {
                'user': $('#user').val(),
                'pass': $('#pass').val()             
            },
            dataType: 'json',
            success: function(data){
                console.log(data.response);
              if(data.response == 'Error Login')
              {
                 Swal.fire('Error', 'Invalid Password', 'error');
              }
              else 
              {
                 Swal.fire('Success', 'Successfully Login', 'success');
                location.reload();
              }
              
            }      
       });      
  });
});

   </script>

</body>
</html>




