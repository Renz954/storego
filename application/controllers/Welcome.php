<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Login_model');
         $this->load->helper('url');

    // Disable caching
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    $this->output->set_header('Pragma: no-cache');
    }

    function login_homepage_ctrl()
    {
        $designation = $this->Login_model->getUserType($_SESSION['id']);
                $buHandle = $this->Login_model->getBU_Handle($_SESSION['id']);
                if ($designation == "Administrator") {
                    redirect(base_url('Administrator_Access'));
                }
                else if($designation == "Hrd"){
                    redirect(base_url('Hrd_Access'));
                }
                else if($designation == "Leasing"){
                    redirect(base_url('Leasing_Access'));
                }
                else if($designation == "SSD"){
                    redirect(base_url('SSD_Access'));
                }
                else if($designation == "Store Engineer"){
                    redirect(base_url('Engineer_Access'));
                }
                else if($designation == "Finance"){
                    redirect(base_url('Finance_Access'));
                }
                else if($designation == "Accounting Supervisor"){
                    redirect(base_url('Accounting_Access'));
                }
                else if($designation == "Store Bookkeeper"){
                    redirect(base_url('Bookkeeper_Access'));
                }
                else
                {
                    $this->session->sess_destroy();
                     redirect(base_url('Login_controller/index'));
                }
    }

	public function logout()
	{
        $this->session->sess_destroy();
        redirect(base_url('Login_controller/index'));
    }



    

}
