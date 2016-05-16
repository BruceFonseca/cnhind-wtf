<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->helper('array');//ajuda a passar dados para o model
        $this->load->library('session');
        $this->load->database();//carrega o banco de dados para fazer operações no banco
        $this->load->model('user_menu_model');//carrega o model
        $this->load->model('ocorrencia_model');//carrega o model
    }

    function index()
    {
        if($this->session->userdata('logged_in'))
        {
            //carregando os menus em session
            $session_data = $this->session->userdata('logged_in');
            $role = $session_data['role'];
            $this->user_menu_model->set_session_menu_header($role);
            $this->user_menu_model->set_session_menu_sidebar();

            redirect('assunto/conceito');
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

    function update_menu_sidebar()
    {
        $session_data = $this->session->userdata('logged_in');
        $role = $session_data['role'];
        $dados = array(
                'menu_list'=> $this->user_menu_model->get_menu_by_role($role),
                'submenu_list'=> $this->user_menu_model->get_submenu_by_role($role),
                'menu_planta'=> $this->ocorrencia_model->get_menu_planta(),
        );
         $this->load->view('includes/menu_sidebar', $dados);
    }

}