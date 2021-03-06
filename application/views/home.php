<?php

$this->load->view('includes/head_site');
$this->load->view('includes/header_site');
// $this->load->view('transactions/conteudo/conteudo'); //é a div que vai guardar o conteudo de todas as abas.
?>

   <div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <?php $this->load->view('includes/menu_sidebar'); ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
    			<span class="hamb-middle"></span>
				<span class="hamb-bottom"></span>
            </button>
            <div class="container">
                <div class="row">
                    <div class="col-lg-11 col-lg-offset-0">
                        <?php 
                        if( isset($pasta) && isset($tela)):
                                $this->load->view('transactions/' .$pasta .'/'.$tela);
                        endif;
                         ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Footer -->
    <?php $this->load->view('includes/footer_site'); ?>