<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('ocorrencia_model');//carrega o model
        
       //menu sidebar
        $this->load->model('user_menu_model');//carrega o model
        $menu_sidebar = array('menu_planta'=> $this->user_menu_model->get_menu_planta()->result());
        $this->load->vars($menu_sidebar);

        
    }

    function index()
    {
            // redirect('working-time-flexibility');
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('working-time-flexibility');
    }

}