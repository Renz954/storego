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
   function engineer_home_js()
   { 
        document.querySelector('.water-menus').classList.remove('water-header-style');
        document.querySelector('.water-menus span').classList.remove('water-header-style-span');
        document.querySelector('.electric-menus').classList.remove('electric-header-style');
         document.querySelector('.electric-menus span').classList.remove('electric-header-style-span');

        document.querySelector('.homepage-menu').classList.add('home-header-style');
        document.querySelector('.homepage-menu span').classList.add('home-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>engineer_home_route');   
      $("#header_name").html("🧮DASHBOARD");   
   }

   function engineer_water_js()
   {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.electric-menus').classList.remove('electric-header-style');
         document.querySelector('.electric-menus span').classList.remove('electric-header-style-span');

         document.querySelector('.water-menus').classList.add('water-header-style');
         document.querySelector('.water-menus span').classList.add('water-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>engineer_water_route');   
      $("#header_name").html("💦 Water Consumption Report"); 
   }

   function engineer_electric_js()
   {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.water-menus').classList.remove('water-header-style');
         document.querySelector('.water-menus span').classList.remove('water-header-style-span');

         document.querySelector('.electric-menus').classList.add('electric-header-style');
         document.querySelector('.electric-menus span').classList.add('electric-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>engineer_electric_route');   
      $("#header_name").html("⚡ Electric Consumption Report"); 
   }

   function leasing_about_us()
   {
        $("#body_name").html("");
        $("#body_name").load('<?php echo base_url(); ?>leasing_about_us_route');   
        $("#header_name").html("🛈 About Us"); 
   }

    function engineer_dashboard_js()
    {
        $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>engineer_dashboard_route',
              dataType: 'json',
              success: function(data) {
              $("#table_lacking_water").html(data.lacking_wat);  
              $("#table_lacking_electric").html(data.lacking_elect);  
              }
            });
    }

    function select_date_water_js()
    {   
        var data= $("#comp_engr option:selected").val().split('|');
        $("#water_type").text($("#comp_engr option:selected").text());
        $("#water_button_save").prop('hidden', true);
        $("#refresh_btn").prop('hidden', true);
       $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>select_date_water_route',
            data:{
                     'month_id': $("#month_id option:selected").val(),
                     'year_id' : $("#year_id option:selected").val(),
                     'type': data[1],
                     'id': data[0]
                },
            dataType: 'json',
            success: function(data) {
                  if(data.month_select != '')
                    {
                        $("#month_id").html(data.month_select);
                    }  

                  if(data.button_hide == 'EMPTY')
                  {
                    $("#water_button_save").prop('hidden', false);
                    $("#refresh_btn").prop('hidden', false);
                  }
                  if(data.admin_list == '0.00')
                  {
                    $("#water_button_save").prop('hidden', true);
                     Swal.fire('Empty Previous Data', 'Make sure to submit previous readings', 'error');
                  }

                    $("#water_consumption_table").html(data.dept_list); 
                    $("#amount_id_"+data.user_id).html(data.admin_list); 
                    $("#water_list_table").html(data.water_list); 
                    $("#rate_id_"+data.user_id).html(data.rate); 

                    $("#hidden_input").html(data.hidden_input); 
                    $("#hidden_input_admin").html(data.hidden_input_admin); 
                    $("#hidden_new").html(data.hidden_new) 
                    setTimeout(function() {                           
                             var bu_id_arr = $("#bu_id").val().split('^');
                                 // var bu_new_arr = $("#new_bu_id").val().split('^');
                                 // var combined_arr = bu_id_arr.concat(bu_new_arr);
                                 combined_arr = bu_id_arr.filter(function(value) {
                                  return value.trim() !== "";
                                });
                             for(var a=0;a<combined_arr.length;a++) 
                             {
                                $("#consumption_id_"+combined_arr[a]).text('0.00');
                                $("#def_consumption_"+combined_arr[a]).text('0.00');
                             }
                             $("#total_con").text('0.00');
                             $("#total_amount").text('0.00');
                    }, 100);            

                    setTimeout(function() {    
                             if(data.existing == 'yes')
                                   {
                                        compute_all(data.user_id,data.bu_id,data.rate,data.old_amount);
                                   }
                     }, 100);         

            }
          });
    }

    function select_date_electric_js()
    {   
        var data= $("#comp_engr option:selected").val().split('|');
        $("#electric_type").text($("#comp_engr option:selected").text());
        $("#electric_button_save").prop('hidden', true);
        $("#refresh_btn").prop('hidden', true);
       $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>select_date_electric_route',
            data:{
                     'month_id': $("#month_id option:selected").val(),
                     'year_id' : $("#year_id option:selected").val(),
                     'type': data[1],
                     'id': data[0]
                },
            dataType: 'json',
            success: function(data) {
                  if(data.month_select != '')
                    {
                        $("#month_id").html(data.month_select);
                    }  

                  if(data.button_hide == 'EMPTY')
                  {
                    $("#electric_button_save").prop('hidden', false);
                    $("#refresh_btn").prop('hidden', false);
                  }
                  if(data.admin_list == '0.00')
                  {
                    $("#electric_button_save").prop('hidden', true);
                     Swal.fire('Empty Previous Data', 'Make sure to submit previous readings', 'error');
                  }

                    $("#electric_consumption_table").html(data.dept_list); 
                    $("#amount_id_"+data.user_id).html(data.admin_list); 
                    $("#electric_list_table").html(data.electric_list); 
                    $("#rate_id_"+data.user_id).html(data.rate); 

                    $("#hidden_input").html(data.hidden_input); 
                    $("#hidden_input_admin").html(data.hidden_input_admin); 
                    $("#hidden_new").html(data.hidden_new) 
                    setTimeout(function() {                           
                             var bu_id_arr = $("#bu_id").val().split('^');
                                 // var bu_new_arr = $("#new_bu_id").val().split('^');
                                 // var combined_arr = bu_id_arr.concat(bu_new_arr);
                                 combined_arr = bu_id_arr.filter(function(value) {
                                  return value.trim() !== "";
                                });
                             for(var a=0;a<combined_arr.length;a++) 
                             {
                                $("#consumption_id_"+combined_arr[a]).text('0.00');
                                $("#def_consumption_"+combined_arr[a]).text('0.00');
                             }
                             $("#total_con").text('0.00');
                             $("#total_amount").text('0.00');
                    }, 100);            

                    setTimeout(function() {    
                             if(data.existing == 'yes')
                                   {
                                        compute_all(data.user_id,data.bu_id,data.rate,data.old_amount);
                                   }
                     }, 100);         

            }
          });
    }

    function compute_all(user_id,bu_id,rate,old)
    {
        var admin_present = parseFloat($("#present_id_"+user_id).val().replace(/,/g, ''));
        if(admin_present == null)
        {
           admin_present = 0.00;
        }

        var previous_admin = parseFloat($("#amount_id_"+user_id).text().replace(/,/g, ''));
        if(previous_admin == null)
        {
            previous_admin = 0.00;
        }
        if(old != '0')
        {
            var adding_old = parseFloat(old)+parseFloat(admin_present);
            // console.log(old);
          var consumption = adding_old - previous_admin;
        }
        else
        {
            
         var consumption = admin_present - previous_admin;
        }

        //console.log(admin_present+'\n'+previous_admin);
        
        $("#consumption_id_"+user_id).text(consumption.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

        var total_amount_def = consumption * rate;

         $("#tot_amount_id").text(total_amount_def.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));



          var bu_id_arr= bu_id.split('^');
          // var bu_new_arr= bu_new.split('^');
         // var combined_arr = bu_id_arr.concat(bu_new_arr);
         combined_arr = bu_id_arr.filter(function(value) {
          return value.trim() !== "";
        });
        var tot_consum =0.00;
        for(var a=0; a<combined_arr.length; a++)
        {
                var admin_present = parseFloat($("#present_id_"+combined_arr[a]).val().replace(/,/g, ''));
            if(admin_present == null)
            {
               admin_present = 0.00;
            }

            var previous_admin = parseFloat($("#previous_"+combined_arr[a]).text().replace(/,/g, ''));
            if(previous_admin == null)
            {
                previous_admin = 0.00;
            }

            var old_admin = parseFloat($("#old_id_"+combined_arr[a]).val());
            if (old_admin === null || isNaN(old_admin)) {
                old_admin = 0.00;
            }
                var consumption = admin_present + old_admin;
                var consumption = consumption - previous_admin;
            // console.log($("#old_id_"+combined_arr[a]).val());
            
           /*  console.log(admin_present +'--->'+ previous_admin+'\n');*/
              $("#consumption_id_"+combined_arr[a]).text(consumption.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

             var final_consumption =  parseFloat($("#tot_amount_id").text().replace(/,/g, '')) * parseFloat($("#consumption_id_"+combined_arr[a]).text().replace(/,/g, ''));

              $("#def_consumption_"+combined_arr[a]).text(final_consumption.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

             tot_consum += consumption;

        }

             $("#total_con").text(tot_consum.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

        for(var a=0;a<combined_arr.length;a++)
         {
            var amount =   parseFloat($("#def_consumption_"+combined_arr[a]).text().replace(/,/g, '')) / parseFloat($("#total_con").text().replace(/,/g, ''));

           if(isNaN(amount)) 
           {
                $("#def_consumption_"+combined_arr[a]).text('0.00');
           }
           else
           {
                $("#def_consumption_"+combined_arr[a]).text(amount.toFixed(3).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
           }
        }


            var total_amount = 0.00;
         for(var a=0;a<combined_arr.length;a++)
         {

             total_amount = total_amount + parseFloat($("#def_consumption_"+combined_arr[a]).text().replace(/,/g, ''));
         }

         // console.log(total_amount);
         $("#total_amount").text(total_amount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));


    }

    function cacl_consumption(id,rate,old)
 {
     var bu_id_arr = $("#bu_id").val().split('^');
     // var bu_new_arr = $("#new_bu_id").val().split('^');
     // var combined_arr = bu_id_arr.concat(bu_new_arr);
     combined_arr = bu_id_arr.filter(function(value) {
      return value.trim() !== "";
    });
     console.log(old);



    var id_arr         = id.split('^');
    if(old != '0')
    {
        var adding_old= parseFloat($(id_arr[0]).val().replace(/,/g, '')) + parseFloat(old);
        console.log(adding_old);
        var consumption    = adding_old - parseFloat($(id_arr[1]).text().replace(/,/g, ''));
    }
    else
    {

        var consumption    = parseFloat($(id_arr[0]).val().replace(/,/g, '')) - parseFloat($(id_arr[1]).text().replace(/,/g, ''));
    }
    //var total_con      = consumption;
    var default_amount = consumption;
    if(rate != '_')
    {
       default_amount = consumption * rate;
       $('#tot_amount_id').text( default_amount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
       $(id_arr[2]).text( consumption.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    }
    else
    {

       var product_consumption = parseFloat($('#tot_amount_id').text().replace(/,/g, ''))*consumption;
       $(id_arr[2]).text( consumption.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    }
   // var amount_con     = default_amount * consumption;
  
   // console.log(bu_id_arr);

     var total_consumpt = 0.00;
     for(var a=0;a<combined_arr.length;a++)
     {
        var consumpt = $("#consumption_id_"+combined_arr[a]).text();
        //console.log(consumpt);
        if(consumpt == '')
        {
             var amount =   parseFloat($("#tot_amount_id").text().replace(/,/g, '')) * 0.00 ;
             $("#def_consumption_"+combined_arr[a]).text(amount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
             consumpt = 0.00;
        }
        else 
        {
            var amount = parseFloat($("#tot_amount_id").text().replace(/,/g, '')) * consumpt.replace(/,/g, '');
            console.log(amount);
            consumpt   = parseFloat(consumpt.replace(/,/g, ''));
           // var final_amount = amount / total_consumpt;
            $("#def_consumption_"+combined_arr[a]).text(amount.toFixed(3).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        }
         var total_consumpt = total_consumpt + consumpt;

         //console.log(total_consumpt);
     }

     $("#total_con").text(total_consumpt.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));




     for(var a=0;a<combined_arr.length;a++)
     {
            var amount =   parseFloat($("#def_consumption_"+combined_arr[a]).text().replace(/,/g, '')) / parseFloat($("#total_con").text().replace(/,/g, ''));

           if(isNaN(amount)) 
           {
                $("#def_consumption_"+combined_arr[a]).text('0.00');
           }
           else
           {
                $("#def_consumption_"+combined_arr[a]).text(amount.toFixed(3).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
           }
     }

     var total_amount = 0.00;
     for(var a=0;a<combined_arr.length;a++)
     {
         total_amount = total_amount + parseFloat($("#def_consumption_"+combined_arr[a]).text().replace(/,/g, ''));
     }

     //console.log(total_amount);
     $("#total_amount").text(total_amount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

     if(parseFloat($(id_arr[0]).val().replace(/,/g, '')) < parseFloat($(id_arr[1]).text().replace(/,/g, '')))
    {
        console.log('wrong');
    }
    else
    {
        console.log('correct');
    }

 }

 function calc_consumption_js(input)
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
 }

 function save_water_billing_js()
    {
        var user_id=$('#user_id').val();
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
     var bu_admin_arr= $('#admin_bu_id').val().split('^');
      var bu_id_arr = $("#bu_id").val().split('^');
         // var bu_new_arr = $("#new_bu_id").val().split('^');
         // var combined_arr = bu_id_arr.concat(bu_new_arr);
         combined_arr = bu_id_arr.filter(function(value) {
          return value.trim() !== "";
        });
        var data= $("#comp_engr option:selected").val().split('|');
         var message= '';
          for(var a=0; a<combined_arr.length; a++)
          {
            // console.log($("#consumption_id_"+combined_arr[a]).text());
            if($("#present_id_"+combined_arr[a]).val() =='' || $("#present_id_"+combined_arr[a]).val() == 0.00)
            {
                message='EMPTY'
            }
            //console.log();
            else
            // if(parseFloat($("#present_id_"+combined_arr[a]).val()) < parseFloat($("#previous_"+combined_arr[a]).text()))
            if($("#consumption_id_"+combined_arr[a]).text() < 0)
            {
                message = 'INVALID';
            }
          }
          

        if ($('#present_id_'+user_id).val() == 0.00 || $('#present_id_'+user_id).val() == '' )
         {
          Swal.fire('Missing Amount', 'Please enter amount', 'error');
         }else
         if(message=='EMPTY')
         {
             Swal.fire('Missing Amount', 'Please enter amount', 'error');
         }else 
         // if(parseFloat($('#present_id_'+user_id).val()) < parseFloat($('#amount_id_'+user_id).text()))
         if($("#consumption_id_"+combined_arr[a]).text() < 0)
         {
            Swal.fire('Invalid Amount', 'Present Amount must higher than Previous Amount','error');
         }
         else 
         if(message=='INVALID')
         {
             Swal.fire('Invalid Amount', 'Present Amount must higher than Previous Amount', 'error');
         }else 
         if($("#month_id").val() == '')
         {
            Swal.fire('Select Month', 'Required Month','error');
         }
         else
         if($("#year_id").val() == '')
         {
            Swal.fire('Select Year', 'Required Year', 'error')
         }else
         if(data[0]=='')
         {
              Swal.fire('Select Company', 'Required Company', 'error');
         }
         else {

        for(var a=1; a<bu_admin_arr.length; a++)
          {
               var company_code= bu_admin_arr[a].substr(0, 2);
               var bunit_code= bu_admin_arr[a].substr(2, 2);
               var dept_code= bu_admin_arr[a].substr(4, 2);
          $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>save_water_billing_route',
            data: {

              'company_code': company_code,
              'bunit_code'  : bunit_code,
              'dept_code'   : dept_code,
              'user_id': $('#user_billing_id').val(),
              'year'   : $('#year_id option:selected').val(),
              'month'  : $('#month_id option:selected').val(),
             'amount'  : $('#present_id_'+user_id).val().split(',').join(''),
             'rate'    : $('#rate_id_'+user_id).text(),
              'type'   : data[1],
              'engr_id': data[0]
              
            },

            dataType: 'json',
           
          });
            }

          for(var a=0; a<combined_arr.length; a++)
          {
               var company_code= combined_arr[a].substr(0, 2);
               var bunit_code= combined_arr[a].substr(2, 2);
               var dept_code= combined_arr[a].substr(4, 2);

            $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>save_water_billing_route',
            data: {

              'company_code':company_code,
              'bunit_code':bunit_code,
              'dept_code': dept_code,
               'user_id': $('#user_billing_id').val(),
              'year'   : $('#year_id option:selected').val(),
              'month'  : $('#month_id option:selected').val(),
             'amount'  : $('#present_id_'+combined_arr[a]).val().split(',').join(''),
             'rate'    : '0',
              'type'   : data[1],
              'engr_id': data[0]
               
            },

            dataType: 'json',
            success: function(data) {

              console.log(data);
              select_date_water_js();        
               // display_water_consumption_table_js();          
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

  function save_electric_billing_js()
    {
        var user_id=$('#user_id').val();
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
     var bu_admin_arr= $('#admin_bu_id').val().split('^');
      var bu_id_arr = $("#bu_id").val().split('^');
         // var bu_new_arr = $("#new_bu_id").val().split('^');
         // var combined_arr = bu_id_arr.concat(bu_new_arr);
         combined_arr = bu_id_arr.filter(function(value) {
          return value.trim() !== "";
        });
        var data= $("#comp_engr option:selected").val().split('|');
         var message= '';
          for(var a=0; a<combined_arr.length; a++)
          {
            // console.log($("#consumption_id_"+combined_arr[a]).text());
            if($("#present_id_"+combined_arr[a]).val() =='' || $("#present_id_"+combined_arr[a]).val() == 0.00)
            {
                message='EMPTY'
            }
            //console.log();
            else
            // if(parseFloat($("#present_id_"+combined_arr[a]).val()) < parseFloat($("#previous_"+combined_arr[a]).text()))
            if($("#consumption_id_"+combined_arr[a]).text() < 0)
            {
                message = 'INVALID';
            }
          }
          

        if ($('#present_id_'+user_id).val() == 0.00 || $('#present_id_'+user_id).val() == '' )
         {
          Swal.fire('Missing Amount', 'Please enter amount', 'error');
         }else
         if(message=='EMPTY')
         {
             Swal.fire('Missing Amount', 'Please enter amount', 'error');
         }else 
         // if(parseFloat($('#present_id_'+user_id).val()) < parseFloat($('#amount_id_'+user_id).text()))
         if($("#consumption_id_"+combined_arr[a]).text() < 0)
         {
            Swal.fire('Invalid Amount', 'Present Amount must higher than Previous Amount','error');
         }
         else 
         if(message=='INVALID')
         {
             Swal.fire('Invalid Amount', 'Present Amount must higher than Previous Amount', 'error');
         }else 
         if($("#month_id").val() == '')
         {
            Swal.fire('Select Month', 'Required Month','error');
         }
         else
         if($("#year_id").val() == '')
         {
            Swal.fire('Select Year', 'Required Year', 'error')
         }else
         if(data[0]=='')
         {
              Swal.fire('Select Company', 'Required Company', 'error');
         }
         else {

        for(var a=1; a<bu_admin_arr.length; a++)
          {
               var company_code= bu_admin_arr[a].substr(0, 2);
               var bunit_code= bu_admin_arr[a].substr(2, 2);
               var dept_code= bu_admin_arr[a].substr(4, 2);
          $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>save_water_billing_route',
            data: {

              'company_code': company_code,
              'bunit_code'  : bunit_code,
              'dept_code'   : dept_code,
              'user_id': $('#user_billing_id').val(),
              'year'   : $('#year_id option:selected').val(),
              'month'  : $('#month_id option:selected').val(),
             'amount'  : $('#present_id_'+user_id).val().split(',').join(''),
             'rate'    : $('#rate_id_'+user_id).text(),
              'type'   : data[1],
              'engr_id': data[0]
              
            },

            dataType: 'json',
           
          });
            }

          for(var a=0; a<combined_arr.length; a++)
          {
               var company_code= combined_arr[a].substr(0, 2);
               var bunit_code= combined_arr[a].substr(2, 2);
               var dept_code= combined_arr[a].substr(4, 2);

            $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>save_electric_billing_route',
            data: {

              'company_code':company_code,
              'bunit_code':bunit_code,
              'dept_code': dept_code,
               'user_id': $('#user_billing_id').val(),
              'year'   : $('#year_id option:selected').val(),
              'month'  : $('#month_id option:selected').val(),
             'amount'  : $('#present_id_'+combined_arr[a]).val().split(',').join(''),
             'rate'    : '0',
              'type'   : data[1],
              'engr_id': data[0]
               
            },

            dataType: 'json',
            success: function(data) {

              console.log(data);
              select_date_electric_js();        
               // display_water_consumption_table_js();          
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

    function approve_water_is(month, year)
    {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.electric-menus').classList.remove('electric-header-style');
         document.querySelector('.electric-menus span').classList.remove('electric-header-style-span');

         document.querySelector('.water-menus').classList.add('water-header-style');
         document.querySelector('.water-menus span').classList.add('water-header-style-span');

        var url = '<?php echo base_url("engineer_water_route"); ?>?month=' + month + '&year=' + year;
        $("#body_name").load(url);
        $("#header_name").html("💦 Water Consumption Report");
    }

    function approve_electric_js(month, year)
    {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.water-menus').classList.remove('water-header-style');
         document.querySelector('.water-menus span').classList.remove('water-header-style-span');

         document.querySelector('.electric-menus').classList.add('electric-header-style');
         document.querySelector('.electric-menus span').classList.add('electric-header-style-span');

        var url = '<?php echo base_url("engineer_electric_route"); ?>?month=' + month + '&year=' + year;
        $("#body_name").load(url);
        $("#header_name").html("⚡ Electric Consumption Report"); 
    }

    function edit_water_amount_js(id,date,dept,comp_name,amount,previous,old_meter)
    {
        // console.log(previous);
        $("#edit_water_modal").modal({backdrop: 'static', keyboard: false}, 'show');
        $("#wat_id_edit").val(id);
        $("#edit_date_wat").text(date);
        $("#edit_wat_com").text(comp_name);
        $("#edit_dept").text(dept);
        $("#edit_wat_bill").val(amount);
        $("#wat_admin").val(previous);
        $("#old_meter_water").val(old_meter);
    }

    function update_water_js()
    {
        Swal.fire({
            icon: 'info',
            title: 'Are you sure?',
            text: 'You want to update!',
            showDenyButton: true,
            /* showCancelButton: true,*/
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass:
            {
                actions: 'my-actions',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
            }).then((result) => {
            if (result.isConfirmed) 
            {
                 if ($('#edit_wat_bill').val() == '')
                 {
                    Swal.fire('Input Amount', 'Please input amount', 'error');
                 }
                 else if (parseInt($('#old_meter_water').val()) === 0 && parseFloat($('#wat_admin').val()) > parseFloat($('#edit_wat_bill').val().replace(',', '')))
                 {
                    Swal.fire('Invalid Amount', 'The number you inputed is less than previous number', 'error');
                 }
                 else 
                 {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url(); ?>update_water_route',
                        data: 
                        {
                            'id'       : $('#wat_id_edit').val(),             
                            'wat_bill' : $('#edit_wat_bill').val().split(',').join('')             
                        },

                        dataType: 'json',
                        success: function(data) 
                        {
                            Swal.fire('Submit Complete', '', 'success');  
                            select_date_water_js();  
                            $('#edit_water_modal').modal('toggle');    
                        }
                    });
                
                 }
            } 
            else if (result.isDenied) 
            {
                Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error')
            }
        })
    }

    function edit_electric_amount_js(id,date,dept,comp_name,amount,previous,old_meter)
    {
        $("#edit_electric_modal").modal({backdrop: 'static', keyboard: false}, 'show');
        $("#elec_id_edit").val(id);
        $("#edit_date_elect").text(date);
        $("#edit_elect_com").text(comp_name);
        $("#edit_dept").text(dept);
        $("#edit_elect_bill").val(amount);
        $("#previous_admin").val(previous);
        $("#old_meter_validate").val(old_meter);
    }

    function update_electric_js()
    {
        console.log($('#edit_elect_bill').val().split(',').join(''));

        Swal.fire({
            icon: 'info',
            title: 'Are you sure?',
            text: 'You want to update!',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: 
            {
                actions: 'my-actions',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
            }).then((result) => {
            if (result.isConfirmed) 
            {
                 if ($('#edit_elect_bill').val() == '')
                 {
                    Swal.fire('Input Amount', 'Please input amount', 'error');
                 }
                 else if (parseInt($('#old_meter_validate').val()) === 0 && parseFloat($('#previous_admin').val()) > parseFloat($('#edit_elect_bill').val().replace(',', '')))
                 {
                    Swal.fire('Invalid Amount', 'The number you inputed is less than previous number', 'error');
                 }
                 else 
                 {
                    $.ajax({
                         type: 'post',
                         url: '<?php echo base_url(); ?>update_electric_route',
                         data: 
                         {
                                     'id' : $('#elec_id_edit').val(),             
                             'elect_bill' : $('#edit_elect_bill').val().split(',').join('')            
                         },

                         dataType: 'json',
                         success: function(data) 
                         {
                            Swal.fire('Submit Complete', '', 'success');
                            select_date_electric_js();
                            $('#edit_electric_modal').modal('toggle');    
                         }
                    });
                    
                 }
            }
            else if (result.isDenied) 
            {
                Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error');
            }
        })
    }


    </script>   
   </body>
</html>