<?php

class Periodo_model extends CI_Model{
    
    public function do_insert($dados=NULL){            
        
        if ($dados != NULL):
            $this->db->insert('periodo',$dados);
            $this->session->set_flashdata('cadastrook','Cadastro efetuado com sucesso');
            redirect('periodo/create');
        endif;
            
    }
    
    public function do_update($dados=NULL, $condicao=NULL){


        if ($dados != NULL && $condicao != NULL):
            // não está utilizando a variavel condição
        // pd($dados['id_assunto']);

        $sql =  'UPDATE periodo 
                    SET dsc_periodo = ' . "'" . $dados['dsc_periodo'] . "'" .
                ' WHERE id_periodo = ' . $dados['id_periodo'];

                $this->db-> query($sql);

            $this->session->set_flashdata('edicaook','Período atualizado com sucesso!!!');
            redirect(current_url());
        endif;
    }
    
    public function get_all(){

          $query = 'SELECT id_periodo, dsc_periodo FROM periodo';     
         
        return $this->db->query($query);
    }
    
    
    public function get_byid($id) {
        $query = 'SELECT id_periodo, dsc_periodo FROM periodo 
                  WHERE id_periodo = ' . $id ; 

        return $this->db->query($query);
    }

}

