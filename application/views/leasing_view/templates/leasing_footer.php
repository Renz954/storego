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
   function leasing_home_js()
   { 
        document.querySelector('.records-menu').classList.remove('record-header-style');
        document.querySelector('.records-menu span').classList.remove('record-header-style-span');

        document.querySelector('.homepage-menu').classList.add('home-header-style');
        document.querySelector('.homepage-menu span').classList.add('home-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>leasing_home_route');   
      $("#header_name").html("🧮DASHBOARD");   
   }

   function leasing_record_js()
   {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');

         document.querySelector('.records-menu').classList.add('record-header-style');
         document.querySelector('.records-menu span').classList.add('record-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>leasing_record_route');   
      $("#header_name").html("🗺️ Floor Area"); 
   }

   function leasing_about_us()
   {
        $("#body_name").html("");
        $("#body_name").load('<?php echo base_url(); ?>leasing_about_us_route');   
        $("#header_name").html("🛈 About Us"); 
   }

    function leasing_dashboard_js()
    {
      $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>leasing_dashboard_route',
              dataType: 'json',
              success: function(data) {
              $("#leasing_lacking_homepage").html(data.lacking_leasing); 
              }
            });
    }

    function approve_leasing_js(month,year)
    {
        document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');

         document.querySelector('.records-menu').classList.add('record-header-style');
         document.querySelector('.records-menu span').classList.add('record-header-style-span');
        var url = '<?php echo base_url("leasing_record_route"); ?>?month=' + month + '&year=' + year;
        $("#body_name").load(url);
        $("#header_name").html("🗺️ Floor Area"); 
    }

    function select_date_area_js()
    {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>select_date_area_route',
            data:{
                     'year'   : $("#year option:selected").val(),
                     'month'  : $("#month option:selected").val()
                },
            dataType: 'json',
            success: function(data) {
            $("#month").html(data.month_select);
            $("#floor_area_table").html(data.html);
            $("#hidden_input").html(data.hidden_input);

             if(data.button_hide == 'NOT EMPTY')
                  {
                    $("#save_guard_button").prop('hidden', true);
                  }
                  else
                  { 
                     $("#save_guard_button").prop('hidden', false);
                  }
                // $("#ssd_employee_list_table").html(data.list);
            }     
          });
    }

    function cacl_floor(input,id)
    {
         // Remove non-numeric characters
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


        //=============================== calculate rows ===================================
        var b1 = $("#b1_" + id).val().split(',').join('');
        var b2 = $("#b2_" + id).val().split(',').join('');
        var gf = $("#gf_" + id).val().split(',').join('');
        var mez = $("#mez_" + id).val().split(',').join('');
        var second = $("#second_" + id).val().split(',').join('');
        var third = $("#third_" + id).val().split(',').join('');
        var fourth = $("#fourth_" + id).val().split(',').join('');
        var fifth = $("#fifth_" + id).val().split(',').join('');

        // Convert empty strings to 0
        if (b1 === '') {
            b1 = 0;
        }
        if (b2 === '') {
            b2 = 0;
        }
        if (gf === '') {
            gf = 0;
        }
        if (mez === '') {
            mez = 0;
        }
        if (second === '') {
            second = 0;
        }
        if (third === '') {
            third = 0;
        }
        if (fourth === '') {
            fourth = 0;
        }
        if (fifth === '') {
            fifth = 0;
        }

        var sum = parseFloat(b1) + parseFloat(b2) + parseFloat(gf) + parseFloat(mez) + parseFloat(second) + parseFloat(third) + parseFloat(fourth) + parseFloat(fifth);
        // console.log(sum);

               if (isNaN(sum))
                {
                    $("#total_row_" + id).text('0');
                } else {
                    $("#total_row_" + id).text(sum.toLocaleString(undefined, { maximumFractionDigits: 2 }));
                }

                 var overallTotal = 0;
            $(".row-total-span").each(function () {
                const rowTotalValue = parseFloat($(this).text().replace(/[^\d.]/g, "").split(',').join(''));
                overallTotal += rowTotalValue;
            });

            // Display the overall total
            if (isNaN(overallTotal)) {
                $("#overall_total").text('0');
            } else {
                $("#overall_total").text(overallTotal.toLocaleString(undefined, { maximumFractionDigits: 2 }));
            }

             var class_sum = 0;
    $(".get_total").each(function() {
       if ($(this).text().trim() !== '') {
        class_sum += parseFloat($(this).text().split(',').join(''));
      }
    });
     $("#grand_total").text(class_sum.toLocaleString());
               
    }

    function save_floor_js()
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
             // var combined_arr = bu_id_arr.concat(bu_new_arr);
             combined_arr = bu_id_arr.filter(function(value) {
              return value.trim() !== "";
            });
              var hasError = false;
             for(var a=0; a<combined_arr.length; a++)
              {
                if ($('#year option:selected').val() == 0)
                 {
                  Swal.fire('Missing Date', 'Please select a Year', 'error');
                  hasError = true;
                      break;
                 }

                 else if ($('#month option:selected').val() == 0) 
                 {
                   Swal.fire('Missing Date', 'Please select a Month', 'error');
                   hasError = true;
                      break;
                 }
                 else if ($('#b1_'+combined_arr[a]).val() == '')
                 {
                    Swal.fire('Missing Basement 1 Data', 'It is required', 'error');
                    hasError = true;
                      break;
                 }
                 else if ($('#b2_'+combined_arr[a]).val() == '')
                 {
                    Swal.fire('Missing Basement 2 Data', 'It is required', 'error');
                    hasError = true;
                      break;
                 }
                 else if ($('#gf_'+combined_arr[a]).val() == '')
                 {
                    Swal.fire('Missing Ground Floor Data', 'It is required', 'error');
                    hasError = true;
                      break;
                 }
                 else if ($('#mez_'+combined_arr[a]).val() == '')
                 {
                    Swal.fire('Missing Mezzanine Data', 'It is required', 'error');
                    hasError = true;
                      break;
                 }
                 else if ($('#second_'+combined_arr[a]).val() == '')
                 {
                    Swal.fire('Missing Second Floor Data', 'It is required', 'error');
                    hasError = true;
                      break;
                 }
                 else if ($('#third_'+combined_arr[a]).val() == '')
                 {
                    Swal.fire('Missing Third Floor Data', 'It is required', 'error');
                    hasError = true;
                      break;
                 }
                 else if ($('#fourth_'+combined_arr[a]).val() == '')
                 {
                    Swal.fire('Missing Fourth Floor Data', 'It is required', 'error');
                    hasError = true;
                      break;
                 }
                 else if ($('#fifth_'+combined_arr[a]).val() == '')
                 {
                    Swal.fire('Missing Fifth Floor Data', 'It is required', 'error');
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
                        url: '<?php echo base_url(); ?>save_floor_route',
                        data: {
                           'user_id'    : $('#user_id_ssd').val(),
                           'year_id'    : $('#year option:selected').val(),
                           'month_id'   : $('#month option:selected').val(),
                           'dcode'      : combined_arr[a],
                           'b1'         : $('#b1_'+combined_arr[a]).val().split(',').join(''),            
                           'b2'         : $('#b2_'+combined_arr[a]).val().split(',').join(''),            
                           'gf'         : $('#gf_'+combined_arr[a]).val().split(',').join(''),            
                           'mez'        : $('#mez_'+combined_arr[a]).val().split(',').join(''),            
                           'second'     : $('#second_'+combined_arr[a]).val().split(',').join(''),            
                           'third'      : $('#third_'+combined_arr[a]).val().split(',').join(''),            
                           'fourth'     : $('#fourth_'+combined_arr[a]).val().split(',').join(''),            
                           'fifth'      : $('#fifth_'+combined_arr[a]).val().split(',').join('')            
                        },

                        dataType: 'json',
                        success: function(data) {

                          select_date_area_js();  
                          //display_ssd_table_js(); 
                          //select_date_list_js();     
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


   </script>   
   </body>
</html>