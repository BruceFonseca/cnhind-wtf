<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ocorrencia extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       $this->load->helper('url');
       $this->load->helper('form');
       $this->load->helper('array');//ajuda a passar dados para o model
       $this->load->library('form_validation');
       $this->load->library('session');
       $this->load->database();//carrega o banco de dados para fazer operações no banco
       $this->load->library('table');//carrega tabela 
       $this->load->model('ocorrencia_model');//carrega o model
       $this->load->model('assunto_model');//carrega o model
       $this->load->model('planta_model');//carrega o model
       $this->load->model('periodo_model');//carrega o model
       $this->load->model('oc_ac_as_model');//carrega o model
       $this->load->model('tratado_model');//carrega o model
       $this->load->model('user_menu_model');//carrega o model
        date_default_timezone_set('America/Sao_Paulo');//define o timezone
    }
    
   
    public function  create(){

        $flash_data = NULL;

        if(isset($_POST['data'])) {
            
            $data = json_decode($_POST['data']);
            // pd($data->dados_acordo->id_assunto);

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
                $flash_data = $this->ocorrencia_model->msg_validacao('cadastro_duplicado');
            }else{
                $this->ocorrencia_model->do_insert($dados);
                $id_ocorrencia = $this->ocorrencia_model->get_last()->row()->last;
                $this->oc_ac_as_model->do_insert($data, $id_ocorrencia);
                $flash_data = $this->ocorrencia_model->msg_validacao('cadastrado_sucesso');
            }
        }

        $dados = array(
            'validacao'=> TRUE,
            'tela'=> 'create',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'dados_assunto'=> $this->assunto_model->get_all()->result_array(),
            'dados_planta'=> $this->planta_model->get_all()->result_array(),
            'dados_periodo'=> $this->periodo_model->get_all()->result_array(),
            'assuntos_disp'=> $this->tratado_model->get_all()->result_array(),
            'flash_data' => $flash_data,
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
    
    public function delete(){
        $id = $this->uri->segment(3);

        $this->ocorrencia_model->do_delete($id);
    }

    public function  update(){   

      
        // recebe o id do usuário através da URL
        $id = $this->uri->segment(3);
        $flash_data = NULL;
        
        if(isset($_POST['data'])) {
            $data = json_decode($_POST['data']);
            // pd($data);

            $id_assunto = $data->dados_acordo->id_assunto;
            $id_planta  = $data->dados_acordo->id_planta;
            $id_periodo = $data->dados_acordo->id_periodo;
            // $dsc_file   = isset($data->dados_acordo->dsc_file) ? $data->dados_acordo->dsc_file : '';
            $dsc_file = $data->dados_acordo->dsc_file;

            $dados = array(
                'id_assunto' => $id_assunto,
                'id_planta'  => $id_planta,
                'id_periodo' => $id_periodo,
                'dsc_file'   => $dsc_file,
             );

            // if ($this->ocorrencia_model->valida_ocorrencia($id_assunto, $id_planta, $id_periodo) == FALSE){
                // $flash_data = $this->ocorrencia_model->msg_validacao('cadastro_duplicado');
            // }else{
                $this->ocorrencia_model->do_update($dados, $id);
                $this->oc_ac_as_model->do_delete($id);
                $this->oc_ac_as_model->do_insert($data, $id);
                $flash_data = $this->ocorrencia_model->msg_validacao('atualizado_sucesso');
            // }
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
            'flash_data' => $flash_data,
             );
        
        $this->load->view('conteudo', $dados );

    }//fim update


    function importar() {
        
        // Detect form submission.
        if($this->input->post('submit')){
        
            $path = './uploads/';
            $this->load->library('upload');
                        
            // Define file rules
            $this->upload->initialize(array(
                "upload_path"       =>  $path,
                "allowed_types"     =>  'text/plain|text|doc|docx|pdf|csv|png|jpeg',
                // "max_size"          =>  '1000',
                // "max_width"         =>  '1024',
                // "max_height"        =>  '768'
            ));
            
            if($this->upload->do_multi_upload("uploadfile")){
               
                $data['upload_data'] = $this->upload->get_multi_upload_data();
                
                $arquivo = $data['upload_data'][0]["file_name"];

                echo '<div class="alert alert-success">'
                . '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span> '
                . ' Arquivo carregado com sucesso.</div>  '
                . '<input type="hidden" name ="atach-file" value= "' . $arquivo .'">';
                
            } else {    
                
                // Output the errors
                $errors = $this->upload->display_errors('<div class="alert alert-danger" role="alert">
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                        <span class="sr-only">Error:</span>', '<br>Favor inserir um arquivo com extensão <strong>.csv</strong></div>');              
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
        // carrega os arquivos de acordos
        $id = NULL;
        if($this->uri->segment(3)){
            $id =$this->uri->segment(3);
        }

        $this->output->enable_profiler(FALSE);//MODO NATIVO DE DEBUG CODEIGNITER. MUDE PARA "TRUE" PARA HABILITAR


        $dados = array(
            'tela'=> 'carregar',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'id'=> $id,
             );

        $this->load->view('conteudo', $dados);
        
    }


    

     

       
}//fim da classe    
