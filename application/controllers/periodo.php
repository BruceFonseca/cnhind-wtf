<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Periodo extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       $this->load->library('form_validation');
       // $this->load->database();//carrega o banco de dados para fazer operações no banco
       $this->load->library('table');//carrega tabela 
       $this->load->model('periodo_model');//carrega o model
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
        $this->form_validation->set_rules('dsc_periodo', 'Período', 'required|is_unique[periodo.dsc_periodo]');
        $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado.');//é uma menssagem definida pelo programador onde %s é o nome do campo

        // se existe uma validação, envia os dados para o model inserir
        if ($this->form_validation->run()==TRUE){

            $validacao = TRUE;
            $dados = elements(array(
                                    'dsc_periodo'
                                    ), $this->input->post());
            $this->periodo_model->do_insert($dados);
        }

        $dados = array(
            'validacao'=> TRUE,
            'tela'=> 'create',
            'pasta'=> 'periodo',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
             );
        
        $this->load->view('conteudo', $dados );
    }
    
    public function retrieve() {

        $dados = array(
            'tela'=> 'retrieve',
            'pasta'=> 'periodo',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->periodo_model->get_all()->result(),
             );
        
        $this->load->view('conteudo', $dados);
    }
    

    public function  update(){   

        // recebe o id do usuário através da URL
        $id = $this->uri->segment(3);
            

        if($this->input->post('dsc_periodo')){
            
            //o $id é setado novamente quando vem por POST 
            $id = $this->input->post('id_periodo');

            $this->form_validation->set_rules('dsc_periodo', 'Período', 'required|is_unique[periodo.dsc_periodo]');
            $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado.');//é uma menssagem definida pelo programador onde %s é o nome do campo

            if ($this->form_validation->run()==TRUE):


                $dados = elements(array(
                                        'id_periodo',
                                        'dsc_periodo'
                                        ), $this->input->post());

                $this->periodo_model->do_update($dados, array('id_periodo'=> $id));
            endif;

        }//fim do if

        $dados = array(
            'tela'=> 'update',
            'pasta'=> 'periodo',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'query'=> $this->periodo_model->get_byid($id)->row(),
         );
        
        $this->load->view('conteudo', $dados );
    }
    
    public function delete(){
            $id = $this->uri->segment(3);

            $this->periodo_model->do_delete($id);
    }

       
}//fim da classe    
