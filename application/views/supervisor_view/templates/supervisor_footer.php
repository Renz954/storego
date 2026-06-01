<div class="container-fluid">
                     <div class="footer" >
                        <p>Alturas Group of Companies © 2024 <br>Designed by html.design. All rights reserved.<br>
                        </p>
                     </div>
                  </div>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.js"></script>
<script src="<?php echo base_url('assets/toggle/bootstrap4-toggle.min.js'); ?>"></script>
<!-- jQuery and jQuery-dependent Plugins -->

<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap-select.js"></script> -->

<!-- Other Scripts -->
<script src="<?php echo base_url(); ?>assets/js/perfect-scrollbar.min.js"></script>
<script>
    var ps = new PerfectScrollbar('#sidebar');
</script>
<script src="<?php echo base_url(); ?>assets/js/animate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>assets/js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/Chart.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/utils.js"></script>
<script src="<?php echo base_url(); ?>assets/js/analyser.js"></script>
<script src="<?php echo base_url(); ?>assets/js/calendar.js"></script>

<!-- Custom Scripts -->
<!-- <script src="<?php echo base_url(); ?>assets/js/chart_custom_style1.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>


<script src="<?php echo base_url('assets/css/jquery.dataTables.min.js'); ?>"></script>
<link href="<?php echo base_url('assets/css/jquery.dataTables.min.css');?>" rel="stylesheet">
      <!-- nice scrollbar -->
<script src="<?php echo base_url(); ?>assets/js/sweetalert2@11.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
      <!-- custom js -->
   
