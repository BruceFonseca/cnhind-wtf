<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdfgerar extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       $this->load->library('form_validation');
       // $this->load->database();//carrega o banco de dados para fazer operações no banco
       $this->load->library('table');//carrega tabela 
       $this->load->model('ocorrencia_model');//carrega o model
       $this->load->model('assunto_model');//carrega o model
       $this->load->model('planta_model');//carrega o model
       $this->load->model('periodo_model');//carrega o model
       $this->load->model('oc_ac_as_model');//carrega o model
       $this->load->model('tratado_model');//carrega o model
        date_default_timezone_set('America/Sao_Paulo');//define o timezone
    }
    
    public function pdf_ocorrencia() {

        $id = $this->uri->segment(3);

        $dados = array(
            'tela'=> 'pdf_ocorrencia',
            'interpretacao'=> $this->ocorrencia_model->get_all_ocorrencias_assuntos($id)->result(),
             );

        $this->gerar_pdf($dados);
        // $this->load->view('template_pdf', $dados);
    }


    public function pdf_acordos_planta() {
      //todos acordos por planta
      //recebe ID da PLANTA

        $id = $this->uri->segment(3);

        $dados = array(
            'tela'=> 'pdf_acordos_planta',
            'interpretacao'=> $this->ocorrencia_model->get_all_ocorrencias_by_planta($id)->result(),
             );

        $this->gerar_pdf($dados);
        // $this->load->view('template_pdf', $dados);
    }

    public function pdf_plantas_acordo() {
      //plantas que tem o mesmo acordo
      //recebe o id do acordo

        $id = $this->uri->segment(3);

        $dados = array(
            'tela'=> 'pdf_plantas_acordo',
            'interpretacao'=> $this->ocorrencia_model->get_all_ocorrencias_by_acordo($id)->result(),
             );
        
        $this->gerar_pdf($dados);
        // $this->load->view('template_pdf', $dados);
    }

    public function pdf_conceito() {
      //plantas que tem o mesmo acordo
      //recebe o id do acordo

        $id = $this->uri->segment(3);

        $dados = array(
            'tela'=> 'pdf_conceito',
            'status'=> $this->assunto_model->get_conceito_by_id($id)->row(),
             );
        
        $this->gerar_pdf($dados, 'A4');
        // $this->load->view('template_pdf', $dados);
    }

    public function pdf_comparacao() {
      //plantas que tem o mesmo acordo
      //recebe o id do acordo

        $plantas  = $this->uri->segment(3);
        $periodos = $this->uri->segment(4);
        $acordos  = $this->uri->segment(5);

        $dados = array(
            'tela'=> 'pdf_comparacao',
            'acordos'=> $this->ocorrencia_model->retrieve_tabela_comparacao($periodos, $plantas, $acordos)->result(),
             );
        
        $this->gerar_pdf($dados);
        // $this->load->view('template_pdf', $dados);
    }

    public function gerar_pdf($dados, $orientação = "A4-L"){

        // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
        $filename = "WTF-" . date('Y_m_d_H_i_s');
        $pdfFilePath = FCPATH."/downloads/reports/$filename.pdf";

        
        // if (file_exists($pdfFilePath) == FALSE)
        // {
            ini_set('memory_limit','32M'); // boost the memory limit if it's low <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
            // $css = base_url("css/bootstrap.css");// render the view into HTML
            $css = file_get_contents(base_url("css/template_pdf.css"));
            $html = $this->load->view('template_pdf', $dados, true); // render the view into HTML

            $this->load->library('pdf');
            $pdf = $this->pdf->load($orientação);
            date_default_timezone_set('America/Sao_Paulo');//define o timezone
            setlocale(LC_ALL, NULL);
            setlocale(LC_ALL, 'pt_BR');  
            $pdf->SetFooter('Working Time Flexibility' .'|{PAGENO}|'. date("d/m/Y")); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
            $pdf->WriteHTML($css, 1); // write the HTML into the PDF
            $pdf->WriteHTML($html); // write the HTML into the PDF
            $pdf->Output($pdfFilePath, 'F'); // save to file because we can
        // }
         
        redirect("/downloads/reports/$filename.pdf");
    }


    }//fim classe