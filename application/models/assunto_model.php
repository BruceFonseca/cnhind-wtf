<?php

class Assunto_model extends CI_Model{
    
    public function do_insert($dados=NULL){            
        
        if ($dados != NULL):
            $this->db->insert('assunto',$dados);
            $this->session->set_flashdata('excluirok','Cadastro efetuado com sucesso');
            redirect('acordos');
        endif;
            
    }
    
    public function do_update($dados=NULL, $condicao=NULL){

        if ($dados != NULL && $condicao != NULL):
            // não está utilizando a variavel condição
            $exibir = ($dados['exibir']) ? $dados['exibir'] : 0 ;

        $sql =  'UPDATE assunto 
                    SET 
                    dsc_assunto = ' . "'" . $dados['dsc_assunto'] . "' ," .
                   ' dsc_conceito = ' . "'" . addslashes($dados['dsc_conceito']). "' ," .
                   ' exibir = ' . $exibir .
                   ' WHERE id_assunto = ' . $condicao['id'];
                $this->db-> query($sql);

            $this->session->set_flashdata('excluirok','Acordo atualizado com sucesso!!!');
            redirect('assunto/update/'.$condicao['id']);
        endif;
    }


    public function do_delete($id){

        //apaga dados de oc_cs_ocorrencias
        $dbRet = $this->db->delete('assunto', array('id_assunto' => $id));

        if( !$dbRet ){
            $this->session->set_flashdata('excluirNOK','Não foi possível excluir o registro. 
                                         Existem ocorrência(s) que dependem deste acordo. 
                                         É necessário excluir estas ocorrência(s) para continuar.');
        }else{
            $this->session->set_flashdata('excluirok','Registro excluído com sucesso!!!');
        }

        redirect('assunto/retrieve');
    }
    
    public function get_all(){
          $query = 'SELECT id_assunto, dsc_assunto FROM assunto ORDER BY dsc_assunto';     
         
        return $this->db->query($query);
    }

    public function get_conceitos(){
          $query = 'SELECT 
                    id_assunto, 
                    dsc_assunto,
                    dsc_conceito,
                    dsc_file
                    FROM assunto 
                    WHERE exibir =1 
                    ORDER BY dsc_assunto ';     
         
        return $this->db->query($query);
    }
    
    public function get_conceito_by_id($id){
          $query = 'SELECT 
                    id_assunto, 
                    dsc_assunto,
                    dsc_conceito,
                    dsc_file
                    FROM assunto WHERE id_assunto = ' . $id ;     
         
        return $this->db->query($query);
    }
    
    
    public function get_byid($id) {
        $query = 'SELECT id_assunto, dsc_assunto, dsc_conceito, dsc_file, exibir FROM assunto
                  WHERE id_assunto = ' . $id ; 

        return $this->db->query($query);
    }

}

