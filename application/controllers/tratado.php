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
