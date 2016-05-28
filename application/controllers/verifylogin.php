<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verifylogin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user','',TRUE);
        $this->load->model('usuario_model');//carrega o model
    }

    function index()
    {


        //This method will have the credentials validation
        $this->load->library('form_validation');

        // $this->form_validation->set_rules('username', 'Usuário', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Senha', 'trim|xss_clean|callback_check_database');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.  User redirected to login page
            $this->load->view('transactions/login/login_view');
        }
        else
        {
            // if( $this->check_database($username, $password) != FALSE){
                //Go to private area
                redirect('working-time-flexibility');
            // }
        }

    }

    function check_database()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        //query the database
        $result = $this->user->login($username, $password);
        
        if($result)
        {
            $sess_array = array();
            foreach($result as $row)
            {
                $sess_array = array(
                    'id' => $row->id,
                    'username' => $row->username,
                    'dsc_name' => $row->dsc_name,
                    'role' => $row->role,
                );
                
                $this->session->set_userdata('logged_in', $sess_array);
                
            }
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database', 'Usuário ou senha incorretos');
            return FALSE;
        }
    }

    function lembrar_senha(){

        $id = $this->uri->segment(3);

        $email = $this->usuario_model->get_email_byid($id)->row()->email;

        if($email != NULL){
            $senha = time();
            $this->usuario_model->send_email($email, $senha);
            $this->usuario_model->reset_senha_by_username($id, $senha);
            echo ' Nova senha enviada para o e-mail <strong>'. $email . '</strong>';
            return FALSE;
        }else{
            echo ' Não foi possível recuperar sua senha. Contate o administrador do sistema.';
            return FALSE;
        }


    }
}