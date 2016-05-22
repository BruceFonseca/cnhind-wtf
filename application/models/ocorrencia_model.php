<?php

class Ocorrencia_model extends CI_Model{
    
    public function do_insert($dados=NULL){            
        
        if ($dados != NULL):
            $this->db->insert('ocorrencia',$dados);
            $this->session->set_flashdata('cadastrook','<span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                                 <span class="sr-only">Error:</span>     Acordo atualizado com sucesso!!!');
        endif;
            
    }
    
    public function do_update($dados=NULL, $condicao=NULL){

        if ($dados != NULL && $condicao != NULL):
            $sql =  'UPDATE ocorrencia 
                        SET 
                        id_planta = ' .  $dados['id_planta'] . ", " .
                        'id_assunto = ' .  $dados['id_assunto'] . ", " .
                        'id_periodo = ' .  $dados['id_periodo'] . ", " .
                        'dsc_file = "' . $dados['dsc_file'] .' "'  .
                    ' WHERE id_ocorrencia = ' . $condicao;
                    // pd($sql);
            $this->db-> query($sql);
        endif;
    }
    
    public function get_all(){

          $query = '
                SELECT 
                o.id_ocorrencia as id_ocorrencia,
                o.id_assunto as id_assunto,
                a.dsc_assunto as dsc_assunto,
                o.id_planta as id_planta,
                p.dsc_planta as dsc_planta,
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo,
                o.dsc_resumo as dsc_resumo,
                o.dsc_file as dsc_file
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
                ORDER BY p.dsc_planta, a.dsc_assunto, pe.dsc_periodo
            ';     
         
        return $this->db->query($query);
    }
    public function get_all_with_condition($condicao = NULL){

          $query = '
                SELECT 
                o.id_ocorrencia as id_ocorrencia,
                o.id_assunto as id_assunto,
                a.dsc_assunto as dsc_assunto,
                o.id_planta as id_planta,
                p.dsc_planta as dsc_planta,
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo,
                o.dsc_resumo as dsc_resumo,
                o.dsc_file as dsc_file
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo ';   

        $order = ' ORDER BY p.dsc_planta, a.dsc_assunto, pe.dsc_periodo ';

        if($condicao != NULL){
            $query = $query . $condicao  . $order;
        }

        return $this->db->query($query);
    }
    
        
    public function get_all_by_planta($id){

          $query = '
                SELECT 
                o.id_ocorrencia as id_ocorrencia,
                o.id_assunto as id_assunto,
                a.dsc_assunto as dsc_assunto,
                o.id_planta as id_planta,
                p.dsc_planta as dsc_planta,
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo,
                o.dsc_resumo as dsc_resumo,
                o.dsc_file as dsc_file
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
                WHERE o.id_planta = ' . $id ;     
        return $this->db->query($query);

    }    
    public function get_all_ocorrencias_assuntos($id){

          $query = '
                SELECT 
                o.id_ocorrencia as id_ocorrencia,
                o.id_assunto as id_assunto,
                a.dsc_assunto as dsc_assunto,
                oc.dsc_interpretacao as dsc_interpretacao,
                oc.dsc_file as dsc_file,
                t.id_tratado as id_tratado,
                t.dsc_tratado as dsc_tratado,
                o.id_planta as id_planta,
                p.dsc_planta as dsc_planta,
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
                INNER JOIN oc_ac_as oc ON o.id_ocorrencia = oc.id_ocorrencia
                INNER JOIN tratado t on oc.id_tratado = t.id_tratado
                WHERE o.id_ocorrencia = ' . $id . ' ORDER BY t.dsc_tratado';    

        return $this->db->query($query);

    }
    
    public function get_all_acordo_by_planta($id){

          $query = '
                SELECT DISTINCT
                COUNT(o.id_periodo) as cont,
                o.id_assunto as id_assunto,
                a.dsc_assunto as dsc_assunto,
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
                WHERE o.id_planta = ' . $id . ' GROUP BY o.id_assunto, a.dsc_assunto, pe.dsc_periodo'; 
        return $this->db->query($query);
    }  


    public function get_all_periodos_by_planta($plantas){
    //atenção, retorna todos os períodos por plantas

          $query = '
                SELECT DISTINCT
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo
                FROM ocorrencia o
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
                WHERE o.id_planta IN (' . $plantas . ')' ; 
        return $this->db->query($query);
    }

    public function get_all_acordos_by_periodos($periodos, $plantas){
    //atenção, retorna todos os ACORDOS por PERIODOS E PLANTAS

          $query = '
                SELECT DISTINCT
                o.id_assunto as id_assunto,
                a.dsc_assunto as dsc_assunto
                FROM ocorrencia o
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo 
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                WHERE o.id_planta IN (' . $plantas . ') AND 
                o.id_periodo IN (' . $periodos . ')' ; 
        return $this->db->query($query);
    }

