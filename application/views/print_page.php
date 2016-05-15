<?php
// esta página será utilizada para gerar todo conteudo de todos os controllers, EXCETO O CONTROLLER HOME
// ou seja, apenas os controllers utilizados nos conteudos das abas

if( isset($pasta) && isset($tela)):
        $this->load->view('transactions/' .$pasta .'/'.$tela);
endif;