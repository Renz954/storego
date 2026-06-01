<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('Login_model');
        $this->load->helper('url');

        // Disable caching
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        // ✅ FIXED SESSION CHECK (CI WAY)
        $user_id = $this->session->userdata('id');

        if (!empty($user_id))
        {
            if ($this->Login_model->getUserCountById($user_id) > 0)
            {
                $designation = $this->Login_model->getUserType($user_id);

                if ($designation == "Administrator") {
                    redirect(base_url('Administrator_Access'));
                }
                else if ($designation == "Hrd") {
                    redirect(base_url('Hrd_Access'));
                }
                else if ($designation == "Leasing") {
                    redirect(base_url('Leasing_Access'));
                }
                else if ($designation == "SSD") {
                    redirect(base_url('SSD_Access'));
                }
                else if ($designation == "Store Engineer") {
                    redirect(base_url('Engineer_Access'));
                }
                else if ($designation == "Finance") {
                    redirect(base_url('Finance_Access'));
                }
                else if ($designation == "Accounting Supervisor") {
                    redirect(base_url('Accounting_Access'));
                }
                else if ($designation == "Store Bookkeeper") {
                    redirect(base_url('Bookkeeper_Access'));
                }
                else {
                    $this->session->sess_destroy();
                    redirect(base_url('Login_controller/index'));
                }
            }
            else
            {
                $this->session->unset_userdata('id');
            }
        }
    }

    public function index()
    {
        $this->load->view('login');
    }

    function login_ctrl()
    {
        // ✅ FIXED INPUT (secure CI method)
        $user = $this->input->post('user', TRUE);
        $pass = $this->input->post('pass', TRUE);

        $id = $this->Login_model->retrieveAccountID($user, $pass);

        if ($id < 1)
        {
            $validate = "Error Login";
        }
        else
        {
            // ✅ FIXED SESSION SET
            $this->session->set_userdata('id', $id);
            $validate = "Successfully login";
        }

        echo json_encode(array('response' => $validate));
    }
}