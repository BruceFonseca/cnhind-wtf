<?php

class Users_roles_model extends CI_Model{
    
    public function get_all(){
        /*
        TODOS - MENOS - "Administrador" - 
         */
        $query = "select * from user_roles";     
         
        return $this->db->query($query);
    }
    
}

