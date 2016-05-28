<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tratado extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       $this->load->library('form_validation');
       // $this->load->database();//carrega o banco de dados para fazer operações no banco
       $this->load->library('table');//carrega tabela 
       $this->load->model('tratado_model');//carrega o model
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
        $this->form_validation->set_rules('dsc_tratado','Assunto', 'trim|required|is_unique[tratado.dsc_tratado]');
        $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado.');//é uma menssagem definida pelo programador onde %s é o nome do campo

        // se existe uma validação, envia os dados para o model inserir
        if ($this->form_validation->run()==TRUE){

            $dados = elements(array(
                                    'dsc_tratado'
                                    ), $this->input->post());
            
            $this->tratado_model->do_insert($dados);

            }
            $dados = array(
                'tela'=> 'create',
                'pasta'=> 'tratado',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
                 );
        $this->load->view('conteudo', $dados );
    }

    public function  create_fast(){   
        $msg = NULL;
        $tela = NULL;
        
        // validação dos dados recebidos do formulário
        $this->form_validation->set_rules('dsc_tratado','Assunto', 'trim|required|is_unique[tratado.dsc_tratado]');
        $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado.');//é uma menssagem definida pelo programador onde %s é o nome do campo

        // se existe uma validação, envia os dados para o model inserir
        if ($this->form_validation->run()==TRUE){
            $dados = elements(array(
                                    'dsc_tratado'
                                    ), $this->input->post());
            //faz o insert no banco e retorna a mensagem
            $msg = $this->tratado_model->do_insert_fast($dados, $tela);

        }

        $dados = array(
            'msg'=> $msg,
            'last_id' => $this->tratado_model->get_last()->row(),
            'validacao'=> TRUE,
            'tela'=> 'create_fast',
            'pasta'=> 'tratado',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
             );

        $this->load->view('print_page', $dados );
    }
    
    public function retrieve() {

        $dados = array(
            'tela'=> 'retrieve',
            'pasta'=> 'tratado',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->tratado_model->get_all()->result(),
             );
        
        $this->load->view('conteudo', $dados);
    }

    public function  update(){   

        // recebe o id do usuário através da URL
        $id = $this->uri->segment(3);
            

        if($this->input->post('dsc_tratado')){

            //o $id é setado novamente quando vem por POST 
            $id = $this->input->post('id_tratado');
            // pd($this->input->post());

            $this->form_validation->set_rules('dsc_tratado','dsc_tratado','trim');

            if ($this->form_validation->run()==TRUE):

                $dados = elements(array(
                                        'dsc_tratado'
                                        ), $this->input->post());

                $this->tratado_model->do_update($dados, $id);
            endif;

        }//fim do if

        $dados = array(
            'tela'=> 'update',
            'pasta'=> 'tratado',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'query'=> $this->tratado_model->get_byid($id)->row()
         );
        
        $this->load->view('conteudo', $dados );
    }

    public function delete(){
        $id = $this->uri->segment(3);
        $this->tratado_model->do_delete($id);
    }


       
}//fim da classe    
