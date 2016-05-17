<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       $this->load->helper('url');
       $this->load->helper('form');
       $this->load->helper('array');//ajuda a passar dados para o model
       $this->load->library('form_validation');
       $this->load->library('session');
       $this->load->database();//carrega o banco de dados para fazer operações no banco
       $this->load->library('table');//carrega tabela 
       $this->load->model('usuario_model');//carrega o model
       $this->load->model('users_roles_model');//carrega o model
        date_default_timezone_set('America/Sao_Paulo');//define o timezone
    }
    
   
    public function  create(){   


        
        // validação dos dados recebidos do formulário
        $this->form_validation->set_rules('username','User ID','trim|required|max_lenght[45]|strtoupper|is_unique[users.username]');
        $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado.');//é uma menssagem definida pelo programador onde %s é o nome do campo

        $this->form_validation->set_rules('email','E-mail','trim|required|max_lenght[45]|strtoupper|is_unique[users.email]');
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

    $flash_data = NULL;

    if($this->session->flashdata('edicaook')):
        $flash_data = '<div class="alert alert-success">Usuário atualizado com sucesso!!!</div>';
    endif;
      
        // recebe o id do usuário através da URL
        $id = $this->uri->segment(3);
            

        if($this->input->post('dsc_name')){
            
            //o $id é setado novamente quando vem por POST 
            $id = $this->input->post('id');

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
            'flash_data'=> $flash_data,
         );
        
        $this->load->view('conteudo', $dados );

        // $id = $this->input->post('id');

        // pd($id);
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

                $msg ='<div class="alert alert-success">' . ' Senha alterada com sucesso.</div>';
                echo $msg;
                
                exit();

            }else{
                $msg = "Senhas diferentes";
                echo '<div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>'. $msg .'</div>';
                exit();
            }

        }//fim do if
        
        $dados = array(
            'tela'=> 'trocar_senha',
            'pasta'=> 'usuario',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
             );
        
        $this->load->view('conteudo', $dados );
    }


    public function  reset_senha(){   


        if($this->input->post('usuario')){
            
            $id = (int) $this->input->post('usuario');
            
            $this->usuario_model->reset_senha($id);

            echo '<div class="alert alert-success">Reset de senha efetuado com sucesso!!! <br> Nova senha : 123</div>';
            exit();

        }//fim do if
    }
       
}//fim da classe    
