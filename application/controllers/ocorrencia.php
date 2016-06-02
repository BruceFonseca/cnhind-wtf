<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class Ocorrencia extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       $this->load->library('form_validation');
       $this->load->library('table');//carrega tabela 
       $this->load->model('ocorrencia_model');//carrega o model
       $this->load->model('assunto_model');//carrega o model
       $this->load->model('planta_model');//carrega o model
       $this->load->model('periodo_model');//carrega o model
       $this->load->model('oc_ac_as_model');//carrega o model
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
    
    public function delete(){
        $id = $this->uri->segment(3);
        $this->ocorrencia_model->do_delete($id);

        //carregando os menus em session
        $this->user_menu_model->set_session_menu_sidebar();

        $this->session->set_flashdata('excluirok','Registro excluído com sucesso!!!');
        redirect('interpretacoes');
    }
   
    public function  update(){   
 
        // recebe o id do usuário através da URL
        $id = $this->uri->segment(3);
        
        if(isset($_POST['data'])) {
            $data = json_decode($_POST['data']);

            $id_assunto = $data->dados_acordo->id_assunto;
            $id_planta  = $data->dados_acordo->id_planta;
            $id_periodo = $data->dados_acordo->id_periodo;
            $dsc_file = $data->dados_acordo->dsc_file;

            $dados = array(
                'id_assunto' => $id_assunto,
                'id_planta'  => $id_planta,
                'id_periodo' => $id_periodo,
                'dsc_file'   => $dsc_file,
             );

            $this->ocorrencia_model->do_update($dados, $id);
            $this->oc_ac_as_model->do_delete($id);
            $this->oc_ac_as_model->do_insert($data, $id);

            $this->session->set_userdata('ocorrencia-OK', 'Cadastro atualizado com sucesso!!!');

            //carregando os menus em session
            $this->user_menu_model->set_session_menu_sidebar();
        }

        $dados = array(
            'tela'=> 'update',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'dados_assunto'=> $this->assunto_model->get_all()->result_array(),
            'dados_planta'=> $this->planta_model->get_all()->result_array(),
            'dados_periodo'=> $this->periodo_model->get_all()->result_array(),
            'dados_ocorrencia'=> $this->ocorrencia_model->get_byid($id)->row(),
            'assuntos_disp'=> $this->tratado_model->get_disp_byid($id)->result_array(),
            'assuntos_util'=> $this->tratado_model->get_ulti_byid($id)->result_array(),
             );
        
        $this->load->view('conteudo', $dados );

    }//fim update

    public function  create(){

        if(isset($_POST['data'])) {
            
            $data = json_decode($_POST['data']);

            $id_assunto = isset($data->dados_acordo->id_assunto)     ? $data->dados_acordo->id_assunto    : ''; 
            $id_planta  = isset($data->dados_acordo->id_planta)      ? $data->dados_acordo->id_planta     : ''; 
            $id_periodo = isset($data->dados_acordo->id_periodo)     ? $data->dados_acordo->id_periodo    : '';
            $dsc_file   = isset($data->dados_acordo->dsc_file)       ? $data->dados_acordo->dsc_file      : '';

            $dados = array(
                'id_assunto' => $id_assunto,
                'id_planta'  => $id_planta,
                'id_periodo' => $id_periodo,
                'dsc_file'   => $dsc_file,
             );

            if ($this->ocorrencia_model->valida_ocorrencia($id_assunto, $id_planta, $id_periodo) == FALSE){
                    $this->session->set_userdata('ocorrencia-NOK', 'Não foi possível cadastrar esta interpretação. Já existe uma interpretação cadastrada na mesma planta, periodo e acordo.');
            }else{
                $this->ocorrencia_model->do_insert($dados);
                $id_ocorrencia = $this->ocorrencia_model->get_last()->row()->last;
                $this->oc_ac_as_model->do_insert($data, $id_ocorrencia);
                $this->session->set_userdata('ocorrencia-OK', 'Cadastro efetuado com sucesso!!!');
            }

            //carregando os menus em session
            $this->user_menu_model->set_session_menu_sidebar();
        }

        $dados = array(
            'tela'=> 'create',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'dados_assunto'=> $this->assunto_model->get_all()->result_array(),
            'dados_planta'=> $this->planta_model->get_all()->result_array(),
            'dados_periodo'=> $this->periodo_model->get_all()->result_array(),
            'assuntos_disp'=> $this->tratado_model->get_all()->result_array(),
             );
        
        $this->load->view('conteudo', $dados );
    }
    
    public function retrieve() {

        $dados = array(
            'tela'=> 'retrieve',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->ocorrencia_model->get_all()->result(),
            'dados_planta'=> $this->planta_model->get_all()->result_array(),
            'dados_periodo'=> $this->periodo_model->get_all()->result_array(),
             );
        
        $this->load->view('conteudo', $dados);
    }

    public function retrieve_condition() {

        $id_planta= trim($this->input->post('id_planta'));
        $id_periodo= trim($this->input->post('id_periodo'));
        $dsc_assunto= trim($this->input->post('dsc_assunto'));

        $where = Array();

        //seta as condições para query de acordo com o recebido de POST
        if($id_planta != 0){$where[]   = " o.id_planta =".$id_planta;}
        if($id_periodo != 0){$where[]      = " o.id_periodo = ".$id_periodo;}
        if($dsc_assunto != " "){$where[] = " a.dsc_assunto LIKE '"."%".trim($dsc_assunto)."%'";}

        $condicao = " WHERE " . implode( ' AND ',$where );

        $dados = array(
            'tela'=> 'retrieve_condition',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->ocorrencia_model->get_all_with_condition($condicao)->result(),
            'std_planta'=>$id_planta,
            'std_periodo'=>$id_periodo,
            'std_assunto'=>$dsc_assunto,
            'dados_planta'=> $this->planta_model->get_all()->result_array(),
            'dados_periodo'=> $this->periodo_model->get_all()->result_array(),
             );
        
        $this->load->view('conteudo', $dados);
    }


    public function retrieve_by_planta() {

        $id = $this->uri->segment(3);

        $dados = array(
            'tela'=> 'retrieve_by_planta',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'interpretacao'=> $this->ocorrencia_model->get_all_ocorrencias_by_planta($id)->result(),
             );
        
        $this->load->view('conteudo', $dados);
    }

    public function retrieve_periodos_by_plantas() {
        //recebe um JSON com as plantas e retorna os periodos

        $plantas = ($_POST['data']);

        $dados = array(
            'tela'=> 'retrieve_periodos_by_plantas',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'periodos'=> $this->ocorrencia_model->get_all_periodos_by_planta($plantas)->result(),
             );
        
        $this->load->view('page', $dados);

    }

   
    public function retrieve_acordos_by_periodos() {
        //recebe um JSON com os PERIODOS e PLANTAS e retorna os AORDOS


        $data = json_decode($_POST['data']);

        $plantas = NULL;
        for($i=0; $i < count($data->dados->id_planta); $i++){ 
            $plantas = $plantas . $data->dados->id_planta[$i] . ',';
        }
        $periodos = NULL;
        for($i=0; $i < count($data->dados->id_periodo); $i++){ 
            $periodos = $periodos . $data->dados->id_periodo[$i] . ',';
        }

        $plantas = substr($plantas, 0, -1);
        $periodos = substr($periodos, 0, -1);

        // pd($plantas);

        $dados = array(
            'tela'=> 'retrieve_acordos_by_periodos',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'acordos'=> $this->ocorrencia_model->get_all_acordos_by_periodos($periodos, $plantas)->result(),
             );

        $this->load->view('page', $dados);

    }
   
    public function retrieve_tabela_comparacao() {
        // recebe um JSON com os PERIODOS e PLANTAS e retorna os AORDOS

        $data = json_decode($_POST['data']);

        $plantas = NULL;
        for($i=0; $i < count($data->dados->id_planta); $i++){ 
            $plantas = $plantas . $data->dados->id_planta[$i] . ',';
        }
        $periodos = NULL;
        for($i=0; $i < count($data->dados->id_periodo); $i++){ 
            $periodos = $periodos . $data->dados->id_periodo[$i] . ',';
        }
        $acordos = NULL;
        for($i=0; $i < count($data->dados->id_acordo); $i++){ 
            $acordos = $acordos . $data->dados->id_acordo[$i] . ',';
        }

        // remove a ultima "," virgula
        $plantas  = substr($plantas,  0, -1);
        $periodos = substr($periodos, 0, -1);
        $acordos  = substr($acordos,  0, -1);

        $dados = array(
            'tela'=> 'retrieve_tabela_comparacao',
            'plantas' => $plantas,
            'periodos' => $periodos,
            'tratados' => $acordos,
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'acordos'=> $this->ocorrencia_model->retrieve_tabela_comparacao($periodos, $plantas, $acordos)->result(),
             );

        $this->load->view('page', $dados);

    }

    public function retrieve_by_acordo() {

        $id = $this->uri->segment(3);
        
        $dados = array(
            'tela'=> 'retrieve_by_acordo',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'interpretacao'=> $this->ocorrencia_model->get_all_ocorrencias_by_acordo($id)->result(),
             );
        
        $this->load->view('conteudo', $dados);
    }

    public function interpretacao_planta() {

        $id = $this->uri->segment(3);

        $dados = array(
            'tela'=> 'interpretacao_planta',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'interpretacao'=> $this->ocorrencia_model->get_all_ocorrencias_assuntos($id)->result(),
             );
        
        $this->load->view('conteudo', $dados);
    }

    public function comparacao(){
        $dados = array(
            'tela'=> 'comparacao',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'plantas'=> $this->ocorrencia_model->get_all_plantas_with_ocorrencias()->result(),
             );
        
        $this->load->view('conteudo', $dados);
    }

    function importar() {
        
        // Detect form submission.
        if($this->input->post('submit')){
        
            $path = './uploads/';
            $this->load->library('upload');
                        
            // Define file rules
            $this->upload->initialize(array(
                "upload_path"       =>  $path,
                "allowed_types"     =>  'pdf|csv',
                // "max_size"          =>  '1000',
                // "max_width"         =>  '1024',
                // "max_height"        =>  '768'
            ));
            
            if($this->upload->do_multi_upload("uploadfile")){
               
                $data['upload_data'] = $this->upload->get_multi_upload_data();
                
                $arquivo = $data['upload_data'][0]["file_name"];

                echo '<div class="alert alert-success">'
                . '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>'
                . ' Arquivo carregado com sucesso.</div>  '
                . '<input type="hidden" name ="atach-file" value= "' . $arquivo .'">';
                
            } else {    
                
                // Output the errors
                $errors = $this->upload->display_errors('<div class="alert alert-danger" role="alert">
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', 
                                                        '<br>Favor inserir um arquivo com extensão <strong>pdf</strong></div>');              
                echo $errors;
            }
            exit();
        } 

        $dados = array(
            'tela'=> 'importar',
            'pasta'=> 'estrutura_produto',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
        );
        
        $this->load->view('conteudo', $dados );
        
    }

    public function carregar(){
        $this->output->enable_profiler(FALSE);//MODO NATIVO DE DEBUG CODEIGNITER. MUDE PARA "TRUE" PARA HABILITAR

       $dados = array(
            'tela'=> 'carregar',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
             );

        $this->load->view('print_page', $dados);
        
    }


    

     

       
}//fim da classe    
