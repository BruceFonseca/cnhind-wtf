<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assunto extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       $this->load->helper('url');
       $this->load->helper('form');
       $this->load->helper('array');//ajuda a passar dados para o model
       $this->load->library('form_validation');
       $this->load->library('session');
       $this->load->database();//carrega o banco de dados para fazer operações no banco
       $this->load->library('table');//carrega tabela 
       $this->load->model('assunto_model');//carrega o model
        date_default_timezone_set('America/Sao_Paulo');//define o timezone
    }
    
   
    public function  create(){   
        
        $this->form_validation->set_rules('dsc_assunto', 'Título', 'required|is_unique[assunto.dsc_assunto]');
        $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado.');//é uma menssagem definida pelo programador onde %s é o nome do campo

        // se existe uma validação, envia os dados para o model inserir
        if ($this->form_validation->run()==TRUE){
            
            $dados = elements(array(
                                    'dsc_assunto',
                                    'dsc_conceito',
                                    'exibir'
                                    ), $this->input->post());
            $this->assunto_model->do_insert($dados);
        }

        $dados = array(
            'tela'=> 'create',
            'pasta'=> 'assunto',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
             );
        
        $this->load->view('conteudo', $dados );
    }
    
    public function retrieve() {

        $dados = array(
            'tela'=> 'retrieve',
            'pasta'=> 'assunto',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->assunto_model->get_all()->result(),
             );
        
        $this->load->view('conteudo', $dados);
    }

    public function delete(){
        $id = $this->uri->segment(3);

        $this->assunto_model->do_delete($id);
    }

    public function conceito() {
        // é praticamente a mesma visão de RETRIEVE
        // porem será utilizado para exibir os conceitos 
        // dos acordos na primeira tab, assim que o sistema abrir

        $dados = array(
            'tela'=> 'conceito',
            'pasta'=> 'assunto',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->assunto_model->get_conceitos()->result(),
             );
        
        $this->load->view('conteudo', $dados);
    }

    public function conceito_itens() {

        $dados = array(
            'status'=> $this->assunto_model->get_conceitos()->result(),
             );
        
        $this->load->view('transactions/assunto/conceito_itens', $dados);
    }

    public function get_conceito() {
        // é praticamente a mesma visão de RETRIEVE
        // porem será utilizado para exibir os conceitos 
        // dos acordos na primeira tab, assim que o sistema abrir

        // recebe o id do usuário através da URL
        $id = $this->uri->segment(3);

        $dados = array(
            'tela'=> 'get_conceito',
            'pasta'=> 'assunto',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->assunto_model->get_conceito_by_id($id)->row(),
             );
        
        $this->load->view('conteudo', $dados);
    }

    public function print_page() {
        // é praticamente a mesma visão de RETRIEVE, porem com
        // porem será utilizado para exibir os conceitos 
        // dos acordos na primeira tab, assim que o sistema abrir

        // recebe o id do usuário através da URL
        $id = $this->uri->segment(3);

        $dados = array(
            'tela'=> 'imprimir',
            'pasta'=> 'print_page',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->assunto_model->get_conceito_by_id($id)->row(),
             );
        
        $this->load->view('print_page', $dados);
    }
    
    
    

    public function  update(){   

        // recebe o id do usuário através da URL
        $id = $this->uri->segment(3);

            $this->form_validation->set_rules('dsc_assunto', 'Título', 'required');

            if ($this->form_validation->run()==TRUE):

                // pd($this->input->post());

            //o $id é setado novamente quando vem por POST 
            $id = $this->input->post('id_assunto');

                $dados = elements(array(
                                        'id_assunto',
                                        'dsc_assunto',
                                        'dsc_conceito',
                                        'exibir'
                                        ), $this->input->post());

                $this->assunto_model->do_update($dados, array('id'=> $id));
            endif;


        $dados = array(
            'tela'=> 'update',
            'pasta'=> 'assunto',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'query'=> $this->assunto_model->get_byid($id)->row(),
         );
        
        $this->load->view('conteudo', $dados );

    }


       
}//fim da classe    
