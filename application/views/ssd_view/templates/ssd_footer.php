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
   function ssd_home_js()
   { 
        document.querySelector('.records-menu').classList.remove('record-header-style');
        document.querySelector('.records-menu span').classList.remove('record-header-style-span');
        document.querySelector('.reports-menu').classList.remove('report-header-style');
         document.querySelector('.reports-menu span').classList.remove('report-header-style-span');

        document.querySelector('.homepage-menu').classList.add('home-header-style');
        document.querySelector('.homepage-menu span').classList.add('home-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>ssd_home_route');   
      $("#header_name").html("🧮DASHBOARD");   
   }

   function ssd_record_js()
   {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.reports-menu').classList.remove('report-header-style');
         document.querySelector('.reports-menu span').classList.remove('report-header-style-span');

         document.querySelector('.records-menu').classList.add('record-header-style');
         document.querySelector('.records-menu span').classList.add('record-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>ssd_record_route');   
      $("#header_name").html("🗂️ Guard's Record"); 
   }

   function ssd_report_js()
   {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.records-menu').classList.remove('record-header-style');
         document.querySelector('.records-menu span').classList.remove('record-header-style-span');

         document.querySelector('.reports-menu').classList.add('report-header-style');
         document.querySelector('.reports-menu span').classList.add('report-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>ssd_report_route');   
      $("#header_name").html("📊 Guard's Report"); 
   }

   function leasing_about_us()
   {
        $("#body_name").html("");
        $("#body_name").load('<?php echo base_url(); ?>leasing_about_us_route');   
        $("#header_name").html("🛈 About Us"); 
   }

    function select_ssd_week_js()
    {
        $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>select_ssd_week_route',
              data: { 'week_id' : $("#week_id option:selected").val() },
              dataType: 'json',
              success: function(data) {
              $("#ssd_lacking_homepage").html(data.lacking_ssd);
              $("#badge_id").html(data.badge_id);
              }
            });
    }

    function ssd_select_date()
    {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>ssd_select_date_route',
            data:{
                     'year_id_list'   : $("#year_list option:selected").val(),
                     'month_id_list'  : $("#month_list option:selected").val(),
                     'week_list_sel'  : $("#week_list option:selected").val()
                },
            dataType: 'json',
            success: function(data) {
                 $("#month_list").html(data.month_select);    
                 
                  $("#ssd_employee_table").html(data.html);
            $("#hidden_input").html(data.hidden_input);
            // $("#save_guard_button").show();
             if(data.button_hide == 'NOT EMPTY')
                  {
                    $("#save_guard_button").prop('hidden', true);
                  }
                  else
                  { 
                     $("#save_guard_button").prop('hidden', false);
                  }
                $("#ssd_employee_list_table").html(data.list);
            }     
          });
    }

    function save_guard_js()
    {   
        Swal.fire({
          icon: 'info',
          title: 'Are you sure?',
          text: 'You want to save!',
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

            var bu_id_arr= $('#bu_id').val().split('^');
             // var bu_new_arr = $("#bu_new").val().split('^');
             // var combined_arr = bu_id_arr.concat(bu_new_arr);
             combined_arr = bu_id_arr.filter(function(value) {
              return value.trim() !== "";
            });
               var hasError = false; // Flag to check for errors
             for(var a=0; a<combined_arr.length; a++)
              {

                if ($('#year_list option:selected').val() == 0)
                 {
                  Swal.fire('Missing Date', 'Please select a Year', 'error');
                  hasError = true;
                      break;
                 }

                 else if ($('#month_list option:selected').val() == 0) 
                 {
                   Swal.fire('Missing Date', 'Please select a Month', 'error');
                   hasError = true;
                      break;
                 }

                 else if ($('#week_list option:selected').val() == 0) 
                 {
                   Swal.fire('Missing Date', 'Please select a Week', 'error');
                   hasError = true;
                      break;
                 }
                 else if ($('#guard_'+combined_arr[a]).val() == '')
                 {
                    Swal.fire('Input Guard Amount', 'It is required', 'error');
                    hasError = true;
                      break;
                 }
                 else if($('#reliever_'+combined_arr[a]).val() == '')
                 {
                    Swal.fire('Input Reliever Amount', 'It is required', 'error');
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
                        url: '<?php echo base_url(); ?>save_guard_route',
                        data: {
                           'user_id'    : $('#user_id_ssd').val(),
                           'year_id'   : $('#year_list option:selected').val(),
                           'month_id'    : $('#month_list option:selected').val(),
                           'week_id'    : $('#week_list option:selected').val(),
                           'dcode'      : combined_arr[a],
                           'guard'      : $('#guard_'+combined_arr[a]).val(),            
                           'reliever'   : $('#reliever_'+combined_arr[a]).val()            
                        },

                        dataType: 'json',
                        success: function(data) {
            
                            ssd_select_date();  
                        }
                      });
                    }
                    Swal.fire('Submit Complete', '', 'success');
               } 
                  
                    } else if (result.isDenied) {
                    Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error')
                }
            })
    }

    function edit_guard_amount_js(id,month,year,week,dept,guard,reliever)
    {
        $("#edit_guard_amount_modal").modal({backdrop: 'static', keyboard: false}, 'show');
        $("#ssd_id_edit").val(id);
        $("#edit_month").text(month);
        $("#edit_year").text(year);
        $("#edit_week").text(week);
        $("#edit_dept").text(dept);
        $("#edit_guard").val(guard);
        $("#edit_reliever").val(reliever);
    }

    function update_ssd_employee_js()
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

      
        // if ($('#edit_guard').val() == '')
        //  {
        //      Swal.fire('Input Guard Amount', 'It is required', 'error');
        //  }

        //  else if ($('#edit_reliever').val() == '') 
        //  {
        //     Swal.fire('Input Reliever Amount', 'It is required', 'error');
        //  }
        //  else {
            $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>update_ssd_employee_route',
            data: {
               'edit_id'       : $('#ssd_id_edit').val(),
               'edit_guard'    : $('#edit_guard').val(),
               'edit_reliever' : $('#edit_reliever').val()             
            },

            dataType: 'json',
            success: function(data) {

              Swal.fire('Submit Complete', '', 'success') 
                     ssd_select_date();       
                $('#edit_guard_amount_modal').modal('toggle');    
            }
          });
            
           // }
              
                } else if (result.isDenied) {
                Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error')
            }
        })
    }

    function ssd_month_year_js_v2()
    {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>ssd_month_year_v2_route',
            data:{
                     'year_id': $("#year_id option:selected").val(),
                     'month_id': $("#month_id option:selected").val()

                },
            dataType: 'json',
            success: function(data) {
                    $("#ssd_reports_table").html(data.guard);                   
                    $("#month_id").html(data.month_select);
            }
          });
    }

    function approve_ssd_Data(month, year, week_id)
    {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.reports-menu').classList.remove('report-header-style');
         document.querySelector('.reports-menu span').classList.remove('report-header-style-span');

         document.querySelector('.records-menu').classList.add('record-header-style');
         document.querySelector('.records-menu span').classList.add('record-header-style-span');

        var url = '<?php echo base_url("ssd_record_route"); ?>?month=' + month + '&year=' + year + '&week_id=' + week_id;
        $("#body_name").load(url);
        $("#header_name").html("🗂️ Guard's Record");
    }

   </script>   
   </body>
</html>