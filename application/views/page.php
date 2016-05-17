<?php 
//esta página tem o objetivo de carregar solicitações feitas por ajax para

if( isset($pasta) && isset($tela)):
        $this->load->view('transactions/' .$pasta .'/'.$tela);
endif;