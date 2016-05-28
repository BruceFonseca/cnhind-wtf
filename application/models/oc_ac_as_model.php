<?php

class Oc_ac_as_model extends CI_Model{
    
    public function do_insert($data=NULL, $id_ocorrencia){        
        //transforma o objeto em array
        if (is_object($data)) {
                $dados = get_object_vars($data);
                unset($dados['dados_acordo']);
        }

        foreach ($dados as $linha):
            $file = isset($linha->file)     ? $linha->file    : 'Não disponível';
            $sql = ' INSERT INTO oc_ac_as (id_ocorrencia, id_tratado, dsc_file, dsc_interpretacao)
                    VALUES('. $id_ocorrencia .', '. $linha->id . ', "'. $file .'", "'. $linha->interpretacao .'")';
            $this->db-> query($sql);
        endforeach;

    }

    public function do_delete($id=NULL){
        $sql = 'DELETE FROM oc_ac_as WHERE id_ocorrencia= '. $id;
        $this->db-> query($sql);
    }

    


}

