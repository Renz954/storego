<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller']        		= 'Welcome/login_homepage_ctrl';
$route['404_override']              		= '';
$route['translate_uri_dashes']      		= FALSE;


$route['login_route']               		= 'Login_controller/login_ctrl';

//=============================== Administrator Routes ============================================
$route['Administrator_Access']              = 'Admin_Controller/administrator_homepage';
$route['admin_homepage']                    = 'Admin_Controller/admin_homepage';
$route['admin_user_route']                  = 'Admin_Controller/admin_user_ctrl';
$route['display_table_users_route']         = 'Admin_Controller/display_table_users_ctrl';
$route['admin_users_route']                 = 'Admin_Controller/admin_user_ctrl';
$route['admin_count_home_route']            = 'Admin_Controller/admin_count_home_ctrl';
$route['backup_database_route']             = 'Admin_Controller/backup_database_ctrl';
$route['billing_unit_cost_route']           = 'Admin_Controller/billing_unit_cost_ctrl';
$route['display_table_unit_route']          = 'Admin_Controller/display_table_unit_ctrl';
$route['old_meter_menu_route']              = 'Admin_Controller/old_meter_menu_ctrl';
$route['display_old_meter_route']           = 'Admin_Controller/display_old_meter_ctrl';
$route['val_bill_amount_route']             = 'Admin_Controller/val_bill_amount_ctrl';
$route['save_default_amount_route']         = 'Admin_Controller/save_default_amount_ctrl';
$route['update_bill_cost_route']            = 'Admin_Controller/update_bill_cost_ctrl';
$route['old_meter_modal_route']             = 'Admin_Controller/old_meter_modal_ctrl';
$route['select_type_route']                 = 'Admin_Controller/select_type_ctrl';
$route['validate_old_reading_route']        = 'Admin_Controller/validate_old_reading_ctrl';
$route['save_old_reading_route']            = 'Admin_Controller/save_old_reading_ctrl';
$route['edit_type_route']                   = 'Admin_Controller/edit_type_ctrl';
$route['edit_dept_route']                   = 'Admin_Controller/edit_dept_ctrl';
$route['edit_bu_route']                     = 'Admin_Controller/edit_bu_ctrl';
$route['edit_comp_route']                   = 'Admin_Controller/edit_comp_ctrl';
$route['validate_old_meter_route']          = 'Admin_Controller/validate_old_meter_ctrl';
$route['update_old_meter_route']            = 'Admin_Controller/update_old_meter_ctrl';
$route['display_adduser_route']             = 'Admin_Controller/display_adduser_ctrl';
$route['validate_record_save_route']        = 'Admin_Controller/validate_record_save_ctrl';
$route['record_admin_users_route']          = 'Admin_Controller/record_admin_users_ctrl';

//===============================End of Administrator Routes ======================================

//=============================== Hrd Routes ======================================================
$route['Hrd_Access']                        = 'Hrd_Controller/hrd_homepage';
$route['hrd_home_route']                    = 'Hrd_Controller/hrd_home_ctrl';
$route['hrd_dashboard_route']               = 'Hrd_Controller/hrd_dashboard_ctrl';
$route['records_route']                     = 'Hrd_Controller/records_ctrl';
$route['display_table_employees_route']     = 'Hrd_Controller/display_table_employees_ctrl';
$route['reports_route']                     = 'Hrd_Controller/reports_ctrl';
// $route['display_table_reports_route']       = 'Hrd_Controller/display_table_reports_ctrl';
$route['select_year_route']                 = 'Hrd_Controller/select_year_ctrl';
//=============================== End of Hrd Routes ===============================================

//=============================== Leasing Routes ==================================================
$route['Leasing_Access']                    = 'Leasing_Controller/leasing_homepage';
$route['leasing_home_route']                = 'Leasing_Controller/leasing_home_ctrl';
$route['leasing_dashboard_route']           = 'Leasing_Controller/leasing_dashboard_ctrl';
$route['leasing_record_route']              = 'Leasing_Controller/leasing_record_ctrl';
$route['select_date_area_route']            = 'Leasing_Controller/select_date_area_ctrl';
$route['save_floor_route']                  = 'Leasing_Controller/save_floor_ctrl';
$route['leasing_about_us_route']            = 'Leasing_Controller/leasing_about_us_ctrl';
//=============================== End of Leasing Routes ===========================================