<script>
   function supervisor_home_js()
   { 
        document.querySelector('.data-menu').classList.remove('data-header-style');
        document.querySelector('.data-menu span').classList.remove('data-header-style-span');
        document.querySelector('.expense-menu').classList.remove('expense-header-style');
         document.querySelector('.expense-menu span').classList.remove('expense-header-style-span');

        document.querySelector('.homepage-menu').classList.add('home-header-style');
        document.querySelector('.homepage-menu span').classList.add('home-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>supervisor_home_route');   
      $("#header_name").html("🧮DASHBOARD");   
   }

   function supervisor_nav_data_js()
   {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.expense-menu').classList.remove('expense-header-style');
         document.querySelector('.expense-menu span').classList.remove('expense-header-style-span');

         document.querySelector('.data-menu').classList.add('data-header-style');
         document.querySelector('.data-menu span').classList.add('data-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>supervisor_nav_data_route');   
      $("#header_name").html("🗳️ Navision Allocation Approval"); 
   }

   function supervisor_store_expense_js()
   {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.data-menu').classList.remove('data-header-style');
         document.querySelector('.data-menu span').classList.remove('data-header-style-span');

         document.querySelector('.expense-menu').classList.add('expense-header-style');
         document.querySelector('.expense-menu span').classList.add('expense-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>supervisor_store_expense_route');   
      $("#header_name").html("💸 Store Expense Approval"); 
   }

   function leasing_about_us()
   {
        $("#body_name").html("");
        $("#body_name").load('<?php echo base_url(); ?>leasing_about_us_route');   
        $("#header_name").html("🛈 About Us"); 
   }
   function my_profile()
   {
        $("#body_name").html("");
        $("#body_name").load('<?php echo base_url(); ?>my_profile_route');   
        $("#header_name").html("Profile"); 
   }

   function updatePhoto() 
   {
         // Get file and password values
         var fileInput = document.getElementById('file1');
         var passwordInput = document.getElementById('password');
         var file = fileInput.files[0];
         var password = passwordInput.value;

         // Validation
         if (!file) {
             Swal.fire('Please select a file.', 'It is required', 'error');
             return;
         }

         if (file.size > 2 * 1024 * 1024) { // 2MB limit
             Swal.fire('File size must be less than 2MB.', 'Choose another photo', 'error');
             return;
         }

         if (!['image/jpeg', 'image/png', 'image/gif'].includes(file.type)) {
             Swal.fire('Only JPEG, PNG, and GIF images are allowed.', 'Choose another photo', 'error');
             return;
         }

         if (!password) {
             Swal.fire('Please enter your password.', 'It is required', 'error');
             return;
         }

         // Create FormData object
         var formData = new FormData();
         formData.append('file1', file);
         formData.append('password', password);

         // AJAX request
         $.ajax({
             url: 'updatePhoto_route', // Replace with your server-side script URL
             type: 'POST',
             data: formData,
             processData: false, // Needed to send FormData object as is
             contentType: false, // Needed to send FormData object as is
             dataType: 'json', // Expecting JSON response from the server
             success: function(response) {
                 if (response.status === 'success') {
                     Swal.fire(response.message, '', 'success');
                     my_profile();
                 } else {
                     Swal.fire(response.message, '', 'error');
                 }
             },
             error: function(xhr, status, error) {
                 Swal.fire('An error occurred: ' + error, '', 'error');
             }
         });
     }

     function updatePassword() 
     {
         // Get values from the form inputs
         const oldPassword = $('#old_password').val();
         const newPassword = $('#new_password').val();
         const repeatPassword = $('#repeat_password').val();

         // Simple validation check
         if (newPassword !== repeatPassword) {
             Swal.fire("New Password and Repeat Password do not match.", '', 'error');
             return;
         }

         // Prepare data to send
         const formData = {
             old_password: oldPassword,
             new_password: newPassword
         };

         // AJAX request using jQuery
         $.ajax({
             url: 'updatePassword_route', // Replace with your actual endpoint
             type: 'POST',
             data: formData,
             dataType: 'json', // Expecting JSON response from the server
             success: function(response) {
                 if (response.success) {
                     Swal.fire("Password updated successfully.", '', 'success');
                     my_profile();
                 } else {
                     Swal.fire(response.message, '', 'error');
                 }
             },
             error: function(xhr, status, error) {
                 Swal.fire('An error occurred: ' + error, '', 'error');
             }
         });
     }
   
   function account_home_js()
   {
        $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>account_home_route',
              data: { 'store_id' : $("#bu_ids option:selected").val() },
              dataType: 'json',
              success: function(data) {
              $("#nav-pending").html(data.html);   
              $("#badge_id").html(data.badge_count);   
              $("#nav_lacking").html(data.lacking_nav);   
              $("#lack_badge_id").html(data.lack_badge_nav);   
              $("#expense-pending").html(data.expense);   
              $("#expense_badge_id").html(data.badge_expense_count);   
              $("#expense_lacking").html(data.lacking_expense);   
              $("#lack_badge_exp").html(data.lack_badge_exp);   
              }
            });
   }

    function select_nav_data_js()
    {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>select_acct_nav_data_route',
            data:{
                     'month_id': $("#month_id option:selected").val(),
                     'year_id' : $("#year_id option:selected").val(),
                     'store_id' : $("#store_id option:selected").val(),
                     'status_id' : $("#status_id option:selected").val()
                },
            dataType: 'json',
            success: function(data) {
            $("#select_all").text(data.approved_disable);  
            $("#month_id").html(data.select_month);  
            $("#table_accounting_store_data").html(data.tbl_html);  

            }
          });
    }

    function thrc_check_dis_js()
    {
         if($("#th_checkbox_dis").prop("checked") == true)
          {
              $(".td_checkbox_dis").prop( "checked", true );  
              $("#th_checkbox_app").prop( "checked", false );  
              $("#th_checkbox_app").prop( "disabled", true );  
              $(".td_checkbox_app").prop( "checked", false );  
              $(".td_checkbox_app").prop( "disabled", true ); 
              $(".td_checkbox_dis").prop( "disabled", false ); 
          }
          else
          {
              $(".td_checkbox_dis").prop( "checked", false );
              $("#th_checkbox_app").prop( "disabled", false );
              $(".td_checkbox_app").prop( "disabled", false );   
          } 

    }

    function thrc_checked_js()
    {
         if($("#th_checkbox_app").prop("checked") == true)
          {
              $(".td_checkbox_app").prop( "checked", true );  
              $("#th_checkbox_dis").prop( "checked", false );  
              $("#th_checkbox_dis").prop( "disabled", true );  
              $(".td_checkbox_dis").prop( "checked", false );  
              $(".td_checkbox_dis").prop( "disabled", true );  
              $(".td_checkbox_app").prop( "disabled", false );  
          }
          else
          {
              $(".td_checkbox_app").prop( "checked", false );
              $("#th_checkbox_dis").prop( "disabled", false );  
              $(".td_checkbox_dis").prop( "disabled", false );    
          } 

    }

    function approve_check_js(check)
    {
           if($("#approved_id_check_"+check).prop("checked") == true)
            {
                $("#disapproved_id_check_"+check).prop("checked", false);
                $("#disapproved_id_check_"+check).prop("disabled", true);
            }
            else
            {
                 $("#disapproved_id_check_"+check).prop("disabled", false);
            }
                             
    }

    function disapprove_check_js(check)
    {
          if($("#disapproved_id_check_"+check).prop("checked") == true)
            {
                $("#approved_id_check_"+check).prop("checked", false);
                $("#approved_id_check_"+check).prop("disabled", true);
            }
            else
            {
                 $("#approved_id_check_"+check).prop("disabled", false);
            }
    }

    function nav_status_js()
    {
          var selectedValues = [];
          $('.checkbox_select:checked').each(function() {
              selectedValues.push($(this).val());
          });

            
        if (selectedValues.length === 0) 
           {
            Swal.fire('Select to Proceed', 'Please select you want to update status', 'error');
           }else{
          $.ajax({
            type: "POST",
             url: '<?php echo base_url(); ?>nav_status_route',
            data: {
              'checkboxes': selectedValues
            },
            dataType: 'json',
            success: function(response) {
                Swal.fire('The Status is change', '', 'success');
                select_nav_data_js();
            }
          });
         }
    }

    function select_exp_data_js()
    {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>select_exp_data_route',
            data:{
                     'month_id': $("#month_id option:selected").val(),
                     'year_id' : $("#year_id option:selected").val(),
                     'store_id' : $("#store_id option:selected").val(),
                     'store_exp_id' : $("#status_exp_id option:selected").val()
                },
            dataType: 'json',
            success: function(data) {
            $("#select_all").text(data.approved_disable);    
            $("#month_id").html(data.select_month);  
            $("#table_expense_store_data").html(data.tbl_html);  

            }
          });
    }

    function expense_status_js(dataTable)
      {
          var selectedValues = [];
          var currentPage = dataTable.page(); // Store the current page

          // Iterate through all DataTable pages
          for (var i = 0; i < dataTable.page.info().pages; i++) {
              dataTable.page(i).draw(false); // Draw the specific page without changing the current page

              // Collect selected values from checkboxes on the current page
              $('.checkbox_select:checked').each(function() {
                  selectedValues.push($(this).val());
              });
          }

          // Return to the original page
          dataTable.page(currentPage).draw(false); // Draw the original page

          // Now, selectedValues contains the values of all selected checkboxes from all pages
          console.log(selectedValues);


          // var selectedValues = [];
          // $('.checkbox_select:checked').each(function() {
          //     selectedValues.push($(this).val());
          // });

            
        if (selectedValues.length === 0) 
           {
            Swal.fire('Select to Proceed', 'Please select you want to update status', 'error');
           }else{
          $.ajax({
            type: "POST",
             url: '<?php echo base_url(); ?>expense_status_route',
            data: {
              'checkboxes': selectedValues
            },
            dataType: 'json',
            success: function(response) {
                Swal.fire('The Status is change', '', 'success')
                select_exp_data_js();
            }
          });
         }
      }

    function approveData(month, year, bu_id, pending)
    {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.expense-menu').classList.remove('expense-header-style');
         document.querySelector('.expense-menu span').classList.remove('expense-header-style-span');

         document.querySelector('.data-menu').classList.add('data-header-style');
         document.querySelector('.data-menu span').classList.add('data-header-style-span');

        var url = '<?php echo base_url("supervisor_nav_data_route"); ?>?month=' + month + '&year=' + year + '&bu_id=' + bu_id + '&pending=' + pending;
        $("#body_name").load(url);
        $("#header_name").html("🗳️ Navision Allocation Approval");
    }

    function approve_expense_Data(month, year,bu_id,pending)
    {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.data-menu').classList.remove('data-header-style');
         document.querySelector('.data-menu span').classList.remove('data-header-style-span');

         document.querySelector('.expense-menu').classList.add('expense-header-style');
         document.querySelector('.expense-menu span').classList.add('expense-header-style-span');

        var url = '<?php echo base_url("supervisor_store_expense_route"); ?>?month=' + month + '&year=' + year + '&bu_id=' + bu_id + '&pending=' + pending;
        $("#body_name").load(url);
        $("#header_name").html("💸 Store Expense Approval");
    }
   

   </script>   
   </body>
</html>