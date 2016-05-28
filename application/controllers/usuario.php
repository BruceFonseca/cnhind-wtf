<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       $this->load->library('form_validation');
       $this->load->library('table');//carrega tabela 
       $this->load->model('users_roles_model');//carrega o model
       $this->load->model('usuario_model');//carrega o model
        date_default_timezone_set('America/Sao_Paulo');//define o timezone

        //menu sidebar
        $this->load->model('user_menu_model');//carrega o model
        $menu_sidebar = array('menu_planta'=> $this->user_menu_model->get_menu_planta()->result());
        $this->load->vars($menu_sidebar);

        //menu header
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $role = $session_data['role'];
            $menu_header = array('submenu_list'=> $this->user_menu_model->get_submenu_by_role($role)->result());
            $this->load->vars($menu_header);
        }else{
            redirect('login', 'refresh');
        }
    }
    
   
    public function  create(){   

        // validação dos dados recebidos do formulário
        $this->form_validation->set_rules('username','User ID','trim|required|max_lenght[45]|strtoupper');
        $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado.');//é uma menssagem definida pelo programador onde %s é o nome do campo

        $this->form_validation->set_rules('email','E-mail','trim|required|max_lenght[45]|strtoupper');
        $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado.');//é uma menssagem definida pelo programador onde %s é o nome do campo
        
        $this->form_validation->set_rules('dsc_name','Nome','trim|required|max_lenght[100]|strtoupper');
        $this->form_validation->set_rules('dsc_matricula','Matrícula','trim|required|max_lenght[45]|strtoupper');

        // se existe uma validação, envia os dados para o model inserir
        if ($this->form_validation->run()==TRUE){

            $username = $this->input->post('username');
            $name     = $this->input->post('dsc_name');
            $email    = $this->input->post('email');

            $validacao = TRUE;
            $dados = elements(array(
                                    'username',
                                    'dsc_name',
                                    'dsc_matricula', 
                                    'password',
                                    'dt_added',
                                    'dt_updated',
                                    'id_user_roles',
                                    'ativo',
                                    'email' ), $this->input->post());
            $this->usuario_model->send_email($email, '123', 'new_user', $username, $name);
            $this->usuario_model->do_insert($dados);
        }
        $dados = array(
            'validacao'=> TRUE,
            'users_roles'=> $this->users_roles_model->get_all()->result_array(),
            'tela'=> 'create',
            'pasta'=> 'usuario',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
             );
        
        $this->load->view('conteudo', $dados );
    }
    
    public function retrieve() {

        $dados = array(
            'tela'=> 'retrieve',
            'pasta'=> 'usuario',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->usuario_model->get_all()->result(),
             );
        
        $this->load->view('conteudo', $dados);
    }
    

    public function  update(){   

        // recebe o id do usuário através da URL
        $id = $this->uri->segment(3);
            
        if($this->input->post('dsc_name')){
        //o $id é setado novamente quando vem por POST 
        $id = (int) $this->input->post('id');

            $this->form_validation->set_rules('dsc_name','Nome','trim');

            if ($this->form_validation->run()==TRUE):


                $dados = elements(array(
                                        'id',
                                        'username',
                                        'password',
                                        'dsc_name',
                                        'dsc_matricula', 
                                        'id_user_roles',
                                        'ativo',
                                        'dt_updated',
                                        'email'), $this->input->post());

                $this->usuario_model->do_update($dados, array('id'=> $id));
            endif;

        }//fim do if

        $dados = array(
            'users_roles'=> $this->users_roles_model->get_all()->result_array(),
            'tela'=> 'update',
            'pasta'=> 'usuario',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'query'=> $this->usuario_model->get_byid($id)->row(),
         );
        
        $this->load->view('conteudo', $dados );

    }

    public function delete(){
        $id = $this->uri->segment(3);

        $this->usuario_model->do_delete($id);
    }

    public function  trocar_senha(){ 

        if($this->input->post('nova-senha')){
        
            $nova_senha =  (string) trim($this->input->post('nova-senha'));
            $confirmar_senha =  (string) trim($this->input->post('confirmar-senha'));

            if($nova_senha == $confirmar_senha){

                $session_data = $this->session->userdata('logged_in');
                $username = $session_data['username'];

                $this->usuario_model->trocar_senha($username, $nova_senha);

            }else{
                $this->session->set_flashdata('excluirNOK','Não foi possível alterar senha. Favor tentar novamente.');
            }

        }//fim do if
        
        $dados = array(
            'tela'=> 'trocar_senha',
            'pasta'=> 'usuario',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
             );
        
        $this->load->view('conteudo', $dados );
    }


    public function  reset_senha(){   
        $id = (int) $this->uri->segment(3);
        $this->usuario_model->reset_senha($id);
    }
       
}//fim da classe    
