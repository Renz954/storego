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
   function finance_home_js()
   { 
        document.querySelector('.nav_monitor_data').classList.remove('all_header_style');
        document.querySelector('.nav_monitor_data span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_basis').classList.remove('all_header_style');
        document.querySelector('.nav_allo_basis span').classList.remove('all_header_style_span');
        document.querySelector('.exp_monitor_data').classList.remove('all_header_style');
        document.querySelector('.exp_monitor_data span').classList.remove('all_header_style_span');
        document.querySelector('.go_expense').classList.remove('all_header_style');
        document.querySelector('.go_expense span').classList.remove('all_header_style_span');
        document.querySelector('.reports_menu').classList.remove('all_header_style');
        document.querySelector('.reports_menu span').classList.remove('all_header_style_span');

        document.querySelector('.homepage-menu').classList.add('all_header_style');
        document.querySelector('.homepage-menu span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>finance_home_route');   
      $("#header_name").html("🧮DASHBOARD");   
   }

   function finance_nav_data_js()
   {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_basis').classList.remove('all_header_style');
        document.querySelector('.nav_allo_basis span').classList.remove('all_header_style_span');
        document.querySelector('.exp_monitor_data').classList.remove('all_header_style');
        document.querySelector('.exp_monitor_data span').classList.remove('all_header_style_span');
        document.querySelector('.go_expense').classList.remove('all_header_style');
        document.querySelector('.go_expense span').classList.remove('all_header_style_span');
        document.querySelector('.reports_menu').classList.remove('all_header_style');
        document.querySelector('.reports_menu span').classList.remove('all_header_style_span');

        document.querySelector('.nav_monitor_data').classList.add('all_header_style');
        document.querySelector('.nav_monitor_data span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>finance_nav_data_route');   
      $("#header_name").html("🖥️ Monitoring Navision Data"); 
   }

   function finance_nav_allo_js()
   {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_monitor_data').classList.remove('all_header_style');
        document.querySelector('.nav_monitor_data span').classList.remove('all_header_style_span');
        document.querySelector('.exp_monitor_data').classList.remove('all_header_style');
        document.querySelector('.exp_monitor_data span').classList.remove('all_header_style_span');
        document.querySelector('.go_expense').classList.remove('all_header_style');
        document.querySelector('.go_expense span').classList.remove('all_header_style_span');
        document.querySelector('.reports_menu').classList.remove('all_header_style');
        document.querySelector('.reports_menu span').classList.remove('all_header_style_span');

        document.querySelector('.nav_allo_basis').classList.add('all_header_style');
        document.querySelector('.nav_allo_basis span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>finance_nav_allo_route');   
      $("#header_name").html("📊 Navision Allocation Basis"); 
   }

   function exp_monitor_data_js()
   {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_monitor_data').classList.remove('all_header_style');
        document.querySelector('.nav_monitor_data span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_basis').classList.remove('all_header_style');
        document.querySelector('.nav_allo_basis span').classList.remove('all_header_style_span');
        document.querySelector('.go_expense').classList.remove('all_header_style');
        document.querySelector('.go_expense span').classList.remove('all_header_style_span');
        document.querySelector('.reports_menu').classList.remove('all_header_style');
        document.querySelector('.reports_menu span').classList.remove('all_header_style_span');

        document.querySelector('.exp_monitor_data').classList.add('all_header_style');
        document.querySelector('.exp_monitor_data span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>exp_monitor_data_route');   
      $("#header_name").html("🕹️ Monitoring Expense Data"); 
   }

   function go_expense_js()
   {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_monitor_data').classList.remove('all_header_style');
        document.querySelector('.nav_monitor_data span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_basis').classList.remove('all_header_style');
        document.querySelector('.nav_allo_basis span').classList.remove('all_header_style_span');
        document.querySelector('.exp_monitor_data').classList.remove('all_header_style');
        document.querySelector('.exp_monitor_data span').classList.remove('all_header_style_span');
        document.querySelector('.reports_menu').classList.remove('all_header_style');
        document.querySelector('.reports_menu span').classList.remove('all_header_style_span');

        document.querySelector('.go_expense').classList.add('all_header_style');
        document.querySelector('.go_expense span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>go_expense_route');   
      $("#header_name").html("📈 Store GO Expense"); 
   }

   function report_menu_js()
   {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_monitor_data').classList.remove('all_header_style');
        document.querySelector('.nav_monitor_data span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_basis').classList.remove('all_header_style');
        document.querySelector('.nav_allo_basis span').classList.remove('all_header_style_span');
        document.querySelector('.exp_monitor_data').classList.remove('all_header_style');
        document.querySelector('.exp_monitor_data span').classList.remove('all_header_style_span');
        document.querySelector('.go_expense').classList.remove('all_header_style');
        document.querySelector('.go_expense span').classList.remove('all_header_style_span');

        document.querySelector('.reports_menu').classList.add('all_header_style');
        document.querySelector('.reports_menu span').classList.add('all_header_style_span');

      $("#body_name").load('<?php echo base_url(); ?>report_menu_route');   
      $("#header_name").html("💾 Report"); 
   }

   function leasing_about_us()
   {
        $("#body_name").html("");
        $("#body_name").load('<?php echo base_url(); ?>leasing_about_us_route');   
        $("#header_name").html("🛈 About Us"); 
   }

    function finance_dashboard_js()
    {
        $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>finance_dashboard_route',
              dataType: 'json',
              success: function(data) {
              $("#nav_allo_data").html(data.html);  
              $("#expense_data").html(data.expense_html);  
              }
            });
    }

    function select_monitor_allo_js()
    {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>select_monitor_allo_route',
            data:{
                     'month_id': $("#month_id option:selected").val(),
                     'year_id' : $("#year_id option:selected").val(),
                     'status_id' : $("#status_id option:selected").val()
                },
            dataType: 'json',
            success: function(data) {
                 $("#month_id").html(data.select_month);  
                 $("#table_monitor_nav").html(data.tbl_html);  

            }
          });
    }

    function select_nav_data_js()
    {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>select_nav_data_route',
            data:{
                     'month_id': $("#month_id option:selected").val(),
                     'year_id' : $("#year_id option:selected").val(),
                     'store_id' : $("#store_id option:selected").val()
                },
            dataType: 'json',
            success: function(data) {
                 $("#month_id").html(data.select_month);  
                 $("#table_fin_nav_data").html(data.tbl_html);  

            }
          });
    }

    function select_monitor_expense_js()
    {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>select_monitor_expense_route',
            data:{
                     'month_id': $("#month_id option:selected").val(),
                     'year_id' : $("#year_id option:selected").val(),
                     'status_id' : $("#status_id option:selected").val()
                },
            dataType: 'json',
            success: function(data) {
                 $("#month_id").html(data.select_month);  
                 $("#table_monitor_expense").html(data.tbl_html);  

            }
          });
    }

    function select_go_expense_js()
    {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>select_go_expense_route',
            data:{
                     'month': $("#month_ids option:selected").val(),
                     'year' : $("#year_ids option:selected").val(),
                     'store' : $("#store_ids option:selected").val()
                },
            dataType: 'json',
            success: function(data) {
                 $("#month_ids").html(data.select_month);  
                 $("#table_fin_exp_data").html(data.tbl_html);  

            }
          });
    }

    function select_finance_report_js()
    {
        var img = '<img src="<?php echo base_url(); ?>assets/img/Spinners.gif" alt="Italian Trulli" style="margin-left: 474px; margin-bottom: -695px; margin-top: -29%; height: 115px; width: 115px;">' ;  
        $("#loader").html(img); 
         $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>select_finance_report_route',
                data:{
                         'month': $("#month_id option:selected").val(),
                         'year' : $("#year_id option:selected").val(),
                         'store_ids' : $("#store_ids option:selected").val()
                    },
                dataType: 'json',
                success: function(data) {
                   
                        $("#month_id").html(data.month_select);  
                        $("#table_report_allocation").html(data.html);
                    }
                });
    }

    function finance_home_details_js(month,year)
    {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_basis').classList.remove('all_header_style');
        document.querySelector('.nav_allo_basis span').classList.remove('all_header_style_span');
        document.querySelector('.exp_monitor_data').classList.remove('all_header_style');
        document.querySelector('.exp_monitor_data span').classList.remove('all_header_style_span');
        document.querySelector('.go_expense').classList.remove('all_header_style');
        document.querySelector('.go_expense span').classList.remove('all_header_style_span');
        document.querySelector('.reports_menu').classList.remove('all_header_style');
        document.querySelector('.reports_menu span').classList.remove('all_header_style_span');

        document.querySelector('.nav_monitor_data').classList.add('all_header_style');
        document.querySelector('.nav_monitor_data span').classList.add('all_header_style_span');

          var url = '<?php echo base_url("finance_nav_data_route"); ?>?month=' + month + '&year=' + year;
          $("#body_name").load(url);   
          $("#header_name").html("🖥️ Monitoring Navision Data"); 
    }

    function finance_expense_details_js(month,year)
    {
        document.querySelector('.homepage-menu').classList.remove('all_header_style');
        document.querySelector('.homepage-menu span').classList.remove('all_header_style_span');
        document.querySelector('.nav_monitor_data').classList.remove('all_header_style');
        document.querySelector('.nav_monitor_data span').classList.remove('all_header_style_span');
        document.querySelector('.nav_allo_basis').classList.remove('all_header_style');
        document.querySelector('.nav_allo_basis span').classList.remove('all_header_style_span');
        document.querySelector('.go_expense').classList.remove('all_header_style');
        document.querySelector('.go_expense span').classList.remove('all_header_style_span');
        document.querySelector('.reports_menu').classList.remove('all_header_style');
        document.querySelector('.reports_menu span').classList.remove('all_header_style_span');

        document.querySelector('.exp_monitor_data').classList.add('all_header_style');
        document.querySelector('.exp_monitor_data span').classList.add('all_header_style_span');

          var url = '<?php echo base_url("exp_monitor_data_route"); ?>?month=' + month + '&year=' + year;
          $("#body_name").load(url);      
          $("#header_name").html("🕹️ Monitoring Expense Data"); 
    }
    </script>   
   </body>
</html>