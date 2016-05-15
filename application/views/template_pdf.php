<?php 

	if(isset($tela)):
			$this->load->view('pdf/head_pdf');
	        $this->load->view('pdf/'.$tela);
	endif;