    public function retrieve_tabela_comparacao($periodos, $plantas, $acordos){
    //atenção, retorna todos os ACORDOS por PERIODOS E PLANTAS

          $query = '
                SELECT 
                o.id_ocorrencia as id_ocorrencia,
                o.id_assunto as id_assunto,
                a.dsc_assunto as dsc_assunto,
                oc.dsc_interpretacao as dsc_interpretacao,
                oc.dsc_file as dsc_file,
                t.id_tratado as id_tratado,
                t.dsc_tratado as dsc_tratado,
                o.id_planta as id_planta,
                p.dsc_planta as dsc_planta,
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
                INNER JOIN oc_ac_as oc ON o.id_ocorrencia = oc.id_ocorrencia
                INNER JOIN tratado t on oc.id_tratado = t.id_tratado
                WHERE o.id_planta IN (' . $plantas . ') AND 
                o.id_assunto IN (' . $acordos . ') AND 
                o.id_periodo IN (' . $periodos . ')' ; 
        return $this->db->query($query);
    }


    public function get_all_periodo_by_planta($id){

          $query = '
                SELECT DISTINCT
                o.id_assunto as id_assunto,
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
                WHERE o.id_planta = ' . $id ;     
        return $this->db->query($query);
    }
    
    public function get_all_ocorrencias_by_planta($id){

          $query = '
                SELECT DISTINCT 
                (SELECT COUNT(oo.id_assunto) FROM ocorrencia oo WHERE oo.id_assunto = o.id_assunto AND oo.id_planta = o.id_planta) as cont,
                o.id_ocorrencia as id_ocorrencia,
                o.id_assunto as id_assunto,
                p.dsc_planta as dsc_planta,
                p.id_planta as id_planta,
                a.dsc_assunto as dsc_assunto,
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo,
                o.dsc_file as dsc_file
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
                WHERE o.id_planta = ' . $id . ' ORDER BY o.id_assunto, o.id_periodo '; 
        return $this->db->query($query);
    }

    public function get_all_plantas_with_ocorrencias(){
        // todas as plantas que tem ocorrencias cadastradas

          $query = '
                SELECT DISTINCT 
                p.id_planta as id_planta,
                p.dsc_planta as dsc_planta
                FROM ocorrencia o
                INNER JOIN planta p ON o.id_planta = p.id_planta'; 
        return $this->db->query($query);
    }

    public function get_all_ocorrencias_by_acordo($id){

          $query = '
                SELECT DISTINCT 
                (SELECT COUNT(oo.id_assunto) FROM ocorrencia oo WHERE oo.id_assunto = o.id_assunto AND oo.id_planta = o.id_planta) as cont,
                o.id_ocorrencia as id_ocorrencia,
                o.id_assunto as id_assunto,
                p.dsc_planta as dsc_planta,
                a.dsc_assunto as dsc_assunto,
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo,
                o.dsc_file as dsc_file
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
                WHERE o.id_assunto = ' . $id . ' ORDER BY o.id_assunto, o.id_periodo, p.dsc_planta '; 
        
        return $this->db->query($query);
    }
    
    public function get_byid($id) {
        $query = 'SELECT id_ocorrencia, id_assunto, id_planta, id_periodo, dsc_file FROM ocorrencia 
                  WHERE id_ocorrencia = ' . $id ; 

        return $this->db->query($query);
    }

    public function get_last(){
        $query = '
                SELECT 
                MAX(id_ocorrencia) as last
                FROM ocorrencia
            ';     
         
        return $this->db->query($query);
    }

    public function get_submenu_periodo(){
        $query = '
                SELECT DISTINCT
                o.id_planta as id_planta,
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
            ';

        return $this->db->query($query);
    }

    public function get_submenu_ocorrencia(){
        $query = '
                SELECT DISTINCT
                o.id_planta as id_planta,
                o.id_periodo as id_periodo,
                o.id_assunto as id_assunto,
                a.dsc_assunto as dsc_assunto
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
            ';

        return $this->db->query($query);

    }

    public function valida_ocorrencia($id_assunto, $id_planta, $id_periodo){
    // verifica o número de vezes que o registro está cadastrado no banco
        $query = '
            SELECT COUNT(*) as cont FROM ocorrencia
            WHERE 
                id_assunto= ' . $id_assunto . ' AND
                id_planta= '  . $id_planta  . ' AND
                id_periodo= ' . $id_periodo  ;

        //transforma o resultado da query em um objeto para utiliza-lo
        $cont = $this->db->query($query)->row()->cont;

        if ($cont >= 1) {
            // se já está cadastrado, retorna FALSE
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function msg_validacao($msg){

        if($msg == 'cadastro_duplicado'){
             
            $return = ' <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>Esta Interpretação já está cadastrada com 
                        o mesmo <strong>Acordo</strong>, <strong>Planta</strong> e <strong>Período</strong></div>';

        }elseif ($msg == 'cadastrado_sucesso') {
            $return = '<div class="alert alert-success" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        Interpretação cadastrada com sucesso!!!</div>';
        }elseif ($msg == 'atualizado_sucesso') {
            $return = '<div class="alert alert-success" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        Interpretação atualizada com sucesso!!!</div>';
        }

        return $return;
    }

    public function do_delete($id){

        //apaga dados de oc_cs_ocorrencias
        $this->db->delete('oc_ac_as', array('id_ocorrencia' => $id)); 

        //apaga dados de ocorrencia
        $this->db->delete('ocorrencia', array('id_ocorrencia' => $id)); 

        $this->session->set_flashdata('excluirok','Registro excluído com sucesso!!!');
        redirect('interpretacoes');
    }
   
    

}