//=============================== SSD Routes ======================================================
$route['SSD_Access']                        = 'SSD_Controller/ssd_homepage';
$route['ssd_home_route']                    = 'SSD_Controller/ssd_home_ctrl';
$route['select_ssd_week_route']             = 'SSD_Controller/select_ssd_week_ctrl';
$route['ssd_record_route']                  = 'SSD_Controller/ssd_record_ctrl';
$route['ssd_select_date_route']             = 'SSD_Controller/ssd_select_date_ctrl';
$route['save_guard_route'] 					= 'SSD_Controller/save_guard_ctrl';
$route['update_ssd_employee_route'] 		= 'SSD_Controller/update_ssd_employee_ctrl';
$route['ssd_report_route'] 		            = 'SSD_Controller/ssd_report_ctrl';
$route['ssd_month_year_v2_route'] 		    = 'SSD_Controller/ssd_month_year_v2_ctrl';
//=============================== End SSD Routes ==================================================

//=============================== Engineer Routes =================================================
$route['Engineer_Access']                   = 'Engineer_Controller/engineer_homepage';
$route['engineer_home_route']               = 'Engineer_Controller/engineer_home_ctrl';
$route['engineer_dashboard_route']          = 'Engineer_Controller/engineer_dashboard_ctrl';
$route['select_date_water_route']           = 'Engineer_Controller/select_date_water_ctrl';
$route['engineer_water_route']              = 'Engineer_Controller/engineer_water_ctrl';
$route['save_water_billing_route']          = 'Engineer_Controller/save_water_billing_ctrl';
$route['engineer_electric_route']           = 'Engineer_Controller/engineer_electric_ctrl';
$route['select_date_electric_route']        = 'Engineer_Controller/select_date_electric_ctrl';
$route['save_electric_billing_route']       = 'Engineer_Controller/save_electric_billing_ctrl';
$route['update_water_route']                = 'Engineer_Controller/update_water_ctrl';
$route['update_electric_route']             = 'Engineer_Controller/update_electric_ctrl';
//================================ End of Engineer Routes ==========================================

//================================ Finance Routes ===================================================
$route['Finance_Access']                    = 'Finance_Controller/finance_homepage';
$route['finance_home_route']                = 'Finance_Controller/finance_home_ctrl';
$route['finance_dashboard_route']           = 'Finance_Controller/finance_dashboard_ctrl';
$route['finance_nav_data_route']            = 'Finance_Controller/finance_nav_data_ctrl';
$route['select_monitor_allo_route']         = 'Finance_Controller/select_monitor_allo_ctrl';
$route['finance_nav_allo_route']            = 'Finance_Controller/finance_nav_allo_ctrl';
$route['select_nav_data_route']             = 'Finance_Controller/select_nav_data_ctrl';
$route['exp_monitor_data_route']            = 'Finance_Controller/exp_monitor_data_ctrl';
$route['select_monitor_expense_route']      = 'Finance_Controller/select_monitor_expense_ctrl';
$route['go_expense_route']                  = 'Finance_Controller/go_expense_ctrl';
$route['select_go_expense_route']           = 'Finance_Controller/select_go_expense_ctrl';
$route['report_menu_route']                 = 'Finance_Controller/report_menu_ctrl';
$route['select_finance_report_route']       = 'Finance_Controller/select_finance_report_ctrl';
//================================= End of Finance Routes ==========================================

//================================= Accounting Supervisor Routes ===================================
$route['Accounting_Access']                 = 'Supervisor_Controller/supervisor_homepage';
$route['supervisor_home_route']             = 'Supervisor_Controller/supervisor_home_ctrl';
$route['account_home_route']                = 'Supervisor_Controller/account_home_ctrl';
$route['supervisor_nav_data_route']         = 'Supervisor_Controller/supervisor_nav_data_ctrl';
$route['select_acct_nav_data_route']        = 'Supervisor_Controller/select_acct_nav_data_ctrl';
$route['nav_status_route']                  = 'Supervisor_Controller/nav_status_ctrl';
$route['supervisor_store_expense_route']    = 'Supervisor_Controller/supervisor_store_expense_ctrl';
$route['select_exp_data_route']             = 'Supervisor_Controller/select_exp_data_ctrl';
$route['expense_status_route']              = 'Supervisor_Controller/expense_status_ctrl';
//================================= End of Accounting Supervisor Routes ============================

