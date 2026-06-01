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
      <!-- nice scrollbar -->
<script src="<?php echo base_url(); ?>assets/js/sweetalert2@11.js"></script>
<script src="<?php echo base_url('assets/js/xlsx.js'); ?>"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
      <!-- custom js -->
   
<script>
   function bookkeeper_home_js()
   { 
        document.querySelector('.agency_record_menu').classList.remove('all_header_style');
        document.querySelector('.agency_record_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_report_menu').classList.remove('all_header_style');
        document.querySelector('.agency_report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_menu').classList.remove('all_header_style');
        document.querySelector('.nav_allo_menu span').classList.remove('all_header_style_span');
        document.querySelector('.go_exp_menu').classList.remove('all_header_style');
        document.querySelector('.go_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_exp_menu').classList.remove('all_header_style');
        document.querySelector('.agency_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.report_menu').classList.remove('all_header_style');
        document.querySelector('.report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.code_setup_menu').classList.remove('all_header_style');
        document.querySelector('.code_setup_menu span').classList.remove('all_header_style_span');

        document.querySelector('.homepage-menu').classList.add('all_header_style');
        document.querySelector('.homepage-menu span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>bookkeeper_home_route');   
      $("#header_name").html("🧮DASHBOARD");   
   }

   function book_agency_record_js()
   {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_report_menu').classList.remove('all_header_style');
        document.querySelector('.agency_report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_menu').classList.remove('all_header_style');
        document.querySelector('.nav_allo_menu span').classList.remove('all_header_style_span');
        document.querySelector('.go_exp_menu').classList.remove('all_header_style');
        document.querySelector('.go_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_exp_menu').classList.remove('all_header_style');
        document.querySelector('.agency_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.report_menu').classList.remove('all_header_style');
        document.querySelector('.report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.code_setup_menu').classList.remove('all_header_style');
        document.querySelector('.code_setup_menu span').classList.remove('all_header_style_span');

        document.querySelector('.agency_record_menu').classList.add('all_header_style');
        document.querySelector('.agency_record_menu span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>book_agency_route');   
      $("#header_name").html("📰 Agency Employee's Record"); 
   }

   function book_agency_report_js()
   {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_record_menu').classList.remove('all_header_style');
        document.querySelector('.agency_record_menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_menu').classList.remove('all_header_style');
        document.querySelector('.nav_allo_menu span').classList.remove('all_header_style_span');
        document.querySelector('.go_exp_menu').classList.remove('all_header_style');
        document.querySelector('.go_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_exp_menu').classList.remove('all_header_style');
        document.querySelector('.agency_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.report_menu').classList.remove('all_header_style');
        document.querySelector('.report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.code_setup_menu').classList.remove('all_header_style');
        document.querySelector('.code_setup_menu span').classList.remove('all_header_style_span');

        document.querySelector('.agency_report_menu').classList.add('all_header_style');
        document.querySelector('.agency_report_menu span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>book_agency_report_route');   
      $("#header_name").html("📊 Agency Report"); 
   }

   function book_nav_allo_js()
   {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_record_menu').classList.remove('all_header_style');
        document.querySelector('.agency_record_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_report_menu').classList.remove('all_header_style');
        document.querySelector('.agency_report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.go_exp_menu').classList.remove('all_header_style');
        document.querySelector('.go_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_exp_menu').classList.remove('all_header_style');
        document.querySelector('.agency_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.report_menu').classList.remove('all_header_style');
        document.querySelector('.report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.code_setup_menu').classList.remove('all_header_style');
        document.querySelector('.code_setup_menu span').classList.remove('all_header_style_span');

        document.querySelector('.nav_allo_menu').classList.add('all_header_style');
        document.querySelector('.nav_allo_menu span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>book_nav_allo_route');   
      $("#header_name").html("📚 Navision Allocation Basis"); 
   }

   function book_go_exp_js()
   {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_record_menu').classList.remove('all_header_style');
        document.querySelector('.agency_record_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_report_menu').classList.remove('all_header_style');
        document.querySelector('.agency_report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_menu').classList.remove('all_header_style');
        document.querySelector('.nav_allo_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_exp_menu').classList.remove('all_header_style');
        document.querySelector('.agency_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.report_menu').classList.remove('all_header_style');
        document.querySelector('.report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.code_setup_menu').classList.remove('all_header_style');
        document.querySelector('.code_setup_menu span').classList.remove('all_header_style_span');

        document.querySelector('.go_exp_menu').classList.add('all_header_style');
        document.querySelector('.go_exp_menu span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>book_go_exp_route');   
      $("#header_name").html("💵 Monthly Store GO Expense"); 
   }

   function book_agency_exp_js()
   {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_record_menu').classList.remove('all_header_style');
        document.querySelector('.agency_record_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_report_menu').classList.remove('all_header_style');
        document.querySelector('.agency_report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_menu').classList.remove('all_header_style');
        document.querySelector('.nav_allo_menu span').classList.remove('all_header_style_span');
        document.querySelector('.go_exp_menu').classList.remove('all_header_style');
        document.querySelector('.go_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.report_menu').classList.remove('all_header_style');
        document.querySelector('.report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.code_setup_menu').classList.remove('all_header_style');
        document.querySelector('.code_setup_menu span').classList.remove('all_header_style_span');

        document.querySelector('.agency_exp_menu').classList.add('all_header_style');
        document.querySelector('.agency_exp_menu span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>book_agency_exp_route');   
      $("#header_name").html("🤑 Agency Expense Breakdown"); 
   }

   function book_report_js()
   {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_record_menu').classList.remove('all_header_style');
        document.querySelector('.agency_record_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_report_menu').classList.remove('all_header_style');
        document.querySelector('.agency_report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_menu').classList.remove('all_header_style');
        document.querySelector('.nav_allo_menu span').classList.remove('all_header_style_span');
        document.querySelector('.go_exp_menu').classList.remove('all_header_style');
        document.querySelector('.go_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_exp_menu').classList.remove('all_header_style');
        document.querySelector('.agency_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.code_setup_menu').classList.remove('all_header_style');
        document.querySelector('.code_setup_menu span').classList.remove('all_header_style_span');

        document.querySelector('.report_menu').classList.add('all_header_style');
        document.querySelector('.report_menu span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>book_report_route');   
      $("#header_name").html("📁 Allocation Report"); 
   }

   function book_code_setup_js()
   {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_record_menu').classList.remove('all_header_style');
        document.querySelector('.agency_record_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_report_menu').classList.remove('all_header_style');
        document.querySelector('.agency_report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_menu').classList.remove('all_header_style');
        document.querySelector('.nav_allo_menu span').classList.remove('all_header_style_span');
        document.querySelector('.go_exp_menu').classList.remove('all_header_style');
        document.querySelector('.go_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_exp_menu').classList.remove('all_header_style');
        document.querySelector('.agency_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.report_menu').classList.remove('all_header_style');
        document.querySelector('.report_menu span').classList.remove('all_header_style_span');

        document.querySelector('.code_setup_menu').classList.add('all_header_style');
        document.querySelector('.code_setup_menu span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>book_code_setup_route');   
      $("#header_name").html("🧩 Setup Account Codes"); 
   }

   function my_profile()
   {
        $("#body_name").html("");
        $("#body_name").load('<?php echo base_url(); ?>my_profile_route');   
        $("#header_name").html("Profile"); 
   }

   function leasing_about_us()
   {
        $("#body_name").html("");
        $("#body_name").load('<?php echo base_url(); ?>leasing_about_us_route');   
        $("#header_name").html("🛈 About Us"); 
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



   

   function book_home_js()
   {
        $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>book_home_route',
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

   function select_date_agency_js()
    {
       $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>select_date_agency_route',
            data:{
                     'month_id': $("#month_id option:selected").val(),
                     'year_id' : $("#year_id option:selected").val(),
                     'type'    : $("#agency_sel option:selected").val()
                },
            dataType: 'json',
            success: function(data) {
                 $("#agency_record_list_table").html(data.list); 
                 $("#month_id").html(data.month_select);    
                 $("#agency_record_table").html(data.html);    
                 $("#hidden_input").html(data.hidden_input);   
                  if(data.button_hide == 'NOT EMPTY')
                  {
                    $("#save_agency_button").prop('hidden', true);
                  }
                  else
                  { 
                     $("#save_agency_button").prop('hidden', false);
                  }
            }
          });
    }

    function calc_agency_employee()
    {
       
         var beginnings = [];
         var end = []; 
        var bu_id_arr = $("#bu_id").val().split('^');
         // var bu_new_arr = $("#bu_new").val().split('^');
         // var combined_arr = bu_id_arr.concat(bu_new_arr);
         combined_arr = bu_id_arr.filter(function(value) {
          return value.trim() !== "";
        });
        
     for(var a=0;a<combined_arr.length;a++)
     {      
         beginnings.push($("#beginning_"+combined_arr[a]).val());
         end.push($("#end_"+combined_arr[a]).val());

     }
      $.ajax({
                  type:'POST',
                  url:'<?php echo base_url(); ?>calc_agency_employee_route',
                  data:{
                         'beginnings':beginnings,
                         'end':end
                      },
                  dataType:'json',
                  success: function(data)
                  {  
                    $("#total_beginning").text(data.beginnings);
                    $("#total_end").text(data.end);
                  }
                }) 
    }

    function save_agency_js() 
    {
          Swal.fire({
            icon: 'info',
            title: 'Are you sure?',
            text: 'You want to save!',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
              actions: 'my-actions',
              confirmButton: 'order-2',
              denyButton: 'order-3',
            },
          }).then((result) => {
            if (result.isConfirmed) {
              var bu_id_arr = $("#bu_id").val().split('^');
              // var bu_new_arr = $("#bu_new").val().split('^');
              // var combined_arr = bu_id_arr.concat(bu_new_arr);
              combined_arr = bu_id_arr.filter(function(value) {
                return value.trim() !== "";
              });
              var hasError = false; // Flag to check for errors
              
              for (var a = 0; a < combined_arr.length; a++) {
                if ($('#month_id').val() == '') {
                  Swal.fire('Select Month', 'Please select month', 'error');
                  hasError = true;
                  break; // Exit the loop on the first error
                } else if ($('#year_id').val() == '') {
                  Swal.fire('Select Year', 'Please select year', 'error');
                  hasError = true;
                  break;
                } else if ($('#agency_sel').val() == '') {
                  Swal.fire('Select Agency Type', 'Please select agency type', 'error');
                  hasError = true;
                  break;
                } else if ($('#beginning_' + combined_arr[a]).val() == '') {
                  Swal.fire('Input Beginning Amount', 'It is required', 'error');
                  hasError = true;
                  break;
                } else if ($('#end_' + combined_arr[a]).val() == '') {
                  Swal.fire('Input Ending Amount', 'It is required', 'error');
                  hasError = true;
                  break;
                }
              }

              if (!hasError)
               {
                for (var a = 0; a < combined_arr.length; a++)
                 {
                    $.ajax({
                      type: 'post',
                      url: '<?php echo base_url(); ?>save_agency_route',
                      data: {
                        'user_id': $('#user_id').val(),
                        'month_id': $('#month_id option:selected').val(),
                        'year_id': $('#year_id option:selected').val(),
                        'agency_id': $('#agency_sel option:selected').val(),
                        'dcode': combined_arr[a],
                        'beginning': $('#beginning_' + combined_arr[a]).val(),
                        'end': $('#end_' + combined_arr[a]).val(),
                      },
                      dataType: 'json',
                      success: function (data) {
                        select_date_agency_js();
                      },
                    });
                 }
                        Swal.fire('Submit Complete', '', 'success');
               }
            } else if (result.isDenied) {
              Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error');
            }
          });
}

     function edit_agency_amount_js(id,month,year,type,dept,beg,end)
     {
        $("#edit_agency_modal").modal({backdrop: 'static', keyboard: false}, 'show');
        $("#agency_id_edit").val(id);
        $("#edit_month").text(month);
        $("#edit_year").text(year);
        $("#edit_type").text(type);
        $("#edit_dept").text(dept);
        $("#edit_beg").val(beg);
        $("#edit_end").val(end);
     }

     function update_agency_js()
    {
             Swal.fire({
           icon: 'info',
           title: 'Are you sure?',
           text: 'You want to update!',
           showDenyButton: true,
           /* showCancelButton: true,*/
           confirmButtonText: 'Yes',
           denyButtonText: 'No',
           customClass: {
             actions: 'my-actions',
             /*  cancelButton: 'order-1 right-gap',*/
             confirmButton: 'order-2',
             denyButton: 'order-3',
           }
         }).then((result) => {
           if (result.isConfirmed) {

            $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>update_agency_route',
            data: {
               'edit_id'  : $('#agency_id_edit').val(),
               'edit_beg' : $('#edit_beg').val(),
               'edit_end' : $('#edit_end').val()             
            },

            dataType: 'json',
            success: function(data) {

              Swal.fire('Submit Complete', '', 'success') 
                    select_date_agency_js();       
                    $('#edit_agency_modal').modal('toggle');    
            }
          });
            
           
              
                } else if (result.isDenied) {
                Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error')
            }
        })
    }

    function agency_month_year_js()
    {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>agency_month_year_route',
            data:{
                     'year_id': $("#year_id option:selected").val(),
                     'month_id': $("#month_id option:selected").val(),
                     'agency_id': $("#agency_list_sel option:selected").val()

                },
            dataType: 'json',
            success: function(data) {
                    $("#month_id").html(data.month_select);
                    $("#agency_reports_table").html(data.agency);                   
            }
          });
    }

    function selects_month_year_book_js()
    {
            document.getElementById("upload_csv_file").value = null;
            var img = '<img src="<?php echo base_url(); ?>assets/img/loader.gif" alt="Loading..." style="margin-left: 474px; margin-bottom: -695px; margin-top: -45%; height: 150px; width: 150px; position: relative; z-index: 10;">';
            $("#loader").html(img);  
            $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>selects_month_year_book_route',
                data:{
                         'month': $("#month_id option:selected").val(),
                         'year' : $("#year_id option:selected").val(),
                         'status_id' : $("#status_id option:selected").val()
                    },
                dataType: 'json',
                success: function(data) {
                $("#loader").html(img);  
                $("#month_id").html(data.month_select);  
                $("#table_store_data").html(data.html);
                if(data.valid_date == 'not empty')
                {
                    // $("#loader").html(img);
                    $('#hide_button_upload').each(function(){
                              $(this).hide();
                          });
                }
                else 
                {
                    $('#hide_button_upload').each(function(){
                              $(this).show();
                          });
                }  

                }
              });
    }


    //create a user-defined function to download CSV file   

     window.io = {
                open: function(verb, url, data, target){
                    var form = document.createElement("form");
                    form.action = url;
                    form.method = verb;
                    form.target = target || "_self";
                    if (data) {
                        for (var key in data) {
                            var input = document.createElement("textarea");
                            input.name = key;
                            input.value = typeof data[key] === "object"
                                ? JSON.stringify(data[key])
                                : data[key];
                            form.appendChild(input);
                        }

                    }
                    form.style.display = 'none';
                    document.body.appendChild(form);
                    form.submit();
                    document.body.removeChild(form);
                }
            };

    function download_csv_format_js()
    {
        if($("#year_id option:selected").val() == '')
                {
                    Swal.fire('Select Year','Please select year it is required', 'error');                  
                }else 
                 if($("#month_id option:selected").val() == '' )
                {
                    Swal.fire('Select Month', 'Please select month it is required','error');
                }
                else
                {
                      io.open('POST', '<?php echo base_url('download_csv_format_route'); ?>', {  'month_id': $("#month_id").val(),'year_id' : $("#year_id").val(), },'_blank'); 
                }

    } 

    function validate_navision_file_js()
    {
         var file_name = $('#upload_csv_file').val();
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>validate_navision_file_route',
            data:{
                     'month': $("#month_id option:selected").val(),
                     'year' : $("#year_id option:selected").val()
                },
            dataType: 'json',
            success: function(data) {

                   if(!data.validate_nav[0])
                    {
                        upload_navision_file_js();
                    }
                    else 
                    {   
                        $('#hide_button_upload').each(function(){
                              $(this).hide();
                          });
                    }   

            }
          });
    }

    function upload_navision_file_js() {
    var file_name = $('#upload_csv_file').val();
    if (file_name == '') {
        Swal.fire('MISSING CSV FILE', 'Please choose CSV file before clicking the upload button.', 'error');
        return;
    } else {

        var validExtensions = ['csv', 'CSV']; // array of valid extensions
        var fileName = file_name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        // console.log(fileNameExt);
        if ($.inArray(fileNameExt, validExtensions) == -1) {
            Swal.fire('INVALID FILE', 'Please select a CSV file before clicking the upload button.', 'error');
            return;
        } else if ($("#year_id option:selected").val() == '') {
            Swal.fire('Select Year', 'Please select a year; it is required.', 'error');
        } else if ($("#month_id option:selected").val() == '') {
            Swal.fire('Select Month', 'Please select a month; it is required.', 'error');
        } else if (file_name.replace(/\s/g, '') === "") {
            $('#upload_csv_file').focus();
        } else {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to upload the file?',
                icon: 'info',
                showDenyButton: true,
                confirmButtonText: 'Yes',
                denyButtonText: 'No',
                customClass: {
                    actions: 'my-actions',
                    // cancelButton: 'order-1 right-gap',
                    confirmButton: 'order-2',
                    denyButton: 'order-3',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    var year = $('#year_id option:selected').val();
                    var month = $('#month_id option:selected').val();

                    var txt_data = new FormData(); // Initialize FormData object
                    
                    var img = '<img src="<?php echo base_url(); ?>assets/img/loads.gif" alt="Loading..." style="margin-left: 474px; margin-bottom: -695px; margin-top: -45%; height: 104px; width: 115px; position: relative; z-index: 10;">';
                            $("#loader").html(img);
                    var input = $('#upload_csv_file')[0];
                    $.each(input.files, function (i, file) {
                        txt_data.append('files[]', file); // Add file data to the FormData object
                    });

                    txt_data.append('yearss', year); // Add year value to the FormData object
                    txt_data.append('monthss', month); // Add month value to the FormData object

                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url(); ?>upload_navision_file_route',
                        data: txt_data,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        beforeSend: function() {
                            // Display the loading image before making the AJAX request
                            var img = '<img src="<?php echo base_url(); ?>assets/img/loads.gif" alt="Loading..." style="margin-left: 474px; margin-bottom: -695px; margin-top: -45%; height: 104px; width: 115px; position: relative; z-index: 10;">';
                            $("#loader").html(img);
                        },
                        success: function (data) {
                            $("#loader").html("");
                             if (data.file_counter == 'MULTIPLE FILE') {
                        Swal.fire('Multiple files', '', 'error');
                    }
                             if (data.val_file == 'INVALID') {
                                Swal.fire('Invalid File', 'Please select another file', 'error');
                             } else if (data.val_file == 'success') {
                                selects_month_year_book_js();
                                Swal.fire('Upload Success', '', 'success');
                             }
                        }
                        
                    });

                } else if (result.isDenied) {
                    Swal.fire('Cancel Submit', 'Your file upload has been cancelled', 'error')
                }
            })
        }
    }
}

     function edit_navision_allocation_js(id,dept_name,gross_sales,net_sales,mti,mto,gross_profit)
    {
        $("#edit_navision_allocation_modal").modal({backdrop: 'static', keyboard: false}, 'show');
        $("#navision_id").val(id);
        $("#dept_name").text(dept_name);
        $("#gross_sales").val(gross_sales);
        $("#net_sales").val(net_sales);
        $("#mti").val(mti);
        $("#mto").val(mto);
        $("#gross_profit").val(gross_profit);

    }

     function cal_nav_v2(input) 
     {
          let value = input.value.replace(/[^\d.-]/g, "");

         // Count the number of negative signs in the value
         let numNegativeSigns = (value.match(/-/g) || []).length;

         // If there is a negative sign, allow it only at the beginning and remove any additional ones
         if (numNegativeSigns > 1 || (numNegativeSigns === 1 && !value.startsWith("-"))) {
             value = value.replace(/-/g, "");
             numNegativeSigns = 0; // Reset the count
         }

         // Check if the input is negative
         let isNegative = value.startsWith("-");

         if (isNegative) {
             value = value.substring(1);
         }
         
         // Split into whole number and decimal parts
         let parts = value.split(".");
         let whole = parts[0];
         let decimal = parts.length > 1 ? "." + parts[1].slice(0, 2) : "";

         // Add commas for thousands separator
         whole = whole.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

         // Concatenate the whole number and decimal parts
         let formattedValue = isNegative ? "-" + whole + decimal : whole + decimal;

         // Update the input value
         input.value = formattedValue;
     }

     function manager_key_approval_js()
     {
        $('#edit_navision_allocation_modal').modal('toggle');
        $("#managers_key_modal").modal({backdrop: 'static', keyboard: false}, 'show');
     }

     function verify_password_js()
    {
        if ($('#users').val() == '')
         {
          Swal.fire('Username is Empty', 'Please input username', 'error');
         }

         else if ($('#pass').val() == '') 
         {
           Swal.fire('Password is Empty', 'Please input password', 'error');
         }
         else
        {
            $.ajax({
                type:'post',
                url:'<?php echo base_url(); ?>verfiy_password_route',
                data:{
                        'user' : $("#users").val(),
                        'pass' : $("#pass").val()
                    },
                dataType: 'json',
                success: function(data){
                    if(data.message == 'EMPTY')
                    {
                        Swal.fire('Invalid User', '', 'error')
                    }
                    else if(data.message == 'NOT EMPTY')
                    {
                        Swal.fire('BU not applicable', '', 'error')
                    }
                    else 
                    {
                        // delete_old_record_js();
                        $('#managers_key_modal').modal('toggle');
                        document.getElementById("users").value = null;
                        document.getElementById("pass").value = null;
                        update_navision_allocation_js();
                    }
                }
            });
        }
    }

    function update_navision_allocation_js()
    {
                    Swal.fire({
              title: 'Are you sure?',
              text: 'You want to update!',
              icon: 'info',
              showDenyButton: true,
              /* showCancelButton: true,*/
              confirmButtonText: 'Yes',
              denyButtonText: 'No',
              customClass: {
                actions: 'my-actions',
                /*  cancelButton: 'order-1 right-gap',*/
                confirmButton: 'order-2',
                denyButton: 'order-3',
              }
            }).then((result) => {
              if (result.isConfirmed) {

                 if ($('#gross_sales').val() == '') 
                 {
                    Swal.fire('Missing Gross Sales', 'Please enter amount', 'error');
                 }
                 else if($('#net_sales').val() == '')
                 {
                    Swal.fire('Missing Net Sales', 'Please enter amount', 'error');
                 }
                 else if($('#mti').val() == '')
                 {
                    Swal.fire('Missing Gross Purchases + MTI', 'Please enter amount', 'error');
                 }
                 else if($('#mto').val() == '')
                 {
                    Swal.fire('Missing MTO', 'Please enter amount', 'error');
                 }
                 else if($('#gross_profit').val() == '')
                 {
                    Swal.fire('Missing Gross Profit', 'Please enter amount', 'error');
                 }
                 else {
                  
                  $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>update_navision_allocation_route',
                    data: {
                               'edit_id': $('#navision_id').val().split(',').join(''),
                      'edit_gross_sales': $('#gross_sales').val().split(',').join(''),
                        'edit_net_sales': $('#net_sales').val().split(',').join(''),
                              'edit_mti': $('#mti').val().split(',').join(''),
                              'edit_mto': $('#mto').val().split(',').join(''),
                     'edit_gross_profit': $('#gross_profit').val().split(',').join(''),
                           'edit_status': 'Pending'
                    },

                    dataType: 'json',
                    success: function(data) {

                       Swal.fire('Update Complete', '', 'success');
                       $('#managers_key_modal').modal('hide');
                       selects_month_year_book_js();
                                          
                    }
                  });
                }

              } else if (result.isDenied) {
                Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error')
                 $('#edit_navision_allocation_modal').modal({backdrop: 'static', keyboard: false}, 'show');
              }
            })
    }

    function selects_month_year_expense_js()
    {
        var img = '<img src="<?php echo base_url(); ?>assets/img/loader.gif" alt="Loading..." style="margin-left: 474px; margin-bottom: -695px; margin-top: -45%; height: 150px; width: 150px; position: relative; z-index: 10;">';
         $("#loader").html(img);              
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>selects_month_year_expense_route',
            data:{
                     'month': $("#month_id option:selected").val(),
                     'year' : $("#year_id option:selected").val(),
                     'status_expense_id' : $("#status_expense_id option:selected").val()
                },
            dataType: 'json',
            success: function(data) {
            $("#loader").html("");
            $("#month_id").html(data.month_select);  
            $("#table_store_expense").html(data.html);  
            if(data.valid_expense == 'not empty')
            {
                $('#hide_expense_button').each(function(){
                              $(this).hide();
                          });
            }
            else
            {
                $('#hide_expense_button').each(function(){
                              $(this).show();
                          });
            }
            }
          });
    }

    function validate_store_expense_js()
    {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>validate_store_expense_route',
            data:{
                     'month': $("#month_id option:selected").val(),
                     'year' : $("#year_id option:selected").val()
                },
            dataType: 'json',
            success: function(data) {

                   if(!data.validate_expense[0])
                    {
                        upload_store_expense_js();
                    }
                    else 
                    {
                        Swal.fire('This month has data','You already uploaded on this month','error');
                    }   

            }
          });
    }

    function upload_store_expense_js() {
    var fileInput = $('#upload_expense_file')[0];
    if (fileInput.files.length === 0) {
        Swal.fire('MISSING FILE', 'Please choose a file before clicking the upload button.', 'error');
        return;
    }

    var validExtensions = ['csv', 'CSV', 'html', 'htm']; // Add valid extensions
    var fileName = fileInput.files[0].name;
    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);

    if ($.inArray(fileNameExt, validExtensions) === -1) {
        Swal.fire('INVALID FILE', 'Please select a valid file before clicking the upload button.', 'error');
        return;
    }

    if ($('#year_id option:selected').val() === '') {
        Swal.fire('Select Year', 'Please select a year; it is required.', 'error');
        return;
    }

    if ($('#month_id option:selected').val() === '') {
        Swal.fire('Select Month', 'Please select a month; it is required.', 'error');
        return;
    }

    Swal.fire({
        title: 'Are you sure?',
        text: 'You want to upload the file?',
        icon: 'info',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        customClass: {
            actions: 'my-actions',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var year = $('#year_id option:selected').val();
            var month = $('#month_id option:selected').val();
            var txt_data = new FormData();
            var input = $('#upload_expense_file')[0];

            $.each(input.files, function(i, file) {
                txt_data.append('files[]', file);
            });

            // Append the month and year values to the FormData object
            txt_data.append('year', year);
            txt_data.append('month', month);

            $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>upload_store_expense_route',
                data: txt_data,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    var img = '<img src="<?php echo base_url(); ?>assets/img/loads.gif" alt="Loading..." style="margin-left: 474px; margin-bottom: -695px; margin-top: -45%; height: 104px; width: 115px; position: relative; z-index: 10;">';
                    $("#loader").html(img);
                },
                success: function(data) {
                    $("#loader").html("");
                    if (data.val_file == 'INVALID') {
                        Swal.fire('Invalid File', 'Please select another file', 'error');
                    } else if (data.val_file == 'success') {
                        update_date_expense_js(year, month);
                        selects_month_year_expense_js();
                        Swal.fire('Upload Success', '', 'success');
                    } else if (data.file_counter == 'MULTIPLE FILE') {
                        Swal.fire('Multiple files', '', 'error');
                    }
                },
                error: function() {
                    $("#loader").html("");
                }
            });
        } else if (result.isDenied) {
            Swal.fire('Cancel Submit', 'Your file upload has been cancelled', 'error');
        }
    });
}

     function update_date_expense_js(year,month)
     {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>update_date_expense_route',
            data:{
                    'month' : month, 
                    'year'  : year
            },
            dataType: 'json',
        });
     }

     function edit_store_expense_js(id,code,description,amount)
     {
        $("#edit_store_expense_modal").modal({backdrop: 'static', keyboard: false}, 'show');
        $("#expense_id").val(id);
        $("#code_id").text(code);
        $("#expense_name").text(description);
        $("#amount_id").val(amount);
     }

     function manager_key_expense_js()
     {
        $('#edit_store_expense_modal').modal('toggle');
        $("#managers_key_expense_modal").modal({backdrop: 'static', keyboard: false}, 'show');
     }

    function verify_password_expense_js()
    {
        if ($('#users').val() == '')
         {
          Swal.fire('Username is Empty', 'Please input username', 'error');
         }

         else if ($('#pass').val() == '') 
         {
           Swal.fire('Password is Empty', 'Please input password', 'error');
         }
         else
        {
                $.ajax({
                type:'post',
                url:'<?php echo base_url(); ?>verfiy_password_route',
                data:{
                        'user' : $("#users").val(),
                        'pass' : $("#pass").val()
                    },
                dataType: 'json',
                success: function(data){
                    if(data.message == 'EMPTY')
                    {
                        Swal.fire('Invalid User', '', 'error')
                    }
                    else if(data.message == 'NOT EMPTY')
                    {
                        Swal.fire('BU not applicable', '', 'error')
                    }
                    else 
                    {
                        // delete_old_record_js();
                        $('#managers_key_expense_modal').modal('toggle');
                        document.getElementById("users").value = null;
                        document.getElementById("pass").value = null;
                        update_store_expense_js();
                    }
                }
            });
        }
        
    }


    function update_store_expense_js()
    {
         Swal.fire({
              title: 'Are you sure?',
              text: 'You want to update!',
              icon: 'info',
              showDenyButton: true,
              /* showCancelButton: true,*/
              confirmButtonText: 'Yes',
              denyButtonText: 'No',
              customClass: {
                actions: 'my-actions',
                /*  cancelButton: 'order-1 right-gap',*/
                confirmButton: 'order-2',
                denyButton: 'order-3',
              }
            }).then((result) => {
              if (result.isConfirmed) {

                 if ($('#amount_id').val() == '') 
                 {
                    Swal.fire('Missing Amount', 'Please enter amount', 'error');
                 }
                 
                 else {
                  
                  $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>update_store_expense_route',
                    data: {
                               'edit_id': $('#expense_id').val(),
                           'edit_amount': $('#amount_id').val().split(',').join('')
                    },

                    dataType: 'json',
                    success: function(data) {

                       Swal.fire('Update Complete', '', 'success');
                       $('#managers_key_expense_modal').modal('hide');
                       selects_month_year_expense_js();
                                          
                    }
                  });
                }

              } else if (result.isDenied) {
                Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error')
                 $('#edit_store_expense_modal').modal({backdrop: 'static', keyboard: false}, 'show');
              }
            })
    }

    function select_expense_agency_js()
    {
       $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>select_expense_agency_route',
            data:{
                     'month_id': $("#month_id option:selected").val(),
                     'year_id' : $("#year_id option:selected").val()
                },
            dataType: 'json',
            success: function(data) {
                 $("#month_id").html(data.month_select);
                 $("#agency_expense_table").html(data.agent_list);
                 $("#hidden_input").html(data.hidden_input);
                 $("#agent_expense").html(data.agent_expense);
                  if(data.button_hide == 'NOT EMPTY')
                  {
                    $("#save_agency_button").prop('hidden', true);
                  }
                  else
                  { 
                     $("#save_agency_button").prop('hidden', false);
                  }
                $("#expense_record_table").html(data.list);    
            }
          });
    }

    function save_agency_expense_js() {
        // console.log($('#agent_get_expense').val(),$('#total_expense').text());
          Swal.fire({
            icon: 'info',
            title: 'Are you sure?',
            text: 'You want to save!',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
              actions: 'my-actions',
              confirmButton: 'order-2',
              denyButton: 'order-3',
            },
          }).then((result) => {
            if (result.isConfirmed) {
              var agent_arr = $("#agents_id").val().split('^');
              var hasError = false; // Flag to check for errors

              for (var a = 1; a < agent_arr.length; a++) {
                if ($('#month_id').val() == '') {
                  Swal.fire('Select Month', 'Please select month', 'error');
                  hasError = true;
                  break; // Exit the loop on the first error
                } else if ($('#year_id').val() == '') {
                  Swal.fire('Select Year', 'Please select year', 'error');
                  hasError = true;
                  break;
                } else if ($('#agent_' + agent_arr[a]).val() == '') {
                  Swal.fire('Please Input Amount', 'It is required', 'error');
                  hasError = true;
                  break;
                } else if ($('#total_expense').text() != $('#agent_get_expense').val()) {
                  Swal.fire(
                    'Invalid Amount',
                    'The total amount is not match in Agency Fee',
                    'error'
                  );
                  hasError = true;
                  break;
                }
              }

              if (!hasError) {
                // If there are no errors, proceed to save data
                for (var a = 1; a < agent_arr.length; a++) {
                $.ajax({
                  type: 'post',
                  url: '<?php echo base_url(); ?>save_agency_expense_route',
                  data: {
                    'user_id': $('#user_id').val(),
                    'month_id': $('#month_id option:selected').val(),
                    'year_id': $('#year_id option:selected').val(),
                    'agent': agent_arr[a],
                    'amount': $('#agent_' + agent_arr[a]).val().split(',').join(''),
                  },
                  dataType: 'json',
                  success: function (data) {
                    display_agency_record_table_js();
                    select_expense_agency_js();
                  },
                });
            }
                    Swal.fire('Submit Complete', '', 'success');   
              }
            } else if (result.isDenied) {
              Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error');
            }
        });
    }

    function calc_breakdown_employee(input)
    {

      let value = input.value.replace(/[^\d.]/g, "");
        // Check if the input is negative
        let isNegative = false;
        if (value.startsWith("-")) {
            isNegative = true;
            value = value.substring(1);
        }
        // Split into whole number and decimal parts
        let parts = value.split(".");
        let whole = parts[0];
        let decimal = parts.length > 1 ? "." + parts[1].slice(0, 2) : "";
        // Add commas for thousands separator
        whole = whole.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        // Concatenate the whole number and decimal parts
        let formattedValue = isNegative ? "-" + whole + decimal : whole + decimal;
        // Update the input value
        input.value = formattedValue;

         var class_sum = 0;
        $(".tanan").each(function() {
           if ($(this).val().trim() !== '') {
            class_sum += parseFloat($(this).val().split(',').join(''));
          }
        });
         $("#total_expense").text(class_sum.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    }

    function display_bookkeeper_table_js()
    {
        $.ajax({ 
            type: 'post',
            url : '<?php echo base_url(); ?>display_bookkeeper_table_route',
            dataType: 'json',
            success: function(data){
                $("#account_code_table").html(data.html);
            }

        });
    }

    function add_account_code_modal_js()
    {
        $("#add_account_code_modal").modal({backdrop: 'static', keyboard: false}, 'show');
    }

    function get_allocation_type_js()
    {
         $.ajax({
            type:'post',
            url:'<?php echo base_url(); ?>get_allocation_type_route',
            dataType: 'json',
            success: function(data){
                $("#type").html(data.allocation_type);  
            }
        });
    }

    function validate_account_code_js()
    {
         if ($('#code').val() == '') 
         {
            Swal.fire('Missing Account Code', 'Please enter code', 'error');
         }
         else if($('#expense').val() == '')
         {
            Swal.fire('Missing Expense', 'Please input expense name', 'error');
         }
         else if($('#type').val() == '')
         {
            Swal.fire('Select Allocation Type', 'Please select type', 'error');
         }
         else {
          
          $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>validate_account_code_route',
            data: {
                       'code': $('#code').val()
            },

            dataType: 'json',
            success: function(data) {
                if(data.code=='not empty')
                {
                    Swal.fire('Account Code Already Exist', 'Please change your account code', 'error');
                }
                else
                {
                    save_account_code_js();
                }                     
            }
          });
        }
    }

    function save_account_code_js()
    {
         Swal.fire({
              title: 'Are you sure?',
              text: 'You want to save!',
              icon: 'info',
              showDenyButton: true,
              /* showCancelButton: true,*/
              confirmButtonText: 'Yes',
              denyButtonText: 'No',
              customClass: {
                actions: 'my-actions',
                /*  cancelButton: 'order-1 right-gap',*/
                confirmButton: 'order-2',
                denyButton: 'order-3',
              }
            }).then((result) => {
              if (result.isConfirmed) {

                 if ($('#code').val() == '') 
                 {
                    Swal.fire('Missing Account Code', 'Please enter code', 'error');
                 }
                 else if($('#expense').val() == '')
                 {
                    Swal.fire('Missing Expense', 'Please input expense name', 'error');
                 }
                 else if($('#type').val() == '')
                 {
                    Swal.fire('Select Allocation Type', 'Please select type', 'error');
                 }
                 else {
                  
                  $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>save_account_code_route',
                    data: {
                               'code': $('#code').val(),
                            'expense': $('#expense').val(),
                               'type': $('#type').val()
                    },

                    dataType: 'json',
                    success: function(data) {

                       Swal.fire('Save Complete', '', 'success');
                       $('#add_account_code_modal').modal('toggle');
                       display_bookkeeper_table_js();
                                          
                    }
                  });
                }

              } else if (result.isDenied) {
                Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error');
              }
            })
    }

    function edit_account_code_js(id,account_code,name,allo_id)
    {
        $("#edit_account_code_modal").modal({backdrop: 'static', keyboard: false}, 'show');
        $("#ssd_account_id").val(id);
        $("#edit_account_code").val(account_code);
        $("#edit_account_name").val(name);
        $("#edit_type").val(allo_id);     
    }

    function edit_allocation_name_js()
    {
        $.ajax({
            type:'post',
            url:'<?php echo base_url(); ?>get_allocation_type_route',
            dataType: 'json',
            success: function(data){
                $("#edit_type").html(data.allocation_type);  
            }
        });
    }

    function update_account_code_js()
    {
             Swal.fire({
           title: 'Are you sure?',
           text: 'You want to update!',
           icon: 'info',
           showDenyButton: true,
           /* showCancelButton: true,*/
           confirmButtonText: 'Yes',
           denyButtonText: 'No',
           customClass: {
             actions: 'my-actions',
             /*  cancelButton: 'order-1 right-gap',*/
             confirmButton: 'order-2',
             denyButton: 'order-3',
           }
         }).then((result) => {
           if (result.isConfirmed) {

              if ($('#edit_account_name').val() == '') 
              {
                 Swal.fire('Missing Account Name', 'Please enter account name', 'error');
              }
              else if ($('#edit_type').val() == '') 
              {
                 Swal.fire('Select Allocation Type', 'Please select it is required', 'error');
              }
              else {
               
               $.ajax({
                 type: 'post',
                 url: '<?php echo base_url(); ?>update_account_code_route',
                 data: {
                          'id': $('#ssd_account_id').val(),
                   'edit_code': $('#edit_account_code').val(),
                   'edit_name': $('#edit_account_name').val(),
                   'edit_type': $('#edit_type').val()
                 },

                 dataType: 'json',
                 success: function(data) {

                   Swal.fire('Update Complete', '', 'success') 
                    $('#edit_account_code_modal').modal('toggle');
                    display_bookkeeper_table_js();
                                       
                 }
               });
             }

           } else if (result.isDenied) {
             Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error')
           }
         })
    }

    function display_report_allocation_js()
    {
        var img = '<img src="<?php echo base_url(); ?>assets/img/loads.gif" alt="Italian Trulli" style="margin-left: 474px; margin-bottom: -695px; margin-top: -29%; height: 115px; width: 115px;">' ;  
        $("#loader").html(img); 
        $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>display_report_allocation_route',
              dataType: 'json',
              success: function(data) {
              $("#table_report_allocation").html(data.html);    
              $("#hidden_html_report").text(data.report_html);
              $("#loader").html('');  
              $("#disabled_report_id").prop( "disabled", true );
              $("#disabled_excel_id").prop( "disabled", true ); 
              }
            });
    }

    function select_date_reports_js()
    {
        var img = '<img src="<?php echo base_url(); ?>assets/img/Spinners.gif" alt="Italian Trulli" style="margin-left: 474px; margin-bottom: -695px; margin-top: -41%; height: 115px; width: 115px;">' ;  
        $("#loader").html(img); 
         $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>select_date_reports_route',
                data:{
                         'month': $("#month_id option:selected").val(),
                         'year' : $("#year_id option:selected").val()
                    },
                dataType: 'json',
                success: function(data) {
                    // console.log(data.valid_expenses);
                    // $("#loader").html(img); 
                    if(data.valid_expenses == 'empty')
                    {
                        Swal.fire('Missing Data', 'No Data in Store Expense', 'error');
                        $("#disabled_report_id").prop( "disabled", true );  
                        $("#disabled_excel_id").prop( "disabled", true );  
                        display_report_allocation_js();
                    }
                    if(data.checking_empty > 0)
                    {
                        Swal.fire('Missing Data', data.validation_empty, 'error');
                        $("#loader").html(''); 
                        $("#disabled_report_id").prop( "disabled", true );
                        $("#disabled_excel_id").prop( "disabled", true );
                        display_report_allocation_js();
                    }else
                    {
                        $("#month_id").html(data.month_select);  
                        $("#table_report_allocation").html(data.html);
                        $("#hidden_html_report").text(data.report_html);
                        $("#return_bu_id").text(data.return_bu_id);
                        $("#hidden_excel_report").text(data.excel_html);
                        $("#disabled_report_id").prop( "disabled", false );
                        $("#disabled_excel_id").prop( "disabled", false );
                        
                    }
                    $("#month_id").html(data.month_select);  
                }
              });
    }

    function excel_report_js()
    {
        var file_excel=$("#hidden_excel_report").text();
        console.log(file_excel);
        var return_bu_id=$("#return_bu_id").text();
        if(file_excel == '')
        {
            Swal.fire('The Excel Data is Empty','Make sure it has data','error');
        }
        else
        {
            var blob = new Blob([file_excel], { type: 'application/vnd.ms-excel' });
            var url  = URL.createObjectURL(blob);
            var link = document.createElement('a');

            link.href = url;

            // Protect the downloaded Excel file.....................................
            setTimeout(function() {
              protect_report_export(url,return_bu_id);
            }, 100);
        }
        
    }

    function protect_report_export(fileUrl,return_bu_id)
       {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', fileUrl, true);
            xhr.responseType = 'arraybuffer';
        
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var arrayBuffer = xhr.response;
                    var data = new Uint8Array(arrayBuffer);
                    var workbook = XLSX.read(data, { type: 'array' });

        
                    // Assuming the first sheet in the workbook is the one to be protected.........................................
                    var sheetName = workbook.SheetNames[0];
                    var sheet = workbook.Sheets[sheetName];

                    //Set the sheet protection options..............................
                    sheet['!protect'] = {
                                         password: 'ehh',
                                         formatCells: false,
                                         formatColumns: false,
                                         formatRows: false,
                                         insertColumns: false,
                                         insertRows: false,
                                         insertHyperlinks: false,
                                         deleteColumns: false,
                                         deleteRows: false,
                                         selectLockedCells: true,
                                         selectUnlockedCells: true,
                                         sort: false,
                                         autoFilter: false,
                                         pivotTables: false,
                                         objects: true,
                                         scenarios: true,
                                         sheet: false
                                       };


                   // Auto adjust column sizes.....................................
                    var range = XLSX.utils.decode_range(sheet['!ref']);
                    var columnWidths = [];
                    for (var col = range.s.c; col <= range.e.c; col++) {
                        var maxWidth = 0;
                        for (var row = range.s.r + 1; row <= range.e.r; row++) {
                            var cellAddress = XLSX.utils.encode_cell({ r: row, c: col });
                            var cell = sheet[cellAddress];
                            if (cell && cell.v) {
                                var contentLength = cell.v.toString().length;
                                if (contentLength > maxWidth) {
                                    maxWidth = contentLength;

                                } // end contentlength if condition

                             } // end of cell if condition
                           
                         } // end of range row for loop

                        columnWidths[col] = { width: maxWidth + 1 };

                    } // end of range for loop 

                    sheet['!cols'] = columnWidths;
                   // ========================================================================================================================
        
                    var newWorkbook = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(newWorkbook, sheet, 'Sheet 1');
        
                    var wbout = XLSX.write(newWorkbook, { bookType: 'xlsx', type: 'binary' });
                    var s2ab = function (s) {
                        var buf = new ArrayBuffer(s.length);
                        var view = new Uint8Array(buf);
                        for (var i = 0; i < s.length; i++) {
                            view[i] = s.charCodeAt(i) & 0xff;

                        } // end of view for loop

                        return buf;

                    }; // end of s2ab function 

                   // ========================================================================================================================
        
                    var blob = new Blob([s2ab(wbout)], { type: 'application/octet-stream' });
                    var url = URL.createObjectURL(blob);
        
                    var link = document.createElement('a');
                    link.href = url;
                    link.download = return_bu_id+'_'+'export_report.csv';
                     // link.download = +'.csv';
                    document.body.appendChild(link);   
                    link.click();
                    document.body.removeChild(link);  

                } // end of xhr.status if condition 

            }; // end of onload function

            xhr.send();

        } // end of protectExcelFile function 
 
     function generate_report_js() 
     {

             window.io = {
                 open: function(verb, url, data, target){
                     var form = document.createElement("form");
                     form.action = url;
                     form.method = verb;
                     form.target = target || "_self";
                     if (data) {
                         for (var key in data) {
                             var input = document.createElement("textarea");
                             input.name = key;
                             input.value = typeof data[key] === "object"
                                 ? JSON.stringify(data[key])
                                 : data[key];
                             form.appendChild(input);
                         }

                     }
                     form.style.display = 'none';
                     document.body.appendChild(form);
                     form.submit();
                     document.body.removeChild(form);
                 }
             };
         // Get values from #month_id and #year_id
         var month_id = $('#month_id').val();
         var year_id = $('#year_id').val();

         // Use AJAX to send additional data (month_id and year_id)
        io.open('POST', '<?php echo base_url('generate_report_route'); ?>', {month_id:month_id,
                                                                             year_id:year_id
        },'_blank');  

     }

     function approve_nav_book_js(month, year, pending)
     {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_record_menu').classList.remove('all_header_style');
        document.querySelector('.agency_record_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_report_menu').classList.remove('all_header_style');
        document.querySelector('.agency_report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.go_exp_menu').classList.remove('all_header_style');
        document.querySelector('.go_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_exp_menu').classList.remove('all_header_style');
        document.querySelector('.agency_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.report_menu').classList.remove('all_header_style');
        document.querySelector('.report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.code_setup_menu').classList.remove('all_header_style');
        document.querySelector('.code_setup_menu span').classList.remove('all_header_style_span');

        document.querySelector('.nav_allo_menu').classList.add('all_header_style');
        document.querySelector('.nav_allo_menu span').classList.add('all_header_style_span');

      var url = '<?php echo base_url("book_nav_allo_route"); ?>?month=' + month + '&year=' + year + '&pending=' + pending;
        $("#body_name").load(url);   
      $("#header_name").html("📚 Navision Allocation Basis"); 
     }

     function approve_expense_book_js(month, year, pending)
     {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_record_menu').classList.remove('all_header_style');
        document.querySelector('.agency_record_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_report_menu').classList.remove('all_header_style');
        document.querySelector('.agency_report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_menu').classList.remove('all_header_style');
        document.querySelector('.nav_allo_menu span').classList.remove('all_header_style_span');
        document.querySelector('.agency_exp_menu').classList.remove('all_header_style');
        document.querySelector('.agency_exp_menu span').classList.remove('all_header_style_span');
        document.querySelector('.report_menu').classList.remove('all_header_style');
        document.querySelector('.report_menu span').classList.remove('all_header_style_span');
        document.querySelector('.code_setup_menu').classList.remove('all_header_style');
        document.querySelector('.code_setup_menu span').classList.remove('all_header_style_span');

        document.querySelector('.go_exp_menu').classList.add('all_header_style');
        document.querySelector('.go_exp_menu span').classList.add('all_header_style_span');

      var url = '<?php echo base_url("book_go_exp_route"); ?>?month=' + month + '&year=' + year + '&pending=' + pending;
        $("#body_name").load(url);   
      $("#header_name").html("💵 Monthly Store GO Expense"); 
     }

   </script>   
   </body>
</html>