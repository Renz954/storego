<?php

class Login_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        $this->load->database();
        //$this->db2 = $this->load->database('hr', TRUE);
       
    }

        function getUserCountById($id)
        {
                $query = $this->db->query("select * from users where id=?;", array($id));
                return $query->num_rows(); 
        }

        function retrieveAccountID($user,$pass)
        {
                $query = $this->db->query("select password from users where username=?;", array($user));
                $row = $query->row_array();
                if(isset($row)){
                        if(password_verify($pass,$row["password"])){
                                $query = $this->db->query("select id from users where username=?;", array($user));
                                $row = $query->row_array();
                                
                                if (isset($row)){
                                        return $row["id"];
                                }

                                return 0;  
                        }    
                }
                
                return 0;
        }

        function getUserType($id)
        {
                $query = $this->db->query("select designation from users where id=?;", array($id));
                $row = $query->row_array();
                if(isset($row)){
                        return $row["designation"];
                }

                return 0;
        }

        function getBU_Handle($id)
        {
                $query = $this->db->query("select bu_id from users where id=?;", array($id));
                $row = $query->row_array();
                if(isset($row)){
                        return $row["bu_id"];
                }

                return 0;
        }
}