<?php

class Usuario_model extends CI_Model{
    
    public function do_insert($dados=NULL){            
        
        if ($dados != NULL):
            $this->db->insert('users',$dados);
            $this->session->set_flashdata('cadastrook','Cadastro efetuado com sucesso. <br>Um e-mail contendo informações de acesso foi enviado para o usuário.');
            redirect('usuario/create');
        endif;
            
    }
    
    public function do_update($dados=NULL, $condicao=NULL){
        if ($dados != NULL && $condicao != NULL):
            $this->db->update('users',$dados, $condicao);
            $this->session->set_flashdata('edicaook','Usuário atualizado com sucesso');
            redirect(current_url());
        endif;
    }

    public function do_delete($id){

        $dbRet = $this->db->delete('users', array('id' => $id));

        if( !$dbRet ){
            $this->session->set_flashdata('excluirNOK','Não foi possível excluir o registro. 
                                         Existem ocorrência(s) que dependem deste acordo. 
                                         É necessário excluir estas ocorrência(s) para continuar.');
        }else{
            $this->session->set_flashdata('excluirok','Registro excluído com sucesso!!!');
        }

        redirect('usuarios');
    }
    
    public function get_all(){
          $query = 'SELECT id, username, u.dsc_name as nome, dsc_matricula, r.dsc_name as role, ativo as status FROM users u
                    INNER JOIN user_roles r ON u.id_user_roles = r.id_user_roles ORDER BY u.dsc_name';     
         
        return $this->db->query($query);
    }
    
    
    public function get_byid($id) {
        $query = 'SELECT id, username, u.dsc_name as nome, dsc_matricula, u.id_user_roles , r.dsc_name as role, ativo as status, email FROM users u
                  INNER JOIN user_roles r ON u.id_user_roles = r.id_user_roles
                  WHERE id = ' . $id ; 

        return $this->db->query($query);
    }

    public function get_email_byid($id) {
        $query = 'SELECT email FROM users
                  WHERE username = "' . $id . '"' ; 

        return $this->db->query($query);
    }

    public function reset_senha($id){
        $pass = md5(123); // senha 123

        $query = "UPDATE users
                  SET password = " . "'" . $pass ."'" .
                 ' WHERE id = ' . $id;

        $this->db->query($query);
    }

    public function reset_senha_by_username($id, $senha){
        $pass = md5($senha);

        $query = "UPDATE users
                  SET password = " . "'" . $pass ."'" .
                 ' WHERE username = "' . $id . '"' ; 

        $this->db->query($query);
    }
    
    public function trocar_senha($username, $nova_senha){


        $pass = md5($nova_senha); //criptografa senha em md5

        $query = "UPDATE users
                  SET password = " . "'" . $pass ."'" .
                 ' WHERE username = '. "'" . $username ."'";

        $this->db->query($query);
    }

    public function send_email($email, $senha, $tpass = NULL, $username = NULL, $name = NULL){

        $this->load->library('email');

            $config['protocol']='smtp';
            $config['smtp_host']='smtp.bflabs.com.br';
            $config['smtp_port']='587';
            $config['smtp_timeout']='60';
            $config['smtp_user']='contato@bflabs.com.br';
            $config['smtp_pass']='bru198607';
            $config['charset']='utf-8';
            $config['mailtype'] = 'html';

            $this->email->initialize($config);
            
            if ($tpass == 'new_user') {
                $this->email->from('contato@bflabs.com.br', 'Novo Usuário | COE - Flexibilidade');
                $this->email->message("Parabéns $name, 
                                        <br><br>seu usuário COE - Flexibilidade foi criado com sucesso!!!. 
                                        <br> Seu ID de acesso é: $username <br> Sua nova senha é: $senha <br> <br>
                                        Favor alterá-la por questões de segurança<br><br>
                                        <a href='http://bflabs.com.br/cnhind/'' title=>Clique aqui para acessar COE - Flexibilidade</a>");
            }else{
                $this->email->from('contato@bflabs.com.br', 'Lembrar Senha | COE - Flexibilidade');
                $this->email->message("Sua nova senha é: $senha <br> Favor alterá-la por questões de segurança");
            }
            $this->email->to($email); 
            $this->email->subject('Nova mensagem enviada do site');
            $this->email->send();
    }
}

