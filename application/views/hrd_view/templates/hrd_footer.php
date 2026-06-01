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
        
      <!-- custom js -->
   
<script>
   function hrd_home_js()
   { 
        document.querySelector('.records-menu').classList.remove('record-header-style');
        document.querySelector('.records-menu span').classList.remove('record-header-style-span');
        document.querySelector('.reports-menu').classList.remove('reports-menu-style');
        document.querySelector('.reports-menu span').classList.remove('reports-menu-style-span');

        document.querySelector('.homepage-menu').classList.add('home-header-style');
        document.querySelector('.homepage-menu span').classList.add('home-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>hrd_home_route');   
      $("#header_name").html("🧮DASHBOARD");   
   }

   function records_js()
   {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.reports-menu').classList.remove('reports-menu-style');
         document.querySelector('.reports-menu span').classList.remove('reports-menu-style-span');

         document.querySelector('.records-menu').classList.add('record-header-style');
         document.querySelector('.records-menu span').classList.add('record-header-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>records_route');   
      $("#header_name").html("🧑🏻‍💻Employee's Record👩🏻‍💻"); 
   }

   function reports_js()
   {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.records-menu').classList.remove('record-header-style');
         document.querySelector('.records-menu span').classList.remove('record-header-style-span');

         document.querySelector('.reports-menu').classList.add('reports-menu-style');
         document.querySelector('.reports-menu span').classList.add('reports-menu-style-span');

      $("#body_name").html("");
      $("#body_name").load('<?php echo base_url(); ?>reports_route');   
      $("#header_name").html("📰Employee's Report"); 
   }

    function approve_hrd_js(month,year)
    {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.reports-menu').classList.remove('reports-menu-style');
         document.querySelector('.reports-menu span').classList.remove('reports-menu-style-span');

         document.querySelector('.records-menu').classList.add('record-header-style');
         document.querySelector('.records-menu span').classList.add('record-header-style-span');
        var url = '<?php echo base_url("records_route"); ?>?month=' + month + '&year=' + year;
        $("#body_name").load(url);
        $("#header_name").html("🧑🏻‍💻Employee's Record👩🏻‍💻"); 
    }

   function hrd_dashboard_js()
   {
      $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>hrd_dashboard_route',
              dataType: 'json',
              success: function(data) {
              $("#hrd_lacking_homepage").html(data.lacking_hrd); 
              }
            });
   }
   function display_table_employees()
    {
      
       $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>display_table_employees_route',
              dataType: 'json',
              success: function(data) {
              $("#hrd_employees_table").html(data.html);    
              $("#bu_id").val(data.bu_id);    
              select_month_year_js_v2();
              }
            });
    }

   function select_month_year_js_v2()
    {   

        var img = '<img src="<?php echo base_url(); ?>assets/img/Spinners.gif" alt="Italian Trulli" style="margin-left: 474px; margin-bottom: -695px; margin-top: -244px; height: 115px; width: 115px;">';  
        $("#loader").html(img); 
        if($('#month_id').val()   !=''   &&  $('#year_id').val() !='')
        {
               $.ajax({
            type: 'post',
            url: 'http://172.16.161.100/storego/API_PIS/API_Controller/select_month_year_ctrl',
            data:{
                     'month_id': $("#month_id option:selected").val(),
                     'year_id': $("#year_id option:selected").val(),
                     'bu_id': $("#bu_id").val()
                 },
            dataType: 'json',
            success: function(data) {
                    $("#m_start").text(data.month_start);                   
                    $("#m_end").text(data.month_end);   
                    $("#display_dept").html(data.tr); 
                    if(data.month_select != '')
                    {
                        $("#month_id").html(data.month_select);
                    }  
                    $("#loader").html(''); 

            }
          });
        }
    }

    // function display_table_reports_js()
    // {
    //     $.ajax({
    //           type: 'post',
    //           url: '<?php echo base_url(); ?>display_table_reports_route',
    //           dataType: 'json',
    //           success: function(data) {
    //           $("#hrd_reports_table").html(data.html);
    //           select_year_js();
    //           }
    //         });
    // }

    function select_year_js()
    {
         $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>select_year_route',
            data:{
                     'year_id': $("#year_id option:selected").val()
                },
            dataType: 'json',
            success: function(data) {
                    $("#hrd_reports_table").html(data.rec);                   
            }
          });
        
    }

    



   </script>   
   </body>
</html>