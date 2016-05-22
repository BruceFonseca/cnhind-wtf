<?php

class Planta_model extends CI_Model{
    
    public function do_insert($dados=NULL){            
        
        if ($dados != NULL):
            $this->db->insert('planta',$dados);
            $this->session->set_flashdata('cadastrook','Cadastro efetuado com sucesso');
            redirect('planta/create');
        endif;
            
    }
    
    public function do_update($dados=NULL, $condicao=NULL){


        if ($dados != NULL && $condicao != NULL):
            // não está utilizando a variavel condição
        // pd($dados['id_assunto']);

        $sql =  'UPDATE planta 
                    SET dsc_planta = ' . "'" . $dados['dsc_planta'] . "'" .
                ' WHERE id_planta = ' . $dados['id_planta'];

                $this->db-> query($sql);

            $this->session->set_flashdata('edicaook','Acordo atualizado com sucesso');
            redirect(current_url());
        endif;
    }

    public function do_delete($id){

        //apaga dados de oc_cs_ocorrencias
        $dbRet = $this->db->delete('planta', array('id_planta' => $id));

        if( !$dbRet ){
            $this->session->set_flashdata('excluirNOK','Não foi possível excluir o registro. 
                                         Existem ocorrência(s) que dependem deste planta. 
                                         É necessário excluir estas ocorrência(s) para continuar.');
        }else{
            $this->session->set_flashdata('excluirok','Registro excluído com sucesso!!!');
        }

        redirect('plantas');
    }
    
    public function get_all(){

          $query = 'SELECT id_planta, dsc_planta FROM planta ORDER BY dsc_planta';     
         
        return $this->db->query($query);
    }
    
    
    public function get_byid($id) {
        $query = 'SELECT id_planta, dsc_planta FROM planta 
                  WHERE id_planta = ' . $id ; 

        return $this->db->query($query);
    }

}