//================================= Store Bookkeeper Routes ========================================
$route['Bookkeeper_Access']                 = 'Bookkeeper_Controller/bookkeeper_homepage';
$route['bookkeeper_home_route']             = 'Bookkeeper_Controller/bookkeeper_home_ctrl';
$route['book_home_route']                   = 'Bookkeeper_Controller/book_home_ctrl';
$route['book_agency_route']                 = 'Bookkeeper_Controller/book_agency_ctrl';
$route['select_date_agency_route']          = 'Bookkeeper_Controller/select_date_agency_ctrl';
$route['calc_agency_employee_route']        = 'Bookkeeper_Controller/calc_agency_employee_ctrl';
$route['save_agency_route']                 = 'Bookkeeper_Controller/save_agency_ctrl';
$route['update_agency_route']               = 'Bookkeeper_Controller/update_agency_ctrl';
$route['book_agency_report_route']          = 'Bookkeeper_Controller/book_agency_report_ctrl';
$route['agency_month_year_route']           = 'Bookkeeper_Controller/agency_month_year_ctrl';
$route['book_nav_allo_route']               = 'Bookkeeper_Controller/book_nav_allo_ctrl';
$route['selects_month_year_book_route']     = 'Bookkeeper_Controller/selects_month_year_book_ctrl';
$route['download_csv_format_route']         = 'Bookkeeper_Controller/download_csv_format_ctrl';
$route['validate_navision_file_route']      = 'Bookkeeper_Controller/validate_navision_file_ctrl';
$route['upload_navision_file_route']        = 'Bookkeeper_Controller/upload_navision_file_ctrl';
$route['verfiy_password_route'] 		    = 'Bookkeeper_Controller/verfiy_password_ctrl';
$route['update_navision_allocation_route']  = 'Bookkeeper_Controller/update_navision_allocation_ctrl';
$route['book_go_exp_route']                 = 'Bookkeeper_Controller/book_go_exp_ctrl';
$route['selects_month_year_expense_route']  = 'Bookkeeper_Controller/selects_month_year_expense_ctrl';
$route['validate_store_expense_route']      = 'Bookkeeper_Controller/validate_store_expense_ctrl';
$route['upload_store_expense_route']        = 'Bookkeeper_Controller/upload_store_expense_ctrl';
$route['update_date_expense_route']         = 'Bookkeeper_Controller/update_date_expense_ctrl';
$route['update_store_expense_route']        = 'Bookkeeper_Controller/update_store_expense_ctrl';
$route['book_agency_exp_route']             = 'Bookkeeper_Controller/book_agency_exp_ctrl';
$route['select_expense_agency_route']       = 'Bookkeeper_Controller/select_expense_agency_ctrl';
$route['save_agency_expense_route']         = 'Bookkeeper_Controller/save_agency_expense_ctrl';
$route['book_code_setup_route']             = 'Bookkeeper_Controller/book_code_setup_ctrl';
$route['display_bookkeeper_table_route']    = 'Bookkeeper_Controller/display_bookkeeper_table_ctrl';
$route['get_allocation_type_route']         = 'Bookkeeper_Controller/get_allocation_type_ctrl';
$route['validate_account_code_route']       = 'Bookkeeper_Controller/validate_account_code_ctrl';
$route['save_account_code_route']           = 'Bookkeeper_Controller/save_account_code_ctrl';
$route['update_account_code_route']         = 'Bookkeeper_Controller/update_account_code_ctrl';
$route['book_report_route']                 = 'Bookkeeper_Controller/book_report_ctrl';
$route['display_report_allocation_route']   = 'Bookkeeper_Controller/display_report_allocation_ctrl';
$route['select_date_reports_route']         = 'Bookkeeper_Controller/select_date_reports_ctrl';
$route['generate_report_route']             = 'Bookkeeper_Controller/generate_report_ctrl';
$route['my_profile_route']                  = 'Bookkeeper_Controller/my_profile_ctrl';
$route['updatePhoto_route']                 = 'Bookkeeper_Controller/updatePhoto_ctrl';
$route['updatePassword_route']              = 'Bookkeeper_Controller/updatePassword_ctrl';


   