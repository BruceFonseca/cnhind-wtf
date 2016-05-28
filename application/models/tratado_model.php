<?php

class Tratado_model extends CI_Model{
    
    public function do_insert_fast($dados=NULL, $tela = NULL){            
        
        if ($dados != NULL):
            $this->db->insert('tratado',$dados);
          return 'Cadastro efetuado com sucesso';
        endif;
            
    }

    public function do_insert($dados=NULL, $tela = NULL){            
        
        if ($dados != NULL):
            $this->db->insert('tratado',$dados);
            $this->session->set_flashdata('excluirok','Cadastro efetuado com sucesso');

              redirect('assuntos');
        endif;
            
    }
    
    public function do_update($dados=NULL, $id=NULL){

        if ($dados != NULL && $id != NULL):

        $sql =  'UPDATE tratado 
                    SET dsc_tratado = ' . "'" . $dados['dsc_tratado'] . "'" .
                ' WHERE id_tratado = ' . $id['id_tratado'];

            $this->db-> query($sql);
            
            $this->session->set_flashdata('excluirok','Assunto atualizado com sucesso');
            redirect('tratado/update/'.$id['id_tratado']);
        endif;
    }

    public function do_delete($id){

        //apaga dados de oc_cs_ocorrencias
        $dbRet = $this->db->delete('tratado', array('id_tratado' => $id));

        if( !$dbRet ){
            $this->session->set_flashdata('excluirNOK','Não foi possível excluir o registro. 
                                         Existem ocorrência(s) que dependem deste assunto. 
                                         É necessário excluir estas ocorrência(s) para continuar.');
        }else{
            $this->session->set_flashdata('excluirok','Registro excluído com sucesso!!!');
        }

        redirect('assuntos');
    }
    
    public function get_all(){

          $query = 'SELECT id_tratado, dsc_tratado FROM tratado ORDER BY dsc_tratado';     
         
        return $this->db->query($query);
    }

    public function get_last(){

          $query = 'SELECT id_tratado, dsc_tratado FROM tratado ORDER BY id_tratado DESC LIMIT 1';     
         
        return $this->db->query($query);
    }

    public function get_disp_byid($id){

          $query = 
          'SELECT id_tratado, dsc_tratado FROM tratado 
          WHERE id_tratado NOT IN (
                SELECT id_tratado FROM oc_ac_as WHERE id_ocorrencia = '. $id .'
            ) ORDER BY dsc_tratado';
         
        return $this->db->query($query);
    }
    
    public function get_ulti_byid($id){
        $query = 
          'SELECT 
          oc.id_tratado as id_tratado, 
          oc.dsc_interpretacao as dsc_interpretacao, 
          t.dsc_tratado as dsc_tratado, 
          oc.dsc_file as dsc_file FROM oc_ac_as oc
          
          INNER JOIN tratado t ON oc.id_tratado = t.id_tratado
          WHERE oc.id_ocorrencia = '. $id . ' ORDER BY t.dsc_tratado';


        return $this->db->query($query);
    }
    
    
    public function get_byid($id) {
        $query = 'SELECT id_tratado, dsc_tratado FROM tratado 
                  WHERE id_tratado = ' . $id ; 

        return $this->db->query($query);
    }

}

