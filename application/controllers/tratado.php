<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tratado extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       $this->load->helper('url');
       $this->load->helper('form');
       $this->load->helper('array');//ajuda a passar dados para o model
       $this->load->library('form_validation');
       $this->load->library('session');
       $this->load->database();//carrega o banco de dados para fazer operações no banco
       $this->load->library('table');//carrega tabela 
       $this->load->model('tratado_model');//carrega o model
        date_default_timezone_set('America/Sao_Paulo');//define o timezone
    }
    
   
    public function  create(){   
        $msg =NULL;
        $tela = NULL;
        
        // validação dos dados recebidos do formulário
        $this->form_validation->set_rules('dsc_tratado','Assunto', 'trim|required|is_unique[tratado.dsc_tratado]');
        $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado.');//é uma menssagem definida pelo programador onde %s é o nome do campo

        // se existe uma validação, envia os dados para o model inserir
        if ($this->form_validation->run()==TRUE){

            if($this->uri->segment(3)){ //se recebe o 3º segmento, então deve apontar para tratado/create/fast  no módel
                $tela = $this->uri->segment(3);
            }

            $validacao = TRUE;
            $dados = elements(array(
                                    'dsc_tratado'
                                    ), $this->input->post());
            
            //faz o insert no banco e retorna a mensagem
            $msg = $this->tratado_model->do_insert($dados, $tela);

        }
        
        if($this->uri->segment(3)){
            if(!$msg){
                $msg = NULL;
            }

            $dados = array(
                'msg'=> $msg,
                'last_id' => $this->tratado_model->get_last()->row(),
                'validacao'=> TRUE,
                'tela'=> 'create_fast',
                'pasta'=> 'tratado',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
                 );
        }else{
            $dados = array(
                'validacao'=> TRUE,
                'tela'=> 'create',
                'pasta'=> 'tratado',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
                 );
        }
        
        $this->load->view('conteudo', $dados );
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

    $flash_data = NULL;

    if($this->session->flashdata('edicaook')):
        $flash_data = '<div class="alert alert-success">Assunto atualizado com sucesso!!!</div>';
    endif;
      
        // recebe o id do usuário através da URL
        $id = $this->uri->segment(3);
            

        if($this->input->post('dsc_tratado')){

            //o $id é setado novamente quando vem por POST 
            $id = $this->input->post('id_tratado');

            // pd($id);

            $this->form_validation->set_rules('dsc_tratado','dsc_tratado','trim');

            if ($this->form_validation->run()==TRUE):


                $dados = elements(array(
                                        'id_tratado',
                                        'dsc_tratado'
                                        ), $this->input->post());

                $this->tratado_model->do_update($dados, array('id_tratado'=> $id));
            endif;

        }//fim do if

        $dados = array(
            'tela'=> 'update',
            'pasta'=> 'tratado',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'query'=> $this->tratado_model->get_byid($id)->row(),
            'flash_data'=> $flash_data,
         );
        
        $this->load->view('conteudo', $dados );

        // $id = $this->input->post('id');

        // pd($id);
    }


       
}//fim da classe    
