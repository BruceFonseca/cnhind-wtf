
<div class='form'>
    <div class="buttons-controle">

    <?php 
    if ($status->dsc_file) {
        echo 
        '
        <a target="_blank"  data-toggle="tooltip" data-placement="top" data-original-title="Ver anexo"  href= "'. base_url().'uploads/'. $status->dsc_file . '">
        
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
            </button>   
            
        </a>

        ';
    }

    
    echo 
        '
        <a class="btn-print"  data-toggle="tooltip" data-placement="top" data-original-title="Imprimir"  target="_blank" href= "'. base_url('pdfgerar/pdf_conceito/'. $status->id_assunto). '">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
            </button>
        </a>
        ';
    
    echo 
        '
        <a class="btn-download" data-toggle="tooltip" data-placement="top" data-original-title="Salvar em PDF"  target="_blank" href= "'. base_url('pdfgerar/pdf_conceito/'. $status->id_assunto). '">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
            </button>
        </a>
        ';  
    echo 
        '
        <a data-toggle="tooltip" data-placement="top" data-original-title="Plantas com este acordo"  class="retrieve_by_acordo" href= "'. base_url('ocorrencia/retrieve_by_acordo/'. $status->id_assunto) .'">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            </button>
        </a>
        ';

 ?>
	
</div>
<?php

if($this->session->flashdata('excluirok')):
    echo '<p>'.$this->session->flashdata('excluirok').'</p>';
endif;

echo '<form class="ajax_form imprimir">';

echo form_fieldset( $status->dsc_assunto);

echo  validation_errors('<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>','</div>');

    echo 
    '
        <div class="" ctr="assunto/imprimir/'. $status->id_assunto .'">
          <!-- Default panel contents -->
          <div class="dsc_conceito">
            <p>'.
                // (urldecode($status->dsc_conceito))
                $status->dsc_conceito
            .'</p>
          </div>
        </div>
    ';

echo form_fieldset_close();
echo form_close();

?>

</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>                    
$(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });


     $('.retrieve_by_acordo').on('click',function(){
        var conceito = $('.ajax_form.imprimir fieldset legend').text();
        var desc = 'Plantas com ' + conceito;
        var controller = $(this).attr('ctr');
        var numTran = numTab();

        criarNovaAbaSemConteudo(controller, desc, numTran);

         $.ajax({
                type      : 'post',
                url       : controller, //é o controller que receberá
                // data      : 'id='+ id_ocorrencia,
                
                success: function( response ){
                        $('div[numtab="'+ numTran +'"]').append(response);
                }
            });

    });
    
    $('.btn-print').on('click', function(){

        var controller = $('.btn-print').attr('ctr');

         printPdf(controller);
    });

     $('.btn-download').on('click', function(){

        var controller = $('.btn-print').attr('ctr');
        printPdf(controller);

         
    });

    function printPdf(url) {
        
        $.ajax({
            url: url,
            success: function(data) {
                var blob=new Blob([data]);
                var link=data;
                link.click();
            }
        });
    }



</script>