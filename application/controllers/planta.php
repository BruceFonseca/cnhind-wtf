<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planta extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       $this->load->helper('url');
       $this->load->helper('form');
       $this->load->helper('array');//ajuda a passar dados para o model
       $this->load->library('form_validation');
       $this->load->library('session');
       $this->load->database();//carrega o banco de dados para fazer operações no banco
       $this->load->library('table');//carrega tabela 
       $this->load->model('planta_model');//carrega o model
        date_default_timezone_set('America/Sao_Paulo');//define o timezone
    }
    
   
    public function  create(){   
        
        // validação dos dados recebidos do formulário
        $this->form_validation->set_rules('dsc_planta','trim|required|is_unique[planta.dsc_planta]');
        $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado.');//é uma menssagem definida pelo programador onde %s é o nome do campo
        // $this->form_validation->set_rules('dsc_name','Nome','trim|required|max_lenght[100]|strtoupper');
        // $this->form_validation->set_rules('dsc_matricula','Matrícula','trim|required|max_lenght[45]|strtoupper');

        // se existe uma validação, envia os dados para o model inserir
        if ($this->form_validation->run()==TRUE){

            $validacao = TRUE;
            $dados = elements(array(
                                    'dsc_planta'
                                    ), $this->input->post());
            $this->planta_model->do_insert($dados);
        }

        $dados = array(
            'validacao'=> TRUE,
            'tela'=> 'create',
            'pasta'=> 'planta',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
             );
        
        $this->load->view('conteudo', $dados );
    }
    
    public function retrieve() {

        $dados = array(
            'tela'=> 'retrieve',
            'pasta'=> 'planta',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->planta_model->get_all()->result(),
             );
        
        $this->load->view('conteudo', $dados);
    }
    

    public function  update(){   

    $flash_data = NULL;

    if($this->session->flashdata('edicaook')):
        $flash_data = '<div class="alert alert-success">Acordo atualizado com sucesso!!!</div>';
    endif;
      
        // recebe o id do usuário através da URL
        $id = $this->uri->segment(3);
            

        if($this->input->post('dsc_planta')){
            
            //o $id é setado novamente quando vem por POST 
            $id = $this->input->post('id_planta');

            // pd($id);

            $this->form_validation->set_rules('dsc_planta','dsc_planta','trim');

            if ($this->form_validation->run()==TRUE):


                $dados = elements(array(
                                        'id_planta',
                                        'dsc_planta'
                                        ), $this->input->post());

                $this->planta_model->do_update($dados, array('id_planta'=> $id));
            endif;

        }//fim do if

        $dados = array(
            'tela'=> 'update',
            'pasta'=> 'planta',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'query'=> $this->planta_model->get_byid($id)->row(),
            'flash_data'=> $flash_data,
         );
        
        $this->load->view('conteudo', $dados );

        // $id = $this->input->post('id');

        // pd($id);
    }


       
}//fim da classe    
