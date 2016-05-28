<?php

class User_menu_model extends CI_Model{
    
    public function get_all(){

        $query = "select * from user_roles where id_user_roles <> 1";     
         
        return $this->db->query($query);
    }

    public function get_menu_by_role($role){
        // tras o menu do usuário de acordo com a role
        // $role = 'Controlador';

        $query = "  SELECT DISTINCT m.id_menu, m.dsc_name as menu FROM user_menu um
                    INNER JOIN menu m ON um.id_menu = m.id_menu
                    INNER JOIN transactions t ON um.id_transactions = t.id_transactions
                    INNER JOIN user_roles r ON um.id_user_roles = r.id_user_roles
                    WHERE r.dsc_name = '$role' ORDER BY 2";

         
        return $this->db->query($query);
    }
    public function get_submenu_by_role($role){
    	// tras o submenu do usuário de acordo com a role
    	// $role = 'Controlador';

        $query = "	SELECT DISTINCT m.id_menu,  t.dsc_name as submenu, t.controller as controller  FROM user_menu um
                    INNER JOIN menu m ON um.id_menu = m.id_menu
                    INNER JOIN transactions t ON um.id_transactions = t.id_transactions
                    INNER JOIN user_roles r ON um.id_user_roles = r.id_user_roles
					WHERE r.dsc_name = '$role' ORDER BY 2";
         
        return $this->db->query($query);
    }

    public function get_menu_planta(){
        $query = '
                SELECT DISTINCT
                o.id_planta as id_planta,
                p.dsc_planta as dsc_planta
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo 
                ORDER BY p.dsc_planta
            '; 

        return $this->db->query($query);

    }

    public function set_session_menu_header($role){

        $submenu_list = array();
        $submenu_list = $this->get_submenu_by_role($role)->result();
        $this->session->set_userdata('session_menu_header', $submenu_list);
    }

    public function set_session_menu_sidebar(){

        $plantas = array(); 
        $plantas = $this->get_menu_planta()->result();
        $this->session->set_userdata('session_menu_sidebar', $plantas);

    }
    
}
